<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    /**
     * The attributes that are mass assignable.
     * 
     * @var array
     */
    protected $fillable = [
        'title', 
        'content',
        'published_at',
        'category_id',
        'status',
        'user_id',
        'score_avg'
    ];

    /**
     * $dates
     * 
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * category relationship
     * 
     * @return relation
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * user relationship
     * 
     * @return relation
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * tags relationship
     * 
     * @return relation
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    /**
     * stats relationship
     * 
     * @return relation
     */
    public function stats()
    {
        return $this->hasMany('App\Stat');
    }

    /**
     * picture relationship
     * 
     * @return relation
     */
    public function picture()
    {
        return $this->hasOne('App\Picture');
    }
    
    /**
     * scopePublished filter posts by status published
     * 
     * @param  string $query query of the post
     * @return filtered query        
     */
    public function scopePublished($query)
    {   
        return $query->where('status','=','published');
    } 

    /**
     * scopeOrderByPublished order posts by status published
     * 
     * @param  string $query query of the post
     * @return filtered query        
     */
    public function scopeOrderByPublished($query)
    {
        return $query->orderBy('published_at', 'desc');
    } 

    /**
     * scopeOrderByScore order posts by score
     * 
     * @param  string $query query of the post
     * @return filtered query        
     */
    public function scopeOrderByScore($query)
    {
        return $query->orderBy('score_avg', 'desc');
    } 

    /**
     * setCategoryIdAttribute 
     * 
     * @param $value || null
     */
    public function setCategoryIdAttribute($value)
    {
        $this->attributes['category_id'] = ($value == 0) ? null : $value;
    }

    /**
     * getStatusAttribute get formatted status with first letter in uppercase
     * 
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * hasTag add "selected" in the option selected
     * 
     * @param  integer  $id id of the tag to check
     * @return boolean 
     */
    public function hasTag($id)
    {
        if(is_null($this->tags)) return false;

        foreach ($this->tags as $tag) 

            if($tag->id == $id)return true;

        return false;
    }

    /**
     * hasCat add "selected" to the categorie
     * 
     * @param  integer  $id id of the cat to check
     * @return boolean    
     */
    public function hasCat($id)
    {
        if(is_null($this->category_id)) return false;

        if($this->category_id == $id)
            return true;

        return false;
    }


}
