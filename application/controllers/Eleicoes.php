<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Eleicoes extends CI_Controller {
   function __construct() {
      parent::__construct();
      $this->load->model('eleicoes_model');
   }

   public function index() {
      $dados['eleicoes'] = $this->eleicoes_model->listar();

      $this->load->view('cabecalho');
      $this->load->view('lista_eleicoes', $dados);
   }

   public function inserir() {
      $eleicao['titulo']                = $this->input->post('titulo');
      $eleicao['edital']                = $this->input->post('edital');
      $eleicao['data_inicio_inscricao'] = $this->input->post('data_inicio_inscricao');
      $eleicao['data_final_inscricao']  = $this->input->post('data_final_inscricao');
      $eleicao['data_inicio_votacao']   = $this->input->post('data_inicio_votacao');
      $eleicao['data_final_votacao']    = $this->input->post('data_final_votacao');

      $this->eleicoes_model->inserir($eleicao);

      redirect('ouvidoria');
   }

   public function deletar($eleicao_id) {
      $dados['eleicoes'] = $this->eleicoes_model->pesquisarPorId($eleicao_id);

      if (count($dados['eleicoes']) == 0) {
         $this->eleicoes_model->deletar($eleicao_id);

         $this->session->set_flashdata('mensagem_sucesso','Eleição deletada com sucesso.');
      } else {
         $this->session->set_flashdata('mensagem_falha','Não foi possível deletar o registro.');
      }
      redirect('ouvidoria');
   }

   public function cadastrar() {
      $this->load->view('cabecalho');
      $this->load->view('form_adicionar_eleicao');
   }

   public function menu() {
      $dados['eleicoes'] = $this->eleicoes_model->listar();

      $this->load->view('cabecalho');
      $this->load->view('menu_eleicoes', $dados);
   }

   public function desabilitar($eleicao_id) {
      $this->eleicoes_model->desabilitar($eleicao_id);

      redirect('eleicoes');
   }

   public function habilitar($eleicao_id) {
      $this->eleicoes_model->habilitar($eleicao_id);

      redirect('eleicoes');
   }
}