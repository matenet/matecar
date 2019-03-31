<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auta_model extends CI_Model
{
	// Nazwa tabeli, z której będziemy korzystać w modelu
	public $table = 'mr_cars';

	public function wypisz_wszystkie_auta()
	{
        $data = $this->db->get('mr_cars');
        if($data->result())
        {
            return $data->result();
        }
        else
        {
            return "Brak danych do wyświetlenia";
        }
	}
    
    public function pobierz_jedno_auto($id_auta)
    {    
        if($id_auta!='')
        {
            $this->db->where('id_auta', $id_auta);
            $data = $this->db->get('mr_cars');
        }
        if($data->result())
        {
            return $data->result();
        }
        else
        {
            return "Brak danych do wyświetlenia";
        }
    }
    public function pobierz_zdjecia($id_auta)
    {
        if($id_auta!='')
        {
            $this->db->where('id_auta', $id_auta);
            $zdjecia = $this->db->get('mr_cars_images');
        }
        if($zdjecia->result())
        {
            return $zdjecia->result();
        }
        else
        {
            return "Brak danych do wyświetlenia";
        }   
    }
    public function dodaj_auto_pobierz_kategorie()
    {    
        $kategorie = $this->db->get('mr_cars_categories');
        if($kategorie->result())
        {
            return $kategorie->result();
        }
        else
        {
            return "Brak danych do wyświetlenia";
        }
    }
    public function dodaj_auto_pobierz_nadwozia()
    {    
        $nadwozia = $this->db->get('mr_cars_bodies');
                                                           
        if($nadwozia->result())
        {
            return $nadwozia->result();
        }
        else
        {
            return "Brak danych do wyświetlenia";
        }
    }
    public function dodaj_auto_pobierz_rodzaj_paliwa()
    {    
        $paliwa = $this->db->get('mr_cars_fuels');
                                                           
        if($paliwa->result())
        {
            return $paliwa->result();
        }
        else
        {
            return "Brak danych do wyświetlenia";
        }
    }
    public function dodaj_auto_pobierz_rodzaj_napedu()
    {    
        $naped = $this->db->get('mr_cars_drives');
                                                           
        if($naped->result())
        {
            return $naped->result();
        }
        else
        {
            return "Brak danych do wyświetlenia";
        }
    }
    public function dodaj_auto_pobierz_wyposazenie_dodatkowe()
    {    
        $wyposazenie_dodatkowe = $this->db->get('mr_cars_equipment');
                                                           
        if($wyposazenie_dodatkowe->result())
        {
            return $wyposazenie_dodatkowe->result();
        }
        else
        {
            return "Brak danych do wyświetlenia";
        }
    }
    public function dodaj_auto_pobierz_skrzynie_biegow()
    {    
        $skrzynia_biegow = $this->db->get('mr_cars_transmissions');
                                                           
        if($skrzynia_biegow->result())
        {
            return $skrzynia_biegow->result();
        }
        else
        {
            return "Brak danych do wyświetlenia";
        }
    }
    public function dodaj_auto_do_bazy($dane_z_podsumowania)
    {
        $query = $this->db->insert('mr_cars', $dane_z_podsumowania);
    }
    public function dodaj_zdjecia_auta_do_bazy ($dane_wejsciowe)
    {
        $id_auta = $dane_wejsciowe[0]['id_auta'];
        $brak_zdjecia = '';
        $table = 'mr_cars_images';
        $this->db->trans_start();
            $this->db->insert_batch($table, $dane_wejsciowe);
            $this->db->where('id_auta', $id_auta);    
            $this->db->select('zdjecie_glowne');
            $select = $this->db->get('mr_cars');
            $wynik = $select->row();                
            if (isset($wynik))
            {
                if (empty($wynik->zdjecie_glowne))
                {
                    $dane_do_poprawy['zdjecie_glowne'] = $dane_wejsciowe[0]['linki_zdjec'];
                    $this->db->where('id_auta', $id_auta);
                    $this->db->update('mr_cars', $dane_do_poprawy);
                }
            }
        $this->db->trans_complete();
    }
    public function edytuj_dane_auta_w_bazie($dane_z_podsumowania)
    {
        $id_auta = $dane_z_podsumowania['id_auta'];
        if($id_auta != '')
        {
            $this->db->where('id_auta', $id_auta);
        }
        $query = $this->db->update('mr_cars', $dane_z_podsumowania);
    }
    public function usun_auto_z_bazy($dane)
    {
        $query = $this->db->delete('mr_cars', $dane);
        if(!$query)
        {
            return "Brak danych do usunięcia";
        }
    }
    public function usun_zdjecie_auta($dane)
    {
        $id_auta = $dane['id_auta'];
        $zdjecie_do_usuniecia = $dane['linki_zdjec'];
        
        $this->db->trans_start();
            $this->db->where('id_auta', $id_auta);
            $this->db->where('linki_zdjec', $zdjecie_do_usuniecia);
            $query = $this->db->delete('mr_cars_images', $dane);
            $this->db->where('id_auta', $id_auta);
            $select_zdjecia = $this->db->get('mr_cars_images');
            $wynik_braku_zdjec = $select_zdjecia->row();
            $this->db->where('id_auta', $id_auta);
            $select_zdjecia_glownego = $this->db->get('mr_cars');
            $wynik_zdjecia_glownego = $select_zdjecia_glownego->row();
            if(!isset($wynik_braku_zdjec))
            {
                $dane_do_poprawy['zdjecie_glowne'] = null;
                $this->db->where('id_auta', $id_auta);
                $this->db->update('mr_cars', $dane_do_poprawy);
            }
            if(isset($wynik_zdjecia_glownego))
            {
                if($wynik_zdjecia_glownego->zdjecie_glowne==$zdjecie_do_usuniecia)
                {
                    $dane_do_poprawy['zdjecie_glowne'] = null;
                    $this->db->where('id_auta', $id_auta);
                    $this->db->update('mr_cars', $dane_do_poprawy);
                }
            }
        $this->db->trans_complete();
    }
    public function ustaw_zdjecie_glowne_auta($dane)
    {
        $id_auta = $dane['id_auta'];
        $this->db->where('id_auta', $id_auta);
        $query = $this->db->update('mr_cars', $dane);
        if(!$query)
        {
            return "Niepowodzenie operacji.";
        }
    }
}
