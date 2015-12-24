<?php
/**
 * Created by StreetCoder.
 * User: ati
 * Date: 12/24/15
 * Time: 2:21 PM
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class MY_Controller extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('security');
        $this->load->helper('language');

        // Load language file
        $this->lang->load('en_shortener_lang', 'english');
    }
}