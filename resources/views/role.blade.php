@extends('layouts.app')

@section('content')
<style>
.create {
    display: none !important;
}
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">

                    @if(Session::has('message'))
                    <div class="alert alert-info">  {{ Session::get('message') }} </div>
                    @endif

                  <!-- Button trigger modal -->
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#exampleModal">
                      Create Role
                    </button>

                    <!-- Create Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Role</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form action="/role" method="post">
                              @CSRF
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Role Name</label>
                                    <input type="text" class="form-control" name="role" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Role Name">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                          </div>
                          <!-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                          </div> -->
                        </div>
                      </div>
                    </div>
                    <!-- Create Modal -->

                    <table class="table table-default mt-2" >
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Role</th>
                          <th scope="col">Guard </th>
                          <th scope="col">action</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($roles as $role)
                        <tr>
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td>{{$role->name}}</td>
                          <td>{{$role->guard_name}}</td>
                          <td style="display:flex;">
                            <!--Permission  Modal -->
                            <a type="button" class="btn btn-success btn-small mr-2" data-toggle="modal" data-target="#modal2-{{ $role->id }}">
                              Permission
                            </a>
                            <div class="modal fade bd-example-modal-lg" id="modal2-{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Assign Permission</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="/role/assignPermission/{{ $role->id }}" method="post">
                                      @csrf
                                      @foreach($permissions as $permission)
                                      <input type="checkbox" name="permission[]" class="ml-5" value="{{$permission->id}}">
                                          {{ $permission->name }}
                                      @endforeach
                                      <br>
                                      <input type="submit"  class="btn btn-primary mt-4 ml-5" >
                                    </form>
                                  </div>
                                  <!-- <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                  </div> -->
                                </div>
                              </div>
                            </div>
                            <!--Permission  Modal -->

                            <!--Update  Modal -->
                            <a type="button" class="btn btn-secondary btn-small mr-2" data-toggle="modal" data-target="#modal-{{ $role->id }}">
                              Edit
                            </a>
                            <div class="modal fade" id="modal-{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form action="/role/{{$role->id}}" method="post">
                                      @CSRF
                                      {{method_field('PUT')}}
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Role Name</label>
                                            <input type="text" class="form-control" name="role" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $role->name}}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                  </div>
                                  <!-- <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                  </div> -->
                                </div>
                              </div>
                            </div>
                            <!--Update  Modal -->
                            <form action="/role/{{$role->id}}" method="POST">
                              @CSRF
                               {{method_field('DELETE')}}
                                <button class="btn btn-small btn-danger">Delete</button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<script>

      $(document).on('click', '#create_role', function () {
            $('#create_form').css('display','inline')
            console.log("working")
      });



</script>

@endsection
