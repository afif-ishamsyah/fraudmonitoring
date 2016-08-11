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

}
?>