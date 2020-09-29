<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

      <form class="form-signin" action="<?= base_url('index.php/login/registrar'); ?>" method="POST">
         <img src="<?= base_url('assets/img/user-plus-solid.svg'); ?>" height="150" width="100" />
         <h1 class="h3 mb-3 font-weight-normal">Cadastrar Cidadão</h1>
         <input type="text" class="form-control" name="nome" placeholder="Nome Completo" required>
         <input type="text" class="form-control" name="cpf" placeholder="CPF" required>
         <input type="email" class="form-control" name="email" placeholder="Endereço de E-mail" required>
         <select class="form-control" name="comarca_id">
            <option disabled selected="true">Município</option>
            <?php foreach($comarcas as $comarca) { ?>
               <option value="<?= $comarca->id; ?>"><?= $comarca->nome; ?></option>';
            <?php } ?>
         </select>
         <br />
         <!-- Nível do Usuário (Representante de Grupo Operativo) -->
         <input type="hidden" name="nivel" value="2"> 
         <button type="submit" class="btn btn-lg btn-primary btn-block">Cadastrar</button>
         <a href="<?= base_url('index.php/ouvidoria'); ?>" class="btn btn-lg btn-light btn-block" role="button">Voltar</a>
      </form>