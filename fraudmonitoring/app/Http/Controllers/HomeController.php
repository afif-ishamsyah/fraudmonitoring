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
				$data['finish'] = DB::table('kasus')->where('status','=','1')->count('id_case');
				$data['unfinish'] = DB::table('kasus')->where('status','=','0')->count('id_case');

				$data['tahun1'] = Carbon::now()->year;
				$data['tahun2'] = Carbon::now()->year-1;
				$data['tahun3'] = Carbon::now()->year-2;
				$data['tahun4'] = Carbon::now()->year-3;
				$data['tahun5'] = Carbon::now()->year-4;

				$data['closed1'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun1'])->where('status','=','1')->count('id_case');
				$data['open1'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun1'])->where('status','=','0')->count('id_case');

				$data['closed2'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun2'])->where('status','=','1')->count('id_case');
				$data['open2'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun2'])->where('status','=','0')->count('id_case');

				$data['closed3'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun3'])->where('status','=','1')->count('id_case');
				$data['open3'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun3'])->where('status','=','0')->count('id_case');

				$data['closed4'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun4'])->where('status','=','1')->count('id_case');
				$data['open4'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun4'])->where('status','=','0')->count('id_case');
				
				$data['closed5'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun5'])->where('status','=','1')->count('id_case');
				$data['open5'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun5'])->where('status','=','0')->count('id_case');

				$data['parameter'] = DB::table('case_parameter')->join('kasus','case_parameter.id_parameter','=','kasus.case_parameter')
																->select('case_parameter.id_parameter','case_parameter.description',DB::raw('count(kasus.id_case) as total'))
																->groupBy('case_parameter.id_parameter','case_parameter.description')
																->orderBy('case_parameter.id_parameter','asc')
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
				$data['finish'] = DB::table('kasus')->where('status','=','1')->count('id_case');
				$data['unfinish'] = DB::table('kasus')->where('status','=','0')->count('id_case');

				$data['tahun1'] = Carbon::now()->year;
				$data['tahun2'] = Carbon::now()->year-1;
				$data['tahun3'] = Carbon::now()->year-2;
				$data['tahun4'] = Carbon::now()->year-3;
				$data['tahun5'] = Carbon::now()->year-4;

				$data['closed1'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun1'])->where('status','=','1')->count('id_case');
				$data['open1'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun1'])->where('status','=','0')->count('id_case');

				$data['closed2'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun2'])->where('status','=','1')->count('id_case');
				$data['open2'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun2'])->where('status','=','0')->count('id_case');

				$data['closed3'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun3'])->where('status','=','1')->count('id_case');
				$data['open3'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun3'])->where('status','=','0')->count('id_case');

				$data['closed4'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun4'])->where('status','=','1')->count('id_case');
				$data['open4'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun4'])->where('status','=','0')->count('id_case');
				
				$data['closed5'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun5'])->where('status','=','1')->count('id_case');
				$data['open5'] = DB::table('kasus')->whereYear('case_time','=',$data['tahun5'])->where('status','=','0')->count('id_case');

				$data['parameter'] = DB::table('case_parameter')->join('kasus','case_parameter.id_parameter','=','kasus.case_parameter')
																->select('case_parameter.id_parameter','case_parameter.description',DB::raw('count(kasus.id_case) as total'))
																->groupBy('case_parameter.id_parameter','case_parameter.description')
																->orderBy('case_parameter.id_parameter','asc')
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
				$data = array();
				$data['caseparam'] = DB::table('case_parameter')->select('*')->get();
				$data['actparam'] = DB::table('activity_parameter')->select('*')->get();
				return view('admin_inputparam',$data);
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
	      	$userexist = DB::table('profileuser')->select('profileuser.id')->whereRaw('UPPER("USERNAME")=?',[strtoupper($data['username'])])->get();
	  		if($userexist)
	      	{
	        	Session::flash('fail','username sudah digunakan');
	        	return view('admin_inputuser');
	      	}

	      	elseif(!$userexist && $data['password']==$data['conpassword'])
	  		{
	          	$pass=bcrypt( $data['password']);
	          	DB::table('profileuser')->insert([
	             	 'username'=> $data['username'],
	             	 'passwd'=> $pass,
	            	 'previledge'=>$data['previledge']
	             	 ]);
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
	      	$true = DB::table('profileuser')->select('profileuser.id')->whereRaw('UPPER("USERNAME")=?',[strtoupper($data['username'])])->get();

	     	if($true)
	     	{
	     		$passcheck = DB::table('profileuser')->where('profileuser.username','=',$data['username'])->value('passwd');
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
		              ->update(['passwd' => $pass, 'previledge' => $data['previledge']]);
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
	    		Session::flash('fail','Salah Password');
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
	    	$exist = DB::table('case_parameter')->select('id_parameter')
	    										->where('description','=',strtoupper($data['parameter']))
	    										->get();

	    	if($exist)
	    	{
	    		$datas = array();
				$datas['caseparam'] = DB::table('case_parameter')->select('*')->get();
				$datas['actparam'] = DB::table('activity_parameter')->select('*')->get();
	    		Session::flash('fail','Penambahan gagal. Case Parameter sudah ada sebelumnya');
				return view('admin_inputparam',$datas);
	    	}
	    	else
	    	{
		    	DB::table('case_parameter')->insert(['description' => strtoupper($data['parameter'])]);
		    	$datas = array();
				$datas['caseparam'] = DB::table('case_parameter')->select('*')->get();
				$datas['actparam'] = DB::table('activity_parameter')->select('*')->get();
		    	Session::flash('success','Case Parameter berhasil ditambah');
				return view('admin_inputparam',$datas);
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
	    	$exist = DB::table('activity_parameter')->select('id_parameter')->where('description','=',strtoupper($data['parameter']))->get();

	    	if($exist)
	    	{
	    		$datas = array();
				$datas['caseparam'] = DB::table('case_parameter')->select('*')->get();
				$datas['actparam'] = DB::table('activity_parameter')->select('*')->get();
	    		Session::flash('fail','Penambahan gagal. Activity Parameter sudah ada sebelumnya');
				return view('admin_inputparam',$datas);
	    	}
	    	else
	    	{
		    	DB::table('activity_parameter')->insert(['description' => strtoupper($data['parameter']),'akronim'=>strtoupper($data['akronim']), 'status' => $data['status']]);
		    	$datas = array();
				$datas['caseparam'] = DB::table('case_parameter')->select('*')->get();
				$datas['actparam'] = DB::table('activity_parameter')->select('*')->get();
		    	Session::flash('success','Activity Parameter berhasil ditambah');
				return view('admin_inputparam',$datas);
			}
	    }
	    elseif(Request::isMethod('get'))
	    {
	    	return redirect('/');
	    }
	}

	public function deletecaseparam($id)
	{
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				return redirect('user');
			}
			elseif(Auth::user()->previledge=='1')
			{
				$used = DB::table('kasus')->select('id_case')->where('case_parameter','=',$id)->first();

				if($used)
				{
					$data = array();
					$data['caseparam'] = DB::table('case_parameter')->select('*')->get();
					$data['actparam'] = DB::table('activity_parameter')->select('*')->get();
					Session::flash('fail','Maaf. Parameter sudah digunakan dan tidak bisa dihapus');
					return view('admin_inputparam',$data);
				}
				elseif(!$used)
				{
					DB::table('case_parameter')->where('id_parameter','=',$id)->delete();
					$data = array();
					$data['caseparam'] = DB::table('case_parameter')->select('*')->get();
					$data['actparam'] = DB::table('activity_parameter')->select('*')->get();
					Session::flash('success','Parameter telah dihapus');
					return view('admin_inputparam',$data);
				}
				
			}
		}
		else
		{
			return redirect('loginform');
		}
	}

	public function deleteactparam($id)
	{
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				return redirect('user');
			}
			elseif(Auth::user()->previledge=='1')
			{
				$used = DB::table('activity')->select('id_case')->where('activity_number','=',$id)->first();

				if($used)
				{
					$data = array();
					$data['caseparam'] = DB::table('case_parameter')->select('*')->get();
					$data['actparam'] = DB::table('activity_parameter')->select('*')->get();
					Session::flash('fail','Maaf. Parameter sudah digunakan dan tidak bisa dihapus');
					return view('admin_inputparam',$data);
				}
				elseif(!$used)
				{
					DB::table('activity_parameter')->where('id_parameter','=',$id)->delete();
					$data = array();
					$data['caseparam'] = DB::table('case_parameter')->select('*')->get();
					$data['actparam'] = DB::table('activity_parameter')->select('*')->get();
					Session::flash('success','Parameter telah dihapus');
					return view('admin_inputparam',$data);
				}
				
			}
		}
		else
		{
			return redirect('loginform');
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

	public function listprofile()
	{
		if(Auth::check())
		{
			if(Auth::user()->previledge=='0')
			{
				$data = array();
      			$data['nomor'] = DB::connection('oracle2')->table('profil')->join('revenue','profil.notel','=','revenue.notel')
	    														 ->select('profil.notel','profil.namacc','profil.alamat','profil.namaam','profil.segmen','revenue.average')
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
			$status = DB::table('kasus')->where('id_case','=',$id1)->value('status');
			if(Auth::user()->previledge=='0' && $status=='0')
			{
				$data = array();
      			$data['nomor'] = DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
      											     ->select('kasus.id_case','profil.telephone_number','profil.main_number')
      												 ->where('kasus.id_case','=',$id1)->first();

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
	     	DB::table('profil')
		              ->where('id_case', $data['idcase'])
		              ->update(['nipnas' => $data['nipnas'], 'customer' => $data['customer'], 'nikam' => $data['nikam'], 'am' => $data['am'], 'installation'=>$data['alamat'],'segmen' => $data['segmen'], 'revenue' => $data['revenue']]);

			return Redirect::route('closed',$data['idcase']);
	    }
	    elseif(Request::isMethod('get'))
	    {
			return redirect('/');
	    }
	}

	public function checkprofile()
	{
		if(Request::isMethod('post'))
	    {
	     	$data=Input::all();
	     	$datas=array();
	     	$profile = DB::connection('oracle2')->table('profil')->join('revenue','profil.notel','=','revenue.notel')
	    														 ->select('profil.notel','profil.nipnas','profil.namacc','profil.alamat','profil.nikam','profil.namaam','profil.segmen','revenue.average')
	    														 ->where('profil.notel','=',$data['mainnumber'])
	    														 ->first();
	    	if(!$profile)
	    	{
	    		DB::table('profil')
		              ->where('id_case', $data['idcase'])
		              ->update(['main_number'=>$data['mainnumber'],'nipnas'=>'','customer'=>'','installation'=>'','nikam'=>'','am'=>'','segmen'=>'','revenue'=>'']);

	    		$datas['nomor'] = DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
      											     ->select('kasus.id_case','profil.telephone_number','profil.main_number','profil.nipnas','profil.customer','profil.nikam','profil.am','profil.installation','profil.segmen','profil.revenue')
      												 ->where('kasus.id_case','=',$data['idcase'])->first();

      			Session::flash('fail','Data kosong. Silahkan melakukan checking kembali, atau bisa mengisi form profile');
	  			return view('edit',$datas);
	    	}
	    	elseif($profile)
	    	{
	    		DB::table('profil')
		              ->where('id_case', $data['idcase'])
		              ->update(['main_number'=>$data['mainnumber'],'nipnas'=>$profile->nipnas,'customer'=>$profile->namacc,'installation'=>$profile->alamat,'nikam'=>$profile->nikam,'am'=>$profile->namaam,'segmen'=>$profile->segmen,'revenue'=>$profile->average]);
	    	
		       $datas['nomor'] = DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
      											     ->select('kasus.id_case','profil.telephone_number','profil.main_number','profil.nipnas','profil.customer','profil.nikam','profil.am','profil.installation','profil.segmen','profil.revenue')
      												 ->where('kasus.id_case','=',$data['idcase'])->first();

      			Session::flash('success','Data ditemukan. Silahkan mengecek form profile, atau bisa kembali melakukan checking');
	  			return view('edit',$datas);
	    	}
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
	    	
	    	$profile = array();
	    	$profile = DB::connection('oracle2')->table('profil')->join('revenue','profil.notel','=','revenue.notel')
	    														 ->select('profil.nipnas','profil.namacc','profil.alamat','profil.nikam','profil.namaam','profil.segmen','revenue.average')
	    														 ->where('profil.notel','=',$data['mainnumber'])
	    														 ->first();

	    	$caseexist = DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
	    								  ->select('profil.telephone_number')->where('kasus.status','=','0')->where('profil.telephone_number','=',$data['telephonenumber'])
	    								  ->get();


	      	if(!$caseexist)
	  		{
	  			$id =  Uuid::uuid4();	

				$date = str_replace('/', '-', $data['casedate']);
				$dates = date('Y-m-d', strtotime($date));
				
				$extension = $file->getClientOriginalExtension();
				Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));

	          	DB::table('kasus')->insert(['id_case'=>(string)$id,
	          								'case_parameter'=>$data['casetype'],
	          								'case_time'=>$dates,
	          								'description'=>$data['deskripsi'],
	          								'status'=>'0',
	          								'destination'=>$data['destcountry'],
	          								'destination_number'=>$data['destnumber'],
	          								'durasi'=>$data['durasi'],
	          								'number_of_call'=>$data['frekuensi'],
	          								'input_date'=>Carbon::now(),
	          								'filename'=>$file->getFilename().'.'.$extension,
	          								'mime'=>$file->getClientMimeType(),
	          								'original_filename'=>$file->getClientOriginalName()]);
	           	
	          	if($profile)
	          	{
	           		DB::table('profil')->insert(['id_case'=>(string)$id,'telephone_number' => $data['telephonenumber'],'main_number'=>$data['mainnumber'],'nipnas'=>$profile->nipnas,'customer'=>$profile->namacc,'installation'=>$profile->alamat,'nikam'=>$profile->nikam,'am'=>$profile->namaam,'segmen'=>$profile->segmen,'revenue'=>$profile->average]);
	            }
	            elseif(!$profile)
	          	{
	           		DB::table('profil')->insert(['id_case'=>(string)$id,'telephone_number' => $data['telephonenumber'],'main_number'=>$data['mainnumber']]);
	            }

			    return Redirect::route('closed',$id);
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
			    $data['nomor']=DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
			    								->leftJoin('activity_parameter','kasus.last_activity','=','activity_parameter.id_parameter')
			    								->select('kasus.id_case','profil.telephone_number','profil.customer','profil.am','kasus.case_time','kasus.status','activity_parameter.akronim')
			    								->orderBy('kasus.status', 'asc')
			    								->get();

			    // $data['nomor']=DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
       //                                          ->leftJoin('activity','kasus.id_case','=','activity.id_case')
       //                                          ->leftJoin('activity_parameter','activity.activity_number','=','activity_parameter.id_parameter')
       //                                          ->select(DB::raw('kasus.id_case , profil.telephone_number , profil.customer , profil.am , kasus.case_time , kasus.status , activity_parameter.akronim'))
       //                                          ->groupBy('kasus.id_case','profil.telephone_number','profil.customer','profil.am','kasus.case_time','kasus.status','activity_parameter.akronim')
       //                                          ->orderBy('kasus.status', 'asc')
       //                                          ->get();

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
			    	$data['nomor']=DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
			    								->leftJoin('activity_parameter','kasus.last_activity','=','activity_parameter.id_parameter')
			    								->select('kasus.id_case','profil.telephone_number','profil.customer','profil.am','kasus.case_time','kasus.status','activity_parameter.akronim')
			    								->where('profil.telephone_number','LIKE','%'.$datas['telephone'].'%')
			    								->orderBy('kasus.status', 'asc')
			    								->get();
			    }
			    elseif($datas['opsi1']=='2')
			    {
			    	$data['nomor']=DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
			    								->leftJoin('activity_parameter','kasus.last_activity','=','activity_parameter.id_parameter')
			    								->select('kasus.id_case','profil.telephone_number','profil.customer','profil.am','kasus.case_time','kasus.status','activity_parameter.akronim')
			    								->where('profil.telephone_number','LIKE','%'.$datas['telephone'].'%')
			    								->where('kasus.status','=','0')
			    								->get();
			    }
			    elseif($datas['opsi1']=='3')
			    {
			    	$data['nomor']=DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
			    								->leftJoin('activity_parameter','kasus.last_activity','=','activity_parameter.id_parameter')
			    								->select('kasus.id_case','profil.telephone_number','profil.customer','profil.am','kasus.case_time','kasus.status','activity_parameter.akronim')
			    								->where('profil.telephone_number','LIKE','%'.$datas['telephone'].'%')
			    								->where('kasus.status','=','1')
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
			    	$data['nomor']=DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
			    								->leftJoin('activity_parameter','kasus.last_activity','=','activity_parameter.id_parameter')
			    								->select('kasus.id_case','profil.telephone_number','profil.customer','profil.am','kasus.case_time','kasus.status','activity_parameter.akronim')
			    								->where('kasus.case_time','<=',$date)
			    								->orderBy('kasus.status', 'asc')
			    								->get();
			    }
			    elseif($datas['opsi1']=='2')
			    {
			    	$data['nomor']=DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
			    								->leftJoin('activity_parameter','kasus.last_activity','=','activity_parameter.id_parameter')
			    								->select('kasus.id_case','profil.telephone_number','profil.customer','profil.am','kasus.case_time','kasus.status','activity_parameter.akronim')
			    								->where('kasus.case_time','<=',$date)
			    								->where('kasus.status','=','0')
			    								->get();
			    }
			    elseif($datas['opsi1']=='3')
			    {
			    	$data['nomor']=DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
			    								->leftJoin('activity_parameter','kasus.last_activity','=','activity_parameter.id_parameter')
			    								->select('kasus.id_case','profil.telephone_number','profil.customer','profil.am','kasus.case_time','kasus.status','activity_parameter.akronim')
			    								->where('kasus.case_time','<=',$date)
			    								->where('kasus.status','=','1')
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
			    	$data['nomor']=DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
			    								->leftJoin('activity_parameter','kasus.last_activity','=','activity_parameter.id_parameter')
			    								->select('kasus.id_case','profil.telephone_number','profil.customer','profil.am','kasus.case_time','kasus.status','activity_parameter.akronim')
			    								->where('kasus.input_date','<=',$date)
			    								->orderBy('kasus.status', 'asc')
			    								->get();
			    }
			    elseif($datas['opsi1']=='2')
			    {
			    	$data['nomor']=DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
			    								->leftJoin('activity_parameter','kasus.last_activity','=','activity_parameter.id_parameter')
			    								->select('kasus.id_case','profil.telephone_number','profil.customer','profil.am','kasus.case_time','kasus.status','activity_parameter.akronim')
			    								->where('kasus.input_date','<=',$date)
			    								->where('kasus.status','=','0')
			    								->get();
			    }
			    elseif($datas['opsi1']=='3')
			    {
			    	$data['nomor']=DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
			    								->leftJoin('activity_parameter','kasus.last_activity','=','activity_parameter.id_parameter')
			    								->select('kasus.id_case','profil.telephone_number','profil.customer','profil.am','kasus.case_time','kasus.status','activity_parameter.akronim')
			    								->where('kasus.input_date','<=',$date)
			    								->where('kasus.status','=','1')
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
	    		$nama = strtolower($datas['am']);
	    		if($datas['opsi1']=='1')
			    {
			    	$data['nomor']=DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
			    								->leftJoin('activity_parameter','kasus.last_activity','=','activity_parameter.id_parameter')
			    								->select('kasus.id_case','profil.telephone_number','profil.customer','profil.am','kasus.case_time','kasus.status','activity_parameter.akronim')
			    								->whereRaw('LOWER("AM") like ?',['%'.$nama.'%'])
			    								->orderBy('kasus.status', 'asc')
			    								->get();
			    }
			    elseif($datas['opsi1']=='2')
			    {
			    	$data['nomor']=DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
			    								->leftJoin('activity_parameter','kasus.last_activity','=','activity_parameter.id_parameter')
			    								->select('kasus.id_case','profil.telephone_number','profil.customer','profil.am','kasus.case_time','kasus.status','activity_parameter.akronim')
			    								->whereRaw('LOWER("AM") like ?',['%'.$nama.'%'])
			    								->where('kasus.status','=','0')
			    								->get();
			    }
			    elseif($datas['opsi1']=='3')
			    {
			    	$data['nomor']=DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
			    								->leftJoin('activity_parameter','kasus.last_activity','=','activity_parameter.id_parameter')
			    								->select('kasus.id_case','profil.telephone_number','profil.customer','profil.am','kasus.case_time','kasus.status','activity_parameter.akronim')
			    								->whereRaw('LOWER("AM") like ?',['%'.$nama.'%'])
			    								->where('kasus.status','=','1')
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
			    $nama = strtolower($datas['customer']);
			    if($datas['opsi1']=='1')
			    {
			    	$data['nomor']=DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
			    								->leftJoin('activity_parameter','kasus.last_activity','=','activity_parameter.id_parameter')
			    								->select('kasus.id_case','profil.telephone_number','profil.customer','profil.am','kasus.case_time','kasus.status','activity_parameter.akronim')
			    								->whereRaw('LOWER("CUSTOMER") like ?',['%'.$nama.'%'])
			    								->orderBy('kasus.status', 'asc')
			    								->get();
			    }
			    elseif($datas['opsi1']=='2')
			    {
			    	$data['nomor']=DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
			    								->leftJoin('activity_parameter','kasus.last_activity','=','activity_parameter.id_parameter')
			    								->select('kasus.id_case','profil.telephone_number','profil.customer','profil.am','kasus.case_time','kasus.status','activity_parameter.akronim')
			    								->whereRaw('LOWER("CUSTOMER") like ?',['%'.$nama.'%'])
			    								->where('kasus.status','=','0')
			    								->get();
			    }
			    elseif($datas['opsi1']=='3')
			    {
			    	$data['nomor']=DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
			    								->leftJoin('activity_parameter','kasus.last_activity','=','activity_parameter.id_parameter')
			    								->select('kasus.id_case','profil.telephone_number','profil.customer','profil.am','kasus.case_time','kasus.status','activity_parameter.akronim')
			    								->whereRaw('LOWER("CUSTOMER") like ?',['%'.$nama.'%'])
			    								->where('kasus.status','=','1')
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
				  $number = DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
				  						     ->where('kasus.id_case','=',$id)
				  						     ->value('telephone_number');
				  $tanggal = DB::table('kasus')->where('kasus.id_case','=',$id)->value('case_time');

				  $data = array();
			      $data['nomor'] = DB::table('profil')->select('telephone_number','main_number','nipnas','customer','nikam','am','installation','segmen','revenue')->where('profil.id_case','=',$id)->first();

			      
			      $data['aktivitas'] = DB::table('activity')->join('activity_parameter','activity.activity_number','=','activity_parameter.id_parameter')
			      										    ->select('activity.activity_date as tanggal','activity_parameter.description as type','activity.description as descr','activity.filename')
			      										    ->where('activity.id_case','=',$id)
			      										    ->orderBy('activity.input_date','asc')
			      										    ->get();

			      $data['cases'] = DB::table('kasus')->join('case_parameter','kasus.case_parameter','=','case_parameter.id_parameter')
			      									->select('kasus.id_case','kasus.destination','kasus.status','kasus.destination_number','kasus.durasi','kasus.number_of_call','case_parameter.description as des1','kasus.case_time','kasus.description as des2','kasus.filename')
			      									->where('kasus.id_case','=',$id)
			      									->first();

			      $data['actlist'] = DB::table('activity_parameter')->select('description','id_parameter')->get();

			      $data['jumlah'] = DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
			      									 ->where('profil.telephone_number','=',$number)
			      									 ->where('kasus.case_time','<',$tanggal)
			      									 ->count('kasus.id_case');

			      $data['history'] = DB::table('kasus')->join('case_parameter','kasus.case_parameter','=','case_parameter.id_parameter')
				      								->join('profil','kasus.id_case','=','profil.id_case')
				      								->select('kasus.case_time','kasus.destination_number','kasus.destination','kasus.durasi','kasus.number_of_call','case_parameter.description')
				      								->where('profil.telephone_number','=',$number)
				      								->where('kasus.case_time','<',$tanggal)
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

	          	DB::table('activity')->insert(['id_case'=>$data['idcase'],
	          									'activity_date'=>$dates,
	          									'activity_number'=>$data['acttype'],
	          									'description'=>$data['deskripsi'],
	          									'input_date'=>Carbon::now(),
	          									'mime'=>$file->getClientMimeType(),
	          									'original_filename'=>$file->getClientOriginalName(),
	          									'filename'=>$file->getFilename().'.'.$extension]);
	           

	          	$status = DB::table('activity_parameter')->where('id_parameter','=',$data['acttype'])->value('status');

	          	DB::table('kasus')
		              ->where('id_case', $data['idcase'])
		              ->update(['status' => $status,'last_activity'=>$data['acttype']]);

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
				$entry = DB::table('kasus')->select('filename','mime')->where('filename','=',$filename)->first();
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