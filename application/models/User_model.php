<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function get_Data()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        return $data;
    }

    public function get_Item()
    {
        $data = $this->db->get('items')->result();
        return $data;
    }

    public function getItemByCode($item_id)
    {
        $data = $this->db->get_where('items', ['item_id' => $item_id])->result();
        return $data;
    }
}
