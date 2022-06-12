<!-- resources/views/chat.blade.php -->

@extends('layouts.app')
@section('css')
    <!-- resources/views/layouts/app.blade.php -->
@endsection
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <div class="col-8">
            <div class="card blur shadow-blur max-height-vh-70">
              <div class="card-header shadow-lg">
                <div class="row">
                  <div class="col-md-10">
                    <div class="d-flex align-items-center">
                      <img alt="Image" src="../../assets/img/team-2.jpg" class="avatar" style="width: 20%">
                      <div class="ms-3">
                        <h6 class="mb-0 d-block">{{Auth::user()->name}}</h6>
                        <span class="text-sm text-dark opacity-8">last seen today at 1:53am</span>
                      </div>
                    </div>
                  </div>
                  <div class="col-1 my-auto pe-0">
                    <button class="btn btn-icon-only shadow-none text-dark mb-0 me-3 me-sm-0" type="button" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="Video call">
                      <i class="ni ni-camera-compact"></i>
                    </button>
                  </div>
                  <div class="col-1 my-auto ps-0">
                    <div class="dropdown">
                      <button class="btn btn-icon-only shadow-none text-dark mb-0" type="button" data-bs-toggle="dropdown">
                        <i class="ni ni-settings"></i>
                      </button>
                      <ul class="dropdown-menu dropdown-menu-end me-sm-n2 p-2" aria-labelledby="chatmsg">
                        <li>
                          <a class="dropdown-item border-radius-md" href="javascript:;">
                            Profile
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item border-radius-md" href="javascript:;">
                            Mute conversation
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item border-radius-md" href="javascript:;">
                            Block
                          </a>
                        </li>
                        <li>
                          <a class="dropdown-item border-radius-md" href="javascript:;">
                            Clear chat
                          </a>
                        </li>
                        <li>
                          <hr class="dropdown-divider">
                        </li>
                        <li>
                          <a class="dropdown-item border-radius-md text-danger" href="javascript:;">
                            Delete chat
                          </a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
                <div class="row text-right mb-4" id="justify">
                  <div class="col-auto" style="width: 100%">
                    <div class="card bg-gray-200">
                      <div class="card-body py-2 px-3">
                        <p class="mb-1" id="messages">
                          
                        </p>
                        <div class="d-flex align-items-center text-sm opacity-6">
                          <i class="ni ni-check-bold text-sm me-1"></i>
                          <small id="time"></small>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="card-footer d-block">
                <form class="align-items-center" id="messageform">
                  <div class="d-flex">
                    <div class="input-group">
                      <input id="messageinput" name="messageinput" type="text" class="form-control" placeholder="Type here" >
                      <input id="username" name="username" type="hidden" value="{{Auth::user()->name}}" class="form-control" >
                      <input id="userid" name="userid" type="hidden" value="{{auth()->id()}}" class="form-control" >
                    </div>
                    <button type="submit" class="btn bg-gradient-primary mb-0 ms-2 btn-primary">
                      <i class="ni ni-send"></i>
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
<script>
  window.authId = "{{auth()->id()}}";
</script>

@endsection