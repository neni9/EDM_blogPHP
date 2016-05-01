<?php

namespace App\Http\Controllers;

use Auth;
use View;
use File;
use App\Tag;
use App\Stat;
use App\Post;
use App\Picture;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;


class PostController extends Controller
{
    /**
     * $paginate (10 posts by pages)
     * 
     * @var integer
     */
    private $paginate = 10;

    /**
     * __construct 
     * 
     */
    public function __construct(){}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts                = Post::with('category', 'user', 'tags')
                                    ->OrderByPublished()
                                    ->OrderByScore()
                                    ->paginate($this->paginate);
        $title                = 'Liste des articles';
        $total                = [];
        $total['published']   = Post::where('status','=','published')->count();
        $total['unpublished'] = Post::where('status','=','unpublished')->count();

        return view('admin.post.index',compact('posts','title','total'));
    }

    /**
     * deletePicture Delete a picture attached to a post
     * 
     * @param  Post   $post 
     * @return [boolean]       
     */
    private function deletePicture(Post $post,$delFromDb = true)
    {
        if(!is_null($post->picture)){
            $fileName = public_path('uploads') . DIRECTORY_SEPARATOR . $post->picture->uri;

            if(File::exists($fileName))
                File::delete($fileName);
            
            if($delFromDb)
                $post->picture()->delete();

            return true;
        }

        return false;
    }

    /**
     * upload Upload an image
     * 
     * @param  [type] $im     
     * @param  [type] $name   
     * @param  [type] $postId 
     * @return [type]         
     */
    private function upload($im,$name,$postId)
    {    
        $ext = $im->getClientOriginalExtension();   
        $uri = str_random(50).'.'.$ext;     
        Picture::create([
            'name'    => $name,
            'uri'     => $uri, 
            'size'    => $im->getSize(),
            'mime'    => $im->getClientMimeType(),
            'post_id' => $postId
        ]);

        $im->move(env('UPLOAD_PICTURES','uploads'),$uri);

        return true;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title      = "Ajouter un article";
        $categories = Category::lists('title', 'id');
        $tags       = Tag::lists('name','id');
        $userId     = Auth::user()->id;

        return view('admin.post.create',compact('title','categories','tags','userId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post   = Post::create($request->all());

        if(!empty($request->input('tags_id')))
            $post->tags()->attach($request->input('tags_id'));


        if(!is_null($request->file('picture')))
            $this->upload($request->file('picture'), $request->input('picture_name'),$post->id );

        return redirect('post/')->with('message', 'success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post       = Post::findOrFail($id);
        $title      = 'Editer un article';
        $categories = Category::lists('title', 'id');
        $tags       = Tag::lists('name','id');
        $userId     = Auth::user()->id;

        return view('admin.post.edit',compact('post','title','categories','tags','userId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $messages = [];

        $post = Post::findOrFail($id);
        $post->update($request->all());

        $messages[] = sprintf("L'article a été mis à jour.");

        $tags = empty($request->get('tags_id')) ? [] : $request->get('tags_id');
        $post->tags()->sync($tags);


        if($request->input('deleteImage') == "on"){

                $this->deletePicture($post);

                $messages[] = sprintf("L'ancienne image a été supprimée avec succès.");
        }

        else if($request->file('picture')){

                $this->deletePicture($post);
                $this->upload($request->file('picture'), $request->input('picture_name'),$post->id);

                $messages[] = sprintf("La nouvelle image a été uploadé avec succès.");
        }

        else if(!$request->file('picture') && $post->picture && !empty($request->input('picture_name'))){

            $picture       = Picture::findOrFail($post->picture->id);
            $picture->name = $request->input('picture_name');

            $picture->save();

            $messages[] = sprintf("Le nom de l'image associé à l'article %s a été mis à jour.",$post->title);
        }
        
        return redirect('post/')->with('message', $messages);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post  = Post::findOrFail($id);
        $title = $post->title;
        
        $post->delete();
        $this->deletePicture($post,false);
        
        return redirect('post')->with('message', sprintf("Votre ressource %s a bien été supprimée.",$title));
    }

}