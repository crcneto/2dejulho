<?php

class Usuario extends CI_Controller {

    public function index() {
        
    }

    public function alterar_senha() {
        //checa a autenticação
        try {
            if ($this->session->userdata('usuario')) {

                $this->load->view('inc/header_view');
                $this->load->view('usuario/alterar_senha_view');
                $this->load->view('inc/footer_view');
                
            } else {
                throw new Exception('É necessário ter sido autenticado no sistema');
            }
        } catch (Exception $ex) {
            $this->msg->erro($ex->getMessage());
            redirect(site_url('autenticacao'));
        }
    }

}
