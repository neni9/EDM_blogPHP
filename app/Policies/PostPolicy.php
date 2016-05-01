<?php

namespace App\Policies;

use App\Post;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(){}

    /**
     * Policy update - only accept update of a post from administrators or owner of it
     * 
     * @param  User   $user 
     * @param  Post   $post 
     * @return [boolean]       
     */
    public function update(User $user, Post $post)
    {
        return $user->isAdmin() || $user->ownPost($post);
    }

    /**
     * Policy destroy - only accept deleting post from administrators or owner of it
     * 
     * @param  User   $user 
     * @param  Post   $post 
     * @return [boolean]       
     */
    public function destroy(User $user, Post $post)
    {
       return $user->isAdmin() || $user->ownPost($post);
    }

    /**
     * authorizeRate call the method hasRated of the User Model to check if a user has already rated a post
     * 
     * @param  User   $user 
     * @param  Post   $post 
     * @return [boolean]    
     */
    public function authorizeRate(User $user, Post $post)
    {
       return $user->hasRated($user,$post);
    }

}
