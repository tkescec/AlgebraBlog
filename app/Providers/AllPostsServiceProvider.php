<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use App\Services\Admin\AllPostsService;

class AllPostsServiceProvider extends ServiceProvider
{
  
  protected $defer = false;
  
  /**
   * Register services.
   *
   * @return void
   */
  public function register()
  {
    $this->app->singleton('allposts', function($app){
      return new AllPostsService($app->view);
    });
  }

  /**
   * Bootstrap services.
   *
   * @return void
   */
  public function boot()
  {
    AliasLoader::getInstance()->alias('AllPosts', 'App\Facades\AllPosts');
  }
}
