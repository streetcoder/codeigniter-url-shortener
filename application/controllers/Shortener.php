<?php
/**
 * Created by StreetCoder.
 * User: ati
 * Date: 12/24/15
 * Time: 2:28 PM
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Shortener extends MY_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->helper('string');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
    }

    public function index() {

        $this->form_validation->set_rules('url_address', $this->lang->line('create_url_address'), 'required|min_length[1]|max_length[1000]|trim');

        if ($this->form_validation->run() == FALSE) {
            $page_data = array('success_fail'   => null,
                'encoded_url'    => false);

            $this->load->view('layouts/header');
            $this->load->view('layouts/navigation');
            $this->load->view('shortener/create', $page_data);
            $this->load->view('layouts/footer');
        } else {
            $data = array(
                'url_address' => $this->input->post('url_address'),
            );

            $this->load->model('shortener_model');
            if ($res = $this->shortener_model->save_url($data)) {
                $page_data['success_fail'] = 'success';
                $page_data['encoded_url'] = $res;
            } else {
                $page_data['success_fail'] = 'fail';
            }

            $page_data['encoded_url'] = base_url('index.php') . '/' . $res;

            $this->load->view('layouts/header');
            $this->load->view('layouts/navigation');
            $this->load->view('shortener/create', $page_data);
            $this->load->view('layouts/footer');
        }
    }

}