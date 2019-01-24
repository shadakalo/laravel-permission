@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                                      @if(Session::has('message'))
                                      <div class="alert alert-info">  {{ Session::get('message') }} </div>
                                      @endif
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Role Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($users as $user)
                        <tr>
                          <th scope="row">{{$loop->index+1}}</th>
                          <td>{{$user->name}}</td>
                          <td>{{$user->email}}</td>
                          <td>
                            <!-- Button trigger modal -->
                                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal-{{$user->id}}">
                                    Assign
                                  </button>

                                  <!-- Modal -->
                                  <div class="modal fade" id="exampleModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <label> Select Role  </label>
                                          <form action="/role/user" method="post">
                                            @CSRF
                                            <input type="hidden" name="user"  value="{{ $user->id }}">
                                            <select class="form-control" name="role">
                                              @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{$role->name}}</option>
                                              @endforeach
                                            </select>
                                            <input type="submit" class="btn btn-primary mt-3" value="assign">
                                          </form>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                        </div>
                                      </div>
                                    </div>
                                  </div>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                      </table>

            </div>
        </div>
    </div>
</div>


@endsection
