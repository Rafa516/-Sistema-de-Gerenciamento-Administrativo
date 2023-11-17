<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Imagens da Unidade
                            Escolar / CRE - <?php echo $values["nome"]; ?></b></a>
                </li>
            </ul>
            <?php if( numFotos($values["id_unidade"]) != 0 ){ ?>
            <div class="box box-widget">
                <div id="myWorkContent">

                    <?php $counter1=-1;  if( isset($imagens) && ( is_array($imagens) || $imagens instanceof Traversable ) && sizeof($imagens) ) foreach( $imagens as $key1 => $value1 ){ $counter1++; ?>
          
                    <a class="image-link" style="text-decoration:none" href="<?php echo $value1["desphoto"]; ?>"> <img style="height: 15em;width: 15em;" class="photo"
                            id="image-preview" src="<?php echo $value1["desphoto"]; ?>"><br> 
                            <center><button style="margin-top: 2px;margin-bottom: 2px"
                            onclick="deletar('<?php echo $value1["id_foto"]; ?>','essa foto','/usuario/unidade-imagem/delete/<?php echo $value1["id_foto"]; ?>','Excluir ')"
                            class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                            <b></b></button></center></a>                
                    <?php } ?>

                </div>
            </div><br>

            <?php } ?>

            <button  data-toggle="modal" data-target="#imageModal"
              class="btn btn-primary btn-sm"><b>Adicionar Fotos</b> </button>

            <hr class="my-4" />
            <a href="/usuario/unidade/informacoes/<?php echo $values["id_unidade"]; ?>" class="btn btn-info btn-xs"><i
                    class="fas fa-chevron-circle-left"></i><b>
                    Voltar</b></a>


            <!-- Modal imagem -->
            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModal"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="imageModal">Adicionar Fotos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="form-group" action="/usuario/unidade/fotos/post/<?php echo $values["id_unidade"]; ?>"
                                method="post" enctype="multipart/form-data">


                                <div class="form-group"><label class="small mb-1"><b
                                    style="font-size:17px;color: #585858">Foto</b></label>
                                    <input id="addPhoto" class="form-control py-1" type="file" id="" name="nome_foto[]"
                                    multiple="multiple" required/>
                            </div>

                            <input class="form-control py-1" value="<?php echo $usuario["id_usuario"]; ?>" name="id_usuario"
                                type="hidden">
                            <input class="form-control py-1" value="<?php echo $values["id_unidade"]; ?>" name="id_unidade"
                                type="hidden">
                       

                                <input class="btn btn-primary btn btn-block" type="submit" value="Adicionar">

                            </form>
                        </div>
                    </div>
                </div>
            </div>





        </div>
    </div>
</div>