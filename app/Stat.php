<?php

namespace App;

use App\Post;
use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
	/**
	 * The attributes that are mass assignable.
	 * 
	 * @var array
	 */
	 protected $fillable = [
        'post_id', 
        'note',
        'user_id'
    ];

    /**
     * posts relationship
     * 
     * @return relation
     */
    public function posts()
    {
        return $this->hasOne('App\Post');
    }
}
