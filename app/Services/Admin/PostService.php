<?php

namespace App\Services\Admin;

use Auth;
use Exception;
use Storage;
use App\Models\Post;

class PostService
{
  /**
   * Get all posts.
   *
   * @return View
   */
  public function showPosts()
  {
    // Get current user id
    $currentUserId = Auth::user()->id;
    // Fetch posts from database
    $posts = Post::where('user_id', $currentUserId)->orderBy('created_at', 'DESC')->with('user')->paginate(10);
    
    return view('admin.posts.index')->with('posts',$posts);
  }
  
  /**
   * Show the form for creating a new post.
   *
   * @return View
   */
  public function createPost()
  {
    return view('admin.posts.create');
  }
  
  /**
   * Store a newly created post in storage.
   *
   * @param  \App\Http\Requests\PostRequest  $request
   * @return Redirect
   */
  public function storePost($request)
  {
    // Get current user id
    $currentUserId = Auth::user()->id;
    // Check if user upload an image
    if($request->file('image')){
      // Define post image directory
      $dir = 'images/'.$currentUserId.'/posts';
      // Get all public directories
      $existingDirs = Storage::disk('public')->allDirectories();
      // Create image directory if not exist
      if(!in_array($dir, $existingDirs)){
        Storage::disk('public')->makeDirectory($dir);
      }
      
      // Store image to public disk and return image path
      $path =  $request->file('image')->store($dir, 'public');
    }
    // Fill array with data from request
    $data = [
      'title'   => trim($request->get('title')),
      'content' => $request->get('content'),
      'image'   => isset($path) ? $path : '',
      'user_id' => $currentUserId
    ];

    // Instance post model
    $post = new Post();
    // Save new post
    try{
      $postId = $post->savePost($data)->id;
    } catch(Exception $e){
      session()->flash('danger', $e->getMessage());
      return redirect()->back();
    }
    
    session()->flash('success', 'You have successfully added a new post.');
    return redirect()->route('posts.index');
  }
  
  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Post  $post
   * @return View
   */
  public function showPost($post)
  {
    return view('admin.posts.show')->with('post', $post);
  }
  
  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Models\Post  $post
   * @return View
   */
  public function editPost($post)
  {
    return view('admin.posts.edit')->with('post', $post);
  }
  
  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Http\Requests\PostRequest  $request
   * @param  \App\Models\Post  $post
   * @return Redirect
   */
  public function updatePost($request, $post)
  {
    // Check if user upload an image
    if($request->file('image')){
      // Define post image directory
      $dir = 'images/'.$post->user_id.'/posts';
      // Delete old post image
      if($post->image){
        Storage::disk('public')->delete($post->image);
      } else {
        // Get all public directories
        $existingDirs = Storage::disk('public')->allDirectories();
        // Create image directory if not exist
        if(!in_array($dir, $existingDirs)){
          Storage::disk('public')->makeDirectory($dir);
        }
      }
      
      // Store image to public disk and return image path
      $path =  $request->file('image')->store($dir, 'public');
    }
    
    // Fill array with data from request
    $data = [
      'title'   => trim($request->get('title')),
      'content' => $request->get('content'),
      'image'   => isset($path) ? $path : ''
    ];
    
    try{
      $post->updatePost($data);
    } catch(Exception $e){
      session()->flash('danger', $e->getMessage());
      return redirect()->back();
    }
    
    session()->flash('success', 'Post <b>' . $post->title . '</b> has been successfully updated.');
    return redirect()->route('posts.index');
  }
  
  
  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Post  $post
   * @return Recirect
   */
  public function deletePost($post)
  {
    // Delete post
    try{
      // Delete post image
      if($post->image){
        Storage::disk('public')->delete($post->image);
      }
      $post->delete();
    } catch(Exception $e){
      session()->flash('danger', $e->getMessage());
      return redirect()->back();
    }
    
    session()->flash('success', 'You have successfully deleted a post.');
    return redirect()->route('posts.index');
  }
}







