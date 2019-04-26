<?php

namespace App\Services\Admin;

use Illuminate\View\Factory;
use App\Models\Post;
use App;

class AllPostsService
{
  protected $view;
  
  public function __construct(Factory $view)
  {
    $this->view = $view;
  }
  
  public function generate()
  {
    $posts = Post::orderBy('created_at', 'DESC')->paginate(10);
    
    $html = $this->view->make('includes.allPosts', ['posts'=>$posts])->render();
    
    return $html;
  }
}


