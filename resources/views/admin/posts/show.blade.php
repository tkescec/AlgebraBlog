@extends('layouts.app', ['notifications' => false])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                  {{ $post->title }}
                  <a href="{{ route('posts.index') }}" class="btn btn-primary btn-sm float-right">Back</a>
                </div>

                <div class="card-body">
                  <h1>{{ $post->title }}</h1>
                  <time>{{ date('d.m.Y.', strtotime($post->created_at)) }}</time>
                  
                  @if($post->image)
                    <p>
                      <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid" />
                    </p>
                  @endif
                  @if($post->content)
                   {!! $post->content !!}
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
