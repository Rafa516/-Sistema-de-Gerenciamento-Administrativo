<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="content-inside">
    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color:#2E9AFE;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
            role="tab" aria-controls="home" aria-selected="false"><b>Painel de
              Dados</b></a>
        </li>
      </ul>
      <center><img src="../res/user/img/logo.png" class="logo" alt=""></center>

      <div class="subTitulo"><p style="font-size: 20px;color: #585858;" class="small mb-1"><b>UNIDADES ESCOLARES</b></p></div>
      <hr>
      
   
      <center><!-- Button trigger modal -->

        <button  type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalEducacaoInfantil" id="buttonsPainel">
          Educação Infantil
        </button>
      

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-danger" data-toggle="modal"
          data-target="#modalInfantilFundamental"  id="buttonsPainel">
          Educação Infantil e Ensino Fundamental
        </button>



        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalFundamental"  id="buttonsPainel">
          Ensino Fundamental
        </button>

        

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#modalFundamentalMedio"  id="buttonsPainel">
          Ensino Fundamental e Médio
        </button>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
          data-target="#modalMedio"  id="buttonsPainel">
          Ensino Médio
        </button>
      
      </center>
      
      <center><canvas id="unidades" style="width:100%;max-width:600px;height:400px"></canvas><br><br>

          <center><!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modalDiretores"  id="buttonsPainel">
          Diretores
        </button>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-danger" data-toggle="modal"
          data-target="#modalViceDiretores"  id="buttonsPainel">
          Vice-diretores
        </button>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modalSupervisores"  id="buttonsPainel">
          Supervisores
        </button>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#modalChefeSecretaria"  id="buttonsPainel">
          Chefe de Secretaria
        </button>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-outline-secondary" data-toggle="modal"
          data-target="#modalCoordenadorPedagogico"  id="buttonsPainel">
          Coordenadores Pedágogicos
        </button>
      </center>

      

        <canvas id="unidadesGestores" style="width:100%;max-width:600px;height:400px"></canvas><br><br>

        <canvas id="unidadesTurmas" style="width:100%;max-width:100%"></canvas>
      </center><br>


    <div class="subTitulo">
      <p style="font-size: 20px;color: #585858;" class="small mb-1"><b>ITINERÁRIOS</b></p>
      <hr>
    </div>

      <canvas id="itinerarios" style="width:100%"></canvas>




      <hr class="my-4" />


      <!-- MODAL EDUCAÇÃO INFANTIL -->
      <div class="modal fade" id="modalEducacaoInfantil" tabindex="-1" role="dialog"
        aria-labelledby="modalEducacaoInfantilTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">EDUCAÇÃO INFANTIL - <?php echo totalInfantil(); ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <table class="table table-hover table-bordered">
                <thead class="table table-dark">
                  <tr>
                    <th>
                      <center>Unidade Escolar
                    </th>
                    <th>
                      <center>Informações
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($educacaoInfantil) && ( is_array($educacaoInfantil) || $educacaoInfantil instanceof Traversable ) && sizeof($educacaoInfantil) ) foreach( $educacaoInfantil as $key1 => $value1 ){ $counter1++; ?>

                  <tr>

                    <td>
                      <center> <?php echo $value1["sigla"]; ?>


                    </td>

                    <td>
                      <center><a href="/usuario/unidade/informacoes/<?php echo $value1["id_unidade"]; ?>" class="btn btn-primary btn-sm ">
                    <i class="fas fa-eye" aria-hidden="true"></i>
                    <b> Verificar</b></a>

                    </td>

                  </tr>
                  <?php } ?>

                </tbody>
              </table>

              <div class="modal-footer">

              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- MODAL EDUCAÇÃO INFANTIL E FUNDAMENTAL -->

      <div class="modal fade" id="modalInfantilFundamental" tabindex="-1" role="dialog"
        aria-labelledby="modalInfantilFundamentalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">EDUCAÇÃO INFANTIL E ENSINO FUNDAMENTAL -
                <?php echo totalInfantilFundamental(); ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <table class="table table-hover table-bordered">
                <thead class="table table-dark">
                  <tr>
                    <th>
                      <center>Unidade Escolar
                    </th>
                    <th>
                      <center>Informações
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($educacaoInfantilFundamental) && ( is_array($educacaoInfantilFundamental) || $educacaoInfantilFundamental instanceof Traversable ) && sizeof($educacaoInfantilFundamental) ) foreach( $educacaoInfantilFundamental as $key1 => $value1 ){ $counter1++; ?>

                  <tr>

                    <td>
                      <center> <?php echo $value1["sigla"]; ?>


                    </td>

                    <td>
                      <center><a href="/usuario/unidade/informacoes/<?php echo $value1["id_unidade"]; ?>" class="btn btn-primary btn-sm ">
                    <i class="fas fa-eye" aria-hidden="true"></i>
                    <b> Verificar</b></a>

                    </td>

                  </tr>
                  <?php } ?>

                </tbody>
              </table>

              <div class="modal-footer">

              </div>
            </div>
          </div>
        </div>
      </div>

       <!-- MODAL FUNDAMENTAL -->

       <div class="modal fade" id="modalFundamental" tabindex="-1" role="dialog"
       aria-labelledby="modalInfantilFundamentalTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLongTitle">ENSINO FUNDAMENTAL -
               <?php echo totalFundamental(); ?></h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">

             <table class="table table-hover table-bordered">
               <thead class="table table-dark">
                 <tr>
                   <th>
                     <center>Unidade Escolar
                   </th>
                   <th>
                     <center>Informações
                   </th>
                 </tr>
               </thead>
               <tbody>
                 <?php $counter1=-1;  if( isset($educacaoFundamental) && ( is_array($educacaoFundamental) || $educacaoFundamental instanceof Traversable ) && sizeof($educacaoFundamental) ) foreach( $educacaoFundamental as $key1 => $value1 ){ $counter1++; ?>

                 <tr>

                   <td>
                     <center> <?php echo $value1["sigla"]; ?>


                   </td>

                   <td>
                     <center><a href="/usuario/unidade/informacoes/<?php echo $value1["id_unidade"]; ?>" class="btn btn-primary btn-sm ">
                    <i class="fas fa-eye" aria-hidden="true"></i>
                    <b> Verificar</b></a>

                   </td>

                 </tr>
                 <?php } ?>

               </tbody>
             </table>

             <div class="modal-footer">

             </div>
           </div>
         </div>
       </div>
     </div>

      <!-- MODAL FUNDAMENTAL E MEDIO -->

      <div class="modal fade" id="modalFundamentalMedio" tabindex="-1" role="dialog"
      aria-labelledby="modalFundamentalMedioTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">ENSINO FUNDAMENTAL E MÉDIO -
              <?php echo totalFundamentalMedio(); ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <table class="table table-hover table-bordered">
              <thead class="table table-dark">
                <tr>
                  <th>
                    <center>Unidade Escolar
                  </th>
                  <th>
                    <center>Informações
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php $counter1=-1;  if( isset($educacaoFundamentalMedio) && ( is_array($educacaoFundamentalMedio) || $educacaoFundamentalMedio instanceof Traversable ) && sizeof($educacaoFundamentalMedio) ) foreach( $educacaoFundamentalMedio as $key1 => $value1 ){ $counter1++; ?>

                <tr>

                  <td>
                    <center> <?php echo $value1["sigla"]; ?>


                  </td>

                  <td>
                    <center><a href="/usuario/unidade/informacoes/<?php echo $value1["id_unidade"]; ?>" class="btn btn-primary btn-sm ">
                    <i class="fas fa-eye" aria-hidden="true"></i>
                    <b> Verificar</b></a>

                  </td>

                </tr>
                <?php } ?>

              </tbody>
            </table>

            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL  MEDIO -->

      <div class="modal fade" id="modalMedio" tabindex="-1" role="dialog"
      aria-labelledby="modalMedioTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">ENSINO MÉDIO -
              <?php echo totalMedio(); ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <table class="table table-hover table-bordered">
              <thead class="table table-dark">
                <tr>
                  <th>
                    <center>Unidade Escolar
                  </th>
                  <th>
                    <center>Informações
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php $counter1=-1;  if( isset($educacaoMedio) && ( is_array($educacaoMedio) || $educacaoMedio instanceof Traversable ) && sizeof($educacaoMedio) ) foreach( $educacaoMedio as $key1 => $value1 ){ $counter1++; ?>

                <tr>

                  <td>
                    <center> <?php echo $value1["sigla"]; ?>


                  </td>

                  <td>
                    <center><a href="/usuario/unidade/informacoes/<?php echo $value1["id_unidade"]; ?>" class="btn btn-primary btn-sm ">
                    <i class="fas fa-eye" aria-hidden="true"></i>
                    <b> Verificar</b></a>

                  </td>

                </tr>
                <?php } ?>

              </tbody>
            </table>

            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>
    </div>

     <!-- MODAL DIRETORES -->
      <div class="modal fade" id="modalDiretores" tabindex="-1" role="dialog"
        aria-labelledby="modalDiretores" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">DIRETORES(AS) - <?php echo totalDiretores(); ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <table class="table table-hover table-bordered">
                <thead class="table table-dark">
                  <tr>
                    <th>
                      <center>Servidores(as)
                    </th>
                    <th>
                      <center>Unidade Escolar
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($diretores) && ( is_array($diretores) || $diretores instanceof Traversable ) && sizeof($diretores) ) foreach( $diretores as $key1 => $value1 ){ $counter1++; ?>

                  <tr>

                    <td>
                      <center> <?php echo $value1["diretor"]; ?>


                    </td>

                    <td>
                      <center><?php echo $value1["sigla"]; ?>


                    </td>

                  </tr>
                  <?php } ?>

                </tbody>
              </table>

              <div class="modal-footer">

              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- MODAL VICE DIRETORES -->
      <div class="modal fade" id="modalViceDiretores" tabindex="-1" role="dialog"
        aria-labelledby="modalViceDiretores" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">VICE DIRETORES(AS) - <?php echo totalViceDiretores(); ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <table class="table table-hover table-bordered">
                <thead class="table table-dark">
                  <tr>
                    <th>
                      <center>Servidores(as)
                    </th>
                    <th>
                      <center>Unidade Escolar
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($viceDiretores) && ( is_array($viceDiretores) || $viceDiretores instanceof Traversable ) && sizeof($viceDiretores) ) foreach( $viceDiretores as $key1 => $value1 ){ $counter1++; ?>

                  <tr>

                    <td>
                      <center> <?php echo $value1["vice_diretor"]; ?>


                    </td>

                    <td>
                      <center><?php echo $value1["sigla"]; ?>


                    </td>

                  </tr>
                  <?php } ?>

                </tbody>
              </table>

              <div class="modal-footer">

              </div>
            </div>
          </div>
        </div>
      </div>

       <!-- MODAL SUPERVISORES -->
      <div class="modal fade" id="modalSupervisores" tabindex="-1" role="dialog"
        aria-labelledby="modalViceDiretores" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">SUPERVISORES(AS) - <?php echo totalSupervisores(); ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <table class="table table-hover table-bordered">
                <thead class="table table-dark">
                  <tr>
                    <th>
                      <center>Servidores(as)
                    </th>
                    <th>
                      <center>Unidade Escolar
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($supervisores) && ( is_array($supervisores) || $supervisores instanceof Traversable ) && sizeof($supervisores) ) foreach( $supervisores as $key1 => $value1 ){ $counter1++; ?>

                  <tr>

                    <td>
                      <center> <?php echo $value1["supervisor"]; ?>


                    </td>

                    <td>
                      <center><?php echo $value1["sigla"]; ?>


                    </td>

                  </tr>
                  <?php } ?>

                </tbody>
              </table>

              <div class="modal-footer">

              </div>
            </div>
          </div>
        </div>
      </div>


       <!-- MODAL SUPERVISORES -->
      <div class="modal fade" id="modalSupervisores" tabindex="-1" role="dialog"
        aria-labelledby="modalViceDiretores" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">SUPERVISORES(AS) - <?php echo totalSupervisores(); ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <table class="table table-hover table-bordered">
                <thead class="table table-dark">
                  <tr>
                    <th>
                      <center>Servidores(as)
                    </th>
                    <th>
                      <center>Unidade Escolar
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($supervisores) && ( is_array($supervisores) || $supervisores instanceof Traversable ) && sizeof($supervisores) ) foreach( $supervisores as $key1 => $value1 ){ $counter1++; ?>

                  <tr>

                    <td>
                      <center> <?php echo $value1["supervisor"]; ?>


                    </td>

                    <td>
                      <center><?php echo $value1["sigla"]; ?>


                    </td>

                  </tr>
                  <?php } ?>

                </tbody>
              </table>

              <div class="modal-footer">

              </div>
            </div>
          </div>
        </div>
      </div>

         <!-- MODAL CHEFE SECRETARIA -->
      <div class="modal fade" id="modalChefeSecretaria" tabindex="-1" role="dialog"
        aria-labelledby="modalChefeSecretariaTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">CHEFE SECRETARIA - <?php echo totalChefeSecretaria(); ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <table class="table table-hover table-bordered">
                <thead class="table table-dark">
                  <tr>
                    <th>
                      <center>Servidores(as)
                    </th>
                    <th>
                      <center>Unidade Escolar
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($chefeSecretaria) && ( is_array($chefeSecretaria) || $chefeSecretaria instanceof Traversable ) && sizeof($chefeSecretaria) ) foreach( $chefeSecretaria as $key1 => $value1 ){ $counter1++; ?>

                  <tr>

                    <td>
                      <center> <?php echo $value1["chefe_secretaria"]; ?>


                    </td>

                    <td>
                      <center><?php echo $value1["sigla"]; ?>


                    </td>

                  </tr>
                  <?php } ?>

                </tbody>
              </table>

              <div class="modal-footer">

              </div>
            </div>
          </div>
        </div>
      </div>


       <!-- MODAL COORDENADORES PEDAGOGICOS -->
      <div class="modal fade" id="modalCoordenadorPedagogico" tabindex="-1" role="dialog"
        aria-labelledby="modalViceDiretores" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">COORDENADORES(AS) - <?php echo totalCoordenadores(); ?></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <table class="table table-hover table-bordered">
                <thead class="table table-dark">
                  <tr>
                    <th>
                      <center>Servidores(as)
                    </th>
                    <th>
                      <center>Unidade Escolar
                    </th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($coordenadoresPedagogicos) && ( is_array($coordenadoresPedagogicos) || $coordenadoresPedagogicos instanceof Traversable ) && sizeof($coordenadoresPedagogicos) ) foreach( $coordenadoresPedagogicos as $key1 => $value1 ){ $counter1++; ?>

                  <tr>

                    <td>
                      <center> <?php echo $value1["coordenador_pedagogico"]; ?>


                    </td>

                    <td>
                      <center><?php echo $value1["sigla"]; ?>


                    </td>

                  </tr>
                  <?php } ?>

                </tbody>
              </table>

              <div class="modal-footer">

              </div>
            </div>
          </div>
        </div>
      </div>
     



    </div>
  </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


<script>
  //GRÁFICO ITINERARIOS

  var xValues = [
    <?php $counter1=-1;  if( isset($itinerarios) && ( is_array($itinerarios) || $itinerarios instanceof Traversable ) && sizeof($itinerarios) ) foreach( $itinerarios as $key1 => $value1 ){ $counter1++; ?>"<?php echo $value1["nome_itinerario"]; ?>", <?php } ?>

    ];

  var yValues = [
    <?php $counter1=-1;  if( isset($itinerarios) && ( is_array($itinerarios) || $itinerarios instanceof Traversable ) && sizeof($itinerarios) ) foreach( $itinerarios as $key1 => $value1 ){ $counter1++; ?><?php echo $value1["valor_total"]; ?>, <?php } ?>

    ];




  var barColors = "rgba(255,0,0,0.6)";

  new Chart("itinerarios", {
    type: "horizontalBar",

    data: {

      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: "Itinerários X Valores"
      },
      scales: {
        xAxes: [{
          display: true,
          ticks: {
            beginAtZero: true,
            min: 0,
            stepSize: 10
          },
          scaleLabel: {
            display: true,
            labelString: "Valor total diário em R$",
            fontColor: "black"
          }
        }],
        yAxes: [{
          gridLines: {

            borderDash: [2, 5],
          },
          scaleLabel: {
            display: true,
            labelString: "Itinerários",
            fontColor: "black"
          }
        }]

      }
    }


  });
</script>

<script>
  //GRÁFICO UNIDADES
  var xValues = ["Educação Infantil", "Educação Infantil  e Ensino Fundamental", "Ensino Fundamental", "Ensino Fundamental e Médio", "Ensino Médio"];
  var yValues = ['<?php echo totalInfantil(); ?>', '<?php echo totalInfantilFundamental(); ?>', '<?php echo totalFundamental(); ?>',
    '<?php echo totalFundamentalMedio(); ?>', '<?php echo totalMedio(); ?>'];
  var barColors = ["green", "red", "blue", "orange", "gray"];

  new Chart("unidades", {
    type: "doughnut",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      legend: { display: true },
      title: {
        display: true,
        text: "Totais de etapas de ensino"
      },

    }

  });
</script>

<script>
  //GRÁFICO UNIDADES TURMAS


  var xValues = [
    <?php $counter1=-1;  if( isset($unidades) && ( is_array($unidades) || $unidades instanceof Traversable ) && sizeof($unidades) ) foreach( $unidades as $key1 => $value1 ){ $counter1++; ?>"<?php echo $value1["sigla"]; ?>", <?php } ?>

    ];

  var yValues = [
    <?php $counter1=-1;  if( isset($unidades) && ( is_array($unidades) || $unidades instanceof Traversable ) && sizeof($unidades) ) foreach( $unidades as $key1 => $value1 ){ $counter1++; ?><?php echo $value1["qtd_turmas"]; ?>, <?php } ?>

    ];




  var barColors = "rgba(39,88,245,0.6)";

  new Chart("unidadesTurmas", {
    type: "horizontalBar",

    data: {

      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: "Unidades Escolares x Turmas"
      },
      scales: {
        xAxes: [{
          display: true,
          ticks: {
            beginAtZero: true,
            min: 0,
            stepSize: 10
          },
          scaleLabel: {
            display: true,
            labelString: "Total de Turmas",
            fontColor: "black"
          }
        }],
        yAxes: [{
          gridLines: {

            borderDash: [2, 5],
          },
          scaleLabel: {
            display: true,
            labelString: "Unidades Escolares",
            fontColor: "black"
          }
        }]

      }
    }


  });
</script>

<script>
  //GRÁFICO UNIDADES GESTORES E COORDENARDORES
  var xValues = ["Diretores", "Vice-Diretores", "Supervisores", "Chefe de Secretaria", "Coordenadores Pedagógicos"];
  var yValues = ['<?php echo totalDiretores(); ?>', '<?php echo totalViceDiretores(); ?>', '<?php echo totalSupervisores(); ?>', '<?php echo totalChefeSecretaria(); ?>', '<?php echo totalCoordenadores(); ?>'];
  var barColors = ["green", "red", "blue", "orange", "gray"];

  new Chart("unidadesGestores", {
    type: "pie",
    data: {
      labels: xValues,
      datasets: [{
        backgroundColor: barColors,
        data: yValues
      }]
    },
    options: {
      legend: { display: true },
      title: {
        display: true,
        text: "Totais de Gestores e Coordenadores Pedagógicos"
      },

    }

  });
</script>