<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fraud extends CI_Controller {
	
	
//---------------------------------------------------------------------Fungsi Admin------------------------------------------------------

	public function admin()
	{
		$this->load->model('admin');

		$data=array();

		$data['tahun1'] = date("Y");
		$data['tahun2'] = date("Y")-1;
		$data['tahun3'] = date("Y")-2;
		$data['tahun4'] = date("Y")-3;
		$data['tahun5'] = date("Y")-4;

		$data['unfinish'] = $this->admin->countopen();
		$data['finish'] = $this->admin->countclose();

		$data['closed1'] = $this->admin->countperyear($data['tahun1'], '1');
		$data['open1'] = $this->admin->countperyear($data['tahun1'], '0');

		$data['closed2'] = $this->admin->countperyear($data['tahun2'], '1');
		$data['open2'] = $this->admin->countperyear($data['tahun2'], '0');

		$data['closed3'] = $this->admin->countperyear($data['tahun3'], '1');
		$data['open3'] = $this->admin->countperyear($data['tahun3'], '0');

		$data['closed4'] = $this->admin->countperyear($data['tahun4'], '1');
		$data['open4'] = $this->admin->countperyear($data['tahun4'], '0');

		$data['closed5'] = $this->admin->countperyear($data['tahun5'], '1');
		$data['open5'] = $this->admin->countperyear($data['tahun5'], '0');

		$data['parameter'] = $this->admin->countperparam();

		$this->load->view('headerhome'); 
		$this->load->view('home_admin');
		$this->load->view('footerhome',$data);  
	}

	public function userform()
	{
		$this->load->view('header'); 
		$this->load->view('admin_inputuser');
		$this->load->view('footer');  

	}

	public function edituserform()
	{
		$this->load->view('header'); 
		$this->load->view('admin_edituser');
		$this->load->view('footer');  

	}

	public function paramform()
	{
		$this->load->model('admin');
		$data=array();
		$data['caseparam'] = $this->admin->getcaseparam();
		$data['actparam'] = $this->admin->getactparam();
		$this->load->view('header'); 
		$this->load->view('admin_inputparam',$data);
		$this->load->view('footer');  

	}
	public function register()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{
		 	 $this->load->model('admin');
			 $username = $this->input->post('username');
			 $exist = $this->admin->usernameexist($username);

			 if(empty($exist))
			 {
			 	if($this->input->post('password')==$this->input->post('conpassword'))
			 	{
				 	$data = array(
		                'USERNAME' => $username,
		                'PASSWD' =>  $this->admin->hashpassword($this->input->post('password')),
		                'PREVILEDGE' => $this->input->post('previledge')
		         	 );
				 	$this->admin->insertuser($data);
				 	$this->session->set_flashdata('success', 'User berhasil ditambah');
				 	redirect('userform');
				 }
				 else
				 {
				 	$this->session->set_flashdata('fail', 'Konfirmasi password salah');
				 	redirect('userform');
				 }
			 }
			 else
			 {
			 	$this->session->set_flashdata('fail', 'Username sudah ada sebelumnya');
			 	redirect('userform');	
			 }
		}
		elseif ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			redirect('admin');
		}
	}

	public function edituser()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{
		 	 $this->load->model('admin');

			 $username = $this->input->post('username');
			 $exist = $this->admin->usernameexist($username);

			 if(empty($exist))
			 {
			 	$this->session->set_flashdata('fail', 'Username tidak ditemukan');
				redirect('edituserform');
			 }

			 $checkpassword = $this->admin->hashpassword($this->input->post('password'));
			 $check = $this->admin->checkpass($username, $checkpassword);

			 $newpassword = $this->input->post('newpassword');
			 $connewpassword = $this->input->post('connewpassword');

			 if($check==1)
			 {
			 	if($newpassword==$connewpassword)
			 	{
				 	$data = array(
		                'USERNAME' => $username,
		                'PASSWD' =>  $this->admin->hashpassword($newpassword),
		                'PREVILEDGE' => $this->input->post('previledge')
		         	 );
				 	$this->admin->updateuser($username, $data);
				 	$this->session->set_flashdata('success', 'User berhasil diedit');
				 	redirect('edituserform');
				 }
				 else
				 {
				 	$this->session->set_flashdata('fail', 'Konfirmasi password salah');
				 	redirect('edituserform');
				 }
			 }
			 else
			 {
			 	$this->session->set_flashdata('fail', 'Salah Password');
			 	redirect('edituserform');	
			 }
		}
		elseif ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			redirect('admin');
		}
	}

	public function addcaseparam()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{
			$this->load->model('admin');

			$parameter = $this->input->post('parameter');
			$exist = $this->admin->caseparamexist($parameter);

			if($exist==1)
			{
				$this->session->set_flashdata('fail', 'Parameter sudah ada sebelumya');
				redirect('paramform');	 
			}
			else
			{
				$data = array('DESCRIPTION' => strtoupper($parameter));
				$this->admin->insertcaseparamater($data);
				$this->session->set_flashdata('success', 'Parameter berhasil ditambah');
				redirect('paramform');
			}
		}
		elseif ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			redirect('admin');
		}
	}

	public function addactparam()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{
			$this->load->model('admin');

			$parameter = $this->input->post('parameter');
			$akronim = $this->input->post('akronim');
			$exist = $this->admin->actparamexist($parameter, $akronim);

			if($exist==1)
			{
				$this->session->set_flashdata('fail', 'Parameter atau Akronim sudah ada sebelumya');
				redirect('paramform');	 
			}
			else
			{
				$data = array(
					'DESCRIPTION' => strtoupper($parameter),
					'AKRONIM' => strtoupper($akronim),
					'STATUS' => $this->input->post('status')
					);

				$this->admin->insertactparamater($data);
				$this->session->set_flashdata('success', 'Parameter berhasil ditambah');
				redirect('paramform');
			}
		}
		elseif ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			redirect('admin');
		}
	}

	public function deletecaseparam($id)
	{
		$this->load->model('admin');

		$exist = $this->admin->idcaseparamexist($id);

		if($exist==0)
		{
			redirect('admin');
		}

		$used = $this->admin->usedcaseparam($id);

		if($used==1)
		{
			$this->session->set_flashdata('fail', 'Parameter sudah digunakan dan tidak bisa dihapus');
			redirect('paramform');
		}
		else
		{
			$this->admin->deletecase($id);
			$this->session->set_flashdata('success', 'Parameter berhasil dihapus');
			redirect('paramform');
		}
	}

	public function deleteactparam($id)
	{
		$this->load->model('admin');

		$exist = $this->admin->idactparamexist($id);

		if($exist==0)
		{
			redirect('admin');
		}

		$used = $this->admin->usedactparam($id);

		if($used==1)
		{
			$this->session->set_flashdata('fail', 'Parameter sudah digunakan dan tidak bisa dihapus');
			redirect('paramform');
		}
		else
		{
			$this->admin->deleteact($id);
			$this->session->set_flashdata('success', 'Parameter berhasil dihapus');
			redirect('paramform');
		}
	}



//---------------------------------------------------------Fungsi User------------------------------------------------------------------


public function user()
	{
		$this->load->model('user');

		$data=array();

		$data['tahun1'] = date("Y");
		$data['tahun2'] = date("Y")-1;
		$data['tahun3'] = date("Y")-2;
		$data['tahun4'] = date("Y")-3;
		$data['tahun5'] = date("Y")-4;

		$data['unfinish'] = $this->user->countopen();
		$data['finish'] = $this->user->countclose();

		$data['closed1'] = $this->user->countperyear($data['tahun1'], '1');
		$data['open1'] = $this->user->countperyear($data['tahun1'], '0');

		$data['closed2'] = $this->user->countperyear($data['tahun2'], '1');
		$data['open2'] = $this->user->countperyear($data['tahun2'], '0');

		$data['closed3'] = $this->user->countperyear($data['tahun3'], '1');
		$data['open3'] = $this->user->countperyear($data['tahun3'], '0');

		$data['closed4'] = $this->user->countperyear($data['tahun4'], '1');
		$data['open4'] = $this->user->countperyear($data['tahun4'], '0');

		$data['closed5'] = $this->user->countperyear($data['tahun5'], '1');
		$data['open5'] = $this->user->countperyear($data['tahun5'], '0');

		$data['parameter'] = $this->user->countperparam();

		$this->load->view('headerhome'); 
		$this->load->view('home_user');
		$this->load->view('footerhome',$data);  
	}

	public function caseform()
	{
		$this->load->model('user');
		$data = array();
		$data['case'] = $this->user->getcaseparam();

		$this->load->view('header'); 
		$this->load->view('input',$data);
		$this->load->view('footer');  
	}

	public function search()
	{
		$this->load->model('user');
		$data = array();
		$data['nomor'] = $this->user->getsearch();

		$this->load->view('header'); 
		$this->load->view('search',$data);
		$this->load->view('footer');  
	}

	public function searchnumber()
	{
		$this->load->model('user');
		$data = array();
		$opsi = $this->input->get('opsi1');
		$telephone = $this->input->get('telephone');

		if($opsi=='1')
		{
			$data['nomor'] = $this->user->getsearchnumber($telephone);	
		}
		elseif($opsi=='2')
		{
			$data['nomor'] = $this->user->getsearchnumbers($telephone,'0');	
		}
		elseif($opsi=='3')
		{
			$data['nomor'] = $this->user->getsearchnumbers($telephone, '1');	
		}

		$this->load->view('header'); 
		$this->load->view('search',$data);
		$this->load->view('footer'); 
	}

	public function searchdate()
	{
		$this->load->model('user');
		$data = array();
		$opsi = $this->input->get('opsi1');
		$date = $this->input->get('date');

		if($opsi=='1')
		{
			$data['nomor'] = $this->user->getsearchdate($date);	
		}
		elseif($opsi=='2')
		{
			$data['nomor'] = $this->user->getsearchdates($date,'0');	
		}
		elseif($opsi=='3')
		{
			$data['nomor'] = $this->user->getsearchdates($date, '1');	
		}

		$this->load->view('header'); 
		$this->load->view('search',$data);
		$this->load->view('footer'); 
	}

	public function searchinputdate()
	{
		$this->load->model('user');
		$data = array();
		$opsi = $this->input->get('opsi1');
		$date = $this->input->get('date');

		if($opsi=='1')
		{
			$data['nomor'] = $this->user->getsearchinputdate($date);	
		}
		elseif($opsi=='2')
		{
			$data['nomor'] = $this->user->getsearchinputdates($date,'0');	
		}
		elseif($opsi=='3')
		{
			$data['nomor'] = $this->user->getsearchinputdates($date, '1');	
		}

		$this->load->view('header'); 
		$this->load->view('search',$data);
		$this->load->view('footer'); 
	}

	public function searcham()
	{
		$this->load->model('user');
		$data = array();
		$opsi = $this->input->get('opsi1');
		$nama = strtolower($this->input->get('am'));

		if($opsi=='1')
		{
			$data['nomor'] = $this->user->getsearcham($nama);	
		}
		elseif($opsi=='2')
		{
			$data['nomor'] = $this->user->getsearchams($nama,'0');	
		}
		elseif($opsi=='3')
		{
			$data['nomor'] = $this->user->getsearchams($nama, '1');	
		}

		$this->load->view('header'); 
		$this->load->view('search',$data);
		$this->load->view('footer'); 
	}

	public function searchcustomer()
	{
		$this->load->model('user');
		$data = array();
		$opsi = $this->input->get('opsi1');
		$nama = strtolower($this->input->get('customer'));

		if($opsi=='1')
		{
			$data['nomor'] = $this->user->getsearchcustomer($nama);	
		}
		elseif($opsi=='2')
		{
			$data['nomor'] = $this->user->getsearchcustomers($nama,'0');	
		}
		elseif($opsi=='3')
		{
			$data['nomor'] = $this->user->getsearchcustomers($nama, '1');	
		}

		$this->load->view('header'); 
		$this->load->view('search',$data);
		$this->load->view('footer'); 
	}

	public function listprofile()
	{
		$this->load->model('user');
		$data = array();
		$data['nomor'] = $this->user->getlistprofile();

		$this->load->view('header'); 
		$this->load->view('listprofile',$data);
		$this->load->view('footer'); 
	}

	public function cases($id)
	{
		$this->load->model('user');

		if($this->user->checkidcaseexist($id)==0)
		{
			show_404();
		}

		$number = $this->user->getnumber($id);
		$tanggals = $this->user->getdate($id);
		$tanggal = date('d-m-Y',strtotime($tanggals));

		$data = array();

		$data['nomor'] = $this->user->getprofile($id);
		$data['aktivitas'] = $this->user->getactivity($id);
		$data['cases'] = $this->user->getcasedetail($id);
		$data['actlist'] = $this->user->getactparam();
		$data['jumlah'] = $this->user->getcounthistory($number, $tanggal);
		$data['history'] = $this->user->gethistory($number, $tanggal);

		$this->load->view('header'); 
		$this->load->view('case',$data);
		$this->load->view('footer'); 
	}

	public function insertcase()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{
		 	 $this->load->model('user');
		 	 $this->load->model('uuid');

		 	 $mainnumber =  $this->input->post('mainnumber');
		 	 $telephonenumber =  $this->input->post('telephonenumber');

		 	 $date = str_replace('/', '-', $this->input->post('casedate'));
			 $dates = date('d-M-Y', strtotime($date));

		 	 $profile = array();
		 	 $profile = $this->user->getprofile2($mainnumber);

		 	 $caseexist = $this->user->getcaseexist($telephonenumber);

		 	 if($caseexist==0)
		 	 {
		 	 	$id = (string)$this->uuid->v4();

		 	 	$insertdata = array(
		                'ID_CASE' => $id,
		                'CASE_PARAMETER' =>  $this->input->post('casetype'),
		                'CASE_TIME' => $dates,
		                'DESCRIPTION' => $this->input->post('deskripsi'),
		                'STATUS' => '0',
		                'DESTINATION' => $this->input->post('destcountry'),
		                'DESTINATION_NUMBER' => $this->input->post('destnumber'),
		                'DURASI' => $this->input->post('durasi'),
		                'NUMBER_OF_CALL' => $this->input->post('frekuensi'),
		                'INPUT_DATE' => date('d-M-Y')
		        );

		 	 	$this->user->insertcases($insertdata);

		 	 	if(empty($profile))
		 	 	{
		 	 		$profiledata = array(
		                'ID_CASE' => $id,
		                'TELEPHONE_NUMBER' =>  $telephonenumber,
		                'MAIN_NUMBER' =>  $mainnumber,
		                'NIPNAS' => '',
		                'CUSTOMER' => '',
		                'INSTALLATION' => '',
		                'NIKAM' => '',
		                'AM' => '',
		                'SEGMEN' => '',
		                'REVENUE' =>''
		                );
		 	 		$this->user->insertprofiles($profiledata);
		 	 	}
		 	 	else
		 	 	{
		 	 		$profiledata = array(
		                'ID_CASE' => $id,
		                'TELEPHONE_NUMBER' =>  $telephonenumber,
		                'MAIN_NUMBER' =>  $mainnumber,
		                'NIPNAS' => $profile->NIPNAS,
		                'CUSTOMER' => $profile->NAMACC,
		                'INSTALLATION' => $profile->ALAMAT,
		                'NIKAM' => $profile->NIKAM,
		                'AM' => $profile->NAMAAM,
		                'SEGMEN' =>  $profile->SEGMEN,
		                'REVENUE' => $profile->AVERAGE
		                );
		 	 		$this->user->insertprofiles($profiledata);
		 	 	}

		 	 	redirect('cases/'.$id);
		 	 }
		 	 else
		 	 {
		 	 	$this->session->set_flashdata('fail', 'Parameter sudah digunakan dan tidak bisa dihapus');
		 	 	redirect('caseform');
		 	 }
			
		}
		elseif ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			redirect('user');
		}
	}

	public function addactivity()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{
			$this->load->model('user');

			$id = $this->input->post('idcase');

		 	 $date = str_replace('/', '-', $this->input->post('actdate'));
			 $dates = date('d-M-Y', strtotime($date));

			 $data = array(
		                'ID_CASE' => $id,
		                'ACTIVITY_DATE' => $dates,
		                'ACTIVITY_NUMBER' => $this->input->post('acttype'),
		                'DESCRIPTION' =>  $this->input->post('deskripsi'),
		                'INPUT_DATE' => date('d-M-Y')
		                );

			 $this->user->inseractivity($data);

			 $status = $this->user->getstatus($this->input->post('acttype'));

			 $casedata = array(
		                'STATUS' =>  $status,
		                'LAST_ACTIVITY' =>   $this->input->post('acttype')
		                );

			 $this->user->insertlastactivity($id ,$casedata);

			 redirect('cases/'.$id);
		}
		elseif ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			redirect('user');
		}
	}

	public function editingprofile($id)
	{
		$this->load->model('user');

		if($this->user->checkidcaseexist($id)==0)
		{
			show_404();
		}

		$status = $this->user->getstatusbyid($id);

		if($status=='0')
		{
			$data = array();
			$data['nomor'] = $this->user->getcasenumbers($id);

			$this->load->view('header'); 
			$this->load->view('edit',$data);
			$this->load->view('footer'); 
		}
		elseif($status=='1')
		{
			redirect('user');
		}

	}
	// $status = DB::table('kasus')->where('id_case','=',$id1)->value('status');
	// 		if(Auth::user()->previledge=='0' && $status=='0')
	// 		{
	// 			$data = array();
 //      			$data['nomor'] = DB::table('kasus')->join('profil','kasus.id_case','=','profil.id_case')
 //      											     ->select('kasus.id_case','profil.telephone_number','profil.main_number')
 //      												 ->where('kasus.id_case','=',$id1)->first();

	//   			return view('edit',$data);
	// 		}
	// 		elseif(Auth::user()->previledge=='0' && $status=='1')
	// 		{
	// 			return redirect('user');
	// 		}
	// 		elseif(Auth::user()->previledge=='1')
	// 		{
	// 			return redirect('admin');
	// 		}

}

?>