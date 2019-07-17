@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Tutti i post</h1>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Titolo</th>
          <th>Autore</th>
          <th>Slug</th>
          <th>Categoria</th>
          <th>Creato il</th>
          <th>Modificato il</th>
        </tr>
      </thead>
    @forelse ($posts as $post)
      <tr>
        <td>{{ $post->id }}</td>
        <td>{{ $post->title }}</td>
        <td>{{ $post->author }}</td>
        <td>{{ $post->slug }}</td>
        <td>{{ !empty($post->category) ? $post->category->name : '-' }}</td>
        <td>{{ $post->created_at }}</td>
        <td>{{ $post->updated_at }}</td>
      </tr>
    @empty
      <p>Non ci sono post</p>
    @endforelse
  </table>
  </div>

@endsection
