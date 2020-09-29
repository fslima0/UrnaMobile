<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
         <div class="form-signin">
            <img src="<?= base_url('assets/img/list-solid.svg'); ?>" height="150" width="100" />
            <h1 class="h3 mb-3 font-weight-normal">Lista de Eleições</h1>
            <br />
            <ol>
            <?php foreach($eleicoes as $eleicao) { ?>
               <li><?=$eleicao['titulo']?></li>
               <?php
                  echo '<a href="deletar/'.$eleicao['id'].'" class="btn btn-danger">Apagar</a>';

                  if ($eleicao['status'] == '1') {
                     echo '<a href="desabilitar/'.$eleicao['id'].'" class="btn btn-secondary">Desabilitar</a>';
                  }
                  else {
                     echo '<a href="habilitar/'.$eleicao['id'].'" class="btn btn-success">Habilitar</a>';
                  }
                  echo '</hr>';
            }
            ?>
            </ol>
            <a href="<?= base_url('index.php/eleicoes/cadastrar'); ?>" class="btn btn-lg btn-primary btn-block" role="button">Adicionar Nova Eleição</a>
            <a href="<?= base_url(); ?>" class="btn btn-lg btn-light btn-block" role="button">Voltar</a>
         </div>
