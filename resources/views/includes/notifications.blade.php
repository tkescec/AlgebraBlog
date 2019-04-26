<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      @foreach(Session::all() as $key => $message)
        @switch($key)
          @case('success')
          @case('danger')
          @case('info')
          @case('warning')
            <div class="alert alert-{{ $key }}" role="alert">
              <h4>{{ ucfirst($key) }}</h4>
              {!! $message !!}
            </div>
            @break
          @default
        @endswitch
      @endforeach
    </div>
  </div>
</div>