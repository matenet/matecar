<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zaplecze extends CI_Controller {

	public function index()
	{
        $this->load->view('partials/header_zaplecze');
        $this->load->view('zaplecze/index');
        $this->load->view('partials/footer');
	}
    public function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<b>Popełniono błędy: <br></b>');
		$this->form_validation->set_rules('email', 'Login', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Hasło', 'required|trim|sha1');
		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view('partials/header_zaplecze');
			$this->load->view('zaplecze/login');
            $this->load->view('partials/footer');
        }
		else
		{
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$this->load->model('zaplecze_model');

			if ($user = $this->zaplecze_model->login($email, $password))
			{
				$this->session->set_userdata('user_id', $user['id_admina']);
				$this->session->set_flashdata('success', 'Logowanie przebiegło pomyślnie!');
				redirect('zaplecze/index');
			}
			else
			{
				$this->session->set_flashdata('error', 'Podany email lub hasło są nieprawidłowe!');
				redirect('zaplecze/login');
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('zaplecze/login');
	}
	
    public function wszystkie_auta()
	{
        $this->load->view('partials/header_zaplecze');
        $this->load->model('auta_model');
        $data["auta"] = $this->auta_model->wypisz_wszystkie_auta();
        $this->load->view('zaplecze/wszystkie_auta',$data);
        $this->load->view('partials/footer');
	}
    public function wybrane_auto($id_auta)
	{
        $id_auta = $id_auta;
        $od_kiedy = '';
        $config = array(
        'start_day'     => 'monday',
        'month_type'    => 'long',
        'day_type'      => 'short',
);
        $this->load->view('partials/header_zaplecze');        
        $this->load->model('auta_model');
        $dane["auta"] = $this->auta_model->pobierz_jedno_auto($id_auta);
        $dane["zdjecia"] = $this->auta_model->pobierz_zdjecia($id_auta);
        $this->load->model('rezerwacje_model');
        $dane["rezerwacje"] = $this->rezerwacje_model->rezerwacje_pobierz_rezerwacje_auta($id_auta, $od_kiedy);
        $dane["rezerwacje"] = $this->rezerwacje_model->rezerwacje_pobierz_rezerwacje_auta($id_auta, $od_kiedy);
        $this->load->view('zaplecze/wybrane_auto', $dane);
        $this->load->view('partials/footer');
	}
    public function wybrane_auto_edytuj_dane($id_auta)
	{
        $id_auta =$id_auta;
        $this->load->view('partials/header_zaplecze');        
        $this->load->model('auta_model');
        $dane["auta"] = $this->auta_model->pobierz_jedno_auto($id_auta);
        $dane["kategorie"] = $this->auta_model->dodaj_auto_pobierz_kategorie();
        $dane["nadwozia"] = $this->auta_model->dodaj_auto_pobierz_nadwozia();
        $dane["paliwa"] = $this->auta_model->dodaj_auto_pobierz_rodzaj_paliwa();
        $dane["napedy"] = $this->auta_model->dodaj_auto_pobierz_rodzaj_napedu();
        $dane["wyposazenie_dodatkowe_lista"] = $this->auta_model->dodaj_auto_pobierz_wyposazenie_dodatkowe();
        $dane["skrzynie_biegow"] = $this->auta_model->dodaj_auto_pobierz_skrzynie_biegow();
        $this->load->view('zaplecze/wybrane_auto_edytuj_dane', $dane);
        $this->load->view('partials/footer');
	}
	public function dodaj_auto()
    {
        $this->load->view('partials/header_zaplecze');
        $this->load->model('auta_model');
        $dane["kategorie"] = $this->auta_model->dodaj_auto_pobierz_kategorie();
        $dane["nadwozia"] = $this->auta_model->dodaj_auto_pobierz_nadwozia();
        $dane["paliwa"] = $this->auta_model->dodaj_auto_pobierz_rodzaj_paliwa();
        $dane["naped"] = $this->auta_model->dodaj_auto_pobierz_rodzaj_napedu();
        $dane["wyposazenie_dodatkowe"] = $this->auta_model->dodaj_auto_pobierz_wyposazenie_dodatkowe();
        $dane["skrzynia_biegow"] = $this->auta_model->dodaj_auto_pobierz_skrzynie_biegow();
        $this->load->view('zaplecze/dodaj_auto_dane',$dane);
        $this->load->view('partials/footer');
    }
    public function dodaj_zdjecia_auta($id_auta)
    {
        $dane["id_auta"] = $id_auta;
        $this->load->view('partials/header_zaplecze');
        $this->load->view('zaplecze/dodaj_zdjecia_auta', $dane);
        $this->load->view('partials/footer');
    }
    public function upload($id_auta)
    {
      if($_FILES["files"]["name"] != '')
      {        
        $output = '';
        $extra_output = '';
        $next_link = '';
        $good_counter = 0;
        $config["upload_path"]      = 'uploads/zdjecia/';
        $config["allowed_types"]    = 'jpg|jpeg';
        $config['overwrite']        = TRUE;
        $config['max_size']         = 1024;
        $config['max_width']        = 1024;
        $config['max_height']       = 768;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        for($count = 0; $count<count($_FILES["files"]["name"]); $count++)
        {
            $_FILES["file"]["name"] = $_FILES["files"]["name"][$count];
            $_FILES["file"]["type"] = $_FILES["files"]["type"][$count];
            $_FILES["file"]["tmp_name"] = $_FILES["files"]["tmp_name"][$count];
            $_FILES["file"]["error"] = $_FILES["files"]["error"][$count];
            $_FILES["file"]["size"] = $_FILES["files"]["size"][$count];
            if($this->upload->do_upload('file'))
            {
                $data = $this->upload->data();
                $output .= '<img src="'.base_url().'uploads/zdjecia/'.$data["file_name"].'" class="dodaj-auto-img" />';
                $extra_output = '<div class="complete-upload-images">'.'<i style="display: inline-block;margin-top: 0;margin-right: 15px;font-size: 20px;"class="fas fa-check"></i><p style="display: inline-block;margin: 10px 0 23px 0;">Wczytywanie zdjęć zakończone.</p><br>';
                $good_counter++;
                $name = 'zdjecie_'.$count; 
                $image_link = base_url() . "uploads/zdjecia/" . $data["file_name"];
                $this->session->set_userdata($name, $image_link);
                $this->session->set_userdata('ilosc_zdjec', $count);
            }
            else
            {
                $output .= '<div style="display:inline-block; margin:15px;"><i class="fas fa-times"></i><br>Błąd! Wybrane zdjęcie jest za duże.</div>';
            }
        }
        
        echo $output;
        if($good_counter==$count)
        {
            $next_link = '<form action="'. base_url() . 'zaplecze/dodaj_zdjecia_auta_potwierdzenie/'.$id_auta.'" method="post">';
            $ci =& get_instance();
                $ilosc_img=$ci->session->userdata('ilosc_zdjec');
                for($i=0; $i<=$ilosc_img; $i++)
                {
                   $link_number="zdjecie_".$i;
                   $next_link .= '<input type="hidden" name="image-link-' . $i . '" id="image-link-' . $i . '" value="'. $ci->session->userdata($link_number) .'" />'; 
                }
            echo $extra_output;
            $next_link .= '<input type="submit" value="Zapisz zmiany"></form>';
            echo $next_link;
        }
        
      }
    }
    public function dodaj_zdjecia_auta_potwierdzenie($id_auta)
    {   
        $dane = array();
        for ($i = 0; $i < 10; ++$i)    
        {
            if(!empty($this->input->post("image-link-".$i)))
            {
                $dane[$i]["id_auta"]=$id_auta;
                $dane[$i]["linki_zdjec"]=$this->input->post("image-link-".$i);
            }
        }
        $this->load->view('partials/header_zaplecze');
        $this->load->model('auta_model');
        //$dane["auta"] = $this->auta_model->dodaj_zdjecia_auta_do_bazy($dane);
        $id = array("id_auta" => $id_auta);
        $this->auta_model->dodaj_zdjecia_auta_do_bazy($dane);
        $this->load->view('zaplecze/dodaj_zdjecia_auta_potwierdzenie', $id);
        $this->load->view('partials/footer');
    }
    public function dodaj_auto_podsumowanie()
    {
        $this->load->view('partials/header_zaplecze');
        $dane_auta = array(
            "kategoria"             => $this->input->post("kategoria"),
            "nadwozie"              => $this->input->post("nadwozie"),
            "marka"                 => $this->input->post("marka"),
            "model"                 => $this->input->post("model"),
            "nr_rejestracyjny"      => $this->input->post("nr_rejestracyjny"),
            "pojemnosc_silnika"     => $this->input->post("pojemnosc_silnika"),
            "rodzaj_paliwa"         => $this->input->post("rodzaj_paliwa"),            
            "moc"                   => $this->input->post("moc"),            
            "spalanie"              => $this->input->post("spalanie"),
            "skrzynia_biegow"       => $this->input->post("skrzynia_biegow"),
            "naped"                 => $this->input->post("naped"),
            "przebieg"              => $this->input->post("przebieg"),
            "kolor"                 => $this->input->post("kolor"),
            "liczba_miejsc"         => $this->input->post("liczba_miejsc"),
            "liczba_drzwi"          => $this->input->post("liczba_drzwi"),
            "pojemnosc_bagaznika"   => $this->input->post("pojemnosc_bagaznika"),
            "cena"                  => $this->input->post("cena"),
            "kaucja"                => $this->input->post("kaucja"),
            "wyposazenie_dodatkowe" => implode(', ',$this->input->post('wyposazenie_dodatkowe', TRUE)),
        );
        $this->load->view('zaplecze/dodaj_auto_podsumowanie',$dane_auta);
        $this->load->view('partials/footer');
    }
    
    public function dodaj_auto_do_bazy()
    {
        $this->load->view('partials/header_zaplecze');
        $dane_z_podsumowania = array(
            "kategoria"             => $this->input->post("kategoria"),
            "nadwozie"              => $this->input->post("nadwozie"),
            "marka"                 => $this->input->post("marka"),
            "model"                 => $this->input->post("model"),
            "nr_rejestracyjny"      => $this->input->post("nr_rejestracyjny"),
            "pojemnosc_silnika"     => $this->input->post("pojemnosc_silnika"),
            "rodzaj_paliwa"         => $this->input->post("rodzaj_paliwa"),            
            "moc"                   => $this->input->post("moc"),            
            "spalanie"              => $this->input->post("spalanie"),
            "skrzynia_biegow"       => $this->input->post("skrzynia_biegow"),
            "naped"                 => $this->input->post("naped"),
            "przebieg"              => $this->input->post("przebieg"),
            "kolor"                 => $this->input->post("kolor"),
            "liczba_miejsc"         => $this->input->post("liczba_miejsc"),
            "liczba_drzwi"          => $this->input->post("liczba_drzwi"),
            "pojemnosc_bagaznika"   => $this->input->post("pojemnosc_bagaznika"),
            "cena"                  => $this->input->post("cena"),
            "kaucja"                => $this->input->post("kaucja"),
            "wyposazenie_dodatkowe" => $this->input->post("wyposazenie_dodatkowe"),
        );
        $this->load->model('auta_model');
        $this->auta_model->dodaj_auto_do_bazy($dane_z_podsumowania);
        $this->load->view('zaplecze/dodaj_auto_do_bazy');
        $this->load->view('partials/footer');
    }

    public function wybrane_auto_edytuj_dane_potwierdzenie()
    {
        $this->load->view('partials/header_zaplecze');
        $dane_z_podsumowania = array(
            "id_auta"               => $this->input->post("id_auta"),
            "kategoria"             => $this->input->post("kategoria"),
            "nadwozie"              => $this->input->post("nadwozie"),
            "marka"                 => $this->input->post("marka"),
            "model"                 => $this->input->post("model"),
            "nr_rejestracyjny"      => $this->input->post("nr_rejestracyjny"),
            "pojemnosc_silnika"     => $this->input->post("pojemnosc_silnika"),
            "rodzaj_paliwa"         => $this->input->post("rodzaj_paliwa"),            
            "moc"                   => $this->input->post("moc"),            
            "spalanie"              => $this->input->post("spalanie"),
            "skrzynia_biegow"       => $this->input->post("skrzynia_biegow"),
            "naped"                 => $this->input->post("naped"),
            "przebieg"              => $this->input->post("przebieg"),
            "kolor"                 => $this->input->post("kolor"),
            "liczba_miejsc"         => $this->input->post("liczba_miejsc"),
            "liczba_drzwi"          => $this->input->post("liczba_drzwi"),
            "pojemnosc_bagaznika"   => $this->input->post("pojemnosc_bagaznika"),
            "cena"                  => $this->input->post("cena"),
            "kaucja"                => $this->input->post("kaucja"),
            "wyposazenie_dodatkowe" => implode(', ',$this->input->post("wyposazenie_dodatkowe", TRUE)),
        );
        $this->load->model('auta_model');
        $dane['id_auta'] = $this->input->post("id_auta");
        $this->auta_model->edytuj_dane_auta_w_bazie($dane_z_podsumowania);
        $this->load->view('zaplecze/wybrane_auto_edytuj_dane_potwierdzenie', $dane);
        $this->load->view('partials/footer');
    }
    public function usun_zdjecie_auta($id)
    {
        $link_wejściowy = $this->input->post("linki_zdjec");
        $link_wstepnie_przerobiony = explode("zdjecia/", $link_wejściowy);
        $link_przerobiony = FCPATH."uploads/zdjecia/".$link_wstepnie_przerobiony[1];
        $this->load->view('partials/header_zaplecze');
        $dane = array(
            "id_auta" => $id,
            "linki_zdjec" => $link_wejściowy
                );
        if(unlink($link_przerobiony))
            {
                $this->load->model('auta_model');
                if ($this->auta_model->usun_zdjecie_auta($dane))
                {
                    $dane_powrotne = array("komunikat" => "Poprawnie usunięto zdjęcie z serwera");
                }
            }
        else
           {
               $dane_powrotne = array("komunikat" => "Błąd usuwania zdjęcia z serwera!");
           }
        $this->load->view('zaplecze/usun_zdjecie_auta', $dane);
        $this->load->view('partials/footer');
    }
    public function ustaw_zdjecie_glowne_auta($id)
    {
        $this->load->view('partials/header_zaplecze');
        $dane = array(
            'id_auta' => $id,
            'zdjecie_glowne' => $this->input->post('linki_zdjec')
        );
        $this->load->model('auta_model');
        $this->auta_model->ustaw_zdjecie_glowne_auta($dane);
        $this->load->view('zaplecze/ustaw_zdjecie_glowne_auta', $dane);
        $this->load->view('partials/footer');
    }
    public function usun_auto($id)
    {
        $this->load->view('partials/header_zaplecze');
        $dane = array("id_auta" => $id);
        $this->load->model('auta_model');
        $this->auta_model->usun_auto_z_bazy($dane);
        $this->load->view('zaplecze/usun_auto');
        $this->load->view('partials/footer');
    }
    public function wszystkie_rezerwacje()
    {
        $this->load->view('partials/header_zaplecze');
        $this->load->model('auta_model');
        $this->load->model('rezerwacje_model');
        $data["auta"] = $this->auta_model->wypisz_wszystkie_auta();
        $this->load->view('zaplecze/rezerwacje',$data);
        $this->load->view('partials/footer');
    }
    public function pobierz_wszystkie_rezerwacje()
    {
        $od_kiedy = '';
        $do_kiedy = '';
        //echo $od_kiedy;
        $this->load->model('rezerwacje_model');
        if(!empty($this->input->post('odkiedy')) && !empty($this->input->post('dokiedy')))
        {
            $od_kiedy = $this->input->post('odkiedy');
            $do_kiedy = $this->input->post('dokiedy');
        }
        $rezerwacje = $this->rezerwacje_model->rezerwacje_pobierz_wszystkie_do_kalendarza($od_kiedy, $do_kiedy);       
        echo json_encode($rezerwacje);
        
        
    }
    public function rezerwacje_wybrane_auto($id_auta)
    {
        $od_kiedy = '';
        $this->load->view('partials/header_zaplecze');
        $this->load->model('auta_model');
        $this->load->model('rezerwacje_model');
        $dane["auta"] = $this->auta_model->pobierz_jedno_auto($id_auta);
        $dane["rezerwacje"] = $this->rezerwacje_model->rezerwacje_pobierz_rezerwacje_auta($id_auta, $od_kiedy);
        $this->load->view('zaplecze/rezerwacje_wybrane_auto', $dane);
        $this->load->view('partials/footer');
    }
    public function rezerwacje_dodaj()
	{        
        $dane_z_podsumowania = array(
            "id_auta"             => $this->input->post("id_auta"),
            "od_kiedy"            => $this->input->post("od_kiedy"),
            "do_kiedy"            => $this->input->post("do_kiedy"),
            "tytul_rezerwacji"    => $this->input->post("tytul_rezerwacji"),
        );
        $dane['id_auta'] = $this->input->post("id_auta");
        $this->load->model('rezerwacje_model');
        $this->rezerwacje_model->rezerwacje_dodaj_do_bazy($dane_z_podsumowania);
        $this->load->view('partials/header_zaplecze');        
        $this->load->view('zaplecze/rezerwacje_dodaj', $dane);
        $this->load->view('partials/footer');
	}
    public function rezerwacje_usun()
	{        
        $dane_z_podsumowania = array(
            "id_auta"             => $this->input->post("id_auta"),
            "od_kiedy"            => $this->input->post("od_kiedy"),
        );
        $dane['id_auta'] = $this->input->post("id_auta");
        $this->load->model('rezerwacje_model');
        $this->rezerwacje_model->rezerwacje_usun_z_bazy($dane_z_podsumowania);
        $this->load->view('partials/header_zaplecze');
        $this->load->view('zaplecze/rezerwacje_usun', $dane);
        $this->load->view('partials/footer');
	}
    public function rezerwacje_edytuj()
	{        
        $this->load->view('partials/header_zaplecze');
        $id_auta = $this->input->post("id_auta");
        $od_kiedy = $this->input->post("od_kiedy");
        $dane['id_auta'] = $this->input->post("id_auta");
        $this->load->model('rezerwacje_model');
        $dane["rezerwacje"] = $this->rezerwacje_model->rezerwacje_pobierz_rezerwacje_auta($id_auta, $od_kiedy);
        $this->load->view('zaplecze/rezerwacje_edytuj', $dane);
        $this->load->view('partials/footer');
	}
    public function rezerwacje_edytuj_potwierdzenie()
	{        
        $this->load->view('partials/header_zaplecze');
        $dane_z_podsumowania = array(
            "id_auta"             => $this->input->post("id_auta"),
            "od_kiedy"            => $this->input->post("od_kiedy"),
            "do_kiedy"            => $this->input->post("do_kiedy"),
            "tytul_rezerwacji"    => $this->input->post("tytul_rezerwacji"),
        );
        $dane['id_auta'] = $this->input->post("id_auta");
        $this->load->model('rezerwacje_model');
        $dane["rezerwacje"] = $this->rezerwacje_model->rezerwacje_zmien_dane_rezerwacji($dane_z_podsumowania);
        $this->load->view('zaplecze/rezerwacje_edytuj_potwierdzenie', $dane);
        $this->load->view('partials/footer');
	}
}
?>
