<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="content-inside">
    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color: #2E9AFE;;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
            role="tab" aria-controls="home" aria-selected="false"><b>Arquivo(s) do Documento <b><?php echo $value["nome_documento"]; ?></b>
            </b></a>

        </li>
      </ul>

       <?php if( $profileMsg != '' ){ ?>

      <div class="alert alert-success">
        <b><?php echo $profileMsg; ?></b>
      </div>
      <?php } ?>


    
     
      <button data-toggle="modal" data-target="#arquivoModal" class="btn btn-warning btn-sm"><i
          class="far fa-file-alt"></i><b> Anexar Arquivo</b></button>
      

      <?php if( numArquivosDocumentos($value["id_documento"]) != 0 ){ ?>


      <br><br>
      <div class="table-responsive">
        <table class="table table-hover table-sm  table-bordered">
          <thead class="table table-dark">
            <tr style="font-size: 16px; font-weight: bold; ">


              <th>
                <center>Nome do Arquivo<b>
              </th>
              <th>
                <center>Inclusão
              </th>
              <th>
                <center>Usuário
              </th>
              <th>
                <center>Visualizar/Baixar Arquivo
              </th>
             
               <th>
                <center>Excluir
              </th>




            </tr>
          </thead>
          <tbody>
            <?php $counter1=-1;  if( isset($arquivo) && ( is_array($arquivo) || $arquivo instanceof Traversable ) && sizeof($arquivo) ) foreach( $arquivo as $key1 => $value1 ){ $counter1++; ?>

            <tr style="font-size: 15px;font-weight: normal;">

              <td>
                <center><?php echo $value1["arquivo_documento"]; ?>

              </td>
              <td>
                <center><?php echo formatDateHoras($value1["dt_registro_arquivo_documento"]); ?>

              </td>

              <td>
                <center><?php echo $value1["nome_user"]; ?>

              </td>
              <td>
                <center> <a class="btn btn-warning btn-sm " href="<?php echo $value1["arquivo"]; ?>" target="_blank"><i
                      class="far fa-file-alt"></i><b> Visualizar/Download</b></a>
              </td>

             

               <td>
                  <center>
                    <button
                    onclick="deletar('<?php echo $value1["id_arquivoD"]; ?>','<?php echo $value1["arquivo_documento"]; ?>','/admin/documentos-arquivo/delete/<?php echo $value1["id_arquivoD"]; ?>,<?php echo $usuario["nome_user"]; ?>','Excluir Arquivo')"
                    class="btn btn-danger btn-sm">
                    <i class="fas fa-trash-alt"></i>
                    <b></b></button>
              </td>




              <?php } ?>


          </tbody>

        </table><br>

      </div>
    <?php } ?>


     
      <hr class="my-4" />

      <a href="/admin/todos-documentos" class="btn btn-info btn-xs"><i class="fas fa-chevron-circle-left"></i><b>
          Voltar</b></a>


    </div>
  </div>
</div>

<!-- Modal arquivo -->
<div class="modal fade" id="arquivoModal" tabindex="-1" role="dialog" aria-labelledby="arquivoModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModal">Anexar Arquivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-group" action="/admin/documento/anexar-arquivo/<?php echo $value["id_documento"]; ?>" method="post"
          enctype="multipart/form-data"><br>       

          <input class="form-control py-1" value="<?php echo $usuario["id_usuario"]; ?>" name="id_usuario" type="hidden">
          <input class="form-control py-1" value="<?php echo $value["id_documento"]; ?>" name="id_documento" type="hidden">


          <div class="form-group"><label class="small mb-1"><b style="font-size:17px;color: #585858">Anexe o documento
                escaneado  </b></label>
            <input id="addArquivoProfile" class="form-control py-1" type="file" id="arquivo_documento"
              name="arquivo_documento[]" multiple="multiple"  required/>
          </div>

          <input class="btn btn-warning btn btn-block" type="submit" value="Anexar">

        </form>
      </div>
    </div>
  </div>
</div>

</div>