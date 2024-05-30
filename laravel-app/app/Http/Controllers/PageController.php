<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }
    public function blog()
    {
        //Consulta de base de datos
/*         $posts = [
            ['id' => 1, 'title' => 'Post 1', 'slug' => 'php'],
            ['id' => 2, 'title' => 'Post 2', 'slug' => 'laravel'],
            ['id' => 3, 'title' => 'Post 3', 'slug' => 'javascript'],
            ['id' => 4, 'title' => 'Post 4', 'slug' => 'vue.js'],
        ]; */
        //Esto representa una sentencia en sql, pero es un comando elocuent
        //$post = Post::find(25);
        //dd($post);

        $posts = Post::latest()->paginate();
        return view('blog', ['posts' => $posts]);
    }
    public function post(Post $post)
    {
        return view('post', ['post' => $post]);
    }
}
