<?php
/**
 * Created by StreetCoder.
 * User: ati
 * Date: 12/24/15
 * Time: 2:52 PM
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');
class Fetch extends MY_Controller{
    function __construct() {
        parent::__construct();
        $this->load->helper('string');
    }

    public function index() {
        if (!$this->uri->segment(1)) {
            redirect (base_url());
        } else {
            $url_code = $this->uri->segment(1);
            $this->load->model('shortener_model');
            $query = $this->shortener_model->fetch_url($url_code);

            if ($query->num_rows() == 1) {
                foreach ($query->result() as $row) {
                    $url_address = $row->url_address;
                }

                redirect (prep_url($url_address));
            } else {
                $page_data = array('success_fail'   => null,
                    'encoded_url'    => false);

                $this->load->view('layouts/header');
                $this->load->view('layouts/navigation');
                $this->load->view('shortener/create', $page_data);
                $this->load->view('layouts/footer');
            }
        }
    }
}