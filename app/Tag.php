<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	/**
	 * posts relationship
	 * 
	 * @return relation
	 */
    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }

    /**
     * getNameAttribute get formated name
     * 
     * @param  string $value 
     * @return string the formatted string
     */
    public function getNameAttribute($value)
    {
    	return ucfirst($value);
    }
}
