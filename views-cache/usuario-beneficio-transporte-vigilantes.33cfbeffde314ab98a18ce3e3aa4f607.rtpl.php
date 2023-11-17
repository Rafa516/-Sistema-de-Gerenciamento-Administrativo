<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="content-inside">
    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
            role="tab" aria-controls="home" aria-selected="false"><b>Auxílio Transporte Vigilantes -
              <?php if( $total == 0 ){ ?>
              Nenhum Registrado
              <?php }elseif( $total == 1 ){ ?>
              <?php echo $total; ?> Registrado
              <?php }else{ ?>
              <?php echo $total; ?> Registrados
              <?php } ?></b></a>

        </li>

      </ul>



      <a data-toggle="modal" data-target="#modalCadastrarBeneficio" style="width: 20%;" href="/usuario/beneficio/transporte-efetivos"
        class="btn btn-primary btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i><b> Cadastrar
          Benefício</b></a>

       <a href="/usuario/beneficio/transporte-efetivos" class="btn btn-info btn-sm"><i class="fas fa-users"></i><b> Transporte Efetivos</b></a>

       <button class="btn btn-success  btn-sm" onclick="tableToExcel('Transporte_Vigilantes.xls', '#tblExport')">
            <i class="fas fa-file-excel"></i><b> Exportar Excel</b></button>
          <a id="link-to-download" style="display: none;"></a>

    <!--   <a href="/usuario/beneficio/alimentacao" class="btn btn-info btn-sm"><i class="fas fa-bread-slice"></i><b> Auxílio
          Alimentação</b></a>
 -->
      <?php if( $total > 0 ){ ?>
      <div class="search" style="float: right">
        <form action="/usuario/beneficio/transporte-vigilantes" method="get">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Digite sua pesquisa...">
            <span class="input-group-btn">
              <button class="btn btn" style="background-color: #2E9AFE;color: white" type="submit" id="search-btn"><i
                  class="fa fa-search" style="font-size:13px;"> PESQUISAR</i>
              </button>
            </span>
          </div>
        </form>
      </div><br><br>

      <?php if( $profileMsg != '' ){ ?>
      <div class="alert alert-success">
        <b><?php echo $profileMsg; ?></b>
      </div>
      <?php } ?>


      <div id="tblExport" class="table-responsive">
        <table class=" table table-hover table-sm  table-bordered">
          <thead class="table table-dark">
            <tr style="font-size: 16px; font-weight: bold; ">





              <th>
                <center>Nome
              </th>

              <th>
                <center>Matrícula
              </th>
              <th>
                <center>Unidade
              </th>
              <th>
                <center>Carreira
              </th>
              <th>
                <center>Folha
              </th>
              <th>
                <center>Situação
              </th>
              <th class="remover">
                <center >Visualizar
              </th>
              <th class="remover">
                <center>Excluir
              </th>


            </tr>
          </thead>
          <tbody>
            <?php $counter1=-1;  if( isset($beneficios) && ( is_array($beneficios) || $beneficios instanceof Traversable ) && sizeof($beneficios) ) foreach( $beneficios as $key1 => $value1 ){ $counter1++; ?>
            <tr style="font-size: 15px;font-weight: normal;">

              <td>
                <center><?php echo $value1["nome_servidor"]; ?>
              </td>
              <td>
                <center><?php echo $value1["matricula"]; ?>
              </td>
              <td>
                <center><?php echo $value1["sigla"]; ?>
              </td>
              <td>
                <center><?php echo $value1["carreira"]; ?>
              </td>

              <td>
                <center><?php echo $value1["mes"]; ?>/<?php echo $value1["ano"]; ?>
              </td>

              <td>
                <?php if( $value1["situacao"] == 'Incluído no Sistema' ){ ?>
                <b style="color: green;">
                  <center><?php echo $value1["situacao"]; ?>
                </b>
                <?php }elseif( $value1["situacao"] == 'Incluído no Sistema e REPAG Efetuado' ){ ?>
                <b style="color: green;"><center><?php echo $value1["situacao"]; ?></b>
                <?php }elseif( $value1["situacao"] == 'Falta Incluir no Sistema' ){ ?>
                <b style="color: red;">
                  <center><?php echo $value1["situacao"]; ?>
                </b>
                <?php }elseif( $value1["situacao"] == 'Ajustar Benefício' ){ ?>
                <b style="color: orange;">
                  <center><?php echo $value1["situacao"]; ?>
                </b>

                <?php }elseif( $value1["situacao"] == 'Incluído no Sistema e Solicitar REPAG' ){ ?>
                <b style="color: orange;"><center><?php echo $value1["situacao"]; ?></b>
                <?php }else{ ?>
                <b style="color: blue;">
                  <center><?php echo $value1["situacao"]; ?>
                </b>
                <?php } ?>
              </td>


              <td>
                <center> <a href="/usuario/transporte-efetivo-visualizar/<?php echo $value1["id_beneficio_efetivo"]; ?>"
                    class="btn btn-primary btn-sm"><i class="fas fa-eye" aria-hidden="true"></i><b></b></a>
              </td>

              <td>
                <center>
                  <button
                    onclick="deletar('<?php echo $value1["id_beneficio_efetivo"]; ?>','<?php echo $value1["nome_servidor"]; ?>','/usuario/beneficio-transporte-vigilantes/delete/<?php echo $value1["id_beneficio_efetivo"]; ?>,<?php echo $usuario["nome_user"]; ?>','Excluir Transporte')"
                    class="btn btn-danger btn-sm">
                    <i class="fas fa-trash-alt"></i>
                    <b></b></button>
              </td>


            </tr>

            <?php } ?>

          </tbody>

        </table><br>

      </div>



      <center>
        <div class="box-footer clearfix">
          <ul class="pagination">
            <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>
            <?php if( $pages == $value1["link"] ){ ?>
            <li> <a class="active" href="<?php echo $value1["link"]; ?>"><?php echo $value1["page"]; ?></a></li>
            <?php }else{ ?>
            <li><a href="<?php echo $value1["link"]; ?>"><?php echo $value1["page"]; ?></a></li>
            <?php } ?>
            <?php } ?>
        </div>
      </center>

      <?php } ?>


      <br><br><a href="javascript:history.back()" class="btn btn-info btn-xs"><i
          class="fas fa-chevron-circle-left"></i><b>
          Voltar</b></a>


      <hr class="my-4" />

    </div>


  </div>

</div>


<!-- MODAL CADASTRAR BENEFICIO -->
<div class="modal fade" id="modalCadastrarBeneficio" tabindex="-1" role="dialog" aria-labelledby="modalCadastrarBeneficioTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cadastrar Auxílio Transporte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-group" name="form_repag" action="/usuario/registrar-transporte-efetivo/enviar" method="post">

          <input type="hidden" name="beneficio" value="Auxílio Transporte">
          <input  value="<?php echo $usuario["id_usuario"]; ?>" name="id_usuario" type="hidden">

          <label>Servidor - Matrícula - Carreira - Unidade</label>
          <select class="form-control py-1" name="id_efetivo" required  style="width: 75%;display: inline-block">
            <option value="">
              <?php $counter1=-1;  if( isset($efetivos) && ( is_array($efetivos) || $efetivos instanceof Traversable ) && sizeof($efetivos) ) foreach( $efetivos as $key1 => $value1 ){ $counter1++; ?>
            <option value="<?php echo $value1["id_efetivo"]; ?>"><?php echo $value1["nome_servidor"]; ?> - <?php echo $value1["matricula"]; ?> - <?php echo $value1["carreira"]; ?> -
              <?php echo $value1["sigla"]; ?> </option>
            <?php } ?>
          </select>

          <button style="margin-left:3%;" type="button" class="btn btn-primary" data-toggle="modal"
              data-target="#modalEfetivos" id="buttonsUtilidade"><b>
                <i class="fa fa-user"></i> Cadastrar Efetivo</b>
            </button><br>

          <label>Localidade</label> <select class="form-control py-1"  name="id_itinerarios" required>
            <option value="" ></option>
            <?php $counter1=-1;  if( isset($itinerarios) && ( is_array($itinerarios) || $itinerarios instanceof Traversable ) && sizeof($itinerarios) ) foreach( $itinerarios as $key1 => $value1 ){ $counter1++; ?>
            <option value="<?php echo $value1["id_itinerarios"]; ?>"><?php echo $value1["nome_itinerario"]; ?> 
            </option>

            <?php } ?>
          </select>

          <label>Mês</label> <select class="form-control py-1" id="mes" name="mes" required>
            <option value=""></option>
            <option value="01 - Janeiro">01 - Janeiro</option>
            <option value="02 - Fevereiro">02 - Fevereiro</option>
            <option value="03 - Março">03 - Março</option>
            <option value="04 - Abril">04 - Abril</option>
            <option value="05 - Maio">05 - Maio</option>
            <option value="06 - Junho">06 - Junho</option>
            <option value="07 - Julho">07 - Julho</option>
            <option value="08 - Agosto">08 - Agosto</option>
            <option value="09 - Setembro">09 - Setembro</option>
            <option value="10 - Outubro">10 - Outubro</option>
            <option value="11 - Novembro">11 - Novembro</option>
            <option value="12 - Dezembro">12 - Dezembro</option>

          </select>

          <label>Ano</label> <select class="form-control py-1"  name="ano" required>
            <option value=""></option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2026">2027</option>
          </select>

          <label>Processo SEI</label><input name="processo" type="text"
          class="form-control py-1" >

          <label>Data Processo</label><input name="data_processo" type="date"
          class="form-control py-1" >

          <label>Situação</label> <select class="form-control py-1" id="situacao" name="situacao" required>
            <option value=""></option>
            <option value="Incluído no Sistema e Solicitar REPAG">Incluído no Sistema e Solicitar REPAG</option>
            <option value="Incluído no Sistema">Incluído no Sistema</option>
            <option value="Falta Incluir no Sistema">Falta Incluir no Sistema</option>
            <option value="Ajustar Benefício">Ajustar Benefício</option>
          </select>

          <label>Referência</label> <select class="form-control py-1" id="referencia" name="referencia" required>
            <option value=""></option>
             <option value="Efetivos">Efetivos</option>
            <option value="Vigilantes">Vigilantes</option>
          </select>

        


          
          



      </div>
      <div class="modal-footer">
        <input class="btn btn-primary" type="submit" value="Cadastrar">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>

        </form>

      </div>
    </div>
  </div>
</div>

<!-- MODAL CADASTRAR NOVO SERVIDOR EFETIVO -->
<div class="modal fade" id="modalEfetivos" tabindex="-1" role="dialog" aria-labelledby="modalEfetivosTitle"
  aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Cadastrar Servidor Efetivo</h5>
        <button onclick="atualizar()" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form class="form-group" action="/usuario/registrar-efetivos-modal/enviar" method="post">



          <div class="form-group"><label class="small mb-1"><b>Nome</b></label>
            <input class="form-control py-1" type="text" name="nome_servidor" required />
          </div>

          <div class="form-group"><label class="small mb-1"><b>Matrícula</b></label>
            <input class="form-control py-1" type="text" name="matricula" />
          </div>

          <div class="form-group"><label class="small mb-1"><b>Carreira</b></label>
            <select class="form-control py-1" name="carreira">
                  <option value=""></option>
                  <option value="Magistério">Magistério</option>
                  <option value="Assistência">Assistência</option>
            </select>
          </div>

          <div class="form-group"><label class="small mb-1"><b>Unidade</b></label>
            <select class="form-control py-1" id="" name="id_unidade" required>
            <option value=""></option>
            <?php $counter1=-1;  if( isset($unidades) && ( is_array($unidades) || $unidades instanceof Traversable ) && sizeof($unidades) ) foreach( $unidades as $key1 => $value1 ){ $counter1++; ?>
            <option value="<?php echo $value1["id_unidade"]; ?>"><?php echo $value1["sigla"]; ?> - <?php echo $value1["nome"]; ?> 
            </option>
            <?php } ?>
            </select>
          </div>


          <input class="btn btn-primary btn btn-block" type="submit" value="Enviar">
        </form>


        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>
</div>

<script>
  //FUNÇÃO PARA REALIZAR OS CALCULOS DO REPAG
  function calcularRepag() {
    let dias = document.form_repag.dias.value;
    let valor_itinerario = document.form_repag.itinerarios.value;
    let jus = dias * valor_itinerario;
    let valor_recebido = document.form_repag.vr_recebido.value;
    let vencimento = document.form_repag.vencimento_b.value;
    let custeio = vencimento * 0.06;
    let receber = jus.toFixed(2) - valor_recebido - custeio;
    let devolver = valor_recebido - jus.toFixed(2) - custeio;



    document.getElementById('jus_b').innerText = jus.toFixed(2).replace(".", ",");
    document.getElementById('jus_beneficio').value = jus.toFixed(2);

    document.getElementById('valorRecebido').innerText = valor_recebido.replace(".", ",");
    if (valor_recebido > 0) {
      document.getElementById('vr_beneficio').value = valor_recebido.replace(".", ",");
    }

    document.getElementById('custeio_b').innerText = custeio.toFixed(2).replace(".", ",");
    document.getElementById('custeio_beneficio').value = custeio.toFixed(2);

   
   

    if (jus > valor_recebido) {
      document.getElementById('receber_b').innerText = receber.toFixed(2).replace(".", ",");
      document.getElementById('receber_beneficio').value = receber.toFixed(2);
    }
    if (jus < valor_recebido) {
      document.getElementById('devolver_b').innerText = devolver.toFixed(2).replace(".", ",");
      document.getElementById('devolver_beneficio').value = devolver.toFixed(2);
    }
    if (jus > valor_recebido && custeio > jus) {
      document.getElementById('receber_b').innerText = "0,00"
    }


  }
  // FUNÇÃO PARA LIMPAR TODOS OS DADOS
  function limparDados() {

    document.getElementById('jus_b').innerText = "";
    document.getElementById('valorRecebido').innerText = "";
    document.getElementById('custeio_b').innerText = "";
    document.getElementById('receber_b').innerText = "";
    document.getElementById('devolver_b').innerText = "";
    document.form_repag.dias.value = "";
    document.form_repag.itinerarios.value = "";
    document.form_repag.valor_recebido.value = "";
    document.form_repag.vencimento.value = "";
  }


</script>




<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script type="text/javascript">


  $(".js-example-basic-single").select2({

  });

</script>
<script type="text/javascript">
  

const tableToExcel = (nome, table) => {
    let mimetype = 'application/vnd.ms-excel';
    let link = document.querySelector('#link-to-download');
    let tabela = document.querySelector(table);
    let clone = tabela.cloneNode(true);
    let remover = clone.querySelectorAll('.remover');

    remover.forEach((td) => {
        if (td.parentElement) {
            td.parentElement.removeChild(td);
        }
    });

    
    link.href = window.URL.createObjectURL(new Blob(['\ufeff'+clone.outerHTML], {
        type: mimetype
    }));
    link.download = nome;
    link.click();
};

</script>
