<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="content-inside">
    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
            role="tab" aria-controls="home" aria-selected="false"><b>Utilidades</b></a>
        </li>
      </ul>



    <center><img src="../res/user/img/logo.png" class="logo" alt=""><br><br>

     <div class="btn-group" role="group">
      
      <a href="" class="btn btn-primary" data-toggle="modal"
        data-target="#modalEfetivos"><i class="fas fa-users" ></i><span> Efetivos</span></a> 

      <a href="" class="btn btn-primary" data-toggle="modal"
        data-target="#modalTemporarios"><i class="fas fa-users" ></i><span> Contratos Temporários</span></a> 

        <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalComponentes" id="buttonsUtilidade">
          <i class="fas fa-book-open"></i> Componentes
        </button>

       
      

     </div><br><br>
     <div class="btn-group" role="group">

      <a href="/admin/todas-anotacoes" class="btn btn-primary  "><i class="far fa-clipboard"></i> Todas
        anotações</a>

        <button class="btn btn-primary" data-toggle="modal"
        data-target="#modalParametrosTransporte"><i class="fas fa-file-invoice-dollar"></i> Parâmetros Auxílio Transporte</button>

        <a href="/admin/todos-documentos" class="btn btn-primary" ><i class="fas fa-file" ></i><span> Documentos </span></a>


        

      </div>
      </center>


      <!-- MODAL CALCULOS TRANSPORTE -->
      <div class="modal fade" id="modalParametrosTransporte" tabindex="-1" role="dialog"
        aria-labelledby="modalParametrosTrasnporteTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Parâmetros Para Incluir o Auxílio Transporte</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <center>
              
              
                <button class="btn btn-primary btn-sm" data-toggle="modal"
              data-target="#modalCalcularRepag"><i class="fas fa-money-bill-alt"></i> Calcular REPAG</button>

              <a href="/admin/todos-itinerarios"  class="btn btn-primary btn-sm"><i class="fas fa-bus"></i><span> Itinerários</span></a>

              <a href="/admin/linhas" class="btn btn-primary btn-sm"><i class="fas fa-map-marker-alt"></i><span> Linhas</span></a>
            

                <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCalcularDias"><i class='fas fa-calculator'></i> Calcular dias
               </button>

               <button  type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalLocalidades" id="buttonsUtilidade">
                <i class="fa fa-university"></i> Cidades
              </button>
            
        
             </center>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>

            </div>
          </div>
        </div>
      </div>
    

      <!-- MODAL CALCULAR DIAS -->
      <div class="modal fade" id="modalCalcularDias" tabindex="-1" role="dialog"
        aria-labelledby="modalCalcularDiasTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Calcular dias</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-group" name="form_main">
                <label for="date_ini">Data Inicial </label>
                <input name="date_ini" id="date_ini" type="date" class="form-control py-1" required> <br>
                <label for="date_end">Data Final </label>
                <input name="date_end" id="date_end" type="date" class="form-control py-1" required> <br>

                <label for="days"><b>Total de dias:</b> </label>
                <b style="color:red"><span id="days"></span> <br></b>

              </form>
            </div>
            <div class="modal-footer">
              <button type="button" onclick="contarDias()" class="btn btn-primary">Calcular</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>

            </div>
          </div>
        </div>
      </div>


       <!-- NODAL EFETIVOS -->
       <div class="modal fade" id="modalEfetivos" tabindex="-1" role="dialog"
       aria-labelledby="modalCalcularDiasTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLongTitle">Servidores Efetivos</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
            <center>

              <a href="" class="btn btn-primary btn-sm"><i class="fas fa-address-card"></i><span> Dossiê</span></a>

              <a href="/admin/todos-efetivos" class="btn btn-primary btn-sm"><i class="fas fa-users"></i> Servidores</a>

               <!-- <a href="" class="btn btn-primary btn-sm"><i class="fas fa-tasks"></i> Avaliações</a> -->

              <!-- <a href="" class="btn btn-primary btn-sm"><i class="fas fa-bread-slice"></i><span> Auxílio Alimentação</span></a>  -->

              <a href="/admin/beneficio/transporte-efetivos" class="btn btn-primary btn-sm"><i class="fas fa-bus"></i><span> Auxílio Transporte</span></a>
              <!-- <a href="" class="btn btn-primary btn-sm"><i class="fas fa-money-bill-alt"></i><span> Pagamentos</span></a> -->
       
            </center>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>

           </div>
         </div>
       </div>
     </div>

 <!-- NODAL TEMPORARIOS -->
      <div class="modal fade" id="modalTemporarios" tabindex="-1" role="dialog"
        aria-labelledby="modalCalcularDiasTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Contratatos Temporários</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
             <center>

               <a href="/admin/todos-dossiers-temporarios" class="btn btn-primary btn-sm"><i class="fas fa-address-card"></i><span> Dossiê</span></a>

               <a href="/admin/todos-temporarios" class="btn btn-primary btn-sm"><i class="fas fa-users"></i> Contratos</a>

                <a href="/admin/avaliacoes" class="btn btn-primary btn-sm"><i class="fas fa-tasks"></i> Avaliações</a>

               <a href="/admin/beneficio/alimentacao" class="btn btn-primary btn-sm"><i class="fas fa-bread-slice"></i><span> Auxílio Alimentação</span></a> 

               <a href="/admin/beneficio/transporte" class="btn btn-primary btn-sm"><i class="fas fa-bus"></i><span> Auxílio Transporte</span></a>
               <a href="/admin/pagamentos-temporarios" class="btn btn-primary btn-sm"><i class="fas fa-money-bill-alt"></i><span> Pagamentos</span></a>
        
             </center>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>

            </div>
          </div>
        </div>
      </div>

     


      <!-- MODAL CALCULAR REPAG -->
      <div class="modal fade" id="modalCalcularRepag" tabindex="-1" role="dialog"
        aria-labelledby="modalCalcularRepagTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Calcular <b>REPAG</b> Auxílio Transporte</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="form-group" name="form_repag">
                <label>Itinerário</label> <select class="form-control py-1" id="itinerarios" name="itinerarios">
                  <option value=""></option>
                  <?php $counter1=-1;  if( isset($itinerarios) && ( is_array($itinerarios) || $itinerarios instanceof Traversable ) && sizeof($itinerarios) ) foreach( $itinerarios as $key1 => $value1 ){ $counter1++; ?>
                  <option value="<?php echo $value1["valor_total"]; ?>"><?php echo $value1["nome_itinerario"]; ?> - R$ <?php echo formatValor($value1["valor_total"]); ?>
                  </option>

                  <?php } ?>
                </select>

                <label>Dias Trabalhados</label><input min="0" max="31" name="dias" id="dias" type="number"
                  class="form-control py-1" required>

                <label>Valor Recebido R$</label><input min="0" max="10000" step=".01" type="number"
                  name="valor_recebido" id="valor_recebido" class="form-control py-1">

                <label>Vencimento R$</label><input min="0" max="10000" step=".01" type="number" name="vencimento"
                  id="vencimento" class="form-control py-1">
              </form>

              <div class="table-responsive">
                <table class="table table-hover table-bordered">
                  <thead style="background-color:#D3D3D3">
                    <th>
                      <center><button type="button" class="btn btn-secondary  btn-sm" data-toggle="tooltip"
                          data-placement="top" title="Dias trabalhados * valor total diário do Itinerário" disabled>
                          Jus
                        </button>
                    </th>
                    <th>
                      <center><button type="button" class="btn btn-secondary  btn-sm" data-toggle="tooltip"
                          data-placement="top"
                          title="Caso haja algum valor já lançado na folha referente ao benefício, adicione-o" disabled>
                          Recebeu
                        </button>
                    </th>
                    <th>
                      <center><button type="button" class="btn btn-secondary  btn-sm" data-toggle="tooltip"
                          data-placement="top" title="Vencimento (Salário) * 6% (0,06), 6% em cima do Salário ou Vencimento, vale lembrar se o Custeio for maior que o Jus 
                    não terá valor pra receber, o sistema SIGRH automaticamente não lança." disabled>
                          Custeio
                        </button>
                    </th>
                    <th>
                      <center><button type="button" class="btn btn-primary  btn-sm" data-toggle="tooltip"
                          data-placement="top" title="Jus - Recebeu - Custeio" disabled>
                          Receber
                        </button>
                    </th>
                    <th>
                      <center><button type="button" class="btn btn-danger  btn-sm" data-toggle="tooltip"
                          data-placement="top" title="Recebeu - Jus - Custeio" disabled>
                          Devolver
                        </button>
                    </th>

                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td><span id="jus"></span></td>
                      <td><span id="valorRecebido"></span> </td>
                      <td><span id="custeio"></span></td>
                      <td><b><span id="receber"></b></span></td>
                      <td><b><span id="devolver"></b></span></td>

                    </tr>

                  </tbody>

                </table>
              </div>



            </div>
            <div class="modal-footer">
              <button type="button" onclick="calcularRepag()" class="btn btn-primary">Calcular</button>
              <button type="button" onclick="limparDados()" class="btn btn-warning">Limpar Dados</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>

            </div>
          </div>
        </div>
      </div>


       <!-- MODAL COMPONENTES -->
       <div class="modal fade" id="modalComponentes" tabindex="-1" role="dialog"
       aria-labelledby="modalComponentesTitle" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLongTitle">Componentes</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">

            <form class="form-group" action="/admin/cadastrar-componente/registro" method="post">
                <label class="small mb-1"><b>Novo Componente</b></label>
                <div id="form_componente" class="input-group mb-3">
                  <div class="input-group-prepend">
                      <button class="btn btn-primary " onclick="adicionarCampo_componente()" type="button"><i class="fa fa-plus-circle"
                    aria-hidden="true"></i></button>
                  </div>
                  <input type="text" class="form-control" name="componente[]" >
                </div>
                <input class="btn btn-primary btn btn-block" type="submit" value="Enviar">
            </form><br>
         
             <table class="table table-hover table-bordered">
               <thead class="table table-dark">
                 <tr>
                   <th>
                     <center>Componente
                   </th>
                   <th>
                     <center>Excluir
                   </th>
                 </tr>
               </thead>
               <tbody>
                <?php $counter1=-1;  if( isset($componentes) && ( is_array($componentes) || $componentes instanceof Traversable ) && sizeof($componentes) ) foreach( $componentes as $key1 => $value1 ){ $counter1++; ?>
                 <tr>

                   <td>
                     <center><?php echo $value1["componente"]; ?>

                   </td>

                   <td>
                     <center> <button
                    onclick="deletar('<?php echo $value1["id_componente"]; ?>','<?php echo $value1["componente"]; ?>','/admin/componente/delete/<?php echo $value1["id_componente"]; ?>','Excluir Componente')"
                    class="btn btn-danger btn-sm">
                    <i class="fas fa-trash-alt"></i>
                    <b></b></button>

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

      <!-- MODAL LOCALIDADES -->
      <div class="modal fade" id="modalLocalidades" tabindex="-1" role="dialog"
      aria-labelledby="modalmodalLocalidadesTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Cidades</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <p></p><b>Cidades:</b> <b style="color: red;"><?php echo totalcidades(); ?></b> que 
            integram a RIDE, as cidades são:</p>

            

           <form class="form-group" action="/admin/cadastrar-cidade/registro" method="post">
               <label class="small mb-1"><b>Nova Cidade</b></label>
               <div id="form_cidade" class="input-group mb-3">
                 <div class="input-group-prepend">
                     <button class="btn btn-primary " onclick="adicionarCampo_cidade()" type="button"><i class="fa fa-plus-circle"
                   aria-hidden="true"></i></button>
                 </div>
                 <input type="text" class="form-control" name="cidade[]" >
               </div>
               <input class="btn btn-primary btn btn-block" type="submit" value="Enviar">
           </form><br>
        
            <table class="table table-hover table-bordered">
              <thead class="table table-dark">
                <tr>
                  <th>
                    <center>Cidade
                  </th>
                  <th>
                    <center>Excluir
                  </th>
                </tr>
              </thead>
              <tbody>
               <?php $counter1=-1;  if( isset($cidades) && ( is_array($cidades) || $cidades instanceof Traversable ) && sizeof($cidades) ) foreach( $cidades as $key1 => $value1 ){ $counter1++; ?>
                <tr>

                  <td>
                    <center><?php echo $value1["cidade"]; ?>

                  </td>

                  <td>
                    <center> <button
                   onclick="deletar('<?php echo $value1["id_cidade"]; ?>','<?php echo $value1["cidade"]; ?>','/admin/cidade/delete/<?php echo $value1["id_cidade"]; ?>','Excluir Cidade')"
                   class="btn btn-danger btn-sm">
                   <i class="fas fa-trash-alt"></i>
                   <b></b></button>

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


      <hr class="my-4" />


    </div>
  </div>
</div>


<script src="/res/user/js/functions.js"></script>
<script>
  const second = 1000;
  const minute = second * 60;
  const hour = minute * 60;
  const day = hour * 24;

  function contarDias() {
    let date_ini = new Date(document.form_main.date_ini.value);
    let date_end = new Date(document.form_main.date_end.value);

    let diff = date_end.getTime() - date_ini.getTime();

    if (diff >= 0) {
      document.getElementById('days').innerText = Math.floor(diff / day);
    }
    else {
      document.getElementById('days').innerText = "Insira uma Data"
    }
  }
</script>

<script>
  //FUNÇÃO PARA REALIZAR OS CALCULOS DO REPAG
  function calcularRepag() {
    let dias = document.form_repag.dias.value;
    let valor_itinerario = document.form_repag.itinerarios.value;
    let jus = dias * valor_itinerario;
    let valor_recebido = document.form_repag.valor_recebido.value;
    let vencimento = document.form_repag.vencimento.value;
    let custeio = vencimento * 0.06;
    let receber = jus.toFixed(2) - valor_recebido - custeio;
    let devolver = valor_recebido - jus.toFixed(2) - custeio;



    document.getElementById('jus').innerText = jus.toFixed(2).replace(".", ",");
    document.getElementById('valorRecebido').innerText = valor_recebido.replace(".", ",");
    document.getElementById('custeio').innerText = custeio.toFixed(2).replace(".", ",");

    if (jus > valor_recebido) {
      document.getElementById('receber').innerText = receber.toFixed(2).replace(".", ",");
    }
    if (jus < valor_recebido) {
      document.getElementById('devolver').innerText = devolver.toFixed(2).replace(".", ",");
    }
    if (jus > valor_recebido && custeio > jus) {
      document.getElementById('receber').innerText = "0,00"
    }


  }
  // FUNÇÃO PARA LIMPAR TODOS OS DADOS
  function limparDados() {

    document.getElementById('jus').innerText = "";
    document.getElementById('valorRecebido').innerText = "";
    document.getElementById('custeio').innerText = "";
    document.getElementById('receber').innerText = "";
    document.getElementById('devolver').innerText = "";
    document.form_repag.dias.value = "";
    document.form_repag.itinerarios.value = "";
    document.form_repag.valor_recebido.value = "";
    document.form_repag.vencimento.value = "";
  }


</script>

<script type="text/javascript">
  var controleCampo = 1;

  function adicionarCampo_componente() {
    controleCampo++;
    // console.log(controleCampo);

    document.getElementById('form_componente').insertAdjacentHTML('beforeend','<div class="input-group mb-3" id="campo' + controleCampo + '"><label class="small mb-1"><b>Novo Componente</b></label><div id="form_componente" class="input-group mb-3"><div class="input-group-prepend"> <button  class="btn btn-danger  type="button" id="' + controleCampo + '" onclick="removerCampo_componente(' + controleCampo + ')"><i class="fa fa-minus-circle" ></i></button></div> <input type="text"  class="form-control " name="componente[]"></div>' );
  }

  function removerCampo_componente(idCampo) {
    //console.log("Campo remover: " + idCampo);
    document.getElementById('campo' + idCampo).remove();
  }

 
</script>

<script type="text/javascript">
  var controleCampo = 1;

  function adicionarCampo_cidade() {
    controleCampo++;
    // console.log(controleCampo);

    document.getElementById('form_cidade').insertAdjacentHTML('beforeend','<div class="input-group mb-3" id="campo' + controleCampo + '"><label class="small mb-1"><b>Nova Cidade</b></label><div id="form_cidade" class="input-group mb-3"><div class="input-group-prepend"> <button  class="btn btn-danger  type="button" id="' + controleCampo + '" onclick="removerCampo_cidade(' + controleCampo + ')"><i class="fa fa-minus-circle" ></i></button></div> <input type="text"  class="form-control " name="cidade[]"></div>' );
  }

  function removerCampo_cidade(idCampo) {
    //console.log("Campo remover: " + idCampo);
    document.getElementById('campo' + idCampo).remove();
  }

 
</script>