<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
      $posts = Post::isPublic()->orderBy('title', 'ASC')->paginate(15);
      $authors = DB::table('posts')->select('author')->distinct()->get();
      return view('home')->with([
        'posts' => $posts,
        'authors' => $authors
      ]);
    }
}
