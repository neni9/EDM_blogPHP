<?php

use Illuminate\Database\Seeder;

class PictureTableSeeder extends Seeder
{

	private $faker;

	public function __construct(Faker\Generator $faker){
		$this->faker = $faker;
	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dirUpload = public_path(env('UPLOAD_PICTURE','uploads'));

        $files = File::allFiles($dirUpload);

        foreach ($files as $file) File::delete($file);

        $posts = \App\Post::all();

        foreach ($posts as $post) {
        	
        	$uri = str_random(50).'-370x235.jpg';
        	$id = rand(0,9);
        	$fileName = file_get_contents('http://lorempicsum.com/futurama/370/235/'.$id);

        	File::put(
        		$dirUpload.DIRECTORY_SEPARATOR.$uri,$fileName
        	);

        	$mime = mime_content_type($dirUpload.DIRECTORY_SEPARATOR.$uri);

        	// list($width,$height,$type,$attr) = getimagesize($fileName);

        	\App\Picture::create([
        		'post_id'  => $post->id,
        		'uri'      => $uri,
        		'name'     => $this->faker->name,
        		'mime'     => $mime,
        		'size'     => 200
        	]);
        }
        	
        
    }
}
