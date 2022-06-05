@extends('admin.layouts.master')

@section('content')
<div class="container">
    <h1>all categories</h1>
    <table class="table" id="category_table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">edit</th>
                <th scope="col">delete</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            create category
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
                        <form id="storeform" action="{{route('categories.store')}}" method="POST">
                            @csrf
                            @method('POST')
                            <ul id="showerrors">

                            </ul>
                            <div class="form-group">
                                <label for="">name</label>
                                <input type="text" name="name" id="name" class="form-control">
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


        {{-- edit modal --}}

        <!-- Modal -->
        <div class="modal fade" id="editexampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <form method="POST" id="editform">
                            @csrf
                            @method('PATCH')
                            <div id="showediterrors">

                            </div>
                            
                            <div class="form-group">
                                <input type="text" name="cat_id" id="cat_id">
                                <label for="">edit name</label>
                                <input type="text" name="name" id="editname" class="form-control">
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="deleteitem" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
        {{-- end of edit modal --}}
        <!-- delete Modal -->
        <div class="modal fade" id="deleteexampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                        <form method="POST" id="deleteform" name="form">
                            @csrf
                            @method('DELETE')
                            
                            
                            <div class="form-group">
                                are you sure you want to delte this item?
                                <input type="hidden" id="deleteid" name="deleteid">
                            </div>
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

fetchcategory();
        function fetchcategory() {
            $.ajax({
                type: "GET",
                url: "/fetch",
                dataType: "json",
                success: function (response) {
                    // console.log(response.categories);
                    $('tbody').html("");
                    $.each(response.categories, function (key, item) {
                        // console.log(key);
                        $('tbody').append('<tr>\
                            <td>' + key + '</td>\
                            <td>' + '<a href="categories/'+item.id+'">' +item.name+' </a>' + '</td>\
                            <td><button type="button" id="edit" value="' + item.id + '" class="btn btn-primary editbtn btn-sm">Edit</button></td>\
                            <td><button type="button" id="delete" value="' + item.id + '" class="btn btn-danger deletebtn btn-sm">Delete</button></td>\
                        \</tr>');
                    });
                }
            });
        }
   });
         
</script>

<script>
    $(document).ready(function(){
        $('body').on('click','#edit',function(){
            var id = $(this).val();
            // console.log(id);
            $.get(+id+'/edit',function(data){
                console.log(data.category.name);
                $('#editexampleModal').modal('show');
                $('#cat_id').val(data.category.id);
                $('#editname').val(data.category.name);
            });
        });
         

    });

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
                    url: 'categories/'+id,
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
<script>
    $(document).ready(function(){
        $('#editform').submit(function(e){
            e.preventDefault();
            var data = {
                'name' : $("#editname").val(),
                'id' : $('#cat_id').val(),
                '_token' : $("input[name='token']").val(),
            }

            console.log(data);

            var id = $('#edit').val();
            $.ajax({
                url : ""+id,
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

        

    });
</script>
@endsection