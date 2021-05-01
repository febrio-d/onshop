<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->helper('date');
        if (!$this->session->userdata('email')) {
            redirect('auth');
        }
    }

    public function index($url = null, $ext = null)
    {
        $data = $this->user_model->get_Data();
        if ($ext != null) {
            $item = $this->user_model->getItemByCode($url)[0];
            if ($ext === 'del') {
                unset($_SESSION['shopping'][$url]);
            } elseif ($ext === 'plus') {
                $quantity = $item->stock - ($_SESSION['shopping'][$url] + 1);
                if ($quantity > 0) {
                    $_SESSION['shopping'][$url] += 1;
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sorry! We are out of stock!</div>');
                }
            } elseif ($ext === 'min') {
                if ($_SESSION['shopping'][$url] == 0) {
                    unset($_SESSION['shopping'][$url]);
                } else {
                    $_SESSION['shopping'][$url] -= 1;
                    if ($_SESSION['shopping'][$url] == 0) {
                        unset($_SESSION['shopping'][$url]);
                    }
                }
            }
            redirect('user/index');
        } elseif ($url === 'unset') {
            $this->session->unset_userdata('shopping');
        } else {
            if ($url != null) {
                $item = $this->user_model->getItemByCode($url)[0];
                if (!isset($_SESSION['shopping'])) {
                    $this->session->set_userdata('shopping');
                }
                if (isset($_SESSION['shopping'][$url])) {
                    $quantity = $item->stock - $_SESSION['shopping'][$url];
                    if ($quantity > 0) {
                        $_SESSION['shopping'][$url] += 1;
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sorry! We are out of stock!</div>');
                    }
                } else {
                    $quantity = (int) $item->stock;
                    if ($quantity > 0) {
                        $_SESSION['shopping'][$url] = 1;
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Sorry! We are out of stock!</div>');
                    }
                }
                redirect('user/index');
            }
        }
        $data['data'] = $this->user_model->get_Item();
        $data['title'] = "Home";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/user_navbar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function checkout()
    {
        $data = $this->user_model->get_Data();
        $data['data'] = $this->user_model->get_Item();
        $data['title'] = "Check Out";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/user_navbar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/checkout', $data);
        $this->load->view('templates/footer');
    }

    public function add()
    {
        $money = $this->input->post('money');
        $total = $this->input->post('total');
        if ($money < $total) {
            $this->session->set_flashdata('message', '<script>window.alert("The amount paid is insufficient!");</script>');
            redirect('user/checkout');
        }
        $data = $this->user_model->get_Item();
        $shop = $this->session->userdata('shopping');
        $random = rand(0, 99999);
        foreach ($data as $item) {
            if (isset($shop[$item->item_id])) {
                $user = $this->user_model->get_Data()['user'];
                $hid = $this->user_model->getByCode($item->item_id);
                $quantity = $shop[$item->item_id];
                $history = [
                    "user_id" => $user['id'],
                    "item_id" => $hid['item_id'],
                    "history_id" => $random,
                    "total" => $total,
                    "paid" => $money,
                    "quantity" => $quantity,
                    "date" => now('Asia/Jakarta')
                ];
                $this->db->where('item_id', $item->item_id)->update('items', ['stock' => $hid['stock'] - $quantity]);
                $this->db->insert("history", $history);
            }
        }
        if ($this->db->affected_rows() > 0) {
            $this->session->unset_userdata('shopping');
            $this->session->set_flashdata('message', '<script>window.alert("Successfully made a purchase!");</script>');
            redirect('user/history');
        }
    }

    public function history()
    {
        $data = $this->user_model->get_Data();
        $data['title'] = "History";
        $data['history'] = $this->user_model->getHistoryByuid($data['user']['id']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/user_navbar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/history', $data);
        $this->load->view('templates/footer');
    }

    public function detail($hid = "")
    {
        if ($hid == "") {
            $this->session->set_flashdata('error', '<script>window.alert("Error! Failed no code exists!");</script>');
            redirect(base_url('user/histori'));
        }
        $data = $this->user_model->get_data();
        $data['title'] = "Details History";
        $data['histori'] = $this->user_model->getDetailsHistori($hid);
        $this->load->view('templates/user_header', $data);
        $this->load->view('templates/user_navbar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/detail-histori', $data);
        $this->load->view('templates/user_footer');
    }

    public function profile()
    {
        $data['title'] = "My Profile";
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/user_navbar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/profile', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/user_navbar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_sizes'] = '1024';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }

            $this->db->set('name', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated!</div>');
            redirect('user/profile');
        }
    }
}
