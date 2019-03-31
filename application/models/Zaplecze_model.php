<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class Zaplecze_model extends CI_Model
{
	// Nazwa tabeli, z której będziemy korzystać w modelu
	public $table = 'mr_admins';
	
	public function login($email, $password)
	{
		return $this->db->where(array('email' => $email, 'password' => $password))->get($this->table)->row_array();
	}
}