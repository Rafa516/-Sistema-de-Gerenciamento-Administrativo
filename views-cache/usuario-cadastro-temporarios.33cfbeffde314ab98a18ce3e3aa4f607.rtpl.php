<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">

    <div class="content-inside">

        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Cadastrar CT 
                        </b></a>
                </li>
            </ul>


            <div class="container-fluid px-1 py-5 mx-auto">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-12 col-lg-8 col-md-9 col-11 text-center">

                        <form class="form-group" action="/usuario/registrar-temporarios/enviar" method="post">

                            <!-- <input class="form-control py-1" value="<?php echo $usuario["id_usuario"]; ?>" name="id_usuario" type="hidden"> -->


                    </div>
                </div>

                <b>1. Identificação do Contrato Temporário</b><br><br>

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
                                <center>CPF
                            </th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>
                                    <input class="form-control py-1" type="text" name="nome" required />

                                </td>

                                <td>
                                    <input class="form-control py-1" type="text" name="matricula" required />

                                </td>
                                <td>
                                    <input class="form-control py-1" type="text" name="cpf" required />

                                </td>





                            </tr>



                        </tbody>

                        <thead class="table table-dark">


                            <th colspan="2">
                                <center>Componente<b>
                            </th>
                            <th>
                                <center>Ano<b>
                            </th>


                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td colspan="2">
                                    <select class="form-control py-1" id="" name="componente" required>
                                        <option value=""></option>
                                        <?php $counter1=-1;  if( isset($componentes) && ( is_array($componentes) || $componentes instanceof Traversable ) && sizeof($componentes) ) foreach( $componentes as $key1 => $value1 ){ $counter1++; ?>
                                        <option value="<?php echo $value1["componente"]; ?>"><?php echo $value1["componente"]; ?>
                                        </option>
                                        <?php } ?>
                                    </select>

                                </td>

                                <td> <select class="form-control py-1" name="ano">
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2026">2027</option>
                                    </select>
                                </td>


                            </tr>



                        </tbody>

                    </table>
                </div>
                
                <center><input style="width: 100%;" class="btn btn-primary btn " type="submit" value="Enviar"></center>
            </div>           
        </div>

    </form>
    <hr>

        <a href="/usuario/todos-temporarios" class="btn btn-info btn-xs"><i class="fas fa-chevron-circle-left"></i><b>
                Voltar</b></a>
        
    </div>

</div>
</div>

</div>
<hr class="my-4" />





</div>



</div>
</div>