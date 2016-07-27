<!DOCTYPE html>

@extends('layout/layoutlogin')
@section('content')
  
    <img src="{{URL::to ('assets/mantab.png')}}" style="display: block;
    margin-left: auto;
    margin-right: auto;
    height:30%; width: 30%;">

    <div class="box box-danger" style="width: 34%; margin: 0 auto;">
                <div class="box-header with-border">
                  <h3 class="box-title">LOGIN</h3>
                </div><!-- /.box-header -->
                <form class="form-horizontal" method="POST" action="{{URL::to('login')}}" enctype="multipart/form-data">
                  <div class="box-body">
                  @if (Session::has('message'))
                  <div class="alert alert-danger">{{ Session::get('message') }}</div>
                  @endif
                    <div class="form-group">
                      <label for="inputuser" class="col-sm-3 control-label">Username:</label>
                      <div class="col-sm-8">
                        <input type="text" name="username" class="form-control" id="username" placeholder="Username" required>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="inputpass" class="col-sm-3 control-label">Password:</label>
                      <div class="col-sm-8">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
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