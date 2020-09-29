<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>    

      <div class="form-signin">
         <h4><span class="badge badge-warning"><?= $this->session->flashdata('mensagem_falha'); ?></span></h4>
         <h4><span class="badge badge-success"><?= $this->session->flashdata('mensagem_sucesso'); ?></span></h4>
         <h1 class="h3 mb-3 font-weight-normal">Menu de Opções</h1>
         <a href="<?= base_url('index.php/pessoas/cadastro'); ?>" class="btn btn-lg btn-success btn-block" role="button">
            Cadastrar Cidadão
         </a>
         <a href="<?= base_url('index.php/candidatos/cadastro'); ?>" class="btn btn-lg btn-warning btn-block" role="button">
            Cadastrar Candidato
         </a>
         <hr />
         <a href="<?= base_url('index.php/eleicoes/index'); ?>" class="btn btn-lg btn-primary btn-block" role="button">
            Eleições
         </a>
         <a href="<?= base_url('index.php/eleicoes/menu'); ?>" class="btn btn-lg btn-secondary btn-block" role="button">
            Visualizar Relatórios
         </a>
      </div>