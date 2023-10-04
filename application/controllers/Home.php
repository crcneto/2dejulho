<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index() {
        try {
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        } finally {
            $this->load->view("inc/header_view");
            $this->load->view("home/home_view");
            $this->load->view("inc/footer_view");
        }
    }

}
