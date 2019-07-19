@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Tutti i post</h1>
    <a class="btn btn-primary" href="{{ route('admin.posts.create')}}">
      Scrivi un nuovo articolo
    </a>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Titolo</th>
          <th>Autore</th>
          <th>Slug</th>
          <th>Categoria</th>
          <th>Tag</th>
          <th>Creato il</th>
          <th>Modificato il</th>
          <th>Azioni</th>
        </tr>
      </thead>
    @forelse ($posts as $post)
      <tr>
        <td>{{ $post->id }}</td>
        <td>{{ $post->title }}</td>
        <td>{{ $post->author }}</td>
        <td>{{ $post->slug }}</td>
        <td>{{ !empty($post->category) ? $post->category->name : '-' }}</td>
        <td>
          @if(($post->tags)->isNotEmpty())
            @foreach ($post->tags as $singolo_tag_di_questo_post)
              {{ $singolo_tag_di_questo_post->name }}@if(!$loop->last), @endif
            @endforeach
          @else
            -
          @endif
        </td>
        <td>{{ $post->created_at }}</td>
        <td>{{ $post->updated_at }}</td>
        <td>
          <a class="btn btn-info" href="{{ route('admin.posts.show', $post->id) }}">Visualizza</a>
          <a class="btn btn-warning" href="{{ route('admin.posts.edit', $post->id) }}">Modifica</a>
          <form action="{{ route('admin.posts.destroy', $post->id) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger" value="Cancella">
          </form>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="8">Non ci sono post</td>
      </tr>
    @endforelse
  </table>
  </div>

@endsection
