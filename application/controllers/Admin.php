<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model');
        $this->load->model('user_model');
        if (!$this->session->userdata('email')) {
            redirect('auth');
        } else if ($this->session->userdata('role_id') == 3) {
            redirect('auth/blocked');
        }
    }

    public function index()
    {
        $data = $this->admin_model->get_Data();
        $data['list_item'] = $this->user_model->get_Item();
        $data['title'] = 'Dashboard';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/admin_navbar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function delete_item($id = null)
    {
        $this->db->delete('items', ['item_id' => $id]);
        $rest = $this->db->affected_rows();
        if ($rest == 0) {
            $this->session->set_flashdata('message', '<script>window.alert("Item can\'t be deleted!");</script>');
        }
        $this->session->set_flashdata('message', '<script>window.alert("Item has been deleted!");</script>');
        redirect('admin');
    }

    public function change_item()
    {
        $data = $this->user_model->get_Item();
        $name = htmlspecialchars($this->input->post('name', true));
        $id = htmlspecialchars($this->input->post('id', true));
        $price = $this->input->post('price');
        $upload_image = $_FILES['image']['name'];
        if ($upload_image) {
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_sizes'] = '1024';
            $config['upload_path'] = './assets/img/items/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $old_image = $data['user']['image'];
                if ($old_image != 'default.jpg') {
                    unlink(FCPATH . 'assets/img/items/' . $old_image);
                }

                $new_image = $this->upload->data('file_name');
                $this->db->set('image', $new_image);
            } else {
                $this->session->set_flashdata('message', '<script>window.alert("Image is invalid!");</script>');
                redirect('admin');
            }
        }

        if (trim($name) == '' || trim($price) == '') {
            $this->session->set_flashdata('message', '<script>window.alert("Input can\'t be Null!");</script>');
            redirect('admin');
        } elseif ($upload_image == '') {
            $arr = $this->db->get_where('items', ['item_id' => $id])->row_array();
            $upload_image = $arr['image'];
        }
        $this->db->set([
            'name' => $name,
            'price' => $price,
            'image' => $upload_image
        ]);
        $this->db->where('item_id', $id);
        $this->db->update('items');
        if ($this->db->affected_rows() < 0) {
            $this->session->set_flashdata('message', '<script>window.alert("Item doesn\'t changed!");</script>');
        }
        redirect('admin');
    }

    public function stock_item()
    {
        $id = $this->input->get_post('id');
        $stock = $this->input->get_post('item');
        $data = $this->db->get_where('items', ['item_id' => $id])->row_array();
        if (intval($data['stock']) == null) {
            $data['stock'] = 0;
        }
        $stock = intval($stock) + intval($data['stock']);
        if ($stock < 0) {
            $stock = 0;
        }
        $this->db->set('stock', $stock);
        $this->db->where('item_id', $id);
        $this->db->update('items');
        if ($this->db->affected_rows() < 0) {
            $this->session->set_flashdata('error', '<script>window.alert("Error! Not Item can be Changed!");</script>');
        }
        redirect('admin', 'refresh');
    }

    public function add_item()
    {
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        $this->form_validation->set_rules('stock', 'Stock', 'trim|required');

        if ($this->form_validation->run() == true) {
            $this->save();
        } else {
            $data = $this->admin_model->get_data();
            $data['list_item'] = $this->user_model->get_Item();
            $data['title'] = "Add New Item";
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin_navbar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/add-item', $data);
            $this->load->view('templates/footer');
        }
    }

    public function save()
    {
        $image = $_FILES['image']['name'];
        if ($image) {
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_sizes'] = '1024';
            $config['upload_path'] = './assets/img/items/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data('file_name');
                $this->db->set('image', $image);
            } else {
                $this->upload->display_errors();
            }
        } else {
            $image = 'item.png';
            $this->db->set('image', $image);
        }

        $item_code = random_int(1, 9999);
        $save = [
            'item_id' => $item_code,
            'name' => htmlspecialchars($this->input->post('name', true)),
            'price' => htmlspecialchars($this->input->post('price', true)),
            'image' => $image,
            'stock' => htmlspecialchars($this->input->post('stock', true)),
        ];

        $this->db->insert('items', $save);
        $this->session->set_flashdata('message', '<script>window.alert("Item successfully added!");</script>');
        redirect('admin/index');
    }

    public function list_user()
    {
        if ($this->session->userdata('role_id >', '1')) {
            redirect('admin');
        }
        $data = $this->admin_model->get_data();
        $data['list'] = $this->admin_model->get_list_user();
        $data['title'] = "List of Users";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/admin_navbar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/list-user', $data);
        $this->load->view('templates/footer');
    }

    public function delete_user($id = null)
    {
        if ($this->session->userdata('role_id >', '1')) {
            redirect('admin');
        }
        $this->db->delete('user', ['id' => $id]);
        $rest = $this->db->affected_rows();
        if ($rest == 0) {
            $this->session->set_flashdata('message', '<script>window.alert("The account can\'t be deleted!");</script>');
        } else {
            $this->session->set_flashdata('message', '<script>window.alert("The account has been deleted!");</script>');
        }
        redirect('admin/list_user');
    }

    public function change_user()
    {
        if ($this->session->userdata('role_id >', '1')) {
            redirect('admin');
        }
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[user.email]', [
            'is_unique' => 'This Email has already existed!'
        ]);
        $name = htmlspecialchars($this->input->get_post('name', true));
        $email = htmlspecialchars($this->input->get_post('email', true));
        $id = $this->input->get_post('id');
        $data = [
            'name' => $name,
            'email' => $email
        ];

        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('user');
        $rest = $this->db->affected_rows();
        if ($rest == 0) {
            $this->session->set_flashdata('message', '<script>window.alert("The account can\'t be changed!");</script>');
        } else {
            $this->session->set_flashdata('message', '<script>window.alert("The account has been changed!");</script>');
        }
        redirect('admin/list_user');
    }

    public function block_user($id = null)
    {
        if ($this->session->userdata('role_id >', '1')) {
            redirect('admin');
        }
        $this->db->set('is_active', '0');
        $this->db->where('id', $id);
        $this->db->update('user');
        $rest = $this->db->affected_rows();
        if ($rest == 0) {
            $this->session->set_flashdata('message', '<script>window.alert("The account can\'t be blocked!");</script>');
        } else {
            $this->session->set_flashdata('message', '<script>window.alert("The account has been blocked!");</script>');
        }
        redirect('admin/list_user');
    }

    public function activate_user($id = null)
    {
        if ($this->session->userdata('role_id >', '1')) {
            redirect('admin');
        }
        $this->db->set('is_active', '1');
        $this->db->where('id', $id);
        $this->db->update('user');
        $rest = $this->db->affected_rows();
        if ($rest == 0) {
            $this->session->set_flashdata('message', '<script>window.alert("The account can\'t be activated!");</script>');
        } else {
            $this->session->set_flashdata('message', '<script>window.alert("The account has been activated!");</script>');
        }
        redirect('admin/list_user');
    }

    public function registration()
    {
        if ($this->session->userdata('role_id >', '1')) {
            redirect('admin');
        }
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            'matches' => 'Password do not match!',
            'min_length' => 'Your password must be at least 8 characters.'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data = $this->admin_model->get_Data();
            $data['title'] = 'Admin Registration';
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin_navbar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/registration', $data);
            $this->load->view('templates/footer');
        } else {
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 2,
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulations! Your account has been created.</div>');
            redirect('auth');
        }
    }

    public function history()
    {
        $data = $this->user_model->get_Data();
        $data['title'] = "History";
        $data['history'] = $this->user_model->getRecordAll();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/admin_navbar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/history', $data);
        $this->load->view('templates/footer');
    }

    public function delete($hid = "")
    {
        if ($hid != "") {
            $del = $this->admin_model->deleteHistory($hid);
            if ($del > 0) {
                $this->session->set_flashdata('message', '<script>window.alert("Successfully delete history!");</script>');
            } else {
                $this->session->set_flashdata('message', '<script>window.alert("Item can\'t be deleted!");</script>');
            }
            redirect('admin/history');
        } else {
            $this->session->set_flashdata('message', '<script>window.alert("History don\'t exist!");</script>');
            redirect('admin/history');
        }
    }

    public function profile()
    {
        $data = $this->admin_model->get_Data();
        $data['title'] = "My Profile";

        $this->load->view('templates/header', $data);
        $this->load->view('templates/admin_navbar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/profile', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data = $this->admin_model->get_Data();
        $data['title'] = 'Edit Profile';

        $this->form_validation->set_rules('name', 'Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin_navbar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/edit', $data);
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
            redirect('admin/profile');
        }
    }
}
