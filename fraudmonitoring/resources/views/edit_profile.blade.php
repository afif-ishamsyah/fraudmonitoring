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
        <div class="alert alert-danger">{{ Session::get('fail') }}</div>
        @endif

        @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
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
                        <th>Telephone Number</th>
                        <th>Main Number</th>
                        <th>Corporate Customer</th>
                        <th>Account Manager</th>
                        <th>Installation Adress</th>
                        <th>Segment</th>
                        <th>Average Revenue (Last 3 Month)</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($nomor as $number)
                      <tr>
                        <td>{{$number->telephone_number}}</td>
                        <td>{{$number->main_number}}</td>
                        <td>{{$number->customer}}</td>
                        <td>{{$number->am}}</td>
                        <td>{{$number->installation}}</td>
                        <td>{{$number->segment}}</td>
                        <td>{{$number->revenue}}</td>
                        <td><a href="{{URL::to('editingprofile')}}/{{$number->id_case}}" type="submit" class="btn btn-danger">Edit</a></td>
                      </tr>
                      @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Telephone Number</th>
                        <th>Main Number</th>
                        <th>Corporate Customer</th>
                        <th>Account Manager</th>
                        <th>Installation Adress</th>
                        <th>Segment</th>
                        <th>Average Revenue (Last 3 Month)</th>
                        <th>Action</th>
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
