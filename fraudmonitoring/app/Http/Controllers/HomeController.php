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
				return view('home_user');
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
				return view('home_admin');
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
	        return redirect('/');
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

		//return view('admin_inputuser');
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
		//return view('admin_inputparam');
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
		//return view('admin_edituser');
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
	        	return redirect('userform');
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
	           	return redirect('userform');
	      	}
	      	else
	      	{
	      		Session::flash('fail','konfirmasi password gagal');
	  			return redirect('userform');
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
	     		//$passcheck = DB::table('user')->select('user.password')->where('user.username','=',$data['username'])->first();
	     	}
	     	else
	    	{
	    		Session::flash('fail','Akun tidak ditemukan');
	    		return redirect('edituserform');
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
			         return redirect('edituserform');
		      	}
		      	else
		      	{
		        	Session::flash('fail','konfirmasi password gagal');
		        	return redirect('edituserform');
		      	}
	    	}
	    	else
	    	{
	    		Session::flash('fail','Akun tidak ditemukan');
	    		return redirect('edituserform');
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
				return redirect('paramform');
	    	}
	    	else
	    	{
		    	DB::table('case_parameter')->insert(['description' => $data['parameter']]);
		    	Session::flash('success','Case Parameter berhasil ditambah');
				return redirect('paramform');
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
	    		Session::flash('fail','Penambahan gagal. Case Parameter sudah ada sebelumnya');
				return redirect('paramform');
	    	}
	    	else
	    	{
		    	DB::table('activity_parameter')->insert(['description' => $data['parameter'], 'status' => $data['status']]);
		    	Session::flash('success','Activity Parameter berhasil ditambah');
				return redirect('paramform');
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
      			$data['nomor'] = DB::table('profile')->select('telephone_number','customer','am','segment','revenue')->get();

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
			if(Auth::user()->previledge=='0')
			{
				$data = array();
      			$data['nomor'] = DB::table('profile')->select('telephone_number','nipnas','nikam','customer','am','segment','revenue')->where('profile.telephone_number','=',$id1)->get();

	  			return view('edit',$data);
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
		              ->where('telephone_number', $data['telephonenumber'])
		              ->update(['nipnas' => $data['nipnas'], 'customer' => $data['customer'], 'nikam' => $data['nikam'], 'am' => $data['am'], 'segment' => $data['segment'], 'revenue' => $data['revenue']]);
		    Session::flash('success','Edit profile berhasil');
			return redirect('listprofile');
	    }
	    elseif(Request::isMethod('get'))
	    {
			return redirect('/');
	    }
	}

	public function insertnumber()
	{
		if(Request::isMethod('post'))
	    {
	    	$file = Request::file('fileupload');
	    	$data=Input::all();
	    	
	      	$profileexist = DB::table('profile')->select('profile.telephone_number')->where('profile.telephone_number','=',$data['telephonenumber'])->get();
	      	$caseexist = DB::table('case')->select('case.telephone_number')->where('case.status','=','0')->where('case.telephone_number','=',$data['telephonenumber'])->get();

	  		if(!$profileexist)
	  		{
	          	DB::table('profile')->insert(['telephone_number' => $data['telephonenumber']]);
	      	}

	      	if(!$caseexist)
	  		{
	  			$id =  Uuid::uuid4();

				$date = str_replace('/', '-', $data['casedate']);
				$dates = date('Y-m-d', strtotime($date));
				
				$extension = $file->getClientOriginalExtension();
				Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));

	          	DB::table('case')->insert(['id_case'=>$id,'telephone_number'=>$data['telephonenumber'],'destination'=>$data['destcountry'],'destination_number'=>$data['destnumber'],'duration'=>$data['durasi'],'number_of_call'=>$data['frekuensi'],'case_parameter'=>$data['casetype'],'case_time'=>$dates,'description'=>$data['deskripsi'],'input_date'=>Carbon::now(),'mime'=>$file->getClientMimeType(),'original_filename'=>$file->getClientOriginalName(),'filename'=>$file->getFilename().'.'.$extension]);
	           	Session::flash('success','Case berhasil ditambah');
	           	return redirect('caseform');
	      	}
	      	else
	      	{
	      		Session::flash('fail','Input gagal. Nomor sudah pernah diinput');
        		return redirect('caseform');
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
			    $data['nomor']=DB::table('case')->select('case.telephone_number')->where('case.status','=','0')->get();
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
			    $data['nomor']=DB::table('case')->select('case.telephone_number','case.id_case')->where('case.case_time','<=',$date)->where('case.status','=','0')->get();
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
	    		$data['nomor']=DB::table('profile')->join('case','profile.telephone_number','=','case.telephone_number')
	    										   ->select('case.telephone_number','case.id_case')
	    									       ->where(strtolower('profile.am'),'LIKE','%'.strtolower($datas['am']).'%')->where('case.status','=','0')->get();
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
			    $data['nomor']=DB::table('profile')->join('case','profile.telephone_number','=','case.telephone_number')
			    									->select('case.telephone_number','case.id_case')
			    									->where(strtolower('profile.customer'),'LIKE','%'.strtolower($datas['customer']).'%')->where('case.status','=','0')->get();
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

	public function activity($id1)
	{

		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				  $data = array();
			      $data['nomor'] = DB::table('profile')->select('telephone_number','customer','am','segment','revenue')->where('profile.telephone_number','=',$id1)->get();

			      $idcase = DB::table('case')->where('case.telephone_number','=',$id1)->where('case.status','=','0')->value('id_case');

			      $data['aktivitas'] = DB::table('activity')->join('activity_parameter','activity.activity_number','=','activity_parameter.id_parameter')
			      										    ->select('activity.activity_date as tanggal','activity_parameter.description as type','activity.description as descr','activity.filename')
			      										    ->where('activity.id_case','=',$idcase)
			      										    ->get();

			      $data['cases'] = DB::table('case')->join('case_parameter','case.case_parameter','=','case_parameter.id_parameter')
			      									->select('case.id_case','case.destination','case.status','case.destination_number','case.duration','case.number_of_call','case_parameter.description as des1','case.case_time','case.description as des2','case.filename')
			      									->where('case.id_case','=',$idcase)
			      									->get();

			      $data['actlist'] = DB::table('activity_parameter')->select('description','id_parameter')->get();
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

	public function closedactivity($id)
	{
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				//$entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
				  $number = DB::table('case')->where('case.id_case','=',$id)->value('telephone_number');

				  $data = array();
			      $data['nomor'] = DB::table('profile')->select('telephone_number','customer','am','segment','revenue')->where('profile.telephone_number','=',$number)->get();

			      
			      $data['aktivitas'] = DB::table('activity')->join('activity_parameter','activity.activity_number','=','activity_parameter.id_parameter')
			      										    ->select('activity.activity_date as tanggal','activity_parameter.description as type','activity.description as descr','activity.filename')
			      										    ->where('activity.id_case','=',$id)
			      										    ->get();

			      $data['cases'] = DB::table('case')->join('case_parameter','case.case_parameter','=','case_parameter.id_parameter')
			      									->select('case.id_case','case.destination','case.status','case.destination_number','case.duration','case.number_of_call','case_parameter.description as des1','case.case_time','case.description as des2','case.filename')
			      									->where('case.id_case','=',$id)
			      									->get();

			      $data['actlist'] = DB::table('activity_parameter')->select('description','id_parameter')->get();
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

	public function closesearch()
	{
	    if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				$data=array();
			    $data['nomor']=DB::table('case')->select('case.id_case','case.telephone_number')->where('case.status','=','1')->get();
			    return view('searchclose',$data);
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

	public function closesearchdate()
	{	
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				$datas=Input::all();
				$date = Carbon::createFromFormat('d/m/Y', $datas['date']);
			    $data=array();
			    $data['nomor']=DB::table('case')->select('case.telephone_number','case.id_case')->where('case.case_time','<=',$date)->where('case.status','=','1')->get();
			    return view('searchclose',$data);
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

	public function closesearcham()
	{
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				$datas=Input::all();
			    $data=array();
			    $data['nomor']=DB::table('profile')->join('case','profile.telephone_number','=','case.telephone_number')
			    								   ->select('case.telephone_number','case.id_case')
			    								   ->where(strtolower('profile.am'),'LIKE','%'.strtolower($datas['am']).'%')->where('case.status','=','1')->get();
			    return view('searchclose',$data);
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

	public function closesearchcustomer()
	{
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				$datas=Input::all();
			    $data=array();
			    $data['nomor']=DB::table('profile')->join('case','profile.telephone_number','=','case.telephone_number')
			    									->select('case.telephone_number','case.id_case')
			    									->where(strtolower('profile.customer'),'LIKE','%'.strtolower($datas['customer']).'%')->where('case.status','=','1')->get();
			    return view('searchclose',$data);
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

	
	

