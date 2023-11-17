<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="content-inside">
    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
            role="tab" aria-controls="home" aria-selected="false"><b>Anotações -
              <?php if( $total == 0 ){ ?>
              Nenhuma Registrada
              <?php }elseif( $total== 1 ){ ?>
              <?php echo $total; ?> Registrada
              <?php }else{ ?>
              <?php echo $total; ?> Registradas
              <?php } ?> </b></a>

        </li>
      </ul>
      <?php if( $profileMsg != '' ){ ?>
      <div class="alert alert-success">
        <b><?php echo $profileMsg; ?></b>
      </div>
      <?php } ?>



      <a style="width: 25%;" href="/usuario/registrar-anotacoes" class="btn btn-primary btn-sm"><i
          class="fa fa-plus-circle" aria-hidden="true"></i><b> Registrar Anotação</b></a>



      <?php if( $total != 0 ){ ?>
      <div class="search" style="float: right">
        <form action="/usuario/minhas-anotacoes" method="get">
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




      <div class="table-responsive">
        <table class=" table table-hover table-sm  table-bordered">
          <thead class="table table-dark">
            <tr style="font-size: 16px; font-weight: bold; ">




              <th>
                <center>Nome<b>
              </th>

              <th>
                <center>Data Registro<b>
              </th>
              <th>
                <center>Visualizar<b>
              </th>
              <th>
                <center>Excluir Anotação<b>
              </th>

            </tr>
          </thead>
          <tbody>
            <?php $counter1=-1;  if( isset($anotacoes) && ( is_array($anotacoes) || $anotacoes instanceof Traversable ) && sizeof($anotacoes) ) foreach( $anotacoes as $key1 => $value1 ){ $counter1++; ?>
            <tr style="font-size: 15px;font-weight: normal;">

              <td>
                <center><?php echo $value1["nome"]; ?>
              </td>

              <td>

                <center> <?php echo formatDate($value1["dt_registro_anotacao"]); ?>
              </td>


              <td>
                <center> <a href="/usuario/anotacao-visualizar/<?php echo $value1["id_anotacao"]; ?>" class="btn btn-primary btn-sm"><i
                      class="fas fa-eye" aria-hidden="true"></i><b> </b></a>
              </td>

              <td>
                <center>
                  <button
                    onclick="deletar('<?php echo $value1["id_anotacao"]; ?>','<?php echo $value1["nome"]; ?>','/usuario/anotacoes/delete/<?php echo $value1["id_anotacao"]; ?>','Excluir Anotação')"
                    class="btn btn-danger btn-sm">
                    <i class="fas fa-trash-alt"></i>
                    <b> </b></button>
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

      <a href="/usuario/utilidades" class="btn btn-info btn-xs"><i
          class="fas fa-chevron-circle-left"></i><b>
          Voltar</b></a>




    </div>


  </div>

</div>