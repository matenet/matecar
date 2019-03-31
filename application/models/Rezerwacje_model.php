<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Rezerwacje_model extends CI_Model
{

	public function rezerwacje_wypisz_wszystkie()
	{
        
        $data = $this->db->get('mr_cars_reservations');
        if($data->result())
        {
            return $data->result();
        }
        else
        {
            return "Brak danych do wyswietlenia";
        }
	}
    public function rezerwacje_pobierz_wszystkie_do_kalendarza($od_kiedy, $do_kiedy)
    {
        if($od_kiedy != '')
        {
            $this->db->where('od_kiedy <=', $do_kiedy);
            $this->db->where('do_kiedy >=', $od_kiedy);
            $this->db->order_by("id_auta", "asc");
            $dane = $this->db->get('mr_cars_reservations');
            if ($dane->num_rows() > 0) 
            {
                foreach ($dane->result() as $data) 
                {
                    $rezerwacje[] = $data;
                }
                return $rezerwacje;
            }
        } 
        else
        {
            return array('dane' => 'null');
        }
    }
    public function rezerwacje_pobierz_rezerwacje_auta($id_auta, $od_kiedy)
    {    
        
        if($id_auta != '' && $od_kiedy != '')
        {
            $this->db->where('id_auta', $id_auta);
            $this->db->where('od_kiedy', $od_kiedy);
        }
        else if($id_auta != '')
        {
            $this->db->where('id_auta', $id_auta);
        }
        
        $auta = $this->db->get('mr_cars_reservations');
                     
        if($auta->result())
        {
            return $auta->result();
        }
        else
        {
            $error=array('blad' =>'Brak danych do wyświetlenia');
            return $error;
        }
    }
    
    public function rezerwacje_dodaj_do_bazy($dane_z_podsumowania)
    {
        $query = $this->db->insert('mr_cars_reservations', $dane_z_podsumowania);
    }
    public function rezerwacje_zmien_dane_rezerwacji($dane_z_podsumowania)
    {    
            $id_auta = $dane_z_podsumowania['id_auta'];
            $od_kiedy = $dane_z_podsumowania['od_kiedy'];
            $this->db->where('id_auta', $id_auta);
            $this->db->where('od_kiedy', $od_kiedy);        
            $query = $this->db->update('mr_cars_reservations', $dane_z_podsumowania);
    }
    public function rezerwacje_usun_z_bazy($dane_z_podsumowania)
    {
        $query = $this->db->delete('mr_cars_reservations', $dane_z_podsumowania);
    }
}
