<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }
    public function blog()
    {
        $posts = [
            ['id' => 1, 'title' => 'Post 1', 'slug' => 'php'],
            ['id' => 2, 'title' => 'Post 2', 'slug' => 'laravel'],
            ['id' => 3, 'title' => 'Post 3', 'slug' => 'javascript'],
            ['id' => 4, 'title' => 'Post 4', 'slug' => 'vue.js'],
        ];
        return view('blog', ['posts' => $posts]);
    }
    public function post($slug)
    {
        $post = $slug;
        return view('post', ['post' => $post]);
    }
}
