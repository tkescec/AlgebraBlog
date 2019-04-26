<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\PostService;
use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
  /** @var App\Services\Admin\PostService */
  protected $postService;
  
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(PostService $postService)
  {
    // Middleware
    $this->middleware('auth');
    // Dependency Injection
    $this->postService = $postService;
  }
  
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return $this->postService->showPosts();
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return $this->postService->createPost();
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Http\Requests\PostRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function store(PostRequest $request)
  {
    return $this->postService->storePost($request);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function show(Post $post)
  {
    return $this->postService->showPost($post);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function edit(Post $post)
  {
    return $this->postService->editPost($post);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\PostRequest  $request
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function update(PostRequest $request, Post $post)
  {
    return $this->postService->updatePost($request, $post);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function destroy(Post $post)
  {
    return $this->postService->deletePost($post);
  }
}
