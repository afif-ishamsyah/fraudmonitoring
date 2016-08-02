@extends('layout/layout')
@section('content')
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
      <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li><a href="{{URL::to('user')}}"><i class="fa fa-home"></i><span>Home</span></a></li>
            <li><a href="{{URL::to('caseform')}}"><i class="fa fa-edit"></i><span>Input Case</span></a></li>
            <li class="active"><a href="{{URL::to('search')}}"><i class="fa fa-search"></i> <span>Search Case</span></a></li>
            <li><a href="{{URL::to('listprofile')}}"><i class="fa fa-list"></i> <span>List Profile</span></a></li>  
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        <h1>Search</h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
         <div class="col-md-6">
              <!-- Custom Tabs -->
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">By Number</a></li>
                  <li><a href="#tab_2" data-toggle="tab">By Case Date</a></li>
                  <li><a href="#tab_3" data-toggle="tab">By Input Date</a></li>
                  <li><a href="#tab_4" data-toggle="tab">By CC</a></li>
                  <li><a href="#tab_5" data-toggle="tab">By AM</a></li>
                </ul>

                <div class="tab-content">


                <div class="tab-pane active" id="tab_1">
                    <form action="{{URL::to('searchnumber')}}" method="get">
                    <div class="form-group">
                    <label>Telephone Number:</label>
                      <input class="form-control" name="telephone" placeholder="Masukkan Nomor Telepon">
                    </div>

                    <div class="form-group">
                      <label>Status:</label>
                      <br>
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="opsi1" id="opsi1" value="1" checked>
                          All
                        </label>
                      </div>
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="opsi1" id="opsi1" value="2">
                          Open Case
                        </label>
                      </div>
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="opsi1" id="opsi1" value="3">
                          Closed Case
                        </label>
                      </div>
                    </div><!-- /.form group -->

                     <button type="submit" class="btn btn-primary">Search</button>
                     </form>
                     </div>

                  <div class="tab-pane" id="tab_2">
                  <form action="{{URL::to('searchdate')}}" method="get">
                    <div class="form-group">
                      <label>Case Date:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask placeholder="dd-mm-yyyy">
                      </div><!-- /.input group -->
                    </div><!-- /.form group -->

                    <div class="form-group">
                      <label>Status:</label>
                      <br>
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="opsi1" id="opsi1" value="1" checked>
                          All
                        </label>
                      </div>
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="opsi1" id="opsi1" value="2">
                          Open Case
                        </label>
                      </div>
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="opsi1" id="opsi1" value="3">
                          Closed Case
                        </label>
                      </div>
                    </div><!-- /.form group -->

                    <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                  </div>

                  <div class="tab-pane" id="tab_3">
                  <form action="{{URL::to('searchinputdate')}}" method="get">
                    <div class="form-group">
                      <label>Input Date:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="date" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask placeholder="dd-mm-yyyy">
                      </div><!-- /.input group -->
                    </div><!-- /.form group -->

                    <div class="form-group">
                      <label>Status:</label>
                      <br>
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="opsi1" id="opsi1" value="1" checked>
                          All
                        </label>
                      </div>
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="opsi1" id="opsi1" value="2">
                          Open Case
                        </label>
                      </div>
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="opsi1" id="opsi1" value="3">
                          Closed Case
                        </label>
                      </div>
                    </div><!-- /.form group -->

                    <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                  </div>
                  
                  <div class="tab-pane" id="tab_4">
                    <form action="{{URL::to('searchcustomer')}}" method="get">
                    <div class="form-group">
                    <label>Corporate Customer:</label>
                      <input class="form-control" name="customer" placeholder="Masukkan Nama Corporate Cutomer">
                    </div>

                    <div class="form-group">
                      <label>Status:</label>
                      <br>
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="opsi1" id="opsi1" value="1" checked>
                          All
                        </label>
                      </div>
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="opsi1" id="opsi1" value="2">
                          Open Case
                        </label>
                      </div>
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="opsi1" id="opsi1" value="3">
                          Closed Case
                        </label>
                      </div>
                    </div><!-- /.form group -->

                     <button type="submit" class="btn btn-primary">Search</button>
                     </form>
                  </div> 

                  <div class="tab-pane" id="tab_5">
                  <form action="{{URL::to('searcham')}}" method="get">
                  <div class="form-group">
                    <label>Account Manager:</label>
                    <input class="form-control" name="am" placeholder="Masukkan Nama Account Manager">
                  </div>

                  <div class="form-group">
                      <label>Status:</label>
                      <br>
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="opsi1" id="opsi1" value="1" checked>
                          All
                        </label>
                      </div>
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="opsi1" id="opsi1" value="2">
                          Open Case
                        </label>
                      </div>
                      <div class="radio-inline">
                        <label>
                          <input type="radio" name="opsi1" id="opsi1" value="3">
                          Closed Case
                        </label>
                      </div>
                    </div><!-- /.form group -->

                  <button type="submit" class="btn btn-primary">Search</button>
                  </form>
                  </div>
                  
                </div><!-- /.tab-content -->
              </div><!-- nav-tabs-custom -->
              </div>

              <div class="col-md-12">
                <div class="box box-danger">
                <div class="box-header">
                  <h3 class="box-title">Telephone Number</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Telephone Number</th>
                        <th>Case Date</th>
                        <th>CC Name</th>
                        <th>AM Name</th>
                        <th>Last Activity</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($nomor as $number)
                      <tr>
                        <td>{{$number->telephone_number}}</td>
                        <td><?php echo date('d-m-Y',strtotime($number->case_time)); ?></td>
                        <td>{{$number->customer}}</td>
                        <td>{{$number->am}}</td>
                        <td>{{$number->akronim}}</td>
                        @if($number->status=='0')
                        <td><a href="{{URL::to('cases')}}/{{$number->id_case}}"type="get" class="btn btn-danger">Update</a></td>
                        @endif
                        @if($number->status=='1')
                        <td><a href="{{URL::to('cases')}}/{{$number->id_case}}"type="get" class="btn btn-success">View</a></td>
                        @endif
                      </tr>
                      @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Telephone Number</th>
                        <th>Case Date</th>
                        <th>CC Name</th>
                        <th>AM Name</th>
                        <th>Last Activity</th>
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
