<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ouvidoria extends CI_Controller {
   function __construct() {
      parent::__construct();
      $this->load->model('eleicoes_model');
   }

   public function index() {
      $nivel = $this->session->userdata('nivel');
      
      // Acesso permitido somente a Ouvidoria
      if ($nivel == '0') {
         $this->load->view('cabecalho');
         $this->load->view('menu_opcoes');
      }
      else {
         echo "Acesso Restrito.";
      }
   }

   public function relatorio() {
      $eleicao_id = $this->input->post('eleicao_id');

      $dados['candidatos'] = $this->eleicoes_model->relatorio($eleicao_id);

      $this->load->view('relatorio', $dados);
   }
}