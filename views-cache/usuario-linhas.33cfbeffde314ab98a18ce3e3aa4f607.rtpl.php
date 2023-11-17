<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="content-inside">
    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
            role="tab" aria-controls="home" aria-selected="false"><b>Linhas de Ônibus -  <?php if( $total == 0 ){ ?>

              Nenhum Registrado
              <?php }elseif( $total == 1 ){ ?>

              <?php echo $total; ?> Registrado
              <?php }else{ ?>

              <?php echo $total; ?> Registrados
              <?php } ?>

            </b></a>

        </li>

      </ul>



      <a style="width: 30%;" href="/usuario/registrar-linhas" class="btn btn-primary btn-sm"><i
          class="fa fa-plus-circle" aria-hidden="true"></i>
        <b>Cadastrar nova Linha</b></a>




        <?php if( $total > 0 ){ ?>

      <div class="search" style="float: right">
        <form action="/usuario/linhas" method="get">
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



      <div class="table-responsive">
        <table class=" table table-hover table-sm  table-bordered">
          <thead class="table table-dark">
            <tr style="font-size: 16px; font-weight: bold; ">



              <th>
                <center>Código<b>
              </th>
              <th>
                <center>Cidade<b>
              </th>
              <th>
                <center>Valor<b>
              </th>
              <th>
                <center>Valor Diário<b>
              </th>
              <th>
                <center>Alterar<b>
              </th>
              <th>
                <center>Excluir<b>
              </th>

            </tr>
          </thead>
          <tbody>
            <?php $counter1=-1;  if( isset($linha) && ( is_array($linha) || $linha instanceof Traversable ) && sizeof($linha) ) foreach( $linha as $key1 => $value1 ){ $counter1++; ?>

            <tr style="font-size: 15px;font-weight: normal;">



              <td>
                <center><?php echo $value1["codigo"]; ?>

              </td>
              <td>
                <center><?php echo $value1["cidade_linha"]; ?>

              </td>
              <td>
                <center>R$ <?php echo formatValor($value1["valor"]); ?>

              </td>

              <td>
                <center>R$ <?php echo formatValor($value1["valor_diario"]); ?>

              </td>


              <td>
                <center>

                  <a href="/usuario/linhas/editar/<?php echo $value1["id_linha"]; ?>" class="btn btn-success btn-sm"><i
                      class="fas fa-pen"></i>
                    <b></b></a>

              </td>

              <td>
                <center>
                  <button
                    onclick="deletar('<?php echo $value1["id_linha"]; ?>','<?php echo $value1["cidade_linha"]; ?>','/usuario/linhas/delete/<?php echo $value1["id_linha"]; ?>','Excluir Linha')"
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


      <hr class="my-4" />
      <a href="javascript:history.back()" class="btn btn-info btn-xs"><i class="fas fa-chevron-circle-left"></i><b>
          Voltar</b></a>




    </div>


  </div>

</div>