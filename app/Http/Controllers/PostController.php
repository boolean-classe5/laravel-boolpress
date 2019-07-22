<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function show($slug) {
      $post = Post::where('slug', $slug)->first();
      if(empty($post)) {
        abort(404);
      }
      return view('posts.show', compact('post'));
    }

    public function postInCategory($slug) {

      // parto dalla categoria e ne recupero i relativi post

      $category = Category::where('slug', $slug)->first();
      if(empty($category)) {
        abort(404);
      }
      /*
      $posts = $category->posts;
      */

      // parto dai post e filtro per categoria
      $posts = DB::table('posts')
      ->join('categories', 'posts.category_id', '=', 'categories.id')
      ->where('categories.slug', $slug)
      ->get();

      return view('posts.category')->with([
        'posts' => $posts,
        'category' => $category
      ]);
    }

    public function filterPostsByAuthor(Request $request) {
      $author = $request->input('author');
      return redirect()->route('posts.author', $author);
    }

    public function postByAuthor($author) {
      $posts = Post::byAuthor($author)->get();
      return view('posts.author')->with([
        'author' => $author,
        'posts' => $posts
      ]);
    }
}
