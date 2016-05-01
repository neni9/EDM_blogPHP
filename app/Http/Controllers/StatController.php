<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Stat;
use App\Post;
use App\Http\Requests;
use App\Http\Requests\PostRequest;

class StatController extends Controller
{

    /**
     * storeRateAverage save the rating average in the post
     * 
     * @param  [integer] $postId [id of the post]
     * @return [boolean]         
     */
    public function storeRateAverage($postId)
    {
        $post = Post::findOrFail($postId);

        if(!is_null($post->stats)){

            $sum = 0;

            foreach ($post->stats as $stat) 
                $sum += $stat->note;

            $post->score_avg = $sum/count($post->stats);
            $post->rate += 1;
            $post->save();
        }
        
        return true;
    }
    
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function rate(Request $request)
    {
        $stat   = Stat::create([
            'post_id' => $_POST['post_id'],
            'note'    => $_POST['note'],
            'user_id' => Auth::user()->id
            ]);

        $this->storeRateAverage($_POST['post_id']);
        
        return "OK";
     
    }

}
