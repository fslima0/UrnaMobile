<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

      <form class="form-signin" action="<?= base_url('index.php/login/recuperacao'); ?>" method="POST">
         <h4><span class="badge badge-success text-left"><?= $this->session->flashdata('mensagem_sucesso'); ?></span></h4>
         <h4><span class="badge badge-warning text-left"><?= $this->session->flashdata('mensagem_falha'); ?></span></h4>
         <img class="mb-4" src="<?= base_url('assets/img/ouvidoria_logo.png'); ?>" width="315" height="135" alt="logo">
         <h1 class="h3 mb-3 font-weight-normal">Recuperar Conta</h1>
         <input type="email" name="email" class="form-control" placeholder="Endereço de E-mail" required>
         <br />
         <button type="submit" class="btn btn-lg btn-primary btn-block">Recuperar</button>
         <a href="<?= base_url(); ?>" class="btn btn-lg btn-light btn-block" role="button">Voltar</a>
      </form>