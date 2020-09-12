<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LoginUserM extends CI_Model{

  public function cekusernamepass($username, $password){
  	$this->db->select("id_userrole, nama");
    $this->db->where('username', $username);
    $this->db->where('password', $password);
    $this->db->where("isDeleted",0);
    return $this->db->get('user');
  }
  
}
?>