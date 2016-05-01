<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	/**
	 * posts relationship - retrieve all posts for the category
     * 
	 * @return posts
	 */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * postsPublished relationship - retrieve only published posts for the category
     * 
     * @return published posts
     */
    public function postsPublished()
    {
       return $this->hasMany('App\Post')->published();
    }

    /**
     * getTitleAttribute make the first lettre of the title in uppercase
     * 
     * @param  string $value value
     * @return string the string with the first letter in uppercase
     */
    public function getTitleAttribute($value)
    {
    	return ucfirst($value);
    }
}
