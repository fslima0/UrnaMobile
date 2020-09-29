<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <title>Eleição da Ouvidoria</title>
      <meta charset="utf-8">
      <meta name="description" content="Sistema de Eleição da Ouvidoria">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css'); ?>">
      <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
      <link href="<?= base_url('assets/css/styles.css'); ?>" rel="stylesheet">
      <!-- Scripts JS do Bootstrap. Diminuirão aparente performance de carregamento. -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="<?= base_url('assets/js/bootstrap.bundle.min.js'); ?>"></script>
   </head>
   <body class="container text-center">
      <header>
         <nav class="navbar navbar-light fixed-top text-white" style="background-color: #006400;">
            <a class="navbar-brand" href="<?= base_url(); ?>">
               <img src="<?= base_url('assets/img/IconDefensoria.png'); ?>" height="35" width="70" />
            </a> 
            <?php if ($this->session->userdata('logado') == TRUE): ?>
            <div class="text-right">
               <div class="dropdown">
                  <button class="btn btn-outline-light dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     <?= $this->session->userdata('nome'); ?>
                  </button>
                  <div class="dropdown-menu">
                     <a class="dropdown-item" href="<?= base_url('index.php/login/alterar'); ?>">Alterar senha</a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="<?= site_url('login/sair');?>">Sair</a>
                  </div>
               </div>
            </div>
            <?php else:?>
            <?php endif;?>
         </nav>
      </header>  