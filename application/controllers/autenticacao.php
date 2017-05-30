<?php

class Autenticacao extends CI_Controller {

    public function index() {
        $toView = [];
        try {
            if ($this->session->userdata("usuario")) {
                redirect(site_url());
            }
        } catch (Exception $ex) {
            $this->msg->erro($ex->getMessage());
        } finally {
            //carrega as views
            $this->load->view('inc/header_view');
            $this->load->view('usuario/login_view');
            $this->load->view('inc/footer_view');
        }
    }

    public function login() {

        try {
            $this->load->model("usuario_model");
            $email = $this->input->post('email');
            $senha = $this->input->post('senha');

            
            
            $this->load->helper('email');
            
            if (!valid_email($email)) {
                throw new Exception("E-mail inválido");
            }
            
            if(!$senha || $senha==''){
                throw new Exception("Informações inválidas");
            }
            
            if($this->usuario_model->login($email, $senha)){
                $user = $this->usuario_model->get_by_email($email);
                if(!$user){
                    throw new Exception("Usuário não encontrado");
                }else{
                    $this->session->set_userdata("usuario", $user);
                    $this->session->set_userdata("operador", $user['id']);
                    $this->session->set_userdata("autenticado", "true");
                    $this->session->set_userdata("acesso", $user['tipo']);
                    $this->msg->sucesso("Seja bem-vindo!");
                }
            }else{
                throw new Exception("Combinação de login e senha incorretos");
            }
            
            
        } catch (Exception $ex) {
            $this->msg->erro($ex->getMessage());
        } finally {
            redirect(site_url());
        }
    }
    
    public function logout(){
        try{
            $this->session->sess_destroy();
        } catch (Exception $ex) {
            $this->msg->erro($ex->getMessage());
        } finally {
            redirect(site_url());
        }
    }

}
