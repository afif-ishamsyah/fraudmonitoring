<?php 
   Class user extends CI_Model {
	
      public function __construct() 
      { 
   		$this->db = $this->load->database('oracle', TRUE);
   		$this->db2 = $this->load->database('oracle2', TRUE);
      }


      function countopen()
      {
      	$this->db->select('ID_CASE')->from('KASUS')->where('STATUS', '0');
      	$query = $this->db->get();
	  	return $query->num_rows();
      }

      function countclose()
      {
      	$this->db->select('ID_CASE')->from('KASUS')->where('STATUS', '1');
      	$query = $this->db->get();
	  	return $query->num_rows();
      }

      function countperyear($year, $status)
      {
      	$this->db->select('ID_CASE')->from('KASUS')->where('EXTRACT(YEAR from CASE_TIME) =', $year)->where('STATUS',$status);
      	$query = $this->db->get();
	  	return $query->num_rows();
      }

      function countperparam()
      {
      	$this->db->select('CASE_PARAMETER.ID_PARAMETER, CASE_PARAMETER.DESCRIPTION, COUNT(KASUS.ID_CASE) AS TOTAL')
      	    ->from('CASE_PARAMETER')
      	    ->join('KASUS','CASE_PARAMETER.ID_PARAMETER = KASUS.CASE_PARAMETER')
      	    ->group_by('CASE_PARAMETER.ID_PARAMETER , CASE_PARAMETER.DESCRIPTION')
      	    ->order_by('CASE_PARAMETER.ID_PARAMETER','ASC');
      	$query = $this->db->get();
	  	return $query->result();
      }

      function getcaseparam()
	  {
	  	$this->db->select('ID_PARAMETER, DESCRIPTION');
	  	$this->db->from('CASE_PARAMETER');
	  	$query = $this->db->get();
	  	return $query->result();
	  }

	  function getsearch()
	  {
	  	$this->db->select('KASUS.ID_CASE, PROFIL.TELEPHONE_NUMBER, PROFIL.CUSTOMER, PROFIL.AM, KASUS.CASE_TIME, KASUS.STATUS, ACTIVITY_PARAMETER.AKRONIM')
	  			->from('KASUS')
	  			->join('PROFIL','KASUS.ID_CASE = PROFIL.ID_CASE')
	  			->join('ACTIVITY_PARAMETER','KASUS.LAST_ACTIVITY = ACTIVITY_PARAMETER.ID_PARAMETER', 'LEFT')
	  			->order_by('KASUS.STATUS','ASC');
	  	$query = $this->db->get();
	  	return $query->result();
	  }

	  function getsearchnumber($telephone)
	  {
	  	$this->db->select('KASUS.ID_CASE, PROFIL.TELEPHONE_NUMBER, PROFIL.CUSTOMER, PROFIL.AM, KASUS.CASE_TIME, KASUS.STATUS, ACTIVITY_PARAMETER.AKRONIM')
	  			->from('KASUS')
	  			->join('PROFIL','KASUS.ID_CASE = PROFIL.ID_CASE')
	  			->join('ACTIVITY_PARAMETER','KASUS.LAST_ACTIVITY = ACTIVITY_PARAMETER.ID_PARAMETER', 'LEFT')
	  			->like('PROFIL.TELEPHONE_NUMBER',$telephone)
	  			->order_by('KASUS.STATUS','ASC');
	  	$query = $this->db->get();
	  	return $query->result();
	  }

	  function getsearchnumbers($telephone, $status)
	  {
	  	$this->db->select('KASUS.ID_CASE, PROFIL.TELEPHONE_NUMBER, PROFIL.CUSTOMER, PROFIL.AM, KASUS.CASE_TIME, KASUS.STATUS, ACTIVITY_PARAMETER.AKRONIM')
	  			->from('KASUS')
	  			->join('PROFIL','KASUS.ID_CASE = PROFIL.ID_CASE')
	  			->join('ACTIVITY_PARAMETER','KASUS.LAST_ACTIVITY = ACTIVITY_PARAMETER.ID_PARAMETER', 'LEFT')
	  			->like('PROFIL.TELEPHONE_NUMBER',$telephone)
	  			->where('KASUS.STATUS', $status);
	  	$query = $this->db->get();
	  	return $query->result();
	  }

	  function getsearchdate($date)
	  {
	  	$this->db->select('KASUS.ID_CASE, PROFIL.TELEPHONE_NUMBER, PROFIL.CUSTOMER, PROFIL.AM, KASUS.CASE_TIME, KASUS.STATUS, ACTIVITY_PARAMETER.AKRONIM')
	  			->from('KASUS')
	  			->join('PROFIL','KASUS.ID_CASE = PROFIL.ID_CASE')
	  			->join('ACTIVITY_PARAMETER','KASUS.LAST_ACTIVITY = ACTIVITY_PARAMETER.ID_PARAMETER', 'LEFT')
	  			->where('KASUS.CASE_TIME <=',"TO_DATE('$date','DD/MM/YYYY')", FALSE)
	  			->order_by('KASUS.STATUS','ASC');
	  	$query = $this->db->get();
	  	return $query->result();
	  }

	  function getsearchdates($date, $status)
	  {
	  	$this->db->select('KASUS.ID_CASE, PROFIL.TELEPHONE_NUMBER, PROFIL.CUSTOMER, PROFIL.AM, KASUS.CASE_TIME, KASUS.STATUS, ACTIVITY_PARAMETER.AKRONIM')
	  			->from('KASUS')
	  			->join('PROFIL','KASUS.ID_CASE = PROFIL.ID_CASE')
	  			->join('ACTIVITY_PARAMETER','KASUS.LAST_ACTIVITY = ACTIVITY_PARAMETER.ID_PARAMETER', 'LEFT')
	  			->where('KASUS.CASE_TIME <=',"TO_DATE('$date','DD/MM/YYYY')", FALSE)
	  			->where('KASUS.STATUS', $status);
	  	$query = $this->db->get();
	  	return $query->result();
	  }

	  function getsearchinputdate($date)
	  {
	  	$this->db->select('KASUS.ID_CASE, PROFIL.TELEPHONE_NUMBER, PROFIL.CUSTOMER, PROFIL.AM, KASUS.CASE_TIME, KASUS.STATUS, ACTIVITY_PARAMETER.AKRONIM')
	  			->from('KASUS')
	  			->join('PROFIL','KASUS.ID_CASE = PROFIL.ID_CASE')
	  			->join('ACTIVITY_PARAMETER','KASUS.LAST_ACTIVITY = ACTIVITY_PARAMETER.ID_PARAMETER', 'LEFT')
	  			->where('KASUS.INPUT_DATE <=',"TO_DATE('$date','DD/MM/YYYY')", FALSE)
	  			->order_by('KASUS.STATUS','ASC');
	  	$query = $this->db->get();
	  	return $query->result();
	  }

	  function getsearchinputdates($date, $status)
	  {
	  	$this->db->select('KASUS.ID_CASE, PROFIL.TELEPHONE_NUMBER, PROFIL.CUSTOMER, PROFIL.AM, KASUS.CASE_TIME, KASUS.STATUS, ACTIVITY_PARAMETER.AKRONIM')
	  			->from('KASUS')
	  			->join('PROFIL','KASUS.ID_CASE = PROFIL.ID_CASE')
	  			->join('ACTIVITY_PARAMETER','KASUS.LAST_ACTIVITY = ACTIVITY_PARAMETER.ID_PARAMETER', 'LEFT')
	  			->where('KASUS.INPUT_DATE <=',"TO_DATE('$date','DD/MM/YYYY')", FALSE)
	  			->where('KASUS.STATUS', $status);
	  	$query = $this->db->get();
	  	return $query->result();
	  }

	  function getsearcham($nama)
	  {
	  	$this->db->select('KASUS.ID_CASE, PROFIL.TELEPHONE_NUMBER, PROFIL.CUSTOMER, PROFIL.AM, KASUS.CASE_TIME, KASUS.STATUS, ACTIVITY_PARAMETER.AKRONIM')
	  			->from('KASUS')
	  			->join('PROFIL','KASUS.ID_CASE = PROFIL.ID_CASE')
	  			->join('ACTIVITY_PARAMETER','KASUS.LAST_ACTIVITY = ACTIVITY_PARAMETER.ID_PARAMETER', 'LEFT')
	  			->like('LOWER("AM")', $nama)
	  			->order_by('KASUS.STATUS','ASC');
	  	$query = $this->db->get();
	  	return $query->result();
	  }

	  function getsearchams($nama, $status)
	  {
	  	$this->db->select('KASUS.ID_CASE, PROFIL.TELEPHONE_NUMBER, PROFIL.CUSTOMER, PROFIL.AM, KASUS.CASE_TIME, KASUS.STATUS, ACTIVITY_PARAMETER.AKRONIM')
	  			->from('KASUS')
	  			->join('PROFIL','KASUS.ID_CASE = PROFIL.ID_CASE')
	  			->join('ACTIVITY_PARAMETER','KASUS.LAST_ACTIVITY = ACTIVITY_PARAMETER.ID_PARAMETER', 'LEFT')
	  			->like('LOWER("AM")', $nama)
	  			->where('KASUS.STATUS', $status);
	  	$query = $this->db->get();
	  	return $query->result();
	  }

	  function getsearchcustomer($nama)
	  {
	  	$this->db->select('KASUS.ID_CASE, PROFIL.TELEPHONE_NUMBER, PROFIL.CUSTOMER, PROFIL.AM, KASUS.CASE_TIME, KASUS.STATUS, ACTIVITY_PARAMETER.AKRONIM')
	  			->from('KASUS')
	  			->join('PROFIL','KASUS.ID_CASE = PROFIL.ID_CASE')
	  			->join('ACTIVITY_PARAMETER','KASUS.LAST_ACTIVITY = ACTIVITY_PARAMETER.ID_PARAMETER', 'LEFT')
	  			->like('LOWER("CUSTOMER")', $nama)
	  			->order_by('KASUS.STATUS','ASC');
	  	$query = $this->db->get();
	  	return $query->result();
	  }

	  function getsearchcustomers($nama, $status)
	  {
	  	$this->db->select('KASUS.ID_CASE, PROFIL.TELEPHONE_NUMBER, PROFIL.CUSTOMER, PROFIL.AM, KASUS.CASE_TIME, KASUS.STATUS, ACTIVITY_PARAMETER.AKRONIM')
	  			->from('KASUS')
	  			->join('PROFIL','KASUS.ID_CASE = PROFIL.ID_CASE')
	  			->join('ACTIVITY_PARAMETER','KASUS.LAST_ACTIVITY = ACTIVITY_PARAMETER.ID_PARAMETER', 'LEFT')
	  			->like('LOWER("CUSTOMER")', $nama)
	  			->where('KASUS.STATUS', $status);
	  	$query = $this->db->get();
	  	return $query->result();
	  }

	  function getlistprofile()
	  {
	  	$this->db2->select('PROFIL.NOTEL, PROFIL.NAMACC, PROFIL.ALAMAT, PROFIL.NAMAAM, PROFIL.SEGMEN, REVENUE.AVERAGE')
	  			->from('PROFIL')
	  			->join('REVENUE','PROFIL.NOTEL = REVENUE.NOTEL');
	  	$query = $this->db2->get();
	  	return $query->result();
	  }

	  function getnumber($id)
	  {
	  	$this->db->select('TELEPHONE_NUMBER')
	  			->from('PROFIL')
	  			->where('ID_CASE',$id);
	  	$query = $this->db->get();
	  	return $query->row()->TELEPHONE_NUMBER;
	  }

	  function getdate($id)
	  {
	  	$this->db->select('CASE_TIME')
	  			->from('KASUS')
	  			->where('ID_CASE',$id);
	  	$query = $this->db->get();
	  	return $query->row()->CASE_TIME;
	  }

	  function getprofile($id)
	  {
	  	$this->db->select('TELEPHONE_NUMBER, MAIN_NUMBER, NIPNAS, CUSTOMER, NIKAM, AM, INSTALLATION, SEGMEN, REVENUE')
	  			->from('PROFIL')
	  			->where('ID_CASE',$id);
	  	$query = $this->db->get();
	  	return $query->row();
	  }

	  function getactivity($id)
	  {
	  	$this->db->select('ACTIVITY.ACTIVITY_DATE AS TANGGAL, ACTIVITY_PARAMETER.DESCRIPTION AS TYPE, ACTIVITY.DESCRIPTION AS DESCR, ACTIVITY.FILENAME')
	  			->from('ACTIVITY')
	  			->join('ACTIVITY_PARAMETER', 'ACTIVITY.ACTIVITY_NUMBER = ACTIVITY_PARAMETER.ID_PARAMETER')
	  			->where('ACTIVITY.ID_CASE',$id)
	  			->order_by('ACTIVITY.INPUT_DATE','ASC');
	  	$query = $this->db->get();
	  	return $query->result();
	  }

	  function getcasedetail($id)
	  {
	  	$this->db->select('KASUS.ID_CASE, KASUS.DESTINATION, KASUS.STATUS, KASUS.DESTINATION_NUMBER, KASUS.DURASI, KASUS.NUMBER_OF_CALL, CASE_PARAMETER.DESCRIPTION AS DES1, KASUS.CASE_TIME, KASUS.DESCRIPTION AS DES2, KASUS.FILENAME')
	  			->from('KASUS')
	  			->join('CASE_PARAMETER', 'KASUS.CASE_PARAMETER = CASE_PARAMETER.ID_PARAMETER')
	  			->where('KASUS.ID_CASE',$id);
	  	$query = $this->db->get();
	  	return $query->row();
	  }

	  function getactparam()
	  {
	  	$this->db->select('ID_PARAMETER, DESCRIPTION, AKRONIM, STATUS')->from('ACTIVITY_PARAMETER');
	  	$query = $this->db->get();
	  	return $query->result();
	  }

	  function getcounthistory($number, $tanggal)
	  {
	  	$this->db->select('KASUS.ID_CASE')
	  			 ->from('KASUS')
	  			 ->join('PROFIL','KASUS.ID_CASE = PROFIL.ID_CASE')
	  			 ->where('PROFIL.TELEPHONE_NUMBER', $number)
	  			 ->where('KASUS.CASE_TIME <',"TO_DATE('$tanggal','DD/MM/YYYY')", FALSE);
	  	$query = $this->db->get();
	  	return $query->num_rows();
	  }

	  function gethistory($number, $tanggal)
	  {
	  	$this->db->select('KASUS.CASE_TIME, KASUS.DESTINATION_NUMBER, KASUS.DESTINATION, KASUS.DURASI, KASUS.NUMBER_OF_CALL, CASE_PARAMETER.DESCRIPTION')
	  			 ->from('KASUS')
	  			 ->join('PROFIL','KASUS.ID_CASE = PROFIL.ID_CASE')
	  			 ->join('CASE_PARAMETER','KASUS.CASE_PARAMETER = CASE_PARAMETER.ID_PARAMETER')
	  			 ->where('PROFIL.TELEPHONE_NUMBER', $number)
	  			 ->where('KASUS.CASE_TIME <',"TO_DATE('$tanggal','DD/MM/YYYY')", FALSE);
	  	$query = $this->db->get();
	  	return $query->result();
	  }
	
} 

?>