@if($posts->count() > 0)
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Title</th>
        <th scope="col">Author</th>
        <th scope="col">Published</th>
      </tr>
    </thead>
    <tbody>
      @foreach($posts as $post)
        <tr>
          <td>
            <a href="#">{{ $post->title }}<a>
          </td>
          <td>{{ $post->user->name }}</td>
          <td>{{ $post->created_at->diffForHumans() }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {{ $posts->links() }}
@else
  <p>There are currently no posts.</p>
@endif