<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="content-inside">
    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
            role="tab" aria-controls="home" aria-selected="false"><b>Dossiê Temporários - 
                <?php if( $total == 0 ){ ?>
              Nenhum Registrado
              <?php }elseif( $total == 1 ){ ?>
              <?php echo $total; ?> Registrado
              <?php }else{ ?>
              <?php echo $total; ?> Registrados
              <?php } ?></b></a>

        </li>

      </ul>

          

        <a style="width: 20%;" href="/usuario/registrar-dossiers"class="btn btn-primary btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i><b> Cadastrar Dossiê</b></a>
     

      <?php if( $total > 0 ){ ?>
      <div class="search" style="float: right">
        <form action="/usuario/todos-dossiers-temporarios" method="get">
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
                <center>Matrícula
              </th>

               <th>
                <center>CPF
              </th>

              <th>
                <center>Arquivo(s)
              </th>
               <th>
                <center>Alterar
              </th>
               <th>
                <center>Excluir
              </th>
             

            </tr>
          </thead>
          <tbody>
            <?php $counter1=-1;  if( isset($dossiers) && ( is_array($dossiers) || $dossiers instanceof Traversable ) && sizeof($dossiers) ) foreach( $dossiers as $key1 => $value1 ){ $counter1++; ?>
            <tr style="font-size: 15px;font-weight: normal;">

              <td>
                <center><?php echo $value1["nome"]; ?>
              </td>

              <td>
                <center><?php echo $value1["matricula"]; ?>
              </td>

              <td>
                <center><?php echo $value1["cpf"]; ?>
              <td>
               <center> <a  href="/usuario/todos-dossiers-temporarios/arquivos/<?php echo $value1["id_dossie"]; ?>"
                    class="btn btn-warning btn-sm"><b>
                    <i class="far fa-file-alt"></i> <?php echo numArquivosDossiers($value1["id_dossie"]); ?></b>
                    <!-- <?php if( numArquivosDossiers($value1["id_dossie"]) == 1 ){ ?>
                    <b><?php echo numArquivosDossiers($value1["id_dossie"]); ?> Arquivo</b></a>
                  <?php }else{ ?>
                  <b><?php echo numArquivosDossiers($value1["id_dossie"]); ?> Arquivos</b></a>
                  <?php } ?> -->
              </td>
               <td>
                  <center> <a  href="/usuario/dossie/editar/<?php echo $value1["id_dossie"]; ?>"
                    class="btn btn-success btn-sm"><i class="fas fa-pen"></i><b></b></a></center>
              </td>
               <td>
                  <center>
                    <button
                    onclick="deletar('<?php echo $value1["id_dossie"]; ?>','<?php echo $value1["nome"]; ?>','/usuario/dossiers/delete/<?php echo $value1["id_dossie"]; ?>','Excluir Dossiê')"
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

      <br><br><a href="/usuario/utilidades" class="btn btn-info btn-xs"><i class="fas fa-chevron-circle-left"></i><b>
          Voltar</b></a>


      <hr class="my-4" />

    </div>


  </div>

</div>