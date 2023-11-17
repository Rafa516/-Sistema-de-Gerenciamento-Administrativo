<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">

    <div class="content-inside">
  
      <div class="my-4">
        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
          <li class="nav-item">
            <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
              role="tab" aria-controls="home" aria-selected="false"><b>Alterar Documento - <b><?php echo $value["nome_documento"]; ?></b>
              </b></a>
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
  
              <form class="form-group" action="/admin/Documento/editar/<?php echo $value["id_documento"]; ?>" method="post"
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
  
                </tr>
              </thead>
              <tbody>
  
                <tr>
  
                  <td> <input name="nome_documento" type="text" value="<?php echo $value["nome_documento"]; ?>" class="form-control py-1">
                  </td>
                  <td> <input name="dt_documento" type="date" value="<?php echo $value["dt_documento"]; ?>" class="form-control py-1"
                      required></td>
  
  
                </tr>
  
  
  
              </tbody>
  
            </table>
          </div>
  
          <center><input style="width: 100%;" class="btn btn-success btn " type="submit" value="Alterar"></center>
          </form>
          <br><i>Última alteração registrada pelo(a) usuário(a)<b> <?php echo $value["nome_user"]; ?></b> em <b><?php echo formatDateHoras($value["dt_registro_documento"]); ?>.</b></i>
        </div>
      </div>
  
     
      <hr class="my-4" />
  
  
  
      <a href="/admin/todos-documentos" class="btn btn-info btn-xs"><i class="fas fa-chevron-circle-left"></i><b>
          Voltar</b></a>
    </div>
  
  </div>
  </div>
  
  </div>
  
  
  
  
  
  </div>
  </div>