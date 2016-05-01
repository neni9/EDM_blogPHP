<?php

namespace App\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('tags',function($attribute, $value, $parrameters, $validator)
        {
            if(!is_array($value)) return false;

            foreach ($value as $tagId) 
                if(!is_numeric($tagId)) return false;

            return true;
        });

        Validator::replacer('tags',function($message, $attribute, $rule, $parameters){
            
            return sprintf("Il y a un problème avec l'attribut %s, contactez l'admin.",$attribute);
        });


    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
