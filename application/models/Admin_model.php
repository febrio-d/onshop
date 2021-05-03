<?php

class Admin_model extends CI_model
{

    public function get_data()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        return $data;
    }

    public function get_list_user($id = null)
    {
        $data = $this->db->get_where('user', ['role_id' => $id]);
        return $data->result();
    }

    public function get_itemAll()
    {
        $data = $this->db->get('barang');
        return $data->result();
    }

    public function deleteHistory($id)
    {
        $data = array(
            'onDelete' => '0'
        );
        $this->db->where('nomor', $id);
        $this->db->update('riwayat', $data);
        return $this->db->affected_rows();
    }
}
