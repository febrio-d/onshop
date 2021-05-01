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

    public function getByCode($code)
    {
        return $this->db->get_where('items', ['item_id' => $code])->row_array();
    }

    public function getHistory()
    {
        $this->db->select('*');
        $this->db->from('history');
        $this->db->join('items', 'items.item_id = history.item_id');
        $data = $this->db->get();
        return $data->result();
    }

    public function getHistoryByuid($user_id)
    {
        $data = $this->db->where('user_id', $user_id)->order_by('id', 'DESC')->get('history');
        return $data->result();
    }

    public function getHistoryAll()
    {
        $data = $this->db->join('user', 'user.id = history.user_id')->order_by('id', 'DESC')->get_where('history', array('onDelete' => '1'));
        return $data->result();
    }

    public function getDetailsHistory($hid)
    {
        $data = $this->db->where('history_id', $hid)->join('items', 'items.item_id = history.item_id')->get('history');
        return $data->result();
    }
}
