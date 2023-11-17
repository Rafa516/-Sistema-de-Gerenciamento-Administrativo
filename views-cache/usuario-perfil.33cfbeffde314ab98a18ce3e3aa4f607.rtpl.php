<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">

  <div class="content-inside">

    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color:  #2E9AFE;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
            role="tab" aria-controls="home" aria-selected="false"><b>Meu Perfil</b></a>
        </li>
      </ul>


      <?php if( $alteracaoErro != '' ){ ?>

      <div class="alert alert-danger">
        <b><?php echo $alteracaoErro; ?></b>
      </div>
      <?php } ?>


      <?php if( $alteracaoSucesso != '' ){ ?>

      <div class="alert alert-success">
        <b><?php echo $alteracaoSucesso; ?></b>
      </div>
      <?php } ?>


      <div class="row mt-5 align-items-center">
        <div class="col-md-3 text-center mb-5">
          <div class="avatar avatar-xl">

            <?php if( $usuario["foto"] == 0 ){ ?>

            <img src="/res/ft_perfil/ft_male.png" class="avatar-img rounded-circle" alt="">
            <?php }else{ ?>

            <img src="/res/ft_perfil/<?php echo $usuario["foto"]; ?>" class="avatar-img rounded-circle" height="150" alt="">
            <?php } ?>

            <br><br><button onclick="alertAlterarFoto()" data-toggle="modal" data-target="#imageModal"
              class="btn btn-success btn-sm"><b>Alterar Foto</b> </button>
          </div>
        </div>
        <div class="col">
          <div class="row align-items-center">
            <div class="col-md-7">
              <h4 style="font-size: 25px;color: #585858;" class="mb-1"><?php echo getUsuarioNome(); ?></h4>

            </div>
          </div>
          <div class="row mb-4">
            <div class="col-md-7">
              <p class="text-muted">
              <p style="font-size: 18px;color: #585858;" class="small mb-1"><b>Email:</b>
                <?php echo $usuario["email"]; ?></p>
              <p style="font-size: 18px;color: #585858;" class="small mb-1"><b>Login:</b>
                <?php echo $usuario["login"]; ?></p>
            </div>

          </div>
        </div>

      </div>
      <center><button data-toggle="modal" onclick="alertAlterarDados()" data-target="#dateModal"
          class="btn btn-success btn-sm"><b>Alterar Dados</b> </button>
        <button data-toggle="modal" data-target="#dateModal1" class="btn btn-success btn-sm"><b>Alterar senha</b>
        </button>
      </center>
      <hr class="my-4" />

    </div>


  </div>


</div>

<!-- Modal dados -->
<div class="modal fade" id="dateModal" tabindex="-1" role="dialog" aria-labelledby="dateModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dateModal">Alterar meus Dados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-group" action="/usuario/perfil/editar/<?php echo $usuario["id_usuario"]; ?>" method="post"><br>


          <div class="form-group"><label class="small mb-1"><b style="font-size:17px;color: #585858">Nome</b></label>
            <input class="form-control py-1" value='<?php echo getUsuarioNome(); ?>' type="text" name="nome_user"
              required />
          </div>

         

          <input class="btn btn-success btn btn-block" type="submit" value="Alterar">


        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Senha -->
<div class="modal fade" id="dateModal1" tabindex="-1" role="dialog" aria-labelledby="dateModal1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="dateModal1">Alterar Senha</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-group" action="/perfil/alterar-senha" method="post"><br>


          <div class="form-group"><label class="small mb-1"><b style="font-size:17px;color: #585858">Senha
                Atual</b></label>
            <input class="form-control py-1" value='' type="password" id="senha_atual" name="senha_atual" required />
          </div>

          <div class="form-group"><label class="small mb-1"><b style="font-size:17px;color: #585858">Nova
                Senha</b></label>
            <input class="form-control py-1" value='' type="password" name="nova_senha" required />
          </div>


          <input class="btn btn-success btn btn-block" type="submit" value="Alterar">


        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal imagem -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="imageModal">Alterar Foto do Perfil</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-group" action="/usuario/perfil/editar-imagem/<?php echo $usuario["id_usuario"]; ?>" method="post"
          enctype="multipart/form-data"><br>


          <div class="form-group"><label class="small mb-1"><b style="font-size:17px;color: #585858">Foto</b></label>
            <input id="addPhotoProfile" class="form-control py-1" type="file" id="foto" name="foto" required="" />
          </div>

          <input class="btn btn-success btn btn-block" type="submit" value="Alterar">

        </form>
      </div>
    </div>
  </div>
</div>

</div>

</div>

<script src="/res/user/js/functions.js"></script>