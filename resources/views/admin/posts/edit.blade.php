@extends('layouts.app', ['notifications' => false])

@push('scripts')
<!-- CKEDITOR -->
<script src="https://cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
@endpush

@push('script')
CKEDITOR.replace('content');
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                  Edit | {{ $post->title }}
                  <a href="{{ route('posts.index') }}" class="btn btn-primary btn-sm float-right">Back</a>
                </div>

                <div class="card-body">
                  <form method="post" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" />
                      {!! $errors->has('title') ? $errors->first('title', '<p class="text-danger">:message</p>')  : '' !!}
                    </div>
                    <div class="form-group">
                      <label for="content">Content</label>
                      <textarea name="content" id="content" class="form-control" rows="10">{!! $post->content !!}</textarea>
                    </div>
                    @if($post->image)
                      <div>
                        <img src="{{ asset('storage/'.$post->image) }}" class="img-fluid" />
                      </div>
                    @endif
                    <div class="form-group">
                      <label for="image">Image</label>
                      <input type="file" name="image" id="img" class="form-control" />
                      {!! $errors->has('image') ? $errors->first('image', '<p class="text-danger">:message</p>')  : '' !!}
                    </div>
                    <div class="form-group">
                      @csrf
                      @method('PUT')
                      <button class="btn btn-primary">Update Post</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
