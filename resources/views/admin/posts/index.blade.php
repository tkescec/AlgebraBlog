@extends('layouts.app', ['notifications' => true])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                  All Posts
                  <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm float-right">Create New</a>
                </div>

                <div class="card-body">
                  @if($posts->count() > 0)
                    <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">Title</th>
                          <th scope="col">Author</th>
                          <th scope="col">Published</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($posts as $post)
                          <tr>
                            <td>
                              <a href="{{ route('posts.show', $post) }}">{{ $post->title }}<a>
                            </td>
                            <td>{{ $post->user->name }}</td>
                            <td>{{ $post->created_at->diffForHumans() }}</td>
                            <td>
                              <a href="{{ route('posts.edit', $post) }}" class="btn btn-primary btn-sm">Edit</a>
                              <form method="post" action="{{ route('posts.destroy', $post) }}" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Delete</button>
                              </form>
                              
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  @else
                    <p>There are currently no posts.</p>
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
