@extends('layout/layout')
@section('content')
      <aside class="main-sidebar">
      <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li><a href="{{URL::to('admin')}}"><i class="fa fa-home"></i><span>Home</span></a></li>
            <li><a href="{{URL::to('userform')}}"><i class="fa fa-edit"></i> <span>Create User</span></a></li>
            <li><a href="{{URL::to('edituserform')}}"><i class="fa fa-search"></i> <span>Edit User</span></a></li>
            <li class="active"><a href="{{URL::to('paramform')}}"><i class="fa fa-plus "></i> <span>Input Parameter</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>Input Parameter</h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
        
         @if (Session::has('fail'))
        <div class="col=md-12"><div class="alert alert-danger">{{ Session::get('fail') }}</div></div>
        @endif

        @if (Session::has('success'))
        <div class="col=md-12"><div class="alert alert-success">{{ Session::get('success') }}</div></div>
        @endif
        
        <div class="col-md-12">
        <div class="box box-danger">
          <div class="box-header">
            <form class="form-horizontal" role="form" action="addcaseparam" method="post">
            <div class="box-title">Case Parameter</div>
          </div>
          
          <div class="box-body">
            <div class="form-group">
              <label class="control-label col-sm-2" for="namaparameter">Parameter Name:</label>
              <div class="col-sm-9">
                <input class="form-control" name="parameter" id="namaparameter" placeholder="Masukkan Nama Parameter">
              </div>
              </div>
            </div>
            {{csrf_field()}}
            <div class="box-footer">
              <div class="form-group">
              <div class=" pull-right">
                <button type="submit" class="btn btn-danger">Create Case Parameter</button>
              </div>
            </div>
            </form>
            </div>
            </div>
          </div>

          <div class="col-md-12">
          <div class="box box-danger">
          <div class="box-header">
            <form class="form-horizontal" role="form" action="{{URL::to('addactparam')}}" method="post">
            <div class="box-title">Activity Parameter</div>
          </div>
          
          <div class="box-body">
            <div class="form-group">
              <label class="control-label col-sm-2" for="namaparameter">Parameter Name:</label>
              <div class="col-sm-9">
                <input class="form-control" name="parameter" id="namaparameter" placeholder="Masukkan Nama Parameter">
              </div>
              </div>

              <div class="form-group">
                <label  class="control-label col-sm-2" for="tipe">Type:</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="status" id="tipeparam">
                      <option value='0'>Open</option>
                      <option value='1'>Close</option>
                    </select>
                  </div>
              </div>
            </div>
            {{csrf_field()}}
            <div class="box-footer">
              <div class="form-group">
              <div class="pull-right">
                <button type="submit" class="btn btn-danger">Create Activity Parameter</button>
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
