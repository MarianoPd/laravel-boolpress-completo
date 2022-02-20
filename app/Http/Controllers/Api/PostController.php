<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Dotenv\Result\Success;

class PostController extends Controller
{
    public function index(){
        
        $posts = Post::with(['category','tags'])->paginate(5);

        $posts->each(function($post){
            $post->cover = $this->makeImagePath($post->cover);          
        });

        $categories = Category::all();
        $tags = Tag::all();

        return response()->json(compact('posts', 'tags','categories'));
    }

    public function show($slug){
        $post = Post::where('slug', $slug)->with(['category','tags'])->first();

        if(!$post){
            $post = ['title' => 'Post non trovato', 'content' => ''];
        };
        
        $post->cover = $this->makeImagePath($post->cover);
        

        return response()->json($post);
    }

    public function getPostByCategory($slug){
        $categories = Category::where('slug', $slug)->with(['posts.tags', 'posts.category'])->first();

        $categories->posts->each(function($post){
            $post->cover = $this->makeImagePath($post->cover);
        });

        $success = true;
        $error= '';
        if(!$categories){
            $success = false;
            $error = 'Category not existent';
        }elseif($categories && count($categories['posts']) === 0){
            $success = false;
            $error= 'There are no posts in this category';
        }
        
        return response()->json(compact('success','categories','error')); 
    }

    public function getPostByTag($slug){
        $tag = Tag::where('slug', $slug)->with(['posts.tags', 'posts.category'])->first();
        $tag->posts->each(function($post){
            $post->cover = $this->makeImagePath($post->cover);
        });
        $success = true;
        $error= '';
        if(!$tag){
            $success = false;
            $error = 'Tag not existent';
        }elseif($tag && count($tag['posts']) === 0){
            $success = false;
            $error = 'There are no posts with this tag';
        }


        return response()->json(compact('success','tag', 'error'));
    }

    private function makeImagePath($cover){
        if($cover){
            $cover = url('storage/' . $cover);
        }else{
            $cover = url('img/download.png'); 
        } 
        return $cover;
    }
}
