@extends('layouts.app')

@section('content')
  <div class="container">
    <ul>
      <h1>Tutti i post</h1>
      @forelse ($posts as $post)
        <li>
          <a href="{{ route('posts.show', $post->slug)}}">{{ $post->title }}</a>,
          di {{ $post->author }}, del {{ $post->created_at }}
          <em>
            @if (!empty($post->category))
              (<a href="{{ route('posts.category', $post->category->slug)}}">{{$post->category->name}}</a>)
            @else
              (category n.a.)
            @endif
          </em>
          @if(($post->tags)->isNotEmpty())
            - TAG:
            @foreach ($post->tags as $tag)
                {{$tag->name}}@if(!$loop->last) / @endif
            @endforeach
          @endif
        </li>
      @empty
        <p>Non ci sono post</p>
      @endforelse
    </ul>
  </div>

@endsection
