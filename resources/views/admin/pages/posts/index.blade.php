@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <h1>all posts</h1>
        <table class="table" id="category_table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">name</th>
                    <th scope="col">show</th>
                    <th>edit</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
    
            </tbody>
        </table>
        <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            create post
        </button>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new Product</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="storeform" action="{{route('posts.store')}}" method="POST">
                            @csrf
                            @method('POST')
                            <ul id="showerrors">

                            </ul>
                            <div class="form-group">
                                <label for="">title</label>
                                <input type="text" name="title" id="title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">body</label>
                                <input type="text" name="body" id="body" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">category</label>
                                <select name="category_id" id="">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">select tags</label>
                                <select name="tag_id[]" id="" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>


        <!--edit Modal -->
        <div class="modal fade" id="editxampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">edit post</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="editform" method="POST">
                            @csrf
                            @method('PUT')
                            <ul id="showerrors">

                            </ul>
                            <div class="form-group">
                                <label for=""> edit title</label>
                                <input type="text" name="title" id="edittitle" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">edit body</label>
                                <input type="text" name="body" id="editbody" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">edit category</label>
                                <select name="category_id" id="editcategory_id">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="text" id="post_id">
                            <div class="form-group">
                                <label for="">edit tags</label>
                                <select name="tag_id[]" id="edittag_id" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>


        <!--delete Modal -->
        <div class="modal fade" id="deleteexampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">delete post</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="deleteform" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" id="deleteid">
                            <h5>are you sure you want to delete this item?</h5>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="deletebtn" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>



    </div>


@endsection

@section('scripts')

@include('admin.pages.ajax.ajaxcreate')

<script>
    $(document).ready(function(){
        fetchpost();
        function fetchpost() {
            $.ajax({
                type: "GET",
                url: "/fetchpost",
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    $('tbody').html("");
                    $.each(response.posts, function (key, item) {
                        $('tbody').append('<tr>\
                            <td>' + item.id + '</td>\
                            <td>' + item.title + '</td>\
                            <td><a href="'+'posts/'+item.id+'">show</a></td>\
                            <td><button type="button" id="edit" value="' + item.id + '" class="btn btn-primary editbtn btn-sm">Edit</button></td>\
                            <td><button type="button" id="delete" value="' + item.id + '" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
                        \</tr>');
                    });
                }
            });
        }
    })
</script>

<script>
    $(document).ready(function(){
        $('body').on('click','#edit',function(){
            var id = $(this).val();
            // console.log(id);
            $.get('posts/'+id+'/edit',function(data){
                console.log(data.post);
                $('#editxampleModal').modal('show');
                $('#post_id').val(data.post.id);
                $('#edittitle').val(data.post.title);
                $('#editbody').val(data.post.body);
                $('#editcategory_id').val(data.post.category_id);
                $('#edittag_id').val(data.post.tag_id);
            })
        });
        

        $('#editform').submit(function(e){
            e.preventDefault();
            var data = {
                'title' : $("#edittitle").val(),
                'body' : $("#editbody").val(),
                'category_id' : $("#editcategory_id").val(),
                'tag_id' : $("#edittag_id").val(),
                'id' : $('#post_id').val(),
                '_token' : $("input[name='token']").val(),
            }

            console.log(data);

            var id = $('#edit').val();
            $.ajax({
                url : "posts/"+id,
                type: "PUT",
                data:data,
                dataType:'json',
                success:function(response){
                    console.log(response.status);
                    if(response.status == 200){
                        $('#editexampleModal').modal('toggle');
                        $('#showediterrors').empty();   
                        $('#showediterrors').addClass('alert alert-success');
                        $("#showediterrors").append("<div>"+response.message+"</div>");
                        window.location.reload();
                        return false;
                    }
                        else{
                            $.each(response.errors,function(key,value){
                                $('#showediterrors').empty();   
                                $('#showediterrors').addClass('alert alert-danger');
                                $("#showediterrors").append("<div>"+value+"</div>");
                            });
                    }
                },
            });
        });

    })
</script>

<script>
    $(document).ready(function(){
        $('body').on('click','#delete',function(){
            var id = $(this).val();
                $('#deleteexampleModal').modal('show');
                $("#deleteid").val(id);
        });
         
    });

    $('#deleteform').submit(function(e){
        e.preventDefault();
                var id = $("#deleteid").val();
                // console.log(id);
                $.ajax({
                    url: 'posts/'+id,
                    type: "DELETE",
                    dataType: 'json',
                    beforeSend:function(){
                        $('#deletebtn').text('Deleting....');
                    },
                    success:function(response){
                        console.log(response);
                        setTimeout(function(){
                            $("#deleteexampleModal").modal('hide');
                            window.location.reload();
                        }, 2000);
                        // $('#category_table').DataTable().ajax.reload();
                    }
                });
            });

</script>


@endsection