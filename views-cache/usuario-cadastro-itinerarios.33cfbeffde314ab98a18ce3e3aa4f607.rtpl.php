<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">

  <div class="content-inside">

    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
            role="tab" aria-controls="home" aria-selected="false"><b>Cadastrar Itinerários </b></a>
        </li>
      </ul>
      <?php if( $CallOpenMsg != '' ){ ?>

      <div class="alert alert-success">
        <b><?php echo $CallOpenMsg; ?></b>
      </div>
      <?php } ?>


      <?php if( $errorRegister != '' ){ ?>

      <div class="alert alert-danger">
        <b><?php echo $errorRegister; ?></b>
      </div>
      <?php } ?>



      <div class="container-fluid px-1 py-5 mx-auto">
        <div class="row d-flex justify-content-center">
          <div class="col-xl-12 col-lg-8 col-md-9 col-11 text-center">

          </div>
        </div>
        <form class="form-group" action="/usuario/cadastrar-itinerarios/enviar" method="post">

          <input class="form-control py-1" value="<?php echo $usuario["id_usuario"]; ?>" name="id_usuario" type="hidden">


          <b>1. Identificação do Itnerário</b><br><br>

          <div class="table-responsive">
            <table class="table table-hover table-bordered">
              <thead class="table table-dark">

                <th>
                  <center><b>Nome</b>
                </th>

                <th>
                  <center><b>Cidade</b>
                </th>

                </tr>
              </thead>
              <tbody>

                <tr>

                  <td> <input name="nome_itinerario" type="text" class="form-control py-1" required></td>

                  <td >
                    <select class="form-control py-1"  name="cidade" required >
                        <option value=""></option>
                        <?php $counter1=-1;  if( isset($cidades) && ( is_array($cidades) || $cidades instanceof Traversable ) && sizeof($cidades) ) foreach( $cidades as $key1 => $value1 ){ $counter1++; ?>

                        <option value="<?php echo $value1["cidade"]; ?>"><?php echo $value1["cidade"]; ?> </option>
              
                        <?php } ?>

                      </select> 
                </td>

                </tr>



              </tbody>

            </table>
          </div>
          <hr>



          <b>2. Dados das linhas cadastradas</b><br><br>


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


          <hr>

          <b>3. Observações</b>



          <div class="table-responsive">
            <table class="table table-hover table-bordered">
              <thead class="table table-dark">


                <th>
                  <center>Observações em geral<b>
                </th>

                </tr>
              </thead>
              <tbody>

                <tr>
                  <td> <textarea style="height: 110px;" class="form-control py-1" value="" type="text"
                      name="observacoes"> </textarea> </td>
                </tr>



              </tbody>

            </table>
          </div>
          

          <center><input style="width: 100%;" class="btn btn-primary btn" type="submit" value="Enviar"></center>
      </div>
      <hr>
      <a href="/usuario/todos-itinerarios" class="btn btn-info btn-xs"><i class="fas fa-chevron-circle-left"></i><b>
          Voltar</b></a>
      
    </div>

  </div>


</div>
</div>

</div>
<hr class="my-4" />

</form>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script type="text/javascript">


  $(".js-example-basic-single").select2({

  });

</script>



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





