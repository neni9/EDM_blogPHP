<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
	/**
	 * The attributes that are mass assignable.
     * 
	 * @var array
	 */
    protected $fillable = ['name','uri','post_id','size','mime'];

    /**
     * posts relationship
     * 
     * @return posts relationship
     */
    public function posts()
    {
        return $this->hasOne('App\Post');
    }
}
