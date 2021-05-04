<?php

class Admin_model extends CI_model
{

    public function get_Data()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['role'] = 'admin';
        return $data;
    }

    public function get_list_user()
    {
        $data = $this->db->where('role_id !=', '1')->get('user');
        return $data->result();
    }

    public function deleteHistory($id)
    {
        $data = array(
            'onDelete' => '1'
        );
        $this->db->where('record_id', $id);
        $this->db->update('record', $data);
        return $this->db->affected_rows();
    }
}
