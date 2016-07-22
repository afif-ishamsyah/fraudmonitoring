@extends('layout/layout')
@section('content')
      <aside class="main-sidebar">
      <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li><a href="{{URL::to('admin')}}"><i class="fa fa-home"></i><span>Home</span></a></li>
            <li class="active"><a href="{{URL::to('userform')}}"><i class="fa fa-edit"></i> <span>Create User</span></a></li>
            <li><a href="{{URL::to('edituserform')}}"><i class="fa fa-search"></i> <span>Edit User</span></a></li>
            <li><a href="{{URL::to('paramform')}}"><i class="fa fa-plus "></i> <span>Input Parameter</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>Create User</h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
        @if (Session::has('fail'))
        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif

        @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="box box-danger">
        <div class="box-body">
          <form class="form-horizontal" role="form" action="{{URL::to('register')}}" method="post">
              <div class="form-group">
              <label class="control-label col-sm-2" for="no. telp">Username:</label>
              <div class="col-sm-9">
                <input class="form-control" name="username" id="username" placeholder="Masukkan Username">
              </div>
              </div>
              <div class="form-group">
              <label class="control-label col-sm-2" for="no. telp">Password:</label>
              <div class="col-sm-9">
                <input class="form-control" name="password" id="pass" placeholder="Masukkan Password" type="password">
              </div>
              </div>
              <div class="form-group">
              <label class="control-label col-sm-2" for="no. telp">Re-type Password:</label>
              <div class="col-sm-9">
                <input class="form-control" name="conpassword" id="repass" placeholder="Masukkan Ulang Password" type="password">
              </div>
              </div>

              <div class="form-group">
                <label  class="control-label col-sm-2" for="no. telp">User Type:</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="previledge" id="usertype">
                      <option value='0'>User</option>
                      <option value='1'>Admin</option>
                    </select>
                  </div>
              </div>
            </div>
            {{csrf_field()}}
            <div class="box-footer">
              <div class="form-group">
              <div class=" pull-right">
                <button type="submit" class="btn btn-danger">Create User</button>
              </div>
            </div>
            </form>
            </div>
            </div>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

@endsection
