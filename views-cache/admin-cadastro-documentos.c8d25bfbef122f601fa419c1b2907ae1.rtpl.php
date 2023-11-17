<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">

    <div class="content-inside">
  
      <div class="my-4">
        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
          <li class="nav-item">
            <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
              role="tab" aria-controls="home" aria-selected="false"><b>Registrar Documentos </b></a>
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
  
        <center>
  
          <h4><b>Documento</b></h4>
        </center><br>
        <hr>
  
  
        <div class="container-fluid px-1 py-5 mx-auto">
          <div class="row d-flex justify-content-center">
            <div class="col-xl-12 col-lg-8 col-md-9 col-11 text-center">
  
              <form class="form-group" action="/admin/registrar-documentos/enviar" method="post"
                enctype="multipart/form-data">
  
                <input class="form-control py-1" value="<?php echo $usuario["id_usuario"]; ?>" name="id_usuario" type="hidden">
  
  
            </div>
          </div>
  
          <b>Identificação do Documento</b><br><br>
  
            <div class="table-responsive">
            <table class="table table-hover table-bordered">
              <thead class="table table-dark">
  
  
                <th>
                  <center>Nome do Documento<b>
                </th>
                <th>
                  <center>Data do Documento<b>
                </th>
                <th>
                  <center>Anexo<b>
                </th>
           
             
  
  
                </tr>
              </thead>
              <tbody>
  
                <tr>
  
                  <td> <input name="nome_documento" type="text" class="form-control py-1"></td>
                  <td> <input name="dt_documento" type="date" class="form-control py-1" required></td>
                  <td>  <input id="addArquivoProfile" class="form-control py-1" type="file" id="arquivo_documento"
                    name="arquivo_documento[]" multiple="multiple"  required="" />
                </div></td>
  
                </tr>
  
  
  
              </tbody>
  
            </table>
          </div>
          <hr>
  
  
  
  
        </div>
      </div>
  
  
      <center><input style="width: 100%;" class="btn btn-primary btn " type="submit" value="Enviar"></center><br><br>
  
  
      <a href="/admin/todos-documentos" class="btn btn-info btn-xs"><i class="fas fa-chevron-circle-left"></i><b>
          Voltar</b></a>
      <hr>
    </div>
  
  </div>
  </div>
  
  </div>
  <hr class="my-4" />
  
  
  
  </form>
  </div>
  </div>