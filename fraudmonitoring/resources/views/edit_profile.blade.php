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
        <h1>Profile List</h1>
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
                <div class="box-header">
                  <h3 class="box-title">List of Profile Number</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Main Number</th>
                        <th>Corporate Customer</th>
                        <th>Account Manager</th>
                        <th>Installation Adress</th>
                        <th>Segment</th>
                        <th>Average Revenue (Last 3 Month)</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($nomor as $number)
                      <tr>
                        <td>{{$number->notel}}</td>
                        <td>{{$number->namacc}}</td>
                        <td>{{$number->namaam}}</td>
                        <td>{{$number->alamat}}</td>
                        <td>{{$number->segment}}</td>
                        <td>{{$number->average}}</td>
                      </tr>
                      @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Main Number</th>
                        <th>Corporate Customer</th>
                        <th>Account Manager</th>
                        <th>Installation Adress</th>
                        <th>Segment</th>
                        <th>Average Revenue (Last 3 Month)</th>
                      </tr>
                    </tfoot>
                    </table>
                    </div>
                    </div>
                  </div>
              </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

@endsection
