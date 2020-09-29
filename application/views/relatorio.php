<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<html>
   <head>
      <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
   </head>
   <body>
      <div class="container-fluid">
         <h1>Relatório de Classificação</h1>
         <hr />
         <table class="table table-borderless">
            <thead>
               <tr>
                  <th>Classificação</th>
                  <th>Município</th>
                  <th>Votos</th>
                  <th>Nome do Candidato</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $cont = 1;
                  foreach($candidatos as $candidato) {
                     if ($cont <= 2) {
                        $comarca = $candidato->comarca;
                     }
                     else if ($cont <= 4 && ($candidato->comarca == 'SALVADOR')) {
                        $comarca = $candidato->comarca;
                     }
                     else if ($cont <= 4 && ($candidato->comarca == 'FEIRA DE SANTANA')) {
                        if ($comarca == 'SALVADOR') {
                           $cont = 1;
                        }
                        $comarca = $candidato->comarca;
                     }
                     else if ($comarca == $candidato->comarca) { 
                        continue;
                     }
                     else {
                        $cont = 1;
                     }
                     echo '<tr>';
                        echo '<td>'.$cont . '</td>';
                        echo '<td>'.$candidato->comarca. '</td>';
                        echo '<td>'.$candidato->votos.'</td>';
                        echo '<td>'.$candidato->nome.'</td>';
                     echo '</tr>';
                     ++$cont;
                  }
               ?>
            </tbody>
         </table>
      </div>
   </body>
</html>
