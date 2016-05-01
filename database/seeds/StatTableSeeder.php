 <?php

use App\Stat;
use App\Post;
use Illuminate\Database\Seeder;

class StatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
		$datas = [
		            [
		                'post_id' => 1,
		                'note'    => 14,
		                'user_id' => 1
		            ],
		            [
		                'post_id' => 1,
		                'note'    => 7,
		                'user_id' => 3
		            ],
		            [
		                'post_id' => 2,
		                'note'    => 12,
		                'user_id' => 1
		            ],
		            [
		                'post_id' => 3,
		                'note'    => 10,
		                'user_id' => 3
		            ],
		            [
		                'post_id' => 3,
		                'note'    => 11,
		                'user_id' => 2
		            ],[
		                'post_id' => 4,
		                'note'    => 4,
		                'user_id' => 1
		            ],
		            [
		                'post_id' => 4,
		                'note'    => 17,
		                'user_id' => 3
		            ],
		            [
		                'post_id' => 5,
		                'note'    => 19,
		                'user_id' => 1
		            ],
		            [
		                'post_id' => 5,
		                'note'    => 17,
		                'user_id' => 2
		            ]
				];

		foreach ($datas as $data) {
			$stat = Stat::create($data);

			 $post = Post::findOrFail($stat->post_id);

	        if(!is_null($post->stats)){

	            $sum = 0;

	            foreach ($post->stats as $stat) 
	                $sum += $stat->note;

	            $post->score_avg = $sum/count($post->stats);
	            $post->rate += 1;
	            $post->save();
	        }
		}
    }
}
