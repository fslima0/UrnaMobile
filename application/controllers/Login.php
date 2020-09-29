<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
   function __construct() {
      parent::__construct();
      $this->load->model(array('pessoas_model', 'candidatos_model', 'anexos_model'));
   }

   public function index() {
      // Metódo para pegar opção do usuário na URI
      $opcao      = $this->uri->segment(3);
      $estaLogado = $this->session->userdata('logado');
      $nivel      = $this->session->userdata('nivel');

      $this->load->view('cabecalho');

      // Se sessão estiver ativa, retorne a página inicial
      if ($estaLogado == TRUE) { 
         if ($nivel == '0') {
            redirect('ouvidoria');
         }
         else if ($nivel  == '1') {
            redirect('candidatos');
         }
         else {
            redirect('pessoas');
         }
      }

      // Se não estiver logado, inicie página de login ou recuperação de senha
      if ($opcao == "recuperacao") { 
         $this->load->view('form_recuperacao');
      }
      else {
         $this->load->view('form_login');
      }
      $this->load->view('rodape');
   }
   
   public function autenticar() {
      // Utilização do helper Form Validation do CodeIgniter
      $this->form_validation->set_rules('email', 'E-mail', 'trim|required');
      $this->form_validation->set_rules('senha', 'Senha', 'trim|required');

      if ($this->form_validation->run() == FALSE) {
         $this->load->view('form_login');
      }
      else {
         $email    = $this->input->post('email',TRUE);
         $senha    = $this->input->post('senha',TRUE);
         $validate = $this->pessoas_model->validar($email, $senha);

         // Se e-mail e senha forem válidos, inicie sessão
         if ($validate->num_rows() > 0) {
            $dados  = $validate->row_array();

            $sesdata = array(
               'id'        => $dados['id'],
               'nome'      => $dados['nome'],
               'comarca'   => $dados['comarca_id'],
               'nivel'     => $dados['nivel'],
               'logado'    => TRUE
            );
            $this->session->set_userdata($sesdata);
         }
         else {
            $this->session->set_flashdata('mensagem','Usuário e/ou senha inválidos.');
         }
         redirect('login');
      }
   }

   public function htmlmail($pessoa) {
      $estaLogado = $this->session->userdata('logado');

      $config = array(
         'protocol'   => 'smtp',
         'smtp_host'  => '10.53.49.21',
         'smtp_port'  =>  25,
         'smtp_user'  => 'eleicaoouvidoria@gmail.com',
         'mailtype'   => 'html',
         'charset'    => 'utf-8',
         'newline'    => '\r\n',
         'mailpath'   => '/usr/sbin/sendmail',
      );
      
      // Mensagem de confirmação de e-mail
      if ($estaLogado == TRUE) {
         extract($pessoa);
         $titulo = "Confirmação de Cadastro - Eleição da Ouvidoria";
         
         $mensagem = "
         <html>   
            <head>
               <title>Confirmaçao de Cadastro</title>
            </head>
            <body>
               <h2> Prezado(a) $nome </h2>
               <h3>
                  Obrigado por preencher seu cadastro no sistema de eleição da Ouvidoria.
                  É um prazer recebe-lo em nosso site. Seja bem-vindo!
               </h3>
               <p> Informações da sua conta: </p>
               <p> URL: http://eleicao.defensoria.ba.def.br
               <p> Email: $email </p>
               <p> Senha: $senha </p>
            </body>
         </html>
         ";
      }
      // Mensagem de recuperação de senha
      else {
         extract($pessoa[0]);
         $titulo = "Recuperação de Senha - Eleição da Ouvidoria";

         $mensagem = "
         <html>   
            <head>
               <title>Recuperação da Senha</title>
            </head>
            <body>
               <h2> Olá $nome </h2>
               <p> Segue a senha da sua conta: $senha <p>  
            </body>
         </html>
         ";
      }
      
      // Utiliza helper do CodeIgniter para enviar e-mail
      $this->load->library('email', $config);
      $this->email->initialize($config);
      $this->email->from($config['smtp_user']);
      $this->email->to($email);
      $this->email->subject($titulo);
      $this->email->message($mensagem);
      
      // Metódo envia mensagem de e-mail para o usuário
      if ($this->email->send()) {
         $this->session->set_flashdata('mensagem','Cadastro efetuado com sucesso.');
      }
      else {
         $this->session->set_flashdata('mensagem', $this->email->print_debugger());
      }
   }

   public function registrar() {
      // Operação ternária para inicializar variável caso cadastro seja para um candidato
      $descricao         = @$this->input->post('descricao_candidato') ?: NULL;
      $eleicao_id        = @$this->input->post('eleicao_id') ?: NULL;
      $foto_candidato_id = @$_FILES['foto_candidato_id'] ?: NULL;

      // Todo usuário (Representante, Candidato) é uma pessoa
      $pessoa = array(
         'nome'        => $this->input->post('nome'),
         'cpf'         => $this->input->post('cpf'),
         'email'       => $this->input->post('email'),
         'comarca_id'  => $this->input->post('comarca_id'),
         'senha'       => base64_encode(random_bytes(6)), // TODO: https://www.php.net/manual/en/intro.password.php
         'nivel'       => $this->input->post('nivel')
      );

      // Inicialmente cria uma pessoa
      $pessoa_id = $this->pessoas_model->inserir($pessoa);

      // Se cadastro for para candidato, execute segunda etapa
      if ($pessoa['nivel'] == '1') {
         $candidato = array();
         $candidato['descricao_candidato'] = $descricao;
         $candidato['eleicao_id'] = $eleicao_id;
         $candidato['pessoa_id'] = $pessoa_id;

         // Utiliza helper do CodeIgniter para fazer upload
         $config_upload = array( 
            'upload_path'   => './assets/uploads/',
            'allowed_types' => 'gif|jpg|png|jpeg',
            'max_size'	    => '1024',
            'file_name'     => $pessoa_id.'.jpg'
         );
         $this->upload->initialize($config_upload);

         if ($this->upload->do_upload('foto_candidato_id')) {
            $upload['filename'] = $config_upload['file_name'];
            $upload['caminhos_fisico'] = $config_upload['upload_path'];

            $foto_candidato_id = $this->anexos_model->inserir($upload);
            $candidato['foto_candidato_id'] = $foto_candidato_id;
         }
         else {
            echo $this->upload->display_errors();
         }
         $candidato_id = $this->candidatos_model->inserir($candidato); 
      }
      // Envia e-mail de confirmação para o cadastrado
      $this->htmlmail($pessoa);
      $this->session->set_flashdata('mensagem_sucesso','Usuário cadastrado com sucesso.');
      
      redirect('ouvidoria');
   }

   public function recuperacao() {
      $email = $this->input->post('email', TRUE);
      $pessoa = $this->pessoas_model->pesquisarPorEmail($email);
      
      // Se e-mail for válido, mandar e-mail
      if (count($pessoa) > 0) {
         $this->htmlmail($pessoa);

         $this->session->set_flashdata('mensagem_sucesso','Usuário e senha enviado para seu e-mail.');
      }
      else {
         $this->session->set_flashdata('mensagem_falha','Não foi possível localizar o e-mail do usuário.');
      }
      redirect('login/index/recuperacao');
   }

   public function alterar() {
      $this->load->view('cabecalho');
      $this->load->view('form_alterar_senha');
      $this->load->view('rodape');
   }

   public function sair() {
      $this->session->sess_destroy();
      
      redirect('login');
   }
}