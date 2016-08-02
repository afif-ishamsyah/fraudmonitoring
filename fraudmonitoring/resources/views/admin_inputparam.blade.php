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
        <div class="col-md-12"><div class="alert alert-danger">{{ Session::get('fail') }}</div></div>
        @endif

        @if (Session::has('success'))
        <div class="col-md-12"><div class="alert alert-success">{{ Session::get('success') }}</div></div>
        @endif
        
        <div class="col-md-6">
        <div class="box box-danger">
          <div class="box-header">
            <div class="box-title">Case Parameter</div>
          </div>
          
          <div class="box-body">
          <form class="form-horizontal" role="form" action="{{URL::to('addcaseparam')}}" method="post">
            <div class="form-group" style="margin-bottom:113px;">
              <label class="control-label col-sm-2" for="namaparameter">Name:</label>
              <div class="col-sm-9">
                <input class="form-control" name="parameter" id="namaparameter" placeholder="Masukkan Nama Parameter" required>
              </div>
            </div>

            </div>
            {{csrf_field()}}
            <div class="box-footer">
              <div class="form-group">
              <div class=" pull-right">
                <button type="submit" class="btn btn-primary">Create Case Parameter</button>
              </div>
            </div>
            </form>
            </div>

            </div>
          </div>

          <div class="col-md-6">
          <div class="box box-danger">
          
          <div class="box-header">
            <div class="box-title">Activity Parameter</div>
          </div>
          
          <div class="box-body">
          <form class="form-horizontal" role="form" action="{{URL::to('addactparam')}}" method="post">
            <div class="form-group">
              <label class="control-label col-sm-2" for="namaparameter">Name:</label>
              <div class="col-sm-9">
                <input class="form-control" name="parameter" id="namaparameter" placeholder="Masukkan Nama Parameter" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="namaparameter">Code:</label>
              <div class="col-sm-9">
                <input class="form-control" name="akronim" id="namaparameter" placeholder="Masukkan Kode Parameter (3 Karakter Kapital)" pattern=".{3,3}" required>
              </div>
            </div>

              <div class="form-group">
                <label  class="control-label col-sm-2" for="tipe">Type:</label>
                  <div class="col-sm-9">
                    <select class="form-control" name="status" id="tipeparam" required>
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
                <button type="submit" class="btn btn-primary">Create Activity Parameter</button>
              </div>
            </div>
            </form>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="box box-danger">
          <div class="box-header">
            <div class="box-title">List Case Parameter</div>
          </div>

          <div class="box-body">
            <table id="example4" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($caseparam as $casepar)
                      <tr>
                        <td>{{$casepar->description}}</td>
                        <td>
                        <div class="col-md-12">
                            <a href="{{URL::to('deletecaseparam')}}/{{$casepar->id_parameter}}" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> <span>Delete</span></a>
                        </div>
                        </td>
                      </tr>
                      @endforeach
                      </tbody>
                  </table>
                  </div>
            </div>
          </div>

        <div class="col-md-6">
          <div class="box box-danger">
          <div class="box-header">
            <div class="box-title">List Activity Parameter</div>
          </div>
          <div class="box-body">
            <table id="example5" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Type</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($actparam as $actpar)
                      <tr>
                        <td>{{$actpar->description}}</td>
                        <td>{{$actpar->akronim}}</td>
                        @if($actpar->status=='0')
                        <td>Open</td>
                        @endif
                        @if($actpar->status=='1')
                        <td>Close</td>
                        @endif
                        <td>
                        <div class="col-md-12">
                            <a href="{{URL::to('deleteactparam')}}/{{$actpar->id_parameter}}" type="submit" class="btn btn-danger btn-sm"><i class="fa fa-times"></i> <span>Delete</span></a>
                        </div> 
                        </td>
                      </tr>
                      @endforeach
                      </tbody>
                  </table>
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
                    <p>Are you sure to delete this parameter?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <a type="submit" class="btn btn-success">Yes</a>
                  </div>
                </div>
              </div>
            </div>

        </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <script>
      $(document).ready(function(){
          $('[data-toggle="tooltip"]').tooltip();   
      });
     </script>
@endsection
