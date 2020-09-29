<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidatos extends CI_Controller {
   function __construct() {
      parent::__construct();
      $this->load->model(array('candidatos_model', 'comarcas_model', 'eleicoes_model', 'votos_model'));
   }

   public function index() {
      $dados['eleicoes']   = $this->eleicoes_model->listar();
      $dados['candidatos'] = $this->candidatos_model->pesquisarPorComarca($this->session->userdata('comarca'));
      $pessoa_id           = $this->session->userdata('id');
      $voto                = $this->votos_model->listar($pessoa_id);

      $this->load->view('cabecalho');
      
      // Se usuário já tiver votado
      if (count($voto) > 0) {
         $this->load->view('mensagem_confirm_voto');
      }
      else {
         $this->load->view('menu_candidatos', $dados);
      }
   }

   public function cadastro() {
      $dados['comarcas'] = $this->comarcas_model->listar();
      $dados['eleicoes'] = $this->eleicoes_model->listar();
      
      $this->load->view('cabecalho');
      $this->load->view('form_cadastro_candidato', $dados);
   }
}