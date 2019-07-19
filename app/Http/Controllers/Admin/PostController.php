<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
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
        $tutti_i_tags = Tag::all();
        return view('admin.posts.create')->with([
          'categories' => $categories,
          'tags' => $tutti_i_tags
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
        // recupero la categoria selezionata
        $category = Category::find($dati['category_id']);
        // verifico se l'id della categoria ricevuto dal post corrisponde ad una categoria realmente esistente
        if(empty($category)) {
          // non esiste una categoria con l'id selezionato
          // => tolgo il category_id dai dati "fillable"
          unset($dati['category_id']);
        }
        $newPost = new Post();
        $newPost->fill($dati);
        $newPost->save();
        $newPost->tags()->sync($dati['tag_ids']);
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
