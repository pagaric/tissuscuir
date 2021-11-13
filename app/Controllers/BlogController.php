<?php

namespace App\Controllers;

use App\Models\Post;

class BlogController extends Controller
{
    public function welcome()
    {
        return $this->view('blog/welcome');
    }

    public function index()
    {
        $post = new Post();
        $result = $post->getAll();
        $title = 'Tous les articles';
        
        return $this->view('blog.index', compact('result', 'title'));
    }
    
    public function show(int $id)
    {
        $post = new Post();
        $result = $post->getById($id);
        $title = "Article {$result->id}";
        return $this->view('blog.show', compact('result', 'title'));
    }

    public function hello()
    {
        echo sayHello();
    }
}
