@extends('layouts.app')

@section('content')
  <div class="container">
    <ul>
      <h1>Tutti i post della categoria {{ $category->name }}</h1>
      @forelse ($posts as $post)
        <li>
          <a href="{{ route('posts.show', $post->slug )}}">{{ $post->title }}</a>,
          di {{ $post->author }}, del {{ $post->created_at }}
        </li>
      @empty
        <p>Non ci sono post</p>
      @endforelse
    </ul>
  </div>

@endsection
