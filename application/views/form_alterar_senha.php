<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
      <form class="form-signin" action="<?= base_url('index.php/pessoas/alterar'); ?>" method="POST">         
         <img src="<?= base_url('assets/img/key-solid.svg'); ?>" height="150" width="100" />
         <h1 class="h3 mb-3 font-weight-normal">Alterar Senha</h1>
         <input type="password" name="nova_senha" class="form-control" placeholder="Nova Senha" required>
         <input type="password" name="confirm_nova_senha" class="form-control" placeholder="Confirmação da Senha" required>
         <br />
         <button type="submit" class="btn btn-lg btn-primary btn-block">Alterar</button>
         <a href="<?= base_url(); ?>" class="btn btn-lg btn-light btn-block" role="button">Voltar</a>
      </form>