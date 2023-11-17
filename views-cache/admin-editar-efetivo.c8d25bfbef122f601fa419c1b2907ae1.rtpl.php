<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">

    <div class="content-inside">

        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Alterar Dados
                        </b></a>
                </li>
            </ul>

           

            <div class="container-fluid px-1 py-5 mx-auto">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-12 col-lg-8 col-md-9 col-11 text-center">

                        <form class="form-group" action="/admin/efetivo-alterar/<?php echo $value["id_efetivo"]; ?>" method="post">

                            <input class="form-control py-1" value="<?php echo $value["id_efetivo"]; ?>" name="id_efetivo"
                                type="hidden">


                    </div>
                </div>

               
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

                <b>Identificação do Servidor Efetivo</b><br><br>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table table-dark">


                            <th>
                                <center>Nome
                            </th>
                            <th>
                                <center>Matrícula
                            </th>
                            <th>
                                <center>Carreira
                            </th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>
                                    <input class="form-control py-1" value="<?php echo $value["nome_servidor"]; ?>" type="text"
                                        name="nome_servidor" required />

                                </td>

                                <td>
                                    <input class="form-control py-1" value="<?php echo $value["matricula"]; ?>" type="text"
                                        name="matricula" required />

                                </td>
                                <td>
                                    <select class="form-control py-1" name="carreira">
                                         <option value="<?php echo $value["carreira"]; ?>"><?php echo $value["carreira"]; ?></option>
                                        <option value="Magistério">Magistério</option>
                                        <option value="Assistência">Assistência</option>
                                    </select>

                                </td>





                            </tr>



                        </tbody>

                        <thead class="table table-dark">


                            <th colspan="3">
                                <center>Unidade Escolar / CRE<b>
                            </th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td colspan="3">
                                    <select class="form-control py-1" id="" name="id_unidade" required>
                                        <option value="<?php echo $value["id_unidade"]; ?>"><?php echo $value["sigla"]; ?> - <?php echo $value["nome"]; ?>
                                            <?php $counter1=-1;  if( isset($unidades) && ( is_array($unidades) || $unidades instanceof Traversable ) && sizeof($unidades) ) foreach( $unidades as $key1 => $value1 ){ $counter1++; ?>
                                        <option value="<?php echo $value1["id_unidade"]; ?>"><?php echo $value1["sigla"]; ?> - <?php echo $value1["nome"]; ?>
                                        </option>
                                        <?php } ?>
                                    </select>

                                </td>




                            </tr>



                        </tbody>

                    </table>
                </div>

                <center><input style="width: 100%;" class="btn btn-success btn " type="submit" value="Alterar"></center>
            </div>
        </div>

        </form>
        <hr>

        <a href="/admin/todos-efetivos" class="btn btn-info btn-xs"><i class="fas fa-chevron-circle-left"></i><b>
                Voltar</b></a>

    </div>

</div>
</div>

</div>
<hr class="my-4" />





</div>



</div>
</div>