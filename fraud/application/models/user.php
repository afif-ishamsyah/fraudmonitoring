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

	
} 

?>