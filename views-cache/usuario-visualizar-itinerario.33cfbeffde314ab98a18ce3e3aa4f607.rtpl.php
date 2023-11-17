<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="content-inside">
    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color: #2E9AFE;color: white" class="nav-link
            active" id="home-tab" data-toggle="tab" role="tab" aria-controls="home"
            aria-selected="false"><b><?php echo $value["nome_itinerario"]; ?> </b></a>
        </li>
      </ul>

      <?php if( $profileMsg != '' ){ ?>

      <div class="alert alert-success">
        <b><?php echo $profileMsg; ?></b>
      </div>
      <?php } ?>


      <div id="DivIdToPrint">



        <div class="table-responsive">
          <table class="table  table-bordered">


            <tbody>

              <tr>
                <td>
                  <center><img src="/res/user/img/logo.png" width="150" height="90">
                </td>

                <td><br>
                  <center>
                    <h2>Itinerário<h2>
                </td>

              </tr>



              <table class="table table-hover table-bordered">
                <thead class="table table-dark">


                  <th>
                    <center>Nome
                  </th>
                  <th>
                    <center>Cidade
                  </th>
                  <th>
                    <center>Valor Total
                  </th>




                </thead>

                <td>
                  <center><?php echo $value["nome_itinerario"]; ?>

                </td>
                <td>
                  <center><?php echo $value["cidade"]; ?>

                </td>
                <td>
                  <center>R$ <?php echo formatValor($value["valor_total"]); ?>

                </td>
                <table class="table table-hover table-bordered">
                  <thead class="table table-dark">
                    <b>1. Dados das linhas do Itinerário</b><br><br>
                    <th>
                      <center>Código, Cidade, Valor, Valor Diário
                    </th>

                    </tr>
                  </thead>
                  <tbody>

                    <tr>
                      <td>

                        <?php $counter1=-1;  if( isset($itinerario_linhas) && ( is_array($itinerario_linhas) || $itinerario_linhas instanceof Traversable ) && sizeof($itinerario_linhas) ) foreach( $itinerario_linhas as $key1 => $value1 ){ $counter1++; ?>

                        <button
                          onclick="deletar('<?php echo $value1["id_itinerarios_linhas"]; ?>','<?php echo $value1["cidade_linha"]; ?>','/usuario/delete/itinerario-linha/<?php echo $value1["id_itinerarios_linhas"]; ?>','Excluir Linha deste Itinerario')"
                          class="btn btn-outline-danger btn-sm">
                          <i class="fas fa-trash-alt"></i>
                        </button> <b> Codigo:</b> <?php echo $value1["codigo"]; ?> - <b>Cidade:</b> <?php echo $value1["cidade_linha"]; ?> -
                        <b>Valor:</b> R$ <?php echo $value1["valor"]; ?> - <b>Valor Diário:</b> R$ <?php echo $value1["valor_diario"]; ?> <br>

                        <?php } ?>

                      </td>

                    </tr>

                    <table class="table table-hover table-bordered">
                      <thead class="table table-dark">

                        <b>2. Observações</b><br>
                        <th>
                          <center>Observações em geral
                        </th>

                        </tr>
                      </thead>
                      <tbody>

                        <tr>
                          <td>
                            <?php echo $value["observacoes"]; ?> </td>
                        </tr>


                    </table>
        </div>


      </div>



      <i>Última alteração registrada pelo(a) usuário(a)<b> <?php echo $value["nome_user"]; ?></b> em
        <b><?php echo formatDateHoras($value["dt_registro_itinerario"]); ?>.</b></i><br><br>

      <button data-toggle="modal" data-target="#registerModal" class="btn btn-success btn-sm"><b><i
            class="fas fa-pen"></i>Alterar</b>
      </button>

      <button id='btn' value='Print' onclick='printtag("DivIdToPrint");' class="btn btn-primary btn-sm"
        style="margin-right: 5px;">
        <i class="fa fa-print"></i><b> Imprimir</b>
      </button>




      <hr class="my-4" />

      <a href="/usuario/todos-itinerarios" class="btn btn-info btn-xs"><i class="fas fa-chevron-circle-left"></i><b>
          Voltar</b></a>
    </div>
  </div>
</div>

<!-- Modal cadastro -->
<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="registerModal">Alterar ou Incluir Dados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form class="form-group" action="/usuario/itinerario/editar/<?php echo $value["id_itinerarios"]; ?>" method="post">

          <input class="form-control py-1" value="<?php echo $usuario["id_usuario"]; ?>" name="id_usuario" type="hidden">

          <input class="form-control py-1" value="<?php echo $value["id_itinerarios"]; ?>" name="id_itinerarios" type="hidden">

          <div class="form-group"><label><b>Nome</b></label>
            <input class="form-control py-1" type="text" name="nome_itinerario" value="<?php echo $value["nome_itinerario"]; ?>"
              required />
          </div>

          <label><b>Cidade</b> </label>
          <select class="form-control py-1" name="cidade">
            <option value="<?php echo $value["cidade"]; ?>"><?php echo $value["cidade"]; ?></option>
            <?php $counter1=-1;  if( isset($cidades) && ( is_array($cidades) || $cidades instanceof Traversable ) && sizeof($cidades) ) foreach( $cidades as $key1 => $value1 ){ $counter1++; ?>

            <option value="<?php echo $value1["cidade"]; ?>"><?php echo $value1["cidade"]; ?> </option>
            <?php } ?>

          </select>

          <div id="formulario_linha">

            <label><b>Linha</b> </label>
            <div id="form_componente" class="input-group mb-3">
              <div class="input-group-prepend">
                <select class="form-control py-1" name="id_linha[]">
                  <option value=""></option>
                  <?php $counter1=-1;  if( isset($linhas) && ( is_array($linhas) || $linhas instanceof Traversable ) && sizeof($linhas) ) foreach( $linhas as $key1 => $value1 ){ $counter1++; ?>

                  <option value="<?php echo $value1["id_linha"]; ?>"><?php echo $value1["codigo"]; ?> - <?php echo $value1["cidade_linha"]; ?> - R$
                    <?php echo formatValor($value1["valor"]); ?>

                  </option>

                  <?php } ?>

                </select>
              </div>
              <button class="btn btn-primary btn-sm " type="button" onclick="adicionarCampo_linha()"><i
                  class="fa fa-plus-circle" aria-hidden="true"></i> Adicionar</button>
            </div>
          </div>

          <label><b>Observações</b></label><textarea style="height: 110px;" class="form-control py-1"
            value="observacoes" type="text" name="observacoes"><?php echo $value["observacoes"]; ?> </textarea>
          <br>




          <input class="btn btn-info btn btn-block" type="submit" value="Enviar">


        </form>

      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
  function printtag(tagid) {
    var hashid = "#" + tagid;
    var tagname = $(hashid).prop("tagName").toLowerCase();
    var attributes = "";
    var attrs = document.getElementById(tagid).attributes;
    $.each(attrs, function (i, elem) {
      attributes += " " + elem.name + " ='" + elem.value + "' ";
    })
    var divToPrint = $(hashid).html();
    var head = "<html><head>" + $("head").html() + "</head>";
    var allcontent = head + "<body  onload='window.print()'   >" + "<" + tagname + attributes + ">" + divToPrint + "</" + tagname + ">" + "</body></html>";
    var newWin = window.open('', 'Print-Window');
    newWin.document.open();
    newWin.document.write(allcontent);
    newWin.document.close();
    // setTimeout(function(){newWin.close();},10);
  }
</script>
</div>
</div>
</div>
</div>

</div>





<script type="text/javascript">
  var controleCampo = 1;

  function adicionarCampo_linha() {
    controleCampo++;
    // console.log(controleCampo);

    document.getElementById('formulario_linha').insertAdjacentHTML('beforeend', '<div class="form-group" id="campo' + controleCampo + '"> <label><b>Linha</b> </label>  <div id="form_componente" class="input-group mb-3">  <div class="input-group-prepend">  <select  class="form-control py-1" name="id_linha[]" > <option value=""></option> <?php $counter1=-1;  if( isset($linhas) && ( is_array($linhas) || $linhas instanceof Traversable ) && sizeof($linhas) ) foreach( $linhas as $key1 => $value1 ){ $counter1++; ?><option  value="<?php echo $value1["id_linha"]; ?>"><?php echo $value1["codigo"]; ?> - <?php echo $value1["cidade_linha"]; ?> - R$ <?php echo formatValor($value1["valor"]); ?></option> <?php } ?> </select> </div> <button  class="btn btn-danger btn-sm type="button" id="' + controleCampo + '" onclick="removerCampo_linha(' + controleCampo + ')"><i class="fa fa-minus-circle" ></i> Remover</button></div></div>');
  }

  function removerCampo_linha(idCampo) {
    //console.log("Campo remover: " + idCampo);
    document.getElementById('campo' + idCampo).remove();
  }
</script>