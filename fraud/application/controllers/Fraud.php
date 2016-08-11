<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fraud extends CI_Controller {
	
	


	public function loginform()
	{
		if($this->session->userdata('logged_in'))
	    {
		     $session_data = $this->session->userdata('logged_in');
		     $previledge = $session_data['previledge'];
		     if($previledge=='1')
		     {
		     	redirect('admin');
		     }
		     elseif($previledge=='0')
		     {
		     	redirect('user');
		     }
	   }
	   else
	   {
	   		$this->load->view('login');
	   }
	}

	public function login()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{
		 	 $this->load->model('general');

		 	 $username = $this->input->post('username');
		 	 $password = $this->general->hashpassword($this->input->post('password'));

		 	 $check = $this->general->checklogin($username, $password);

		 	 if($check)
		 	 {
			 	$sess_array = array();
			    foreach($check as $row)
			    {
			    	$sess_array = array(
			         'id' => $row->ID,
			         'username' => $row->USERNAME,
			         'previledge' => $row->PREVILEDGE
			        );
			    }
			    $this->session->set_userdata('logged_in', $sess_array);
			    redirect('home');
			 }
			 else
			 {
			 	$this->session->set_flashdata('fail', 'Username dan Password tidak ditemukan');
			 	redirect('loginform');
			 }
		}
		elseif ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			redirect('home');
		}
	}

	public function home()
	{
	   if($this->session->userdata('logged_in'))
	   {
	     $session_data = $this->session->userdata('logged_in');
	     $previledge = $session_data['previledge'];
	     if($previledge=='1')
	     {
	     	redirect('admin');
	     }
	     elseif($previledge=='0')
	     {
	     	redirect('user');
	     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
	}

	public function logout()
	{
		if($this->session->userdata('logged_in'))
	    {
	    	$this->session->unset_userdata('logged_in');
	   		session_destroy();
	   		redirect('home');
	    }
	    else
	    {
	      redirect('loginform');
	    }
	}
//---------------------------------------------------------------------Fungsi Admin------------------------------------------------------

	public function admin()
	{
		if($this->session->userdata('logged_in'))
	    {
		     $session_data = $this->session->userdata('logged_in');
		     $userdata['username'] = $session_data['username'];
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='1')
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

				$this->load->view('headerhome',$userdata); 
				$this->load->view('home_admin');
				$this->load->view('footerhome',$data);  
		     }
		     elseif($userdata['previledge']=='0')
		     {
		     	redirect('user');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
		
	}

	public function userform()
	{
		if($this->session->userdata('logged_in'))
	    {
		     $session_data = $this->session->userdata('logged_in');
		     $userdata['username'] = $session_data['username'];
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='1')
		     {
		     	$this->load->view('header', $userdata); 
				$this->load->view('admin_inputuser');
				$this->load->view('footer');  
		     }
		     elseif($userdata['previledge']=='0')
		     {
		     	redirect('user');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }

	}

	public function edituserform()
	{
		if($this->session->userdata('logged_in'))
	    {
		     $session_data = $this->session->userdata('logged_in');
		     $userdata['username'] = $session_data['username'];
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='1')
		     {
		     	$this->load->view('header', $userdata); 
				$this->load->view('admin_edituser');
				$this->load->view('footer');  
		     }
		     elseif($userdata['previledge']=='0')
		     {
		     	redirect('user');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
	}

	public function paramform()
	{
		if($this->session->userdata('logged_in'))
	    {
		     $session_data = $this->session->userdata('logged_in');
		     $userdata['username'] = $session_data['username'];
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='1')
		     {
		     	$this->load->model('admin');
				$data=array();
				$data['caseparam'] = $this->admin->getcaseparam();
				$data['actparam'] = $this->admin->getactparam();
				$this->load->view('header',$userdata); 
				$this->load->view('admin_inputparam',$data);
				$this->load->view('footer');  
		     }
		     elseif($userdata['previledge']=='0')
		     {
		     	redirect('user');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }

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
			redirect('home');
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
			redirect('home');
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
			redirect('home');
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
			redirect('home');
		}
	}

	public function changecaseparam($id)
	{
		if($this->session->userdata('logged_in'))
	    {
		     $session_data = $this->session->userdata('logged_in');
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='1')
		     {
		     	$this->load->model('admin');

				$exist = $this->admin->idcaseparamexist($id);

				if($exist==0)
				{
					redirect('admin');
				}

				$aktif = $this->admin->getcaseaktif($id);
				$des = $this->admin->desccase($id);

				if($aktif=='1')
				{
					$this->admin->changeaktifcase($id, '0');
					$this->session->set_flashdata('success', 'Case Parameter '.$des.' sudah dinonaktifkan');
					redirect('paramform');
				}
				elseif($aktif=='0')
				{
					$this->admin->changeaktifcase($id, '1');
					$this->session->set_flashdata('success', 'Case Parameter '.$des.' berhasil diaktifkan');
					redirect('paramform');
				}
		     }
		     elseif($userdata['previledge']=='0')
		     {
		     	redirect('user');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
		
	}

	public function changeactparam($id)
	{
		if($this->session->userdata('logged_in'))
	    {
		     $session_data = $this->session->userdata('logged_in');
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='1')
		     {
		     	$this->load->model('admin');

				$exist = $this->admin->idactparamexist($id);

				if($exist==0)
				{
					redirect('admin');
				}

				$aktif = $this->admin->getactaktif($id);
				$des = $this->admin->descact($id);

				if($aktif=='1')
				{
					$this->admin->changeaktifactivity($id, '0');
					$this->session->set_flashdata('success', 'Activity Parameter '.$des.' sudah dinonaktifkan');
					redirect('paramform');
				}
				elseif($aktif=='0')
				{
					$this->admin->changeaktifactivity($id, '1');
					$this->session->set_flashdata('success', 'Activity Parameter '.$des.' berhasil diaktifkan');
					redirect('paramform');
				}
				
		     }
		     elseif($userdata['previledge']=='0')
		     {
		     	redirect('user');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
		
	}

	public function editcaseparam()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{
			$this->load->model('admin');

			$id = $this->input->post('idcase');
			$desc = strtoupper($this->input->post('casename'));
			$exist = $this->admin->caseparamexist($desc);

			if($exist==1)
			{
				$this->session->set_flashdata('fail', 'Parameter sudah ada sebelumya');
				redirect('paramform');	 
			}
			else
			{
				$this->admin->editcasepar($id, $desc);
				$this->session->set_flashdata('success', 'Parameter berhasil diubah');
				redirect('paramform');
			}
			
		}
		elseif ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			redirect('home');
		}
	}

	public function editactparam()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{
			$this->load->model('admin');

			$id = $this->input->post('idcase');
			$desc = strtoupper($this->input->post('actname'));
			$akr = strtoupper($this->input->post('actcode'));
			$exist1 = $this->admin->actparamexist1($id, $desc);
			$exist2 = $this->admin->actparamexist2($id, $akr);


			if($exist1==1 || $exist2==1)
			{
				$this->session->set_flashdata('fail', 'Parameter sudah ada sebelumya');
				redirect('paramform');	 
			}
			else
			{
				$data = array(
					'DESCRIPTION' => strtoupper($desc),
					'AKRONIM' => strtoupper($akr)
					);

				$this->admin->editactpar($id, $data);
				$this->session->set_flashdata('success', 'Parameter berhasil diubah');
				redirect('paramform');
			}
			
		}
		elseif ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			redirect('home');
		}
	}



//---------------------------------------------------------Fungsi User------------------------------------------------------------------


public function user()
	{
		if($this->session->userdata('logged_in'))
	    {
		     $session_data = $this->session->userdata('logged_in');
		     $userdata['username'] = $session_data['username'];
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
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

				$this->load->view('headerhome',$userdata); 
				$this->load->view('home_user');
				$this->load->view('footerhome',$data);  
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
	}

	public function caseform()
	{
		if($this->session->userdata('logged_in'))
	    {
			 $session_data = $this->session->userdata('logged_in');
		     $userdata['username'] = $session_data['username'];
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
		     {
		     	$this->load->model('user');
				$data = array();
				$data['case'] = $this->user->getcaseparam();

				$this->load->view('header',$userdata); 
				$this->load->view('input',$data);
				$this->load->view('footer');  
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }

	}

	public function search()
	{
		if($this->session->userdata('logged_in'))
	    {
			 $session_data = $this->session->userdata('logged_in');
		     $userdata['username'] = $session_data['username'];
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
		     {
		     	$this->load->model('user');

				$data = array();
				$data['nomor'] = $this->user->getsearch();
				$data['value'] = 1;

				$this->load->view('header',$userdata); 
				$this->load->view('search',$data);
				$this->load->view('footer');  
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
	}

	public function downloadsearch()
	{
		if($this->session->userdata('logged_in'))
	    {
			 $session_data = $this->session->userdata('logged_in');
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
		     {
		     	$this->load->library('excel');
		     	$this->load->model('user');

				$data = array();
				$data = $this->user->getsearch();
				$count = count($data);

				$objPHPExcel = new PHPExcel();
			    $objPHPExcel->getActiveSheet()->setTitle("Search Result");
			    //Loop Heading
			    $heading=array('No','Nomor Telepon','Tanggal Case','Nama CC','Nama AM');
			    $rowNumberH = 1;
			    $colH = 'A';

			    foreach($heading as $h){
			        $objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
			        $colH++;    
			    }
			    //Loop Result
			    $maxrow=$count+1;
			    $row = 2;
			    $no = 1;
		        foreach($data as $n){
		            //$numnil = (float) str_replace(',','.',$n->nilai);
		            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$no);
		            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$n->TELEPHONE_NUMBER);
		            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,date('d-M-Y',strtotime($n->CASE_TIME)));
		            $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$row,$n->CUSTOMER);
		            $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'.$row,$n->AM);
		            $row++;
		            $no++;
		        }
			    

			    $header = 'a1:e1';
				$objPHPExcel->getActiveSheet()->getStyle($header)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00ffff00');
				$style = array(
				    'font' => array('bold' => true,),
				    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
				    );
				$objPHPExcel->getActiveSheet()->getStyle($header)->applyFromArray($style);

				for ($col = ord('a'); $col <= ord('e'); $col++)
				{
    				$objPHPExcel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
				}
			    //Cell Style
			    $styleArray = array(
			        'borders' => array(
			            'allborders' => array(
			                'style' => PHPExcel_Style_Border::BORDER_THIN
			            )
			        )
			    );
			    $objPHPExcel->getActiveSheet()->getStyle('A1:E'.$maxrow)->applyFromArray($styleArray);
			    //Save as an Excel BIFF (xls) file
			    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');

			    header('Content-Type: application/vnd.ms-excel');
			    header('Content-Disposition: attachment;filename="Search Result.xlsx"');
			    header('Cache-Control: max-age=0');

			    $objWriter->save('php://output');
			    exit();
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
	}

	public function searchnumber()
	{
		if($this->session->userdata('logged_in'))
	    {
			 $session_data = $this->session->userdata('logged_in');
		     $userdata['username'] = $session_data['username'];
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
		     {
		     	$this->load->model('user');
				$data = array();
				$opsi = $this->input->get('opsi1');
				$telephone = $this->input->get('telephone');
				$data['value'] = 2;
				$data['opsi'] = $opsi;
				$data['telephone'] = $telephone;

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

				$this->load->view('header',$userdata); 
				$this->load->view('search',$data);
				$this->load->view('footer'); 
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
		
	}

	public function downloadsearchnumber()
	{
		if($this->session->userdata('logged_in'))
	    {
			 $session_data = $this->session->userdata('logged_in');
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
		     {
		     	$this->load->library('excel');
		     	$this->load->model('user');
		     	$telephone =  $this->uri->segment(2);
  				$opsi =  $this->uri->segment(3);

				$data = array();
				if($opsi=='1')
				{
					$data = $this->user->getsearchnumber($telephone);	
				}
				elseif($opsi=='2')
				{
					$data = $this->user->getsearchnumbers($telephone,'0');	
				}
				elseif($opsi=='3')
				{
					$data = $this->user->getsearchnumbers($telephone, '1');	
				}
				$count = count($data);

				$objPHPExcel = new PHPExcel();
			    $objPHPExcel->getActiveSheet()->setTitle("Search Result");
			    //Loop Heading
			    $heading=array('No','Nomor Telepon','Tanggal Case','Nama CC','Nama AM');
			    $rowNumberH = 1;
			    $colH = 'A';

			    foreach($heading as $h){
			        $objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
			        $colH++;    
			    }
			    //Loop Result
			    $maxrow=$count+1;
			    $row = 2;
			    $no = 1;
		        foreach($data as $n){
		            //$numnil = (float) str_replace(',','.',$n->nilai);
		            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$no);
		            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$n->TELEPHONE_NUMBER);
		            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,date('d-M-Y',strtotime($n->CASE_TIME)));
		            $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$row,$n->CUSTOMER);
		            $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'.$row,$n->AM);
		            $row++;
		            $no++;
		        }
			    

			    $header = 'a1:e1';
				$objPHPExcel->getActiveSheet()->getStyle($header)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00ffff00');
				$style = array(
				    'font' => array('bold' => true,),
				    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
				    );
				$objPHPExcel->getActiveSheet()->getStyle($header)->applyFromArray($style);

				for ($col = ord('a'); $col <= ord('e'); $col++)
				{
    				$objPHPExcel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
				}
			    //Cell Style
			    $styleArray = array(
			        'borders' => array(
			            'allborders' => array(
			                'style' => PHPExcel_Style_Border::BORDER_THIN
			            )
			        )
			    );
			    $objPHPExcel->getActiveSheet()->getStyle('A1:E'.$maxrow)->applyFromArray($styleArray);
			    //Save as an Excel BIFF (xls) file
			    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');

			    header('Content-Type: application/vnd.ms-excel');
			    header('Content-Disposition: attachment;filename="Search Result.xlsx"');
			    header('Cache-Control: max-age=0');

			    $objWriter->save('php://output');
			    exit();
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
	}

	public function searchdate()
	{
		if($this->session->userdata('logged_in'))
	    {
			 $session_data = $this->session->userdata('logged_in');
		     $userdata['username'] = $session_data['username'];
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
		     {
		     	$this->load->model('user');
				$data = array();
				$opsi = $this->input->get('opsi1');
				$date = $this->input->get('date');
				$enddate = $this->input->get('enddate');
				$data['value'] = 3;
				$data['opsi'] = $opsi;
				$data['startdate'] = $date;
				$data['enddate'] = $enddate;

				if($opsi=='1')
				{
					$data['nomor'] = $this->user->getsearchdate($date, $enddate);	
				}
				elseif($opsi=='2')
				{
					$data['nomor'] = $this->user->getsearchdates($date, $enddate, '0');	
				}
				elseif($opsi=='3')
				{
					$data['nomor'] = $this->user->getsearchdates($date, $enddate, '1');	
				}

				$this->load->view('header',$userdata); 
				$this->load->view('search',$data);
				$this->load->view('footer'); 
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
		
	}

	public function downloadsearchdate()
	{
		if($this->session->userdata('logged_in'))
	    {
			 $session_data = $this->session->userdata('logged_in');
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
		     {
		     	$this->load->library('excel');
		     	$this->load->model('user');
		     	$date =  $this->uri->segment(2);
  				$enddate =  $this->uri->segment(3);
  				$opsi =  $this->uri->segment(4);

				$data = array();
				if($opsi=='1')
				{
					$data = $this->user->getsearchdate($date, $enddate);	
				}
				elseif($opsi=='2')
				{
					$data = $this->user->getsearchdates($date, $enddate, '0');	
				}
				elseif($opsi=='3')
				{
					$data = $this->user->getsearchdates($date, $enddate, '1');	
				}
				$count = count($data);

				$objPHPExcel = new PHPExcel();
			    $objPHPExcel->getActiveSheet()->setTitle("Search Result");
			    //Loop Heading
			    $heading=array('No','Nomor Telepon','Tanggal Case','Nama CC','Nama AM');
			    $rowNumberH = 1;
			    $colH = 'A';

			    foreach($heading as $h){
			        $objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
			        $colH++;    
			    }
			    //Loop Result
			    $maxrow=$count+1;
			    $row = 2;
			    $no = 1;
		        foreach($data as $n){
		            //$numnil = (float) str_replace(',','.',$n->nilai);
		            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$no);
		            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$n->TELEPHONE_NUMBER);
		            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,date('d-M-Y',strtotime($n->CASE_TIME)));
		            $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$row,$n->CUSTOMER);
		            $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'.$row,$n->AM);
		            $row++;
		            $no++;
		        }
			    

			    $header = 'a1:e1';
				$objPHPExcel->getActiveSheet()->getStyle($header)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00ffff00');
				$style = array(
				    'font' => array('bold' => true,),
				    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
				    );
				$objPHPExcel->getActiveSheet()->getStyle($header)->applyFromArray($style);

				for ($col = ord('a'); $col <= ord('e'); $col++)
				{
    				$objPHPExcel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
				}
			    //Cell Style
			    $styleArray = array(
			        'borders' => array(
			            'allborders' => array(
			                'style' => PHPExcel_Style_Border::BORDER_THIN
			            )
			        )
			    );
			    $objPHPExcel->getActiveSheet()->getStyle('A1:E'.$maxrow)->applyFromArray($styleArray);
			    //Save as an Excel BIFF (xls) file
			    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');

			    header('Content-Type: application/vnd.ms-excel');
			    header('Content-Disposition: attachment;filename="Search Result.xlsx"');
			    header('Cache-Control: max-age=0');

			    $objWriter->save('php://output');
			    exit();
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
	}

	public function searchinputdate()
	{
		if($this->session->userdata('logged_in'))
	    {
			 $session_data = $this->session->userdata('logged_in');
		     $userdata['username'] = $session_data['username'];
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
		     {
		     	$this->load->model('user');
				$data = array();
				$opsi = $this->input->get('opsi1');
				$date = $this->input->get('date');
				$enddate = $this->input->get('enddate');
				$data['value'] = 4;
				$data['opsi'] = $opsi;
				$data['startdate'] = $date;
				$data['enddate'] = $enddate;

				if($opsi=='1')
				{
					$data['nomor'] = $this->user->getsearchinputdate($date, $enddate);	
				}
				elseif($opsi=='2')
				{
					$data['nomor'] = $this->user->getsearchinputdates($date, $enddate,'0');	
				}
				elseif($opsi=='3')
				{
					$data['nomor'] = $this->user->getsearchinputdates($date, $enddate, '1');	
				}

				$this->load->view('header',$userdata); 
				$this->load->view('search',$data);
				$this->load->view('footer'); 
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
		
	}

	public function downloadsearchinputdate()
	{
		if($this->session->userdata('logged_in'))
	    {
			 $session_data = $this->session->userdata('logged_in');
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
		     {
		     	$this->load->library('excel');
		     	$this->load->model('user');
		     	$date =  $this->uri->segment(2);
  				$enddate =  $this->uri->segment(3);
  				$opsi =  $this->uri->segment(4);

				$data = array();
				if($opsi=='1')
				{
					$data = $this->user->getsearchinputdate($date, $enddate);	
				}
				elseif($opsi=='2')
				{
					$data = $this->user->getsearchinputdates($date, $enddate,'0');	
				}
				elseif($opsi=='3')
				{
					$data = $this->user->getsearchinputdates($date, $enddate, '1');	
				}
				$count = count($data);

				$objPHPExcel = new PHPExcel();
			    $objPHPExcel->getActiveSheet()->setTitle("Search Result");
			    //Loop Heading
			    $heading=array('No','Nomor Telepon','Tanggal Case','Nama CC','Nama AM');
			    $rowNumberH = 1;
			    $colH = 'A';

			    foreach($heading as $h){
			        $objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
			        $colH++;    
			    }
			    //Loop Result
			    $maxrow=$count+1;
			    $row = 2;
			    $no = 1;
		        foreach($data as $n){
		            //$numnil = (float) str_replace(',','.',$n->nilai);
		            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$no);
		            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$n->TELEPHONE_NUMBER);
		            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,date('d-M-Y',strtotime($n->CASE_TIME)));
		            $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$row,$n->CUSTOMER);
		            $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'.$row,$n->AM);
		            $row++;
		            $no++;
		        }
			    

			    $header = 'a1:e1';
				$objPHPExcel->getActiveSheet()->getStyle($header)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00ffff00');
				$style = array(
				    'font' => array('bold' => true,),
				    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
				    );
				$objPHPExcel->getActiveSheet()->getStyle($header)->applyFromArray($style);

				for ($col = ord('a'); $col <= ord('e'); $col++)
				{
    				$objPHPExcel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
				}
			    //Cell Style
			    $styleArray = array(
			        'borders' => array(
			            'allborders' => array(
			                'style' => PHPExcel_Style_Border::BORDER_THIN
			            )
			        )
			    );
			    $objPHPExcel->getActiveSheet()->getStyle('A1:E'.$maxrow)->applyFromArray($styleArray);
			    //Save as an Excel BIFF (xls) file
			    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');

			    header('Content-Type: application/vnd.ms-excel');
			    header('Content-Disposition: attachment;filename="Search Result.xlsx"');
			    header('Cache-Control: max-age=0');

			    $objWriter->save('php://output');
			    exit();
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
	}

	public function searcham()
	{
		if($this->session->userdata('logged_in'))
	    {
			 $session_data = $this->session->userdata('logged_in');
		     $userdata['username'] = $session_data['username'];
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
		     {
		     	$this->load->model('user');
				$data = array();
				$opsi = $this->input->get('opsi1');
				$nama = strtolower($this->input->get('am'));
				$data['value'] = 5;
				$data['nama'] = $nama;
				$data['opsi'] = $opsi;

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

				$this->load->view('header',$userdata); 
				$this->load->view('search',$data);
				$this->load->view('footer'); 
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
		
	}

	public function downloadsearcham()
	{
		if($this->session->userdata('logged_in'))
	    {
			 $session_data = $this->session->userdata('logged_in');
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
		     {
		     	$this->load->library('excel');
		     	$this->load->model('user');
		     	$nama =  $this->uri->segment(2);
  				$opsi =  $this->uri->segment(3);

				$data = array();
				if($opsi=='1')
				{
					$data = $this->user->getsearcham($nama);	
				}
				elseif($opsi=='2')
				{
					$data = $this->user->getsearchams($nama,'0');	
				}
				elseif($opsi=='3')
				{
					$data = $this->user->getsearchams($nama, '1');	
				}
				$count = count($data);

				$objPHPExcel = new PHPExcel();
			    $objPHPExcel->getActiveSheet()->setTitle("Search Result");
			    //Loop Heading
			    $heading=array('No','Nomor Telepon','Tanggal Case','Nama CC','Nama AM');
			    $rowNumberH = 1;
			    $colH = 'A';

			    foreach($heading as $h){
			        $objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
			        $colH++;    
			    }
			    //Loop Result
			    $maxrow=$count+1;
			    $row = 2;
			    $no = 1;
		        foreach($data as $n){
		            //$numnil = (float) str_replace(',','.',$n->nilai);
		            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$no);
		            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$n->TELEPHONE_NUMBER);
		            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,date('d-M-Y',strtotime($n->CASE_TIME)));
		            $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$row,$n->CUSTOMER);
		            $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'.$row,$n->AM);
		            $row++;
		            $no++;
		        }
			    

			    $header = 'a1:e1';
				$objPHPExcel->getActiveSheet()->getStyle($header)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00ffff00');
				$style = array(
				    'font' => array('bold' => true,),
				    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
				    );
				$objPHPExcel->getActiveSheet()->getStyle($header)->applyFromArray($style);

				for ($col = ord('a'); $col <= ord('e'); $col++)
				{
    				$objPHPExcel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
				}
			    //Cell Style
			    $styleArray = array(
			        'borders' => array(
			            'allborders' => array(
			                'style' => PHPExcel_Style_Border::BORDER_THIN
			            )
			        )
			    );
			    $objPHPExcel->getActiveSheet()->getStyle('A1:E'.$maxrow)->applyFromArray($styleArray);
			    //Save as an Excel BIFF (xls) file
			    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');

			    header('Content-Type: application/vnd.ms-excel');
			    header('Content-Disposition: attachment;filename="Search Result.xlsx"');
			    header('Cache-Control: max-age=0');

			    $objWriter->save('php://output');
			    exit();
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
	}

	public function searchcustomer()
	{
		if($this->session->userdata('logged_in'))
	    {
			 $session_data = $this->session->userdata('logged_in');
		     $userdata['username'] = $session_data['username'];
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
		     {
		     	$this->load->model('user');
				$data = array();
				$opsi = $this->input->get('opsi1');
				$nama = strtolower($this->input->get('customer'));
				$data['value'] = 6;
				$data['nama'] = $nama;
				$data['opsi'] = $opsi;

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

				$this->load->view('header',$userdata); 
				$this->load->view('search',$data);
				$this->load->view('footer'); 
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }

	}

	public function downloadsearchcustomer()
	{
		if($this->session->userdata('logged_in'))
	    {
			 $session_data = $this->session->userdata('logged_in');
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
		     {
		     	$this->load->library('excel');
		     	$this->load->model('user');
		     	$nama =  $this->uri->segment(2);
  				$opsi =  $this->uri->segment(3);

				$data = array();
				if($opsi=='1')
				{
					$data = $this->user->getsearchcustomer($nama);	
				}
				elseif($opsi=='2')
				{
					$data = $this->user->getsearchcustomers($nama,'0');	
				}
				elseif($opsi=='3')
				{
					$data = $this->user->getsearchcustomers($nama, '1');	
				}
				$count = count($data);

				$objPHPExcel = new PHPExcel();
			    $objPHPExcel->getActiveSheet()->setTitle("Search Result");
			    //Loop Heading
			    $heading=array('No','Nomor Telepon','Tanggal Case','Nama CC','Nama AM');
			    $rowNumberH = 1;
			    $colH = 'A';

			    foreach($heading as $h){
			        $objPHPExcel->getActiveSheet()->setCellValue($colH.$rowNumberH,$h);
			        $colH++;    
			    }
			    //Loop Result
			    $maxrow=$count+1;
			    $row = 2;
			    $no = 1;
		        foreach($data as $n){
		            //$numnil = (float) str_replace(',','.',$n->nilai);
		            $objPHPExcel->getActiveSheet()->setCellValue('A'.$row,$no);
		            $objPHPExcel->getActiveSheet()->setCellValue('B'.$row,$n->TELEPHONE_NUMBER);
		            $objPHPExcel->getActiveSheet()->setCellValue('C'.$row,date('d-M-Y',strtotime($n->CASE_TIME)));
		            $objPHPExcel->getActiveSheet()->setCellValueExplicit('D'.$row,$n->CUSTOMER);
		            $objPHPExcel->getActiveSheet()->setCellValueExplicit('E'.$row,$n->AM);
		            $row++;
		            $no++;
		        }
			    

			    $header = 'a1:e1';
				$objPHPExcel->getActiveSheet()->getStyle($header)->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('00ffff00');
				$style = array(
				    'font' => array('bold' => true,),
				    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
				    );
				$objPHPExcel->getActiveSheet()->getStyle($header)->applyFromArray($style);

				for ($col = ord('a'); $col <= ord('e'); $col++)
				{
    				$objPHPExcel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
				}
			    //Cell Style
			    $styleArray = array(
			        'borders' => array(
			            'allborders' => array(
			                'style' => PHPExcel_Style_Border::BORDER_THIN
			            )
			        )
			    );
			    $objPHPExcel->getActiveSheet()->getStyle('A1:E'.$maxrow)->applyFromArray($styleArray);
			    //Save as an Excel BIFF (xls) file
			    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');

			    header('Content-Type: application/vnd.ms-excel');
			    header('Content-Disposition: attachment;filename="Search Result.xlsx"');
			    header('Cache-Control: max-age=0');

			    $objWriter->save('php://output');
			    exit();
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
	}

	public function listprofile()
	{
		if($this->session->userdata('logged_in'))
	    {
			 $session_data = $this->session->userdata('logged_in');
		     $userdata['username'] = $session_data['username'];
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
		     {
		     	$this->load->model('user');
				$data = array();
				$data['nomor'] = $this->user->getlistprofile();

				$this->load->view('header',$userdata); 
				$this->load->view('listprofile',$data);
				$this->load->view('footer'); 
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
		
	}

	public function cases($id)
	{
		if($this->session->userdata('logged_in'))
	    {
			 $session_data = $this->session->userdata('logged_in');
		     $userdata['username'] = $session_data['username'];
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
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

				$this->load->view('header',$userdata); 
				$this->load->view('case',$data);
				$this->load->view('footer'); 
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
		
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
		 	 	$config['upload_path'] = 'case_activity/';
				$config['allowed_types'] = '*';
				$config['max_size'] = '30000';
				$this->load->library('upload',$config);

				if($this->upload->do_upload('fileupload'))
				{
					$uploaded = $this->upload->data();
					$file_path = $uploaded['full_path'];
					$file_name = $uploaded['file_name'];

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
			                'INPUT_DATE' => date('d-M-Y'),
			                'FILENAME' => $file_name,
		                	'ORIGINAL_FILENAME' => $file_path
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
			 		$this->session->set_flashdata('fail', 'Upload file gagal');
		 	 		redirect('caseform');
			 	}
		 	}
		 	else
		 	{
		 	 	$this->session->set_flashdata('fail', 'Nomor masih dalam proses');
		 	 	redirect('caseform');
		 	}
			
		}
		elseif ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			redirect('home');
		}
	}

	public function addactivity()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{
			$this->load->model('user');

			$id = $this->input->post('idcase');
			$file = $this->input->post('fileupload');

			$status = array();
			$status = $this->user->getlastactivity($this->input->post('acttype'));

		 	 $date = str_replace('/', '-', $this->input->post('actdate'));
			 $dates = date('d-M-Y', strtotime($date));

			 $config['upload_path'] = 'file_activity/';
			 $config['allowed_types'] = '*';
			 $config['max_size'] = '30000';
			 $this->load->library('upload',$config);

			 if($this->upload->do_upload('fileupload'))
			 {
				 $uploaded = $this->upload->data();
				 $file_path = $uploaded['full_path'];
				 $file_name = $uploaded['file_name'];

				

				 $data = array(
		                'ID_CASE' => $id,
		                'ACTIVITY_DATE' => $dates,
		                'ACTIVITY_PARAMETER' => $status->DESCRIPTION,
		                'DESCRIPTION' =>  $this->input->post('deskripsi'),
		                'INPUT_DATE' => date('d-M-Y'),
		                'FILENAME' => $file_name,
		                'ORIGINAL_FILENAME' => $file_path
		                );

				 $this->user->inseractivity($data);

				

				 $casedata = array(
			                'STATUS' =>  $status->STATUS,
			                'LAST_ACTIVITY' =>   $status->AKRONIM
			                );

				 $this->user->insertlastactivity($id ,$casedata);

				 redirect('cases/'.$id);
			 }
			 else
			 {
			 	$this->session->set_flashdata('fail', 'Upload file gagal');
		 	 	redirect('cases/'.$id);
			 }
		}
		elseif ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			redirect('home');
		}
	}

	public function getact($id)
	{
		if($this->session->userdata('logged_in'))
	    {
			 $session_data = $this->session->userdata('logged_in');
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
		     {
		     	$this->load->helper('download');
		     	$data = file_get_contents("file_activity/".$id);
		     	force_download($id, $data);
		     	
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
	}

	public function getcase($id)
	{
		if($this->session->userdata('logged_in'))
	    {
			 $session_data = $this->session->userdata('logged_in');
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
		     {
		     	$this->load->helper('download');
		     	$data = file_get_contents("case_activity/".$id);
		     	force_download($id, $data);
		     	
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
		
	}

	public function editingprofile($id)
	{
		if($this->session->userdata('logged_in'))
	    {
			 $session_data = $this->session->userdata('logged_in');
		     $userdata['username'] = $session_data['username'];
		     $userdata['previledge'] = $session_data['previledge'];
		     if($userdata['previledge']=='0')
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
					$data['nomors'] = $this->user->getmainnumber1($id);
					$profile = $this->user->getprofile2($data['nomors']);

					if(empty($profile))
					{
						$data['profile'] = $this->user->getnullprofile();
					}
					else
					{
						$data['profile'] = $profile;
					}

					$this->load->view('header',$userdata); 
					$this->load->view('edit',$data);
					$this->load->view('footer'); 
				}
				elseif($status=='1')
				{
					redirect('user');
				}
		     }
		     elseif($userdata['previledge']=='1')
		     {
		     	redirect('admin');
		     }
	   }
	   else
	   {
	     redirect('loginform');
	   }
		

	}

	public function checkprofile()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{
			$this->load->model('user');

			$mainnumber =  $this->input->post('mainnumber');
			$id =  $this->input->post('idcase');
			
			$data = array();
			$data['nomor'] = $this->user->getcasenumbers($id);
			$data['nomors'] = $mainnumber;
			$profile = $this->user->getprofile2($mainnumber);

			if(empty($profile))
			{
				$data['profile'] = $this->user->getnullprofile();
			}
			else
			{
				$data['profile'] = $profile;
			}

			$session_data = $this->session->userdata('logged_in');
		    $userdata['username'] = $session_data['username'];
		    $userdata['previledge'] = $session_data['previledge'];

		 	 $this->load->view('header',$userdata); 
			 $this->load->view('edit',$data);
			 $this->load->view('footer'); 	
		 	 
		}
		elseif ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			redirect('home');
		}
	}

	public function editingprofileprocess()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') 
		{
			$this->load->model('user');

			$id =  $this->input->post('idcase');
			
			$data = array(
				'MAIN_NUMBER' => $this->input->post('mainnumber'),
				'NIPNAS' => $this->input->post('nipnas'),
				'CUSTOMER' => $this->input->post('customer'),
				'NIKAM' => $this->input->post('nikam'),
				'AM' => $this->input->post('am'),
				'INSTALLATION' => $this->input->post('alamat'),
				'SEGMEN' => $this->input->post('segmen'),
				'REVENUE' => $this->input->post('revenue')
				);
			$this->user->updateprofile($id, $data);
			redirect('cases/'.$id);
		 	 
		}
		elseif ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			redirect('home');
		}
	}
}

?>