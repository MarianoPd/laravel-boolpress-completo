@extends('layouts.admin')
@section('content')



<div class="container">
    <div>
        <h1>
            {{$post->title}}
        </h1>
        @if ($post->category)
            Category: {{$post->category->name}}
        @endif
        <p>{{$post->content}}</p>
        <div>
            @forelse ($post->tags as $tag)
                <span class="badge bg-primary">{{$tag->name}}</span>
            @empty
            
            @endforelse

            <div>
                <img src="{{asset('storage/'. $post->cover)}}" alt=""  class="w-50">
            </div>
        </div>
    </div>
    <br>
    <button type="button" class="btn btn-primary"><a href="{{route('admin.posts.index')}}" class="text-white">Go back</a></button>
    <button type="button" class="btn btn-success mx-2"><a href="{{route('admin.posts.edit',$post)}}" class="text-white">Edit</a></button>
    <div class="my-2">
        <form onsubmit="return confirm('This action will eliminate this post. Confirm?')"
              action="{{route('admin.posts.destroy',$post)}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger mx-2">Delete</button>
        </form>
    </div>
    
</div>


@endsection

@section('title')
 | {{$post->title}}
@endsection