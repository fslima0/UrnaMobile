<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pessoas extends CI_Controller {
   function __construct() {
      parent::__construct();
      $this->load->model(array('pessoas_model', 'comarcas_model', 'eleicoes_model', 'candidatos_model', 'votos_model', 'anexos_model'));
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
      
      $this->load->view('cabecalho');
      $this->load->view('form_cadastro_pessoa', $dados);
   }
   
   public function votar() {
      $candidato_id        = $this->input->post('candidato', TRUE);
      $dados['candidato']  = $this->candidatos_model->pesquisarPorId($candidato_id);
      $dados['anexo']      = $this->anexos_model->pesquisarAnexoPorId($candidato_id);
      $pessoa_id           = $this->session->userdata('id');
      $voto                = $this->votos_model->listar($pessoa_id);

      // Para receber a data final de inscrição
      $data_atual          = date('Y-m-d H:i:s', time());
      $eleicao_id          = @$voto['eleicao_id'] ?: NULL;
      $data_final_votacao  = @$this->eleicoes_model->pesquisarPorDataFinal($eleicao_id) ?: NULL;

      $this->load->view('cabecalho');

      // Se data atual exceder data final de votação, não conclua voto
      if ($data_atual > $data_final_votacao) {
         $this->session->set_flashdata('mensagem_falha','Período de votação encerrado.');

         redirect('login');
      }
      else {
         $this->load->view('form_voto', $dados);
      }
   }

   public function alterar() {
      // Altera a senha do usuário
      $senha         = $this->input->post('nova_senha');
      $confirm_senha = $this->input->post('confirm_nova_senha');
      $id            = $this->session->userdata('id');

      if (!strcmp($senha, $confirm_senha)) {
         $this->pessoas_model->atualizar($id, $senha); // TODO: Boas prácticas de segurança

         $this->session->set_flashdata('mensagem_sucesso','Senha foi alterado com sucesso.');
      }
      else {
         $this->session->set_flashdata('mensagem_falha','Não foi possível mudar a senha.');
      }
      redirect('login');
   }
}