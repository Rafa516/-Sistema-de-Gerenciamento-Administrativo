<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">

    <div class="content-inside">

        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Cadastrar ou Alterar Contato do(a) Supervisor(a) <?php echo $values["supervisor"]; ?></b></a>
                </li>
            </ul>
            <?php if( $unidadeOpenMsg!= '' ){ ?>
            <div class="alert alert-success">
                <b><?php echo $unidadeOpenMsg; ?></b>
            </div>
            <?php } ?>

            <?php if( $errorRegister != '' ){ ?>
            <div class="alert alert-danger">
                <b><?php echo $errorRegister; ?></b>
            </div>
            <?php } ?>

        
                <div class="col">
                   
                       
                            

                            <form class="form-group" action="/usuario/cadastrar-alterar-contato-supervisor/registro/<?php echo $values["id_supervisor"]; ?>" method="post"
                                enctype="multipart/form-data"><br>

                                <div class="form-group"><label class="small mb-1"><b
                                            style="font-size:20px;color: #585858">Telefone com DDD</b></label>
                                    <input class="form-control py-1" placeholder="Exemplo 61955554444"
                                      value="<?php echo $values["telefone_supervisor"]; ?>"  type="text" name="telefone_supervisor" />
                                </div>

                              

                                <center><input style="width: 100%;" class="btn btn-primary btn " type="submit"
                                        value="Enviar"></center>

                        

                    </div>
                </div>

            </div>
            <hr class="my-4" />
            </form>
           
        </div>
        
    </div>
    
</div>
</div>
</div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>



<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>



