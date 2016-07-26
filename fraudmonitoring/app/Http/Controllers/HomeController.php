<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Response;
use Auth;
use Session;
use Validator;
use DB;
use Request;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Hash;



class HomeController extends Controller
{
	public function home()
	{
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				return redirect('user');
			}
			elseif(Auth::user()->previledge=='1')
			{
				return redirect('admin');
			}
		}
		else
		{
			return redirect('loginform');
		}
	}

	public function user()
	{
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				$data = array();
				$data['finish'] = DB::table('case')->where('status','=','1')->count('id_case');
				$data['unfinish'] = DB::table('case')->where('status','=','0')->count('id_case');

				$data['tahun1'] = Carbon::now()->year;
				$data['tahun2'] = Carbon::now()->year-1;
				$data['tahun3'] = Carbon::now()->year-2;
				$data['tahun4'] = Carbon::now()->year-3;
				$data['tahun5'] = Carbon::now()->year-4;

				$data['closed1'] = DB::table('case')->whereYear('case_time','=',$data['tahun1'])->where('status','=','1')->count('id_case');
				$data['open1'] = DB::table('case')->whereYear('case_time','=',$data['tahun1'])->where('status','=','0')->count('id_case');

				$data['closed2'] = DB::table('case')->whereYear('case_time','=',$data['tahun2'])->where('status','=','1')->count('id_case');
				$data['open2'] = DB::table('case')->whereYear('case_time','=',$data['tahun2'])->where('status','=','0')->count('id_case');

				$data['closed3'] = DB::table('case')->whereYear('case_time','=',$data['tahun3'])->where('status','=','1')->count('id_case');
				$data['open3'] = DB::table('case')->whereYear('case_time','=',$data['tahun3'])->where('status','=','0')->count('id_case');

				$data['closed4'] = DB::table('case')->whereYear('case_time','=',$data['tahun4'])->where('status','=','1')->count('id_case');
				$data['open4'] = DB::table('case')->whereYear('case_time','=',$data['tahun4'])->where('status','=','0')->count('id_case');
				
				$data['closed5'] = DB::table('case')->whereYear('case_time','=',$data['tahun5'])->where('status','=','1')->count('id_case');
				$data['open5'] = DB::table('case')->whereYear('case_time','=',$data['tahun5'])->where('status','=','0')->count('id_case');

				$data['parameter'] = DB::table('case_parameter')->join('case','case_parameter.id_parameter','=','case.case_parameter')
																->select('case_parameter.description',DB::raw('count(case.id_case) as total'))
																->groupBy('case.case_parameter')
    	             											->orderBy('case.case_parameter','asc')
    	             											->get();
				return view('home_user',$data);
			}
			elseif(Auth::user()->previledge=='1')
			{
				return redirect('admin');
			}
		}
		else
		{
			return redirect('loginform');
		}
	}

	public function admin()
	{
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				return redirect('user');
			}
			elseif(Auth::user()->previledge=='1')
			{
				
				$data = array();
				$data['finish'] = DB::table('case')->where('status','=','1')->count('id_case');
				$data['unfinish'] = DB::table('case')->where('status','=','0')->count('id_case');

				$data['tahun1'] = Carbon::now()->year;
				$data['tahun2'] = Carbon::now()->year-1;
				$data['tahun3'] = Carbon::now()->year-2;
				$data['tahun4'] = Carbon::now()->year-3;
				$data['tahun5'] = Carbon::now()->year-4;

				$data['closed1'] = DB::table('case')->whereYear('case_time','=',$data['tahun1'])->where('status','=','1')->count('id_case');
				$data['open1'] = DB::table('case')->whereYear('case_time','=',$data['tahun1'])->where('status','=','0')->count('id_case');

				$data['closed2'] = DB::table('case')->whereYear('case_time','=',$data['tahun2'])->where('status','=','1')->count('id_case');
				$data['open2'] = DB::table('case')->whereYear('case_time','=',$data['tahun2'])->where('status','=','0')->count('id_case');

				$data['closed3'] = DB::table('case')->whereYear('case_time','=',$data['tahun3'])->where('status','=','1')->count('id_case');
				$data['open3'] = DB::table('case')->whereYear('case_time','=',$data['tahun3'])->where('status','=','0')->count('id_case');

				$data['closed4'] = DB::table('case')->whereYear('case_time','=',$data['tahun4'])->where('status','=','1')->count('id_case');
				$data['open4'] = DB::table('case')->whereYear('case_time','=',$data['tahun4'])->where('status','=','0')->count('id_case');
				
				$data['closed5'] = DB::table('case')->whereYear('case_time','=',$data['tahun5'])->where('status','=','1')->count('id_case');
				$data['open5'] = DB::table('case')->whereYear('case_time','=',$data['tahun5'])->where('status','=','0')->count('id_case');

				$data['parameter'] = DB::table('case_parameter')->join('case','case_parameter.id_parameter','=','case.case_parameter')
																->select('case_parameter.description',DB::raw('count(case.id_case) as total'))
																->groupBy('case.case_parameter')
    	             											->orderBy('case.case_parameter','asc')
    	             											->get();

				return view('home_admin',$data);
			}
		}
		else
		{
			return redirect('loginform');
		}
	}




	public function loginform()
	{
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				return redirect('user');
			}
			elseif(Auth::user()->previledge=='1')
			{
				return redirect('admin');
			}
		}
		else
		{
			return view('index');
		}
	}

	

	 public function login()
	 {
	    if(Request::isMethod('post'))
	    {
	      $new = Input::only('username','password');
	  
	      if(Auth::attempt($new,true))
	      {

	        $id=Auth::user()->id;
	        return redirect('/');
	      }
	      else
	      {
	        Session::flash('message','Login anda gagal, silahkan cek kembali username dan password');
	        return view('index');
	      }
	    }
	    elseif(Request::isMethod('get'))
	    {
	      return redirect('/');
	    } 
	 }

	public function logout()
  	{
    	Auth::logout();
    	return redirect('/');
 	}

	//fungsi admin-------------------------------------------
	//-------------------------------------------------------

 	public function userform()
	{
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				return redirect('user');
			}
			elseif(Auth::user()->previledge=='1')
			{
				return view('admin_inputuser');
			}
		}
		else
		{
			return redirect('loginform');
		}
	}

	public function paramform()
	{
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				return redirect('user');
			}
			elseif(Auth::user()->previledge=='1')
			{
				return view('admin_inputparam');
			}
		}
		else
		{
			return redirect('loginform');
		}
	}

	public function edituserform()
	{
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				return redirect('user');
			}
			elseif(Auth::user()->previledge=='1')
			{
				return view('admin_edituser');
			}
		}
		else
		{
			return redirect('loginform');
		}
	}

	public function register()
	{
	    if(Request::isMethod('post'))
	    {
	    	$data=Input::all();
	      	$userexist = DB::table('profileuser')->select('profileuser.username')->where(strtolower('profileuser.username'),'=',strtolower($data['username']))->get();
	  		if($userexist)
	      	{
	        	Session::flash('fail','username sudah digunakan');
	        	return view('admin_inputuser');
	      	}

	      	elseif(!$userexist && $data['password']==$data['conpassword'])
	  		{
	          	$pass=bcrypt( $data['password']);
	          	DB::table('profileuser')->insertGetId(array(
	             	 'username'=> $data['username'],
	             	 'password'=> $pass,
	            	 'previledge'=>$data['previledge']
	             	 ));
	          	Session::flash('success','User berhasil ditambah');
	           	return view('admin_inputuser');
	      	}
	      	else
	      	{
	      		Session::flash('fail','konfirmasi password gagal');
	  			return view('admin_inputuser');
	      	}
	    }
	    elseif(Request::isMethod('get'))
	    {
	    	return redirect('/');
	    }
	}


	public function edituser()
	{
	    if(Request::isMethod('post'))
	    {
	     	$data=Input::all();
	     	$true = DB::table('profileuser')->select('profileuser.username')->where('profileuser.username','=',$data['username'])->get();

	     	if($true)
	     	{
	     		$passcheck = DB::table('profileuser')->where('profileuser.username','=',$data['username'])->value('password');
	     	}
	     	else
	    	{
	    		Session::flash('fail','Akun tidak ditemukan');
	    		return view('admin_edituser');
	    	}

	      	if(Hash::check($data['password'],$passcheck))
	      	{
		      	if($data['newpassword']==$data['connewpassword'])	
		      	{
		            $pass=bcrypt( $data['newpassword']);
		            DB::table('profileuser')
		              ->where('username', $data['username'])
		              ->update(['password' => $pass, 'previledge' => $data['previledge']]);
		            Session::flash('success','Berhasil edit akun');
			        return view('admin_edituser');
		      	}
		      	else
		      	{
		        	Session::flash('fail','konfirmasi password gagal');
		        	return view('admin_edituser');
		      	}
	    	}
	    	else
	    	{
	    		Session::flash('fail','Akun tidak ditemukan');
	    		return view('admin_edituser');
	    	}
	    }

	    elseif(Request::isMethod('get'))
	    {
	      return redirect('/');
	    }
	}

	public function addcaseparam()
	{
	    if(Request::isMethod('post'))
	    {
	    	$data=Input::all();
	    	$exist = DB::table('case_parameter')->select('description')->where(strtolower('description'),'=',strtolower($data['parameter']))->get();

	    	if($exist)
	    	{
	    		Session::flash('fail','Penambahan gagal. Case Parameter sudah ada sebelumnya');
				return view('admin_inputparam');
	    	}
	    	else
	    	{
		    	DB::table('case_parameter')->insert(['description' => $data['parameter']]);
		    	Session::flash('success','Case Parameter berhasil ditambah');
				return view('admin_inputparam');
			}
	    }
	    elseif(Request::isMethod('get'))
	    {
	    	return redirect('/');
	    }
	}

	public function addactparam()
	{
	    if(Request::isMethod('post'))
	    {
	    	$data=Input::all();
	    	$exist = DB::table('activity_parameter')->select('description')->where(strtolower('description'),'=',strtolower($data['parameter']))->get();

	    	if($exist)
	    	{
	    		Session::flash('fail','Penambahan gagal. Activity Parameter sudah ada sebelumnya');
				return view('admin_inputparam');
	    	}
	    	else
	    	{
		    	DB::table('activity_parameter')->insert(['description' => $data['parameter'], 'status' => $data['status']]);
		    	Session::flash('success','Activity Parameter berhasil ditambah');
				return view('admin_inputparam');
			}
	    }
	    elseif(Request::isMethod('get'))
	    {
	    	return redirect('/');
	    }
	}
	

	 //fungsi user----------------------------------------------
	//----------------------------------------------------------

	public function caseform()
	{
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				$choose = array();
			    $choose['case'] = DB::table('case_parameter')->select('description', 'id_parameter')->get();

				return view('input',$choose);
			}
			elseif(Auth::user()->previledge=='1')
			{
				return redirect('admin');
			}
		}
		else
		{
			return redirect('loginform');
		}
	  
	}

	public function editprofile()
	{
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				$data = array();
      			$data['nomor'] = DB::table('case')->join('profile','case.id_case','=','profile.id_case')
      											  ->select('profile.id_case','profile.telephone_number','profile.main_number','profile.customer','profile.am','profile.segment','profile.revenue','profile.installation','case.status')
      											  ->where('case.status','=','0')
      											  ->get();

	  			return view('edit_profile',$data);
			}
			elseif(Auth::user()->previledge=='1')
			{
				return redirect('admin');
			}
		}
		else
		{
			return redirect('loginform');
		}
	}

	public function editingprofile($id1)
	{
		if(Auth::check())
		{
			$status = DB::table('case')->where('id_case','=',$id1)->value('status');
			if(Auth::user()->previledge=='0' && $status=='0')
			{
				$data = array();
      			$data['nomor'] = DB::table('case')->join('profile','case.id_case','=','profile.id_case')
      											     ->select('case.id_case','profile.telephone_number','profile.main_number','profile.nipnas','profile.customer','profile.nikam','profile.am','profile.installation','profile.segment','profile.revenue','case.status')
      												 ->where('case.id_case','=',$id1)->first();

	  			return view('edit',$data);
			}
			elseif(Auth::user()->previledge=='0' && $status=='1')
			{
				return redirect('user');
			}
			elseif(Auth::user()->previledge=='1')
			{
				return redirect('admin');
			}
		}
		else
		{
			return redirect('loginform');
		}
	}

	public function editingprofileprocess()
	{
	    if(Request::isMethod('post'))
	    {
	     	$data=Input::all();
	     	DB::table('profile')
		              ->where('id_case', $data['idcase'])
		              ->update(['nipnas' => $data['nipnas'], 'customer' => $data['customer'], 'nikam' => $data['nikam'], 'am' => $data['am'], 'installation'=>$data['alamat'],'segment' => $data['segment'], 'revenue' => $data['revenue']]);

		    $datas = array();
      		$datas['nomor'] = DB::table('case')->join('profile','case.id_case','=','profile.id_case')
      										  ->select('profile.id_case','profile.telephone_number','profile.main_number','profile.customer','profile.am','profile.segment','profile.revenue','profile.installation','case.status')
      										  ->where('case.status','=','0')
      										  ->get();

		    Session::flash('success','Edit profile berhasil');
			return view('edit_profile',$datas);
	    }
	    elseif(Request::isMethod('get'))
	    {
			return redirect('/');
	    }
	}

	public function insertcase()
	{
		if(Request::isMethod('post'))
	    {
	    	$file = Request::file('fileupload');
	    	$data=Input::all();
	    	
	    	$caseexist = DB::table('case')->select('case.telephone_number')->where('case.status','=','0')->where('case.telephone_number','=',$data['telephonenumber'])->get();


	      	if(!$caseexist)
	  		{
	  			$id =  Uuid::uuid4();

				$date = str_replace('/', '-', $data['casedate']);
				$dates = date('Y-m-d', strtotime($date));
				
				$extension = $file->getClientOriginalExtension();
				Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));

	          	DB::table('case')->insert(['id_case'=>$id,'telephone_number'=>$data['telephonenumber'],'destination'=>$data['destcountry'],'destination_number'=>$data['destnumber'],'duration'=>$data['durasi'],'number_of_call'=>$data['frekuensi'],'case_parameter'=>$data['casetype'],'case_time'=>$dates,'description'=>$data['deskripsi'],'input_date'=>Carbon::now(),'mime'=>$file->getClientMimeType(),'original_filename'=>$file->getClientOriginalName(),'filename'=>$file->getFilename().'.'.$extension]);
	           	DB::table('profile')->insert(['id_case'=>$id,'telephone_number' => $data['telephonenumber'],'main_number'=>$data['mainnumber']]);
	           
	           	$choose = array();
			    $choose['case'] = DB::table('case_parameter')->select('description', 'id_parameter')->get();

			    Session::flash('success','Case berhasil ditambah');
				return view('input',$choose);
	      	}
	      	else
	      	{
	      		$choose = array();
			    $choose['case'] = DB::table('case_parameter')->select('description', 'id_parameter')->get();
	      		Session::flash('fail','Input gagal. Nomor masih dalam proses');
        		return view('input',$choose);
	      	}
	    }
	    elseif(Request::isMethod('get'))
	    {
	      return redirect('/');
	    }
	}

	public function search()
	{
	    if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				$data=array();
			    $data['nomor']=DB::table('case')->join('profile','case.id_case','=','profile.id_case')
			    								->select('case.id_case','case.telephone_number','profile.customer','profile.am','case.case_time','case.status')
			    								->orderBy('case.status', 'asc')
			    								->get();
			    return view('search',$data);
			}
			elseif(Auth::user()->previledge=='1')
			{
				return redirect('admin');
			}
		}
		else
		{
			return redirect('loginform');
		}
	}

	public function searchnumber()
	{	
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				$datas=Input::all();
			    $data=array();

			    if($datas['opsi1']=='1')
			    {
			    	$data['nomor']=DB::table('case')->join('profile','case.id_case','=','profile.id_case')
			    								->select('case.id_case','case.telephone_number','profile.customer','profile.am','case.case_time','case.status')
			    								->where('case.telephone_number','LIKE','%'.$datas['telephone'].'%')
			    								->orderBy('case.status', 'desc')
			    								->get();
			    }
			    elseif($datas['opsi1']=='2')
			    {
			    	$data['nomor']=DB::table('case')->join('profile','case.id_case','=','profile.id_case')
			    								->select('case.id_case','case.telephone_number','profile.customer','profile.am','case.case_time','case.status')
			    								->where('case.telephone_number','LIKE','%'.$datas['telephone'].'%')
			    								->where('case.status','=','0')
			    								->get();
			    }
			    elseif($datas['opsi1']=='3')
			    {
			    	$data['nomor']=DB::table('case')->join('profile','case.id_case','=','profile.id_case')
			    								->select('case.id_case','case.telephone_number','profile.customer','profile.am','case.case_time','case.status')
			    								->where('case.telephone_number','LIKE','%'.$datas['telephone'].'%')
			    								->where('case.status','=','1')
			    								->get();
			    }
			   	//$data['nomor']=DB::table('case')->select('case.telephone_number','case.id_case')->where('case.telephone_number','LIKE','%'.$datas['telephone'].'%')->where('case.status','=','0')->get();
			    return view('search',$data);
			}
			elseif(Auth::user()->previledge=='1')
			{
				return redirect('admin');
			}
		}
		else
		{
			return redirect('loginform');
		}
	}

	public function searchdate()
	{	
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				$datas=Input::all();
				$date = Carbon::createFromFormat('d/m/Y', $datas['date']);
			    $data=array();
			    if($datas['opsi1']=='1')
			    {
			    	$data['nomor']=DB::table('case')->join('profile','case.id_case','=','profile.id_case')
			    								->select('case.id_case','case.telephone_number','profile.customer','profile.am','case.case_time','case.status')
			    								->where('case.case_time','<=',$date)
			    								->orderBy('case.status', 'desc')
			    								->get();
			    }
			    elseif($datas['opsi1']=='2')
			    {
			    	$data['nomor']=DB::table('case')->join('profile','case.id_case','=','profile.id_case')
			    								->select('case.id_case','case.telephone_number','profile.customer','profile.am','case.case_time','case.status')
			    								->where('case.case_time','<=',$date)
			    								->where('case.status','=','0')
			    								->get();
			    }
			    elseif($datas['opsi1']=='3')
			    {
			    	$data['nomor']=DB::table('case')->join('profile','case.id_case','=','profile.id_case')
			    								->select('case.id_case','case.telephone_number','profile.customer','profile.am','case.case_time','case.status')
			    								->where('case.case_time','<=',$date)
			    								->where('case.status','=','1')
			    								->get();
			    }
			    return view('search',$data);
			}
			elseif(Auth::user()->previledge=='1')
			{
				return redirect('admin');
			}
		}
		else
		{
			return redirect('loginform');
		}
	}

	public function searchinputdate()
	{	
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				$datas=Input::all();
				$date = Carbon::createFromFormat('d/m/Y', $datas['date']);
			    $data=array();
			    if($datas['opsi1']=='1')
			    {
			    	$data['nomor']=DB::table('case')->join('profile','case.id_case','=','profile.id_case')
			    								->select('case.id_case','case.telephone_number','profile.customer','profile.am','case.case_time','case.status')
			    								->where('case.input_date','<=',$date)
			    								->orderBy('case.status', 'desc')
			    								->get();
			    }
			    elseif($datas['opsi1']=='2')
			    {
			    	$data['nomor']=DB::table('case')->join('profile','case.id_case','=','profile.id_case')
			    								->select('case.id_case','case.telephone_number','profile.customer','profile.am','case.case_time','case.status')
			    								->where('case.input_date','<=',$date)
			    								->where('case.status','=','0')
			    								->get();
			    }
			    elseif($datas['opsi1']=='3')
			    {
			    	$data['nomor']=DB::table('case')->join('profile','case.id_case','=','profile.id_case')
			    								->select('case.id_case','case.telephone_number','profile.customer','profile.am','case.case_time','case.status')
			    								->where('case.input_date','<=',$date)
			    								->where('case.status','=','1')
			    								->get();
			    }
			    return view('search',$data);
			}
			elseif(Auth::user()->previledge=='1')
			{
				return redirect('admin');
			}
		}
		else
		{
			return redirect('loginform');
		}
	}

	public function searcham()
	{
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				$datas=Input::all();
	    		$data=array();
	    		if($datas['opsi1']=='1')
			    {
			    	$data['nomor']=DB::table('case')->join('profile','case.id_case','=','profile.id_case')
			    								->select('case.id_case','case.telephone_number','profile.customer','profile.am','case.case_time','case.status')
			    								->where(strtolower('profile.am'),'LIKE','%'.strtolower($datas['am']).'%')
			    								->orderBy('case.status', 'desc')
			    								->get();
			    }
			    elseif($datas['opsi1']=='2')
			    {
			    	$data['nomor']=DB::table('case')->join('profile','case.id_case','=','profile.id_case')
			    								->select('case.id_case','case.telephone_number','profile.customer','profile.am','case.case_time','case.status')
			    								->where(strtolower('profile.am'),'LIKE','%'.strtolower($datas['am']).'%')
			    								->where('case.status','=','0')
			    								->get();
			    }
			    elseif($datas['opsi1']=='3')
			    {
			    	$data['nomor']=DB::table('case')->join('profile','case.id_case','=','profile.id_case')
			    								->select('case.id_case','case.telephone_number','profile.customer','profile.am','case.case_time','case.status')
			    								->where(strtolower('profile.am'),'LIKE','%'.strtolower($datas['am']).'%')
			    								->where('case.status','=','1')
			    								->get();
			    }
	    		return view('search',$data);
			}
			elseif(Auth::user()->previledge=='1')
			{
				return redirect('admin');
			}
		}
		else
		{
			return redirect('loginform');
		}

	}

	public function searchcustomer()
	{
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				$datas=Input::all();
			    $data=array();
			    if($datas['opsi1']=='1')
			    {
			    	$data['nomor']=DB::table('case')->join('profile','case.id_case','=','profile.id_case')
			    								->select('case.id_case','case.telephone_number','profile.customer','profile.am','case.case_time','case.status')
			    								->where(strtolower('profile.customer'),'LIKE','%'.strtolower($datas['customer']).'%')
			    								->orderBy('case.status', 'desc')
			    								->get();
			    }
			    elseif($datas['opsi1']=='2')
			    {
			    	$data['nomor']=DB::table('case')->join('profile','case.id_case','=','profile.id_case')
			    								->select('case.id_case','case.telephone_number','profile.customer','profile.am','case.case_time','case.status')
			    								->where(strtolower('profile.customer'),'LIKE','%'.strtolower($datas['customer']).'%')
			    								->where('case.status','=','0')
			    								->get();
			    }
			    elseif($datas['opsi1']=='3')
			    {
			    	$data['nomor']=DB::table('case')->join('profile','case.id_case','=','profile.id_case')
			    								->select('case.id_case','case.telephone_number','profile.customer','profile.am','case.case_time','case.status')
			    								->where(strtolower('profile.customer'),'LIKE','%'.strtolower($datas['customer']).'%')
			    								->where('case.status','=','1')
			    								->get();
			    }
			    return view('search',$data);
			}
			elseif(Auth::user()->previledge=='1')
			{
				return redirect('admin');
			}
		}
		else
		{
			return redirect('loginform');
		}

	}

	public function cases($id)
	{

		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				  $number = DB::table('case')->where('case.id_case','=',$id)->value('telephone_number');
				  $tanggal = DB::table('case')->where('case.id_case','=',$id)->value('case_time');

				  $data = array();
			      $data['nomor'] = DB::table('profile')->select('telephone_number','main_number','nipnas','customer','nikam','am','installation','segment','revenue')->where('profile.id_case','=',$id)->first();

			      
			      $data['aktivitas'] = DB::table('activity')->join('activity_parameter','activity.activity_number','=','activity_parameter.id_parameter')
			      										    ->select('activity.activity_date as tanggal','activity_parameter.description as type','activity.description as descr','activity.filename')
			      										    ->where('activity.id_case','=',$id)
			      										    ->get();

			      $data['cases'] = DB::table('case')->join('case_parameter','case.case_parameter','=','case_parameter.id_parameter')
			      									->select('case.id_case','case.telephone_number','case.destination','case.status','case.destination_number','case.duration','case.number_of_call','case_parameter.description as des1','case.case_time','case.description as des2','case.filename')
			      									->where('case.id_case','=',$id)
			      									->first();

			      $data['actlist'] = DB::table('activity_parameter')->select('description','id_parameter')->get();

			      $data['jumlah'] = DB::table('case')->where('case.telephone_number','=',$number)
			      									 ->where('case.case_time','<',$tanggal)
			      									 ->count('case.id_case');

			      $data['history'] = DB::table('case')->join('case_parameter','case.case_parameter','=','case_parameter.id_parameter')
			      								->select('case.case_time','case.destination_number','case.destination','case.duration','case.number_of_call','case_parameter.description')
			      								->where('case.telephone_number','=',$number)
			      								->where('case.case_time','<',$tanggal)
			      								->get();
				  return view('activity',$data);
			}
			elseif(Auth::user()->previledge=='1')
			{
				return redirect('admin');
			}
		}
		else
		{
			return redirect('loginform');
		}
	 
	}

	public function addactivity()
	{
		if(Request::isMethod('post'))
	    {
	    		$file = Request::file('fileupload');
	    		$data=Input::all();

	    		$date = str_replace('/', '-',$data['actdate']);
				$dates = date('Y-m-d', strtotime($date));

				$extension = $file->getClientOriginalExtension();
				Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));

	          	DB::table('activity')->insert(['id_case'=>$data['idcase'],'activity_date'=>$dates,'activity_number'=>$data['acttype'],'description'=>$data['deskripsi'],'input_date'=>Carbon::now(),'mime'=>$file->getClientMimeType(),'original_filename'=>$file->getClientOriginalName(),'filename'=>$file->getFilename().'.'.$extension]);
	           

	          	$status = DB::table('activity_parameter')->where('id_parameter','=',$data['acttype'])->value('status');

	          	DB::table('case')
		              ->where('id_case', $data['idcase'])
		              ->update(['status' => $status]);

		        if($status=='0')
		        {
	         		return Redirect::back();
	         		
	         	}
	         	elseif($status=='1')
	         	{
	         		return Redirect::route('closed',$data['idcase']);
	         	}

	    }
	    elseif(Request::isMethod('get'))
	    {
			return redirect('/');
	    }
	}

	public function getact($filename){
	
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				//$entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
				$entry = array();
				$entry = DB::table('activity')->select('filename','mime')->where('filename','=',$filename)->first();
				$file = Storage::disk('local')->get($entry->filename);
		 
				return (new Response($file, 200))
		              ->header('Content-Type', $entry->mime);
			}
			elseif(Auth::user()->previledge=='1')
			{
				return redirect('admin');
			}
		}
		else
		{
			return redirect('loginform');
		}
	}

	public function getcase($filename){
	
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				//$entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
				$entry = array();
				$entry = DB::table('case')->select('filename','mime')->where('filename','=',$filename)->first();
				$file = Storage::disk('local')->get($entry->filename);
		 
				return (new Response($file, 200))
		              ->header('Content-Type', $entry->mime);
			}
			elseif(Auth::user()->previledge=='1')
			{
				return redirect('admin');
			}
		}
		else
		{
			return redirect('loginform');
		}
	}
}