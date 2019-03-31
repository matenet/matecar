<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auta extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $this->load->model('auta_model');
        $data["auta"] = $this->auta_model->wypisz_wszystkie_auta();
        $this->load->view('auta', $data);
	}
    public function wybrane_auto($marka, $id_auta)
	{
        $this->load->model('auta_model');
        $data["auta"] = $this->auta_model->pobierz_jedno_auto($id_auta);
        $data["zdjecia"] = $this->auta_model->pobierz_zdjecia($id_auta);
        $this->load->view('wybrane_auto', $data);
	}
}
