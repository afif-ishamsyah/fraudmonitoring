<?php 
   Class admin extends CI_Model {
	
      public function __construct() 
      { 
   		$this->db = $this->load->database('oracle', TRUE);

      } 

	  function hashpassword($password) 
	  {
        return md5($password);
      }

      function checkpass($username, $password)
      {
      	$this->db->select('ID')->from('PROFILEUSER')->where('USERNAME', $username)->where('PASSWD', $password);
      	$query = $this->db->get();
      	if($query->num_rows() > 0)
      	{
      		return 1;
      	}
      	else
      	{
      		return 0;
      	}
      }

      function insertuser($data)
      {
        $this->db->insert('PROFILEUSER', $data);
      }

      function updateuser($username, $data)
      {
      	$this->db->where('USERNAME', $username);
        $this->db->update('PROFILEUSER', $data);
      }

      function usernameexist($username)
      {
      	$this->db->select('USERNAME')->from('PROFILEUSER')->where('UPPER("USERNAME")', strtoupper($username));
      	$query = $this->db->get();
	  	return $query->result();
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
        $this->db->select('KASUS.CASE_PARAMETER, COUNT(KASUS.ID_CASE) AS TOTAL')
            ->from('KASUS')
            ->group_by('KASUS.CASE_PARAMETER')
            ->order_by('KASUS.CASE_PARAMETER','ASC');
        $query = $this->db->get();
      return $query->result();
      }


       //------------------------------------------------------------------------Case Parameter--------------------

    function getcaseparam()
	  {
	  	$this->db->select('ID_PARAMETER, DESCRIPTION, AKTIF');
	  	$this->db->from('CASE_PARAMETER');
	  	$query = $this->db->get();
	  	return $query->result();
	  }


	  function idcaseparamexist($id)
	  {
	  	$this->db->select('ID_PARAMETER')->from('CASE_PARAMETER')->where('ID_PARAMETER',$id);
	  	$query = $this->db->get();
      	if($query->num_rows() > 0)
      	{
      		return 1;
      	}
      	else
      	{
      		return 0;
      	}
	  }

	  function getcaseaktif($id)
	  {
	  	$this->db->select('AKTIF')->from('CASE_PARAMETER')->where('ID_PARAMETER',$id);
	  	$query = $this->db->get();
      return $query->row()->AKTIF;
	  }

    function desccase($id)
    {
      $this->db->select('DESCRIPTION')->from('CASE_PARAMETER')->where('ID_PARAMETER',$id);
      $query = $this->db->get();
      return $query->row()->DESCRIPTION;
    }

    function changeaktifcase($id, $num)
    {
      $this->db->set('AKTIF', $num);
      $this->db->where('ID_PARAMETER', $id);
      $this->db->update('CASE_PARAMETER');
    }

	  function caseparamexist($parameter)
	  {
	  	$this->db->select('ID_PARAMETER')->from('CASE_PARAMETER')->where('DESCRIPTION',strtoupper($parameter));
	  	$query = $this->db->get();
      	if($query->num_rows() > 0)
      	{
      		return 1;
      	}
      	else
      	{
      		return 0;
      	}
	  }

	 function insertcaseparamater($data)
	 {
	 	$this->db->insert('CASE_PARAMETER', $data);
	 }

	 function deletecase($id)
	 {
	 	$this->db->where('ID_PARAMETER', $id);
		$this->db->delete('CASE_PARAMETER');
	 }

   function editcasepar($id, $des)
    {
      $this->db->set('DESCRIPTION', $des);
      $this->db->where('ID_PARAMETER', $id);
      $this->db->update('CASE_PARAMETER');
    }
	 //------------------------------------------------------------------------Activity Parameter--------------------

	 function getactparam()
	  {
	  	$this->db->select('ID_PARAMETER, DESCRIPTION, AKRONIM, STATUS, AKTIF');
	  	$this->db->from('ACTIVITY_PARAMETER');
	  	$query = $this->db->get();
	  	return $query->result();
	  }

   function idactparamexist($id)
  {
      $this->db->select('ID_PARAMETER')->from('ACTIVITY_PARAMETER')->where('ID_PARAMETER',$id);
      $query = $this->db->get();
      if($query->num_rows() > 0)
      {
            return 1;
      }
      else
      {
            return 0;
      }
  }

   function getactaktif($id)
    {
      $this->db->select('AKTIF')->from('ACTIVITY_PARAMETER')->where('ID_PARAMETER',$id);
      $query = $this->db->get();
      return $query->row()->AKTIF;
    }

    function descact($id)
    {
      $this->db->select('DESCRIPTION')->from('ACTIVITY_PARAMETER')->where('ID_PARAMETER',$id);
      $query = $this->db->get();
      return $query->row()->DESCRIPTION;
    }

    function changeaktifactivity($id, $num)
    {
      $this->db->set('AKTIF', $num);
      $this->db->where('ID_PARAMETER', $id);
      $this->db->update('ACTIVITY_PARAMETER');
    }

  function actparamexist1($id ,$parameter)
  {
  	$this->db->select('ID_PARAMETER')->from('ACTIVITY_PARAMETER')
                                     ->where('ID_PARAMETER !=', $id)
                                     ->where('DESCRIPTION',strtoupper($parameter));
  	$query = $this->db->get();
    	if($query->num_rows() > 0)
    	{
    		return 1;
    	}
    	else
    	{
    		return 0;
    	}
  }

  function actparamexist2($id ,$akronim)
  {
    $this->db->select('ID_PARAMETER')->from('ACTIVITY_PARAMETER')
                                     ->where('ID_PARAMETER !=', $id)
                                     ->where('AKRONIM',strtoupper($akronim));
    $query = $this->db->get();
      if($query->num_rows() > 0)
      {
        return 1;
      }
      else
      {
        return 0;
      }
  }

  function insertactparamater($data)
  {
  	$this->db->insert('ACTIVITY_PARAMETER', $data);
  }

  function deleteact($id)
  {
    $this->db->where('ID_PARAMETER', $id);
    $this->db->delete('ACTIVITY_PARAMETER');
  }

  function editactpar($id, $data)
  {
    $this->db->where('ID_PARAMETER', $id);
    $this->db->update('ACTIVITY_PARAMETER', $data);
  }

   									
} 
?>