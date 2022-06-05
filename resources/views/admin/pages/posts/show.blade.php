@extends('admin.layouts.master')

@section('content')
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">post title</th>
                <th scope="col">post body</th>
                <th scope="col">category</th>
                <th scope="col">tags</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td>{{$post->title}}</td>
                <td>{{$post->body}}</td>
                <td><a href="{{route('categories.show',$post->category->id)}}">{{$post->category->name}}</a></td>
                <td>
                    @foreach ($post->tags as $tag)
                    {{$tag->name}}
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>

    @if ($errors->any())
    <div class="alert alert-primary">
        <ul>
            @foreach ($errors->all() as $error)
            <li class="text-white">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <h5>add comment</h5>
    <form action="{{route('comments.store')}}" method="post">
        @csrf
        @method('POST')
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <label for="">comment description</label><br>
        <textarea name="description" id="" cols="50" rows="5"></textarea>

        <input type="hidden" name="user_id" value="{{Auth::user()->id}}"><br>
        <input type="submit" value="add comment" class="btn btn-primary">
    </form>

    @foreach ($comments as $comment)
    <div class="list-group">
        <a href="javascript:;" class="list-group-item list-group-item-action active">
            {{$comment->user->name}}
        </a>
        <a href="javascript:;" class="list-group-item list-group-item-action disabled">{{$comment->description}}</a>
        @if($comment->user_id == Auth::user()->id)
        <!-- Button trigger modal -->
        <button type="button" class="btn bg-gradient-primary w-25" data-bs-toggle="modal" data-bs-target="#exampleModal{{$comment->id}}">
            Edit
        </button>
        <button type="button" class="btn bg-gradient-primary w-25" data-bs-toggle="modal" data-bs-target="#dexampleModal{{$comment->id}}">
            Delete
        </button>

        <!--Edit Modal -->
        <div class="modal fade" id="exampleModal{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('comments.update',$comment->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <label for="">edit description</label><br>
                            <textarea name="description" id="" cols="30" rows="10">{{$comment->description}}</textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Delete Modal -->
        <div class="modal fade" id="dexampleModal{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('comments.destroy',$comment->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <h6>are you sure you want to delete this item?</h6>
                            <input type="text" value="{{$comment->id}}">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </div>

    
    <!-- Modal -->
    @endforeach
</div>
@endsection