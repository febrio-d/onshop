<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    public function get_Data()
    {
        $email = $this->session->userdata('email');
        $data['user'] = $this->db->get_where('user', ['email' => $email])->row_array();
        $data['role'] = 'user';
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

    public function getRecordByRId($user_id)
    {
        $data = $this->db->where('user_id', $user_id)->where('onDelete', '0')->order_by('record_id', 'DESC')->get('record');
        return $data->result();
    }

    public function getRecordAll()
    {
        $data = $this->db->join('user', 'user.id = record.user_id')->order_by('record_id', 'DESC')->get_where('record', array('onDelete' => '0'));
        return $data->result();
    }

    public function getDetailsHistory($hid)
    {
        $data = $this->db->where('history_id', $hid)->get('history');
        return $data->result();
    }

    public function getRecordByHId($hid)
    {
        $data = $this->db->where('history_id', $hid)->get('record');
        return $data->result();
    }
}
