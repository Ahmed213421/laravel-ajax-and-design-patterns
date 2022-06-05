@extends('admin.layouts.master')

@section('content')
<br>
edit profile
    <div class="container">
        <form action="{{route('profile.update',$profile->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                {{-- <input type="hidden" name="id" value="{{$profile->id}}"> --}}
                <label for="">name</label>
                <input type="text" placeholder="name" value="{{$profile->name}}" name="name">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Email address</label>
              <input type="email" class="form-control" name="email" value="{{$profile->email}}" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">old password</label>
              <input type="password" class="form-control" name="oldpassword" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">new password</label>
              <input type="password" class="form-control" name="password" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">new password confirmation</label>
              <input type="password" class="form-control" name="passwordconfitmation" id="exampleFormControlInput1" placeholder="name@example.com">
            </div>
            <div class="form-group">
              <label for="exampleFormControlTextarea1">change photo</label>
              <input type="file" name="photo" id="" value="{{$profile->photo}}">
            </div>
            <input type="submit" value="save">
          </form>    
    </div> 
@endsection