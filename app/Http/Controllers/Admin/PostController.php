<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create')->with([
          'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:posts|max:255',
            'content' => 'required',
            'author' => 'required',
            'category_id' => 'required'
        ]);
        $dati = $request->all();
        $dati['slug'] = Str::slug($dati['title']);
        $newPost = new Post();
        $newPost->fill($dati);
        $newPost->save();

        return redirect()->route('admin.posts.index');
    }

    public function show($id)
    {
        return 'pagina di visualizzazione singolo post backend. Il post da visualizzare ha id '. $id;
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
