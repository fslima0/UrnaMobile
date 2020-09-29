<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
   
      <form class="form-signin" action="<?= base_url('index.php/login/autenticar'); ?>" method="POST">
         <h4><span class="badge badge-warning"><?= $this->session->flashdata('mensagem'); ?></span></h4>
         <img class="mb-4" src="<?= base_url('assets/img/ouvidoria_logo.png'); ?>" width="315" height="135" alt="logo">
         <h1 class="h3 mb-3 font-weight-normal">Login</h1>
         <input type="text" class="form-control" name="email" placeholder="Endereço de E-mail" required autofocus>
         <input type="password" class="form-control" name="senha" placeholder="Senha" required>
         <p class="text-left">
            <a href="<?= base_url('index.php/login/index/recuperacao'); ?>"> 
               Esqueceu sua senha?
            </a>
         </p>
         <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
         <p class="text-left">
            <span class="badge badge-warning"><?= $this->session->flashdata('login_falhou'); ?></span>
         </p>
      </form>