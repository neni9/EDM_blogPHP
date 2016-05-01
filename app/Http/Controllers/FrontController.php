<?php

namespace App\Http\Controllers;

use View;
use App\Post;
use Auth;
use App\Score\Score;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    private $paginate = 10;

    /**
     * home page of the blog
     * 
     * @param  Score  $score score class 
     * @return view   front.index
     */
    public function index(Score $score)
    {
        $title = "Home";

        $best = $score->get();

        if(!empty($best)){

            $posts    = Post::with('category', 'user', 'tags' ,'picture')
                        ->published()
                        ->OrderByPublished()
                        ->OrderByScore()
                        ->whereNotIn('id', [$best->id])
                        ->paginate($this->paginate);
        }
        else
        {
            $posts    = Post::with('category', 'user', 'tags' ,'picture')
                        ->published()
                        ->OrderByPublished()
                        ->OrderByScore()
                        ->paginate($this->paginate);
        }

        return view('front.index', compact('posts', 'title','best'));
    }

    /**
     * showPost display the detail of a post
     * 
     * @param  [integer] $id [a post id]
     * @return [view]     [front.show]
     */
    public function showPost($id)
    {
        $post       = Post::findOrFail($id);
        $title      = $post->name;

        return view('front.show', compact('post', 'title'));
    }

    /**
     * showPostByCat display all posts that belongs to a category (id)
     * 
     * @param  integer $id id de la catégorie
     * @return view     front.category
     */
    public function showPostByCat($id)
    {
        $category   = Category::findOrFail($id);
        $title      = $category->title;
        $posts      = $category->postsPublished;

        return view('front.category', compact('posts', 'title'));
    }


}
