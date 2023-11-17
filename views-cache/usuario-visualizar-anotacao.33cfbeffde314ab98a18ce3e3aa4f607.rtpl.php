<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">

    <div class="content-inside">

        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Anotação -
                            <?php echo $value["nome"]; ?></b></a>
                </li>
            </ul>

            <?php if( $profileMsg != '' ){ ?>
            <div class="alert alert-success">
              <b><?php echo $profileMsg; ?></b>
            </div>
            <?php } ?>

            <div class="container-fluid px-1 py-5 mx-auto">
                <div class="row d-flex justify-content-center">
                    <div class="col-xl-12 col-lg-8 col-md-9 col-11 text-center">

                    </div>
                </div>


                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="table table-dark">


                            <th>
                                <center>Anotações <b>
                            </th>

                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td> <?php echo $value["anotacoes"]; ?> </td>
                            </tr>



                        </tbody>

                    </table>
                </div>
                <i>Última alteração registrada pelo(a) usuário(a)<b> <?php echo $value["nome_user"]; ?></b> em <b><?php echo formatDateHoras($value["dt_registro_alteracao"]); ?>.</b></i><br><br>
                <a href="/usuario/anotacao-editar/<?php echo $value["id_anotacao"]; ?>" class="btn btn-success btn-sm"><i
                    class="fas fa-pen"></i><b> Alterar dados</b></a> 
                <hr>

            </div>
            
             
            <a href="/usuario/minhas-anotacoes" class="btn btn-info btn-xs"><i
                    class="fas fa-chevron-circle-left"></i><b>
                    Voltar</b></a>
        </div>

    </div>


</div>
</div>

</div>
<hr class="my-4" />

</form>
</div>
</div>



<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

    $(document).ready(function () {
        $('#eqp1').select2();
    });
</script>

<script>
    $(document).ready(function () {
        $('#eqp2').select2();
    });
</script>