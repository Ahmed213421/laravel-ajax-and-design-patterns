@extends('admin.layouts.master')

@section('content')
    <h3>category {{$category->name}}</h3>
    <h1>posts</h1>
    <table border="1" class="table">
        <tr>
            <th>post name</th>
            <th>post body</th>
            <th>post user</th>
            <th>post category</th>
        </tr>
        @foreach ($posts as $post)
        <tr>
            <td>{{$post->title}}</td>
            <td>{{$post->body}}</td>
            <td>{{$post->user->name}}</td>
            <td><a href="{{route('categories.show',$post->category->id)}}">{{$post->category->name}}</a></td>
        </tr>
        @endforeach
    </table>
@endsection