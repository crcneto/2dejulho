<?php

class Home extends CI_Controller {

    public function index() {
        $this->load->view('inc/header_view');
        $this->load->view('home/home_view');
        $this->load->view('inc/footer_view');
    }

    public function contato() {
        $toView = [];
        if($this->session->flashdata("req")){
            $toView['req'] = $this->session->flashdata("req");
        }
        $this->load->view('inc/header_view');
        $this->load->view('home/contato_view', $toView);
        $this->load->view('inc/footer_view');
    }
    
    public function erro(){
        $this->load->view('inc/header_view');

        $this->load->view('erro/e404_view');

        $this->load->view('inc/footer_view');
    }
    
    public function send(){
        $toView = [];
        
        try{
            $nome = $this->input->post('nome');
            $email = $this->input->post('email');
            $telefone = $this->input->post('telefone');
            $titulo = $this->input->post('titulo');
            $mensagem = $this->input->post('mensagem');
            
            if(!$nome || $nome==''){
                throw new Exception("É necessário o preenchimento do nome");
            }
            if(!$email || $email=='' || !valid_email($email)){
                throw new Exception("É necessário o preenchimento de um e-mail válido");
            }
            if(!$mensagem || $mensagem==''){
                throw new Exception("Mensagem inválida");
            }
            
            $msg = "Contato via site:<br>";
            $msg.= "Nome: ".$nome."<br>";
            $msg.= "E-mail: ".$email."<br>";
            $msg.= "Telefone: ".$telefone."<br>";
            $msg.= "T&iacute;tulo: ".$titulo."<br>";
            $msg.= "Mensagem: ".$mensagem."<br><br>";
            $msg.= "---------------------------<br>Fim da Mensagem";
            
            $this->load->library('correio');
            if(!$this->correio->sendMail("claudiorcneto@yahoo.com.br", "Contato através do site - ", $msg)){
                throw new Exception("Erro ao enviar a mensagem");
            }
            $this->msg->sucesso("Mensagem enviada. Aguarde nosso contato.");
            
            
        } catch (Exception $ex) {
            $req = $this->input->post();
            $this->session->set_flashdata("req", $req);
            $this->msg->erro($ex->getMessage());
        } finally{
            redirect(site_url('home/contato'));
        }
    }

}
