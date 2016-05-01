<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use View;
use App\Category;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * __construct Controller constructeur
     */
    public function __construct(){
        
        View::composer(['front.partials.nav',],function($view){

            $categories = Category::lists('title', 'id');
            $view->with(compact('categories'));
            
        });

    }
}
