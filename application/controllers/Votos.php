<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Votos extends CI_Controller {
   function __construct() {
      parent::__construct();
      $this->load->model('votos_model');
   }

   public function index() {
      $dados['pessoa_id']    = $this->session->userdata('id');
      $dados['candidato_id'] = $this->input->post('candidato_id');
      $dados['eleicao_id']   = $this->input->post('eleicao_id');

      // Insere voto no banco de dados
      $this->votos_model->inserir($dados); 
      
      redirect('login');
   }
}