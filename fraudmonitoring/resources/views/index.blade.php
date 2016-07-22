<!DOCTYPE html>

@extends('layout/layoutlogin')
@section('content')
  

    @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <div class="box box-danger" style="width: 40%; margin: 0 auto; margin-top: 8%;">
                <div class="box-header with-border">
                  <h3 class="box-title">Login</h3>
                </div><!-- /.box-header -->
                <form class="form-horizontal" method="POST" action="{{URL::to('login')}}" enctype="multipart/form-data">
                  <div class="box-body">
                    <div class="form-group">
                      <label for="inputuser" class="col-sm-2 control-label">Username:</label>
                      <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputpass" class="col-sm-2 control-label">Password:</label>
                      <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                      </div>
                    </div>
                      {{csrf_field()}}
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-danger pull-right">Sign in</button>
                  </div><!-- /.box-footer -->
                </form>
    </div>
@endsection