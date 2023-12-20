<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

    //  Une fois on depasse 5 lignes par tableau Ca d'affiche
    public function index()
    {
        $data = Post::latest()->paginate(5);
        return view('posts.index',compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    // Direction view create
    public function create()
    {
        return view('posts.create');
    }

    // Processus de creation 
    public function store(Request $request)
    {
         $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'author' => 'required'
        ]);
    
        Post::create($request->all());
     
        return redirect()->route('posts.index')
            ->with('success','');
    }
    
    // Direction vers le view de details du post
    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    }

    // Direction vers le view de la modification du post
    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    // Processus de modification du post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'date' => 'required',
            'author' => 'required'
        ]);
    
        $post->update($request->all());
        return redirect()->route('posts.index')
            ->with('success','');
    }

    // Procesuus de la suppression du post 
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')
                        ->with('success','');
    }
}