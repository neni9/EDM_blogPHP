<?php
namespace App\Score;

use DB;
use App\Post;

class Score
{
    /**
     * $post
     * 
     * @var Post $post
     */
    private $post;

    /**
     * __construct 
     * 
     * @param Post $post 
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * get  get the post which have the best score and numbers of rates.
     * 
     * @return [Post | false ]
     */
    public function get()
    {
        $bestPost   = DB::select( DB::raw("
            SELECT id 
            FROM posts 
            WHERE status = :status
            ORDER BY score_avg DESC, rate DESC 
            LIMIT 1"), 
            ['status' => 'published']);

        if(!empty($bestPost))
            return Post::findOrFail($bestPost[0]->id);  

        else
            return false;
    }
}

