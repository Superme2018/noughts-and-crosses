<?php

namespace SuperMe2018\NoughtsAndCrosses;

use Illuminate\Support\ServiceProvider;

class NoughtsAndCrossesServiceProvider extends ServiceProvider
{

    public function boot(){}

    public function register(){

       // Not yet sure why this is needed. Package seems to work without it.
       $this->app->bind('noughts-and-crosses', function($app){
            return new NoughtsAndCrosses;
       });

    }

}
