<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LoginM extends CI_Model{

  public function ceknum($username_admin, $password_admin){
    $this->db->where('username_admin', $username_admin);
    $this->db->where('password_admin', $password_admin);
    return $this->db->get('admin');
  }
  
}
?>