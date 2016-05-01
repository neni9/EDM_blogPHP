<?php

namespace App;

use Auth;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * posts relationship
     * 
     * @return relation
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * hasRated description
     * 
     * @param  User    $user 
     * @param  Post    $post 
     * @return boolean       
     */
    public function hasRated(User $user,Post $post)
    {
        if(is_null($post->stats)) return false;

        foreach ($post->stats as $stat)
            if($stat->user_id == $user->id)
                return false;

        return true;
    }

    /**
     * isAdmin check if a user has the role administrator
     * 
     * @return boolean 
     */
    public function isAdmin()
    {
        return ($this->role === 'administrator') ? true : false; 
    }

    /**
     * isEditor check if a user has the role editor
     * 
     * @return boolean 
     */
    public function isEditor()
    {
        return ($this->role === 'editor') ? true : false; 
    }

    /**
     * ownPost check if a user has write a post 
     * @param  Post   $post post to check
     * @return boolean
     */
    public function ownPost(Post $post)
    {
        return ($post->user_id === $this->id) ? true : false; 
    }
}
