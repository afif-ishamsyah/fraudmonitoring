@extends('layout/layout')
@section('content')
      <aside class="main-sidebar">
      <section class="sidebar">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li><a href="{{URL::to('user')}}"><i class="fa fa-home"></i><span>Home</span></a></li>
            <li class="active"><a href="{{URL::to('caseform')}}"><i class="fa fa-edit"></i><span>Input Case</span></a></li>
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
        <h1>Input Data</h1>
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
        <div class="col-sm-12">
        <div class="box box-danger">
        <div class="box-body">
          <form class="form-horizontal" role="form" action="{{URL::to('insert')}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label class="control-label col-sm-2" for="no. telp">Telephone Number:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="telephonenumber" id="notelepon" placeholder="Masukkan Nomor Telepon" pattern=".{1,15}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="no. telp">Main Number:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="mainnumber" id="notelepon" placeholder="Masukkan Nomor Induk" pattern=".{1,15}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="destnumber">Destination Number:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="destnumber" id="destnumber" placeholder="Masukkan Nomor Telepon Tujuan" pattern=".{1,15}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="no. telp">Destination Country:</label>
              <div class="col-sm-10">
                <input class="form-control" name="destcountry" id="notelepon" placeholder="Masukkan Daerah Tujuan Menelpon" pattern=".{1,15}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="durasi">Duration (sec):</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="durasi" id="durasi" placeholder="Masukkan Durasi Menelepon" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="frekueni">Call Frequency:</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" name="frekuensi" id="frekunsi" placeholder="Masukkan Jumlah Menelepon" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="casetype">Case Type:</label>
              <div class="col-sm-10">
                    <select class="form-control" name="casetype" id="casetype" required>
                      @foreach($case as $kasus)
                      <option value="{{$kasus->id_parameter}}">{{$kasus->description}}</option>
                      @endforeach
                    </select>
                  </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Case Date:</label>
                  <div class="col-sm-10">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="casedate" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask placeholder="dd-mm-yyyy" required>
                  </div><!-- /.input group -->
                  </div>
            </div><!-- /.form group -->

            <div class="form-group">
              <label class="control-label col-sm-2" for="deskripsi">Description:</label>
              <div class="col-sm-10">
              <textarea type="text" class="form-control" rows="6" id="deskripsi" name="deskripsi" placeholder="Masukkan Deskripsi Kasus disini (Max. 500 karakter)" maxlength="500" required></textarea>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-sm-2" for="upload">Upload Evidence:</label>
              <div class="col-sm-10">
                <input type="file" name="fileupload" id="fileToUpload" required>
              </div>
            </div>
            {{csrf_field()}}
        </div>

          <div class="box-footer">
            <div class="form-group">
              <div class="pull-right">
                <button type="submit" class="btn btn-primary">Submit</button>
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