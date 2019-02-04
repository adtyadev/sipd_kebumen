<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login_model extends CI_Model {

	private $_table = "admin";
/*
  function cekUser($username, $password) {
    return $this->db->get_where('user', array('username' => $username, 'password' => $password));
  }
*/
  public function adminLogin($idAdmin,$password){
  	return $this->db->get_where($this->_table, array('idAdmin'=>$idAdmin, 'password'=>$password));
  }
}

?>