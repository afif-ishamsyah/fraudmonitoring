@extends('layout/layout')
@section('content')
    <aside class="main-sidebar">
      <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li><a href="{{URL::to('user')}}"><i class="fa fa-home"></i><span>Home</span></a></li>
            <li><a href="{{URL::to('caseform')}}"><i class="fa fa-edit"></i><span>Input Case</span></a></li>
            <li><a href="{{URL::to('search')}}"><i class="fa fa-search"></i> <span>Search Case</span></a></li>
            <li class="active"><a href="{{URL::to('listprofile')}}"><i class="fa fa-list"></i> <span>List Profile</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>Edit Profile</h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
        @if (Session::has('fail'))
        <div class="col-md-12"><div class="alert alert-danger">{{ Session::get('fail') }}</div></div>
        @endif

        @if (Session::has('success'))
        <div class="col-md-12"><div class="alert alert-success">{{ Session::get('success') }}</div></div>
        @endif
        <div class="col-md-12">
        <div class="box box-danger">
        <div class="box-body">
        <form class="form-horizontal" role="form" action="{{URL::to('editingprofileprocess')}}" method="post"> 
            <div class="form-group">
              <label class="control-label col-sm-2" for="notelepon">Nomor Telepon:</label>
              <div class="col-sm-10">
                <input class="form-control" name="telnumber" id="telnumber" placeholder="{{$nomor->telephone_number}}" disabled>
                <input class="form-control" type="hidden" name="idcase" id="idcase" value="{{$nomor->id_case}}">
              </div>
            </div>

             <div class="form-group">
              <label class="control-label col-sm-2" for="destnumber">Nomor Induk:</label>
              <div class="col-sm-10">
                <input class="form-control" name="main" id="destnumber" placeholder="{{$nomor->main_number}}" disabled>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="destnumber">NIP NAS:</label>
              <div class="col-sm-10">
                <input class="form-control" name="nipnas" id="destnumber" placeholder="{{$nomor->nipnas}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="no. telp">Corporate Customer:</label>
              <div class="col-sm-10">
                <input class="form-control" name="customer" id="notelepon" placeholder="{{$nomor->customer}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="durasi">NIK AM:</label>
              <div class="col-sm-10">
                <input class="form-control" name="nikam" id="durasi" placeholder="{{$nomor->nikam}}">
              </div>
            </div>

             <div class="form-group">
              <label class="control-label col-sm-2" for="durasi">Alamat Instalasi:</label>
              <div class="col-sm-10">
                <input class="form-control" name="alamat" id="durasi" placeholder="{{$nomor->installation}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="frekueni">Account Manager:</label>
              <div class="col-sm-10">
                <input class="form-control" name="am" id="frekunsi" placeholder="{{$nomor->am}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="frekueni">Segment:</label>
              <div class="col-sm-10">
                <input class="form-control" name="segment" id="frekunsi" placeholder="{{$nomor->segment}}">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="frekueni">Average Revenue:</label>
              <div class="col-sm-10">
                <input class="form-control" name="revenue" id="frekunsi" placeholder="{{$nomor->revenue}}">
              </div>
            </div>
            </div>
            {{csrf_field()}}

            <div class="box-footer">
              <div class="form-group">
                <div class="pull-right">
                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">Update</button>
                </div>
              </div>
            </div>
          <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ATTENTION!</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure to edit this profile?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Yes</button>
                  </div>
                </div>
              </div>
              </form>
            </div>
            </div>
            </div>
            </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
@endsection
    