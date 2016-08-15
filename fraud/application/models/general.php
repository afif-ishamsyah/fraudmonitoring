<?php 
   Class general extends CI_Model {
	
    public function __construct() 
    { 
    	$this->db = $this->load->database('oracle', TRUE);
   	}

 //   	function hashpassword($password) 
	// {
 //        return md5($password);
 //    }

    function checklogin($username, $password)
    {
    	$this->db->select('ID, USERNAME, PASSWD, PREVILEDGE')->from('PROFILEUSER')->where('USERNAME', $username)->where('PASSWD', $password);
    	$query = $this->db->get();
    	if($query->num_rows() > 0)
    	{
    		return $query->result();
    	}
    	else
    	{
    		return false;
    	}
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

      function countpermonth($month, $year, $status)
      {
        $this->db->select('ID_CASE')->from('KASUS')->where('EXTRACT(YEAR from CASE_TIME) =', $year)->where('EXTRACT(MONTH from CASE_TIME) =', $month)->where('STATUS',$status);
        $query = $this->db->get();
        return $query->num_rows();
      }

      function countperparam()
      {
        $this->db->select('KASUS.CASE_PARAMETER, COUNT({F}KASUS.ID_CASE) AS TOTAL')
            ->from('KASUS')
            ->group_by('KASUS.CASE_PARAMETER')
            ->order_by('KASUS.CASE_PARAMETER','ASC');
        $query = $this->db->get();
        return $query->result();
      }

      function openunder1month()
      {
        $this->db->select('KASUS.ID_CASE')
            ->from('KASUS')
            ->where('STATUS','0')
            ->where('trunc(sysdate) -  trunc(CASE_TIME) <=', 30);
        $query = $this->db->get();
        return $query->num_rows();
      }

      function openunder1_3month()
      {
        $this->db->select('KASUS.ID_CASE')
            ->from('KASUS')
            ->where('STATUS','0')
            ->where('trunc(sysdate) -  trunc(CASE_TIME) >', 30)
            ->where('trunc(sysdate) -  trunc(CASE_TIME) <=', 90);
        $query = $this->db->get();
        return $query->num_rows();
      }

      function openunder3_6month()
      {
        $this->db->select('KASUS.ID_CASE')
            ->from('KASUS')
            ->where('STATUS','0')
            ->where('trunc(sysdate) -  trunc(CASE_TIME) >', 90)
            ->where('trunc(sysdate) -  trunc(CASE_TIME) <=', 180);
        $query = $this->db->get();
        return $query->num_rows();
      }

      function openunder6_12month()
      {
        $this->db->select('KASUS.ID_CASE')
            ->from('KASUS')
            ->where('STATUS','0')
            ->where('trunc(sysdate) -  trunc(CASE_TIME) >', 180)
            ->where('trunc(sysdate) -  trunc(CASE_TIME) <=', 360);
        $query = $this->db->get();
        return $query->num_rows();
      }

      function openover1year()
      {
        $this->db->select('KASUS.ID_CASE')
            ->from('KASUS')
            ->where('STATUS','0')
            ->where('trunc(sysdate) -  trunc(CASE_TIME) >', 360);
        $query = $this->db->get();
        return $query->num_rows();
      }

       function closeunder1month()
      {
        $this->db->select('KASUS.ID_CASE')
            ->from('KASUS')
            ->where('STATUS','1')
            ->where('trunc(FINISH_DATE) - trunc(CASE_TIME) <=', 30);
        $query = $this->db->get();
        return $query->num_rows();
      }

      function closeunder1_3month()
      {
        $this->db->select('KASUS.ID_CASE')
            ->from('KASUS')
            ->where('STATUS','1')
            ->where('trunc(FINISH_DATE) - trunc(CASE_TIME) >', 30)
            ->where('trunc(FINISH_DATE) - trunc(CASE_TIME) <=', 90);
        $query = $this->db->get();
        return $query->num_rows();
      }

      function closeunder3_6month()
      {
        $this->db->select('KASUS.ID_CASE')
            ->from('KASUS')
            ->where('STATUS','1')
            ->where('trunc(FINISH_DATE) - trunc(CASE_TIME) >', 90)
            ->where('trunc(FINISH_DATE) - trunc(CASE_TIME) <=', 180);
        $query = $this->db->get();
        return $query->num_rows();
      }

      function closeunder6_12month()
      {
        $this->db->select('KASUS.ID_CASE')
            ->from('KASUS')
            ->where('STATUS','1')
            ->where('trunc(FINISH_DATE) - trunc(CASE_TIME) >', 180)
            ->where('trunc(FINISH_DATE) - trunc(CASE_TIME) <=', 360);
        $query = $this->db->get();
        return $query->num_rows();
      }

      function closeover1year()
      {
        $this->db->select('KASUS.ID_CASE')
            ->from('KASUS')
            ->where('STATUS','1')
            ->where('trunc(FINISH_DATE) - trunc(CASE_TIME) >', 360);
        $query = $this->db->get();
        return $query->num_rows();
      }

}
?>