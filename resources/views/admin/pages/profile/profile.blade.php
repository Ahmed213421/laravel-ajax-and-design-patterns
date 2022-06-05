@extends('admin.layouts.master')

@section('content')
<div class="container">
    <div>
        <h1>profile admin</h1>
    </div>
    <div class="card">
        <div class="card-header p-0 mx-3 mt-3 position-relative z-index-1">
          <a href="javascript:;" class="d-block">
            <img src="{{asset('assets/img/'.Auth::user()->photo)}}" style="width:50%" class="img-fluid border-radius-lg">
          </a>
        </div>
      
        <div class="card-body pt-2">
          <span class="text-gradient text-primary text-uppercase text-xs font-weight-bold my-2">Admin</span>
          <a href="javascript:;" class="card-title h5 d-block text-darker">
        </a>
        {{Auth::user()->name}}
          <p class="card-description mb-4">
            Use border utilities to quickly style the border and border-radius of an element. Great for images, buttons.
          </p>
          <div class="author align-items-center">
            {{-- <img src="./assets/img/kit/pro/team-2.jpg" alt="..." class="avatar shadow"> --}}
            <div class="name ps-3">
              <span><a href="{{route('profile.edit',Auth::user()->id)}}"><button type="button" class="btn btn-primary">
                edit
              </button></a></span>
              <div class="stats">
                <small><!-- Button trigger modal -->
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    delete
                  </button>
                  
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">are you sure you want to delete your profile</h5>
                          <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="{{route('profile.destroy',Auth::user()->id)}}" method="POST">
                            @csrf
                            @method('DELETE')

                            <div class="modal-footer">
                              <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="submit" class="btn bg-gradient-primary">save</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </small>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection