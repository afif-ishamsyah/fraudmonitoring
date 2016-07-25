@extends('layout/layout')
@section('content')
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
      <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li><a href="{{URL::to('user')}}"><i class="fa fa-home"></i><span>Home</span></a></li>
            <li><a href="{{URL::to('caseform')}}"><i class="fa fa-edit"></i><span>Input Case</span></a></li>
            <li><a href="{{URL::to('search')}}"><i class="fa fa-search"></i> <span>Search Case</span></a></li>
            <li><a href="{{URL::to('listprofile')}}"><i class="fa fa-list"></i> <span>List Profile</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        
        @foreach($cases as $check)
        @if($check->status=='1')
          <h1 class="pull-left">Closed Case</h1>
          <h1><span class="label label-success pull-right">Case Closed
          </span></h1>
        @endif
        @if($check->status=='0')
          <h1 class="pull-left">Case</h1>
          <h1><span class="label label-danger pull-right">Case Opened
          </span></h1>
        @endif
        @endforeach
        </section>

        <br>
        <!-- Main content -->
        <section class="content">
        <div class="row">
        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Profile</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              @foreach($nomor as $profile)
                <div class="form-group">
                  <label class="control-label col-sm-5">Nomor Telepon:</label>
                    <label class="control-label col-sm-7">{{$profile->telephone_number}}<br></label>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-5">Corporate Customer:</label>
                    <label class="control-label col-sm-7">{{$profile->customer}}<br></label>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-5">Account Manager:</label>
                    <label class="control-label col-sm-7">{{$profile->am}}<br></label>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-5">Segment:</label>
                    <label class="control-label col-sm-7">{{$profile->segment}}<br></label>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-5">Average Revenue:</label>
                    <label class="control-label col-sm-7">{{$profile->revenue}}<br></label>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-5">Previous Case:</label>
                  <label class="control-label col-md-3">{{$jumlah}} times<br></label>
                  <button class="btn btn-primary btn-xs col-md-4 pull-right" data-toggle="modal" data-target="#myModal3"><i class="fa fa-search"></i> <span>View Previous Case</span></button>
                </div>
                @endforeach
            </div>
            <div class="box-footer">
            <div class="form-group">
              <div class="pull-left">
                @foreach($cases as $checks)
                @if($checks->status=='0')
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> <span>Add Activity</span></button>
                @endif
                @if($checks->status=='1')
                <a type="button" href="#" class="btn btn-success"><i class="fa fa-book"></i> <span>View Report</span></a>
                @endif
              </div>
               @if($checks->status=='0')
                <div class="pull-right">
                <button type="button" class="btn btn-danger"><i class="fa fa-edit"></i> <span>Edit Profile</span></button>
              </div>
               @endif
               @endforeach
              </div>
            </div>
          </div>
          </div>

          <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">Case Details</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              @foreach($cases as $kasus)
                <div class="form-group">
                  <label class="control-label col-sm-5">Destination Number:</label>
                    <label class="control-label col-sm-7">{{$kasus->destination}}<br></label>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-5">Destination Country:</label>
                    <label class="control-label col-sm-7">{{$kasus->destination_number}}<br></label>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-5">Duration (sec):</label>
                    <label class="control-label col-sm-7">{{$kasus->duration}}<br></label>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-5">Call Frequency:</label>
                    <label class="control-label col-sm-7">{{$kasus->number_of_call}}<br></label>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-5">Case Type:</label>
                    <label class="control-label col-sm-7">{{$kasus->des1}}<br></label>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-5">Case Date:</label>
                    <label class="control-label col-sm-7">{{$kasus->case_time}}<br></label>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-5">Description:</label>
                    <label class="control-label col-sm-7">{{$kasus->des2}}<br></label>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-5">Evidence:</label>
                  <div class="col-sm-7">
                    <a href="{{URL::to('getcase')}}/{{$kasus->filename}}" type="button" class="btn btn-primary btn-xs"><i class="fa fa-download"></i><span>Download Evidence</span></a>
                  </div>
                </div>

                @endforeach
            </div>
          </div>
          </div>

          <div class="col-md-12">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">List Activity</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Activity Type</th>
                        <th>Description</th>
                        <th>Evidence</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($aktivitas as $act)
                      <tr>
                        <td>{{$act->tanggal}}</td>
                        <td>{{$act->type}}</td>
                        <td>{{$act->descr}}</td>
                        <td><a href="{{URL::to('getact')}}/{{$act->filename}}" type="get" class="btn btn-danger">View</a></td>
                      </tr>
                      @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Date</th>
                        <th>Activity Type</th>
                        <th>Description</th>
                        <th>Evidence</th>
                      </tr>
                    </tfoot>
                  </table>
            </div>
          </div>
          </div>
        <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Activity</h4>
                  </div>
                  <div class="modal-body">
                    <form class="form-horizontal" role="form" action="{{URL::to('addactivity')}}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-sm-2">Activity Date:</label>
                          <div class="col-sm-10">
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            @foreach($cases as $kasuss)
                            <input class="form-control" type="hidden" name="idcase" id="idcase" value="{{$kasuss->id_case}}">
                            @endforeach
                            <input type="text" name="actdate" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask placeholder="dd/mm/yyyy">
                          </div><!-- /.input group -->
                          </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="casetype">Activity Type:</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="acttype" id="casetype">
                          @foreach($actlist as $list)
                            <option value="{{$list->id_parameter}}">{{$list->description}}</option>
                            @endforeach
                        </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="deskripsi">Description:</label>
                      <div class="col-sm-10">
                      <textarea class="form-control" rows="6" id="deskripsi" name="deskripsi"></textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-sm-2" for="upload">Upload Evidence:</label>
                      <div class="col-sm-10">
                        <input type="file" name="fileupload" id="fileToUpload">
                      </div>
                    </div>

                    {{csrf_field()}}
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal2">Add Activity</button>

                  </div>
                </div>
              </div>
            </div>
            <div class="modal fade" id="myModal2" role="dialog">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ATTENTION!</h4>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure to add this activity?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Yes</button>
                  </div>
                </div>
              </div>
              </form>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="myModal3" role="dialog">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Previous Case</h4>
                  </div>
                  <div class="modal-body">
                    <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Case Date</th>
                        <th>Destination Number</th>
                        <th>Destination Country</th>
                        <th>Duration(sec)</th>
                        <th>Call Frequency</th>
                        <th>Case Type</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($history as $past)
                      <tr>
                        <td>{{$past->case_time}}</td>
                        <td>{{$past->destination_number}}</td>
                        <td>{{$past->destination}}</td>
                        <td>{{$past->duration}}</td>
                        <td>{{$past->number_of_call}}</td>
                        <td>{{$past->description}}</td>
                      </tr>
                      @endforeach
                    </tbody>
                      <tfoot>
                      <tr>
                        <th>Case Date</th>
                        <th>Destination Number</th>
                        <th>Destination Country</th>
                        <th>Duration(sec)</th>
                        <th>Call Frequency</th>
                        <th>Case Type</th>                      
                      </tr>
                    </tfoot>
                  </table>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

@endsection