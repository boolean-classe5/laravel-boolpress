<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Category;
use App\Tag;
use App\PostImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        // creo il nuovo post, assegno i valori e salvo a db
        $newPost = new Post();
        $newPost->fill($dati);
        $newPost->save();
        // salvo le associazioni con i tag selezionati dall'utente
        $newPost->tags()->sync($dati['tag_ids']);
        // salvo l'immagine di copertina caricata dall'utente
        $img = Storage::put('post_images', $dati['post_image']);
        $newPostImage = new PostImage();
        $newPostImage->path = $img;
        /*
        $newPostImage->post_id = $newPost->id;
        $newPostImage->save();
        */
        $newPost->postImage()->save($newPostImage);

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
