<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\Post::class, 50)->create()->each(function($post){
                $post->tags()->attach(range(1, rand(1,7)));
        });
    }
}
