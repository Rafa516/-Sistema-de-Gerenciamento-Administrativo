<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #2E9AFE;color: white" class="nav-link
              active" id="home-tab" data-toggle="tab" role="tab" aria-controls="home"
                        aria-selected="false"><b><?php echo $value["nome"]; ?> </b></a>
                </li>
            </ul>

            <div id="DivIdToPrint">



                <div class="table-responsive">
                    <table class="table  table-bordered">


                        <tbody>

                            <tr>
                                <td>
                                    <center><img src="/res/user/img/logo.png" width="150" height="90">
                                </td>

                                <td><br>
                                    <center>
                                        <h2>Cálculo de Pagamento <?php echo $value["mes"]; ?><h2>
                                </td>

                            </tr>

                            <?php if( $profileMsg != '' ){ ?>
                            <div class="alert alert-success">
                                <b><?php echo $profileMsg; ?></b>
                            </div>
                            <?php } ?>



                            <table class="table table-hover table-bordered">
                                <thead class="table table-dark">

                                    <th>
                                        <center>Cod. Carência
                                    </th>

                                    <th>
                                        <center>Nome
                                    </th>

                                    <th>
                                        <center>Matrícula
                                    </th>

                                    <th>
                                        <center>CPF
                                    </th>

                                </thead>
                                <td>
                                    <center><?php echo $value["cod_carencia"]; ?>
                                </td>

                                <td>
                                    <center><?php echo $value["nome"]; ?>
                                </td>

                                <td>
                                    <center><?php echo $value["matricula"]; ?>

                                </td>
                                <td>
                                    <center><?php echo $value["cpf"]; ?>

                                </td>

                                <table class="table table-hover table-bordered">
                                    <thead class="table table-dark">
                                        <th colspan="4">
                                            <center>Início de exercício
                                        </th>
                                        <th colspan="4">
                                            <center>Fim de exercício
                                        </th>
                                    </thead>
                                    <td colspan="4">
                                        <center><?php echo formatDate($value["data_inicial"]); ?>
                                    </td>

                                    <td colspan="4">
                                        <center><?php echo formatDate($value["data_final"]); ?>
                                    </td>
                                    <thead class="table table-dark">
                                        <th colspan="8">
                                            <center>Valores
                                        </th>
                                    </thead>
                                    <thead style="background-color:#D3D3D3">
                                        <b>1. Dados do pagamento</b><br><br>

                                        <th>
                                            <center><button type="button" class="btn btn-secondary  btn-sm" disabled>
                                                    <b style="color: black;">Dias pagos</b>
                                                </button>
                                        </th>

                                        <th>
                                            <center><button type="button" class="btn btn-danger  btn-sm" disabled>
                                                    <b style="color: black;">Vencimento</b>
                                                </button>
                                        </th>

                                        <th>
                                            <center><button type="button" class="btn btn-danger  btn-sm" disabled>
                                                    <b style="color: black;">GAPED</b>
                                                </button>
                                        </th>

                                        <th>
                                            <center><button type="button" class="btn btn-danger  btn-sm" disabled>
                                                    <b style="color: black;">GAA</b>
                                                </button>
                                        </th>

                                        <th>
                                            <center><button type="button" class="btn btn-danger  btn-sm" disabled>
                                                    <b style="color: black;">GAZR</b>
                                                </button>
                                        </th>

                                        <th>
                                            <center><button type="button" class="btn btn-danger btn-sm" disabled>
                                                    <b style="color: black;">GAEE</b>
                                                </button>
                                        </th>

                                        <th>
                                            <center><button type="button" class="btn btn-primary  btn-sm" disabled>
                                                    <b style="color: black;">Soma</b>
                                                </button>
                                        </th>

                                        <th>
                                            <center><button type="button" class="btn btn-primary  btn-sm" disabled>
                                                    <b style="color: black;">1/12 Avos</b>
                                                </button>
                                        </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td>
                                                <center> <?php echo $value["dias_pagos"]; ?>
                                            </td>

                                            <td>
                                                <center>R$ <?php echo formatValor($value["vencimento_pag"]); ?>
                                            </td>

                                            <td>
                                                <center>R$ <?php echo formatValor($value["gaped"]); ?>
                                            </td>

                                            <td>
                                                <center>R$ <?php echo formatValor($value["gaa"]); ?>
                                            </td>

                                            <td>
                                                <center>R$ <?php echo formatValor($value["gazr"]); ?>
                                            </td>

                                            <td>
                                                <center>R$ <?php echo formatValor($value["gaee"]); ?>
                                            </td>

                                            <td>
                                                <center>R$ <?php echo formatValor($value["soma"]); ?>
                                            </td>

                                            <td>
                                                <center>R$ <?php echo formatValor($value["um_doze_avos"]); ?>
                                            </td>



                                        </tr>
                                    </tbody>
                                </table>

                                <?php if( $value["observacoes"] != NULL OR $value["observacoes"] != ''  ){ ?>
                                <table class="table table-hover table-bordered">
                                    <thead class="table table-dark">

                                        <b>2. Observações</b><br>
                                        <th>
                                            <center>Observações em geral
                                        </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr>
                                            <td><?php echo $value["observacoes"]; ?>
                                            </td>
                                        </tr>


                                </table>
                                <?php } ?>
                               
                </div>


            </div>


            <i>Última alteração registrada pelo usuário <b><?php echo $value["nome_user"]; ?></b> em <b><?php echo formatDateHoras($value["dt_registro_pagamento"]); ?>.</b></i><br>


            <br><button id='btn' value='Print' onclick='printtag("DivIdToPrint");' class="btn btn-primary btn-sm">
                <i class="fa fa-print"></i><b> Imprimir</b>
            </button>

            <button class="btn btn-success btn-sm" data-toggle="modal" onclick="pagamento()"
                data-target="#modalCalcularPagamento"><i class="fas fa-pen"></i> Alterar</button>

            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalObservacoes"><i
                    class="fas fa-info-circle"></i><b> Observações</b></button>

     

            <hr class="my-4" />

            <a href="/usuario/pagamentos-temporarios" class="btn btn-info btn-xs"><i
                    class="fas fa-chevron-circle-left"></i><b>
                    Voltar</b></a>
        </div>
    </div>
</div>

<!-- MODAL CALCULAR PAGAMENTO -->
<div class="modal fade" id="modalCalcularPagamento" tabindex="-1" role="dialog"
    aria-labelledby="modalCalcularPagamentoTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Alterar dados do Cálculo do <b>Pagamento</b> do
                    Servidor</h5>
                <button onclick="atualizar()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-group" name="form_pagamento" action="/usuario/Pagamento/editar/<?php echo $value["id_pagamento"]; ?>"
                    method="post">

                    <input class="form-control py-1" value="<?php echo $usuario["id_usuario"]; ?>" name="id_usuario" type="hidden">
                    <input class="form-control py-1" value="<?php echo $value["id_pagamento"]; ?>" type="hidden">

                    <label><b>Nome - Matrícula - CPF - Componente Curricular</b></label> <select
                        class="form-control py-1" id="id_temporario" name="id_temporario" required>
                        <option value="<?php echo $value["id_temporario"]; ?>"><?php echo $value["nome"]; ?> - <?php echo $value["matricula"]; ?> - <?php echo $value["cpf"]; ?> -
                            <?php $counter1=-1;  if( isset($temporarios) && ( is_array($temporarios) || $temporarios instanceof Traversable ) && sizeof($temporarios) ) foreach( $temporarios as $key1 => $value1 ){ $counter1++; ?>
                        <option value="<?php echo $value1["id_temporario"]; ?>"><?php echo $value1["nome"]; ?> - <?php echo $value1["matricula"]; ?> - <?php echo $value1["cpf"]; ?> -
                            <?php echo $value1["componente"]; ?>
                        </option>

                        <?php } ?>
                    </select>

                    <label><b>Código da Carência</b></label><input value="<?php echo $value["cod_carencia"]; ?>" name="cod_carencia"
                        id="cod_carencia" type="text" class="form-control py-1" required>

                    <label><b>Grade</b></label> <select class="form-control py-1" name="id_grade">
                        <?php $counter1=-1;  if( isset($grades) && ( is_array($grades) || $grades instanceof Traversable ) && sizeof($grades) ) foreach( $grades as $key1 => $value1 ){ $counter1++; ?>
                        <option value="<?php echo $value1["id_grade"]; ?>"><?php echo $value1["nome_progressao"]; ?>
                        </option>
                        <?php } ?>
                    </select>



                    <label><b>Mês de Referência</b></label> <select class="form-control py-1" name="id_horas_pagas">
                        <option value="<?php echo $value["id_horas_pagas"]; ?>"><?php echo $value["mes"]; ?></option>
                        <?php $counter1=-1;  if( isset($horasPagas) && ( is_array($horasPagas) || $horasPagas instanceof Traversable ) && sizeof($horasPagas) ) foreach( $horasPagas as $key1 => $value1 ){ $counter1++; ?>
                        <option value="<?php echo $value1["id_horas_pagas"]; ?>"><?php echo $value1["mes"]; ?>
                        </option>
                        <?php } ?>

                    </select>

                    <label><b>Valor da Hora Paga</b></label> <select class="form-control py-1" id="valor_horas">
                        <option value="<?php echo $value["valor_horas"]; ?>"><?php echo $value["id_horas_pagas"]; ?> - R$ <?php echo $value["valor_horas"]; ?>
                            <?php $counter1=-1;  if( isset($horasPagas) && ( is_array($horasPagas) || $horasPagas instanceof Traversable ) && sizeof($horasPagas) ) foreach( $horasPagas as $key1 => $value1 ){ $counter1++; ?>
                        <option value="<?php echo $value1["valor_horas"]; ?>"><?php echo $value1["id_horas_pagas"]; ?> - R$ <?php echo $value1["valor_horas"]; ?>
                        </option>
                        <?php } ?>

                    </select>




                    <label for="date_ini"><b>Data Inicial</b> </label>
                    <input value="<?php echo $value["data_inicial"]; ?>" name="data_inicial" id="date_ini" type="date"
                        class="form-control py-1" required>

                    <label for="date_end"><b>Data Final</b> </label>
                    <input value="<?php echo $value["data_final"]; ?>" name="data_final" id="date_end" type="date"
                        class="form-control py-1" required><br>

                    <label for="date_ini"><b>Gratificações</b> </label>

                    <?php if( $value["gaa"] == 0 ){ ?>
                    <div class="form-check">
                        <input onclick="pagamento()" class="form-check-input" type="checkbox" id="grat_gaa"
                            value="0.15">
                        <label class="form-check-label">
                            <b>GAA</b>

                        </label>
                    </div>
                    <?php }else{ ?>

                    <div class="form-check">
                        <input onclick="pagamento()" class="form-check-input" type="checkbox" id="grat_gaa" value="0.15"
                            checked>
                        <label class="form-check-label">
                            <b>GAA</b>

                        </label>
                    </div>
                    <?php } ?>

                    <?php if( $value["gazr"] == 0 ){ ?>
                    <div class="form-check">
                        <input onclick="pagamento()" class="form-check-input" type="checkbox" id="grat_gazr"
                            value="0.15">
                        <label class="form-check-label">
                            <b>GAZR</b>

                        </label>
                    </div>
                    <?php }else{ ?>
                    <div class="form-check">
                        <input onclick="pagamento()" class="form-check-input" type="checkbox" id="grat_gazr"
                            value="0.15" checked>
                        <label class="form-check-label">
                            <b>GAZR</b>

                        </label>
                    </div>
                    <?php } ?>

                    <?php if( $value["gaee"] == 0 ){ ?>
                    <div onclick="pagamento()" class="form-check">
                        <input class="form-check-input" type="checkbox" id="grat_gaee" value="0.15">
                        <label class="form-check-label">
                            <b>GAEE</b>

                        </label>
                    </div><br>
                    <?php }else{ ?>
                    <div onclick="pagamento()" class="form-check">
                        <input class="form-check-input" type="checkbox" id="grat_gaee" value="0.15" checked>
                        <label class="form-check-label">
                            <b>GAEE</b>

                        </label>
                    </div><br>
                    <?php } ?>


                    <!-- TABELA GRADE HORARIA -->
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead style="background-color:#D3D3D3">
                                <th>
                                    <center><button type="button" class="btn btn-warning  btn-sm" disabled>
                                            <b>Segunda</b>
                                        </button>
                                </th>

                                <th>
                                    <center><button type="button" class="btn btn-warning    btn-sm" disabled>
                                            <b>Terça</b>
                                        </button>
                                </th>

                                <th>
                                    <center><button type="button" class="btn btn-warning   btn-sm" disabled>
                                            <b>Quarta</b>
                                        </button>
                                </th>

                                <th>
                                    <center><button type="button" class="btn btn-warning   btn-sm" disabled>
                                            <b>Quinta</b>
                                        </button>
                                </th>

                                <th>
                                    <center><button type="button" class="btn btn-warning    btn-sm" disabled>
                                            <b>Sexta</b>
                                        </button>
                                </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>

                                    <td><span id="seg"></span></td>
                                    <td><span id="ter"></span></td>
                                    <td><span id="qua"></span></td>
                                    <td><span id="qui"></span></td>
                                    <td><span id="sex"></span></td>


                                </tr>

                            </tbody>

                        </table>
                    </div>

                    <!-- TABELA PAGAMENTO -->
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead style="background-color:#D3D3D3">
                                <th>
                                    <center><button type="button" class="btn btn-secondary  btn-sm" disabled>
                                            <b>Dias </b>
                                        </button>
                                </th>
                                <th>
                                    <center><button type="button" class="btn btn-secondary  btn-sm" disabled>
                                            <b>Dias pagos</b>
                                        </button>
                                </th>

                                <th>
                                    <center><button type="button" class="btn btn-secondary  btn-sm" disabled>
                                            <b>Horas Pagas</b>
                                        </button>
                                </th>

                                <th>
                                    <center><button type="button" class="btn btn-secondary  btn-sm" disabled>
                                            <b>Valor Horas Pagas</b>
                                        </button>
                                </th>

                                <th>
                                    <center><button type="button" class="btn btn-danger  btn-sm" disabled>
                                            <b>Vencimento</b>
                                        </button>
                                </th>

                                <th>
                                    <center><button type="button" class="btn btn-danger  btn-sm" disabled>
                                            <b>GAPED</b>
                                        </button>
                                </th>

                                <th>
                                    <center><button type="button" class="btn btn-danger  btn-sm" disabled>
                                            <b>GAA</b>
                                        </button>
                                </th>

                                <th>
                                    <center><button type="button" class="btn btn-danger  btn-sm" disabled>
                                            <b>GAZR</b>
                                        </button>
                                </th>

                                <th>
                                    <center><button type="button" class="btn btn-danger btn-sm" disabled>
                                            <b>GAEE</b>
                                        </button>
                                </th>

                                <th>
                                    <center><button type="button" class="btn btn-primary  btn-sm" disabled>
                                            <b>Soma</b>
                                        </button>
                                </th>

                                <th>
                                    <center><button type="button" class="btn btn-primary  btn-sm" disabled>
                                            <b>1/12 Avos</b>
                                        </button>
                                </th>

                                <!-- <th>
              <center><button type="button" class="btn btn-primary  btn-sm" data-toggle="tooltip"
                  data-placement="top" title="Jus - Recebeu - Custeio" disabled>
                  Receber
                </button>
            </th> -->


                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><span id="days"></span><input type="hidden" id="dias" name="dias" value=""></td>
                                    <td><span id="dias_pagos"></span><input type="hidden" id="d_pagos" name="dias_pagos"
                                            value=""></td>
                                    <td><span id="horas_pagas"> </span><input type="hidden" id="h_pagas"
                                            name="horas_pagas" value="">
                                    </td>
                                    <td><span id="valor_horas_pagas"></span><input type="hidden" id="v_horas_pagas"
                                            name="valor_horas_pagas" value=""></td>
                                    <td><b><span id="vencimento"></b></span></span><input type="hidden"
                                            id="v_vencimento" name="vencimento_pag" value=""></td>
                                    <td><b><span id="gaped"></b></span><input type="hidden" id="v_gaped" name="gaped"
                                            value=""></td>
                                    <td><b><span id="GAA"></b></span><input type="hidden" id="v_gaa" name="gaa"
                                            value=""></td>
                                    <td><b><span id="GAZR"></b></span><input type="hidden" id="v_gazr" name="gazr"
                                            value=""></td>
                                    <td><b><span id="GAEE"></b></span><input type="hidden" id="v_gaee" name="gaee"
                                            value=""></td>
                                    <td><b><span id="soma_vencimento_gratificacoes"></b></span><input type="hidden"
                                            id="v_soma" name="soma" value=""></td>
                                    <td><b><span id="um_doze_avos"></b></span><input type="hidden" id="v_um_doze_avos"
                                            name="um_doze_avos" value=""></td>

                                </tr>

                            </tbody>

                        </table>
                    </div>




            </div>
            <div class="modal-footer">
                <button type="button" onclick="pagamento()" class="btn btn-primary">Calcular</button>
                <!-- <button type="button" onclick="limparDados()" class="btn btn-warning">Limpar Dados</button> -->
                <input class="btn btn-success" type="submit" value="Alterar">
                <button onclick="atualizar()" type="button" class="btn btn-secondary"
                    data-dismiss="modal">Voltar</button>
                </form>

            </div>
        </div>
    </div>
</div>

<!-- MODAL OBSERVAÇOES -->
<div class="modal fade" id="modalObservacoes" tabindex="-1" role="dialog" aria-labelledby="modalObservacoesTitle"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Incluir ou Alterar Observações</h5>
                <button onclick="atualizar()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="form-group" action="/usuario/incluir-observacao/enviar/<?php echo $value["id_pagamento"]; ?>" method="post">
                    <input class="form-control py-1" value="<?php echo $value["id_pagamento"]; ?>" type="hidden">

                    <input class="form-control py-1" value="<?php echo $usuario["id_usuario"]; ?>" name="id_usuario" type="hidden">

                    <label><b>Observações</b></label><textarea style="height: 110px;" class="form-control py-1" value="observacoes" type="text"name="observacoes"><?php echo $value["observacoes"]; ?> </textarea>
                    <br>



                    <input class="btn btn-warning btn btn-block" type="submit" value="Enviar" style="font-weight: bold;">
                </form>


            </div>
            <div class="modal-footer">

                <button onclick="atualizar()" type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>


            </div>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.21.0/basic/ckeditor.js"></script>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script type="text/javascript">
    function printtag(tagid) {
        var hashid = "#" + tagid;
        var tagname = $(hashid).prop("tagName").toLowerCase();
        var attributes = "";
        var attrs = document.getElementById(tagid).attributes;
        $.each(attrs, function (i, elem) {
            attributes += " " + elem.name + " ='" + elem.value + "' ";
        })
        var divToPrint = $(hashid).html();
        var head = "<html><head>" + $("head").html() + "</head>";
        var allcontent = head + "<body  onload='window.print()'   >" + "<" + tagname + attributes + ">" + divToPrint + "</" + tagname + ">" + "</body></html>";
        var newWin = window.open('', 'Print-Window');
        newWin.document.open();
        newWin.document.write(allcontent);
        newWin.document.close();
        // setTimeout(function(){newWin.close();},10);
    }
</script>
</div>
</div>
</div>
</div>

</div>

<script>
    const second = 1000;
    const minute = second * 60;
    const hour = minute * 60;
    const day = hour * 24;
    //FUNÇÃO PARA O CALCULO DO PAGAMENTO
    function pagamento() {
        let date_ini = new Date(document.form_pagamento.date_ini.value);
        let date_end = new Date(document.form_pagamento.date_end.value);

        let diff = date_end.getTime() - date_ini.getTime();

        //SEM VARIAÇÃO
        //let hora_padrao = document.form_pagamento.grades.value;

        let hora_padrao = 9.6;

        let v_horas = document.form_pagamento.valor_horas.value;

        let gaa = document.form_pagamento.grat_gaa.value;
        let gazr = document.form_pagamento.grat_gazr.value;
        let gaee = document.form_pagamento.grat_gaee.value;



        document.getElementById('valor_horas_pagas').innerText = v_horas;
        document.getElementById('v_horas_pagas').value = v_horas;



        if (diff >= 0) {
            document.getElementById('days').innerText = Math.floor(diff / day) + 1;
            var dias = document.getElementById('days').innerText = Math.floor(diff / day) + 1;
            document.getElementById('dias').value = dias;

        }
        else {
            document.getElementById('days').innerText = "----"
        }

        var limite = (diff / day);
        this.diasUteis(limite, date_ini, hora_padrao, v_horas, gaa, gazr, gaee)


    }
    //FUNÇÃO PARA VERIFICAR OS DIAS UTEIS DAS DATAS ESCOLHIDAS
    function diasUteis(limite, date_ini, hora_padrao, v_horas, gaa, gazr, gaee) {

        this.dias_uteis = 0;
        var segunda = 0
        var terca = 0
        var quarta = 0
        var quinta = 0
        var sexta = 0

        this.day = date_ini.getDay();
        for (f0 = 0; f0 <= limite; f0++) {
            if (this.day !== 5 && this.day !== 6) {
                this.dias_uteis += 1;

            }
            if (this.day == 0) {
                segunda += 1;
            }
            if (this.day == 1) {
                terca += 1;
            }
            if (this.day == 2) {
                quarta += 1;
            }
            if (this.day == 3) {
                quinta += 1;
            }
            if (this.day == 4) {
                sexta += 1;
            }

            if (this.day < 6) {
                this.day += 1;
            }
            else {
                this.day = 0;
            }
        }
        document.getElementById('dias_pagos').innerText = dias_uteis;
        var dias_pagos = document.getElementById('dias_pagos').innerText = dias_uteis;
        document.getElementById('d_pagos').value = dias_pagos;

        document.getElementById('seg').innerText = segunda;
        document.getElementById('ter').innerText = terca;
        document.getElementById('qua').innerText = quarta;
        document.getElementById('qui').innerText = quinta;
        document.getElementById('sex').innerText = sexta;




        this.matrizPagamento(segunda, terca, quarta, quinta, sexta, hora_padrao, v_horas, gaa, gazr, gaee)

    }
    //FUNÇÃO DA MATRIZ DO PAGAMENTO
    function matrizPagamento(segunda, terca, quarta, quinta, sexta, hora_padrao, v_horas, gaa, gazr, gaee) {

        let h_pagas = (segunda * hora_padrao) + (terca * hora_padrao) + (quarta * hora_padrao) + (quinta * hora_padrao) + (sexta * hora_padrao)

        document.getElementById('horas_pagas').innerText = h_pagas.toFixed(2);
        document.getElementById('h_pagas').value = h_pagas.toFixed(2);


        this.calcVencimento(h_pagas, v_horas, gaa, gazr, gaee);

    }
    //FUNÇÃO CALCULO VENCIMENTO
    function calcVencimento(h_pagas, v_horas, gaa, gazr, gaee) {

        let ven = h_pagas * v_horas;
        let gaped = ven * 0.3;

        let GAA = gaa * ven;
        let GAZR = gazr * ven;
        let GAEE = gaee * ven;

        console.log(gazr);

        document.getElementById('vencimento').innerText = ven.toFixed(2);
        document.getElementById('v_vencimento').value = ven.toFixed(2);

        document.getElementById('gaped').innerText = gaped.toFixed(2);
        document.getElementById('v_gaped').value = gaped.toFixed(2);

        if (document.getElementById("grat_gaa").checked == true) {
            document.getElementById('GAA').innerText = GAA.toFixed(2);
            document.getElementById('v_gaa').value = GAA.toFixed(2);
        }
        else {
            document.getElementById('GAA').innerText = "----";
            document.getElementById('v_gaa').value = 0.00;
        }

        if (document.getElementById("grat_gazr").checked == true) {
            document.getElementById('GAZR').innerText = GAZR.toFixed(2);
            document.getElementById('v_gazr').value = GAZR.toFixed(2);
        }
        else {
            document.getElementById('GAZR').innerText = "----";
            document.getElementById('v_gazr').value = 0.00;
        }

        if (document.getElementById("grat_gaee").checked == true) {
            document.getElementById('GAEE').innerText = GAEE.toFixed(2);
            document.getElementById('v_gaee').value = GAEE.toFixed(2);
        }
        else {
            document.getElementById('GAEE').innerText = "----";
            document.getElementById('v_gaee').value = 0.00;
        }

        somaVencimentoGratificacoes(ven, gaped, GAA, GAZR, GAEE)

    }
    //FUNÇÃO DA SOMA DO VENCIMENTO COM AS GRATIFICAÇÕES
    function somaVencimentoGratificacoes(ven, gaped, GAA, GAZR, GAEE) {

        //SEM AS GRATIFICAÇÕES
        if (document.getElementById("grat_gaa").checked == false
            && document.getElementById("grat_gazr").checked == false
            && document.getElementById("grat_gaee").checked == false) {
            document.getElementById('soma_vencimento_gratificacoes').innerText = (ven + gaped).toFixed(2);
            document.getElementById('v_soma').value = (ven + gaped).toFixed(2);
            document.getElementById('um_doze_avos').innerText = ((ven + gaped) / 12).toFixed(2);
            document.getElementById('v_um_doze_avos').value = ((ven + gaped) / 12).toFixed(2)
        }
        //COM A GAA
        if (document.getElementById("grat_gaa").checked == true
            && document.getElementById("grat_gazr").checked == false
            && document.getElementById("grat_gaee").checked == false) {
            document.getElementById('soma_vencimento_gratificacoes').innerText = (ven + gaped + GAA).toFixed(2);
            document.getElementById('v_soma').value = (ven + gaped + GAA).toFixed(2);
            document.getElementById('um_doze_avos').innerText = ((ven + gaped + GAA) / 12).toFixed(2);
            document.getElementById('v_um_doze_avos').value = ((ven + gaped + GAA) / 12).toFixed(2);
        }

        //COM A GAA E GAZR
        if (document.getElementById("grat_gaa").checked == true
            && document.getElementById("grat_gazr").checked == true
            && document.getElementById("grat_gaee").checked == false) {
            document.getElementById('soma_vencimento_gratificacoes').innerText = (ven + gaped + GAA + GAZR).toFixed(2);
            document.getElementById('v_soma').value = (ven + gaped + GAA + GAZR).toFixed(2);
            document.getElementById('um_doze_avos').innerText = ((ven + gaped + GAA + GAZR) / 12).toFixed(2);
            document.getElementById('v_um_doze_avos').value = ((ven + gaped + GAA + GAZR) / 12).toFixed(2);
        }

        //COM A GAA, GAZR E GAEE
        if (document.getElementById("grat_gaa").checked == true
            && document.getElementById("grat_gazr").checked == true
            && document.getElementById("grat_gaee").checked == true) {
            document.getElementById('soma_vencimento_gratificacoes').innerText = (ven + gaped + GAA + GAZR + GAEE).toFixed(2);
            document.getElementById('v_soma').value = (ven + gaped + GAA + GAZR + GAEE).toFixed(2);
            document.getElementById('um_doze_avos').innerText = ((ven + gaped + GAA + GAZR + GAEE) / 12).toFixed(2);
            document.getElementById('v_um_doze_avos').value = ((ven + gaped + GAA + GAZR + GAEE) / 12).toFixed(2);
        }

        //COM A GAZR 
        if (document.getElementById("grat_gaa").checked == false
            && document.getElementById("grat_gazr").checked == true
            && document.getElementById("grat_gaee").checked == false) {
            document.getElementById('soma_vencimento_gratificacoes').innerText = (ven + gaped + GAZR).toFixed(2);
            document.getElementById('v_soma').value = (ven + gaped + GAZR).toFixed(2);
            document.getElementById('um_doze_avos').innerText = ((ven + gaped + GAZR) / 12).toFixed(2);
            document.getElementById('v_um_doze_avos').value = ((ven + gaped + GAZR) / 12).toFixed(2);
        }

        //COM A GAZR E GAEE
        if (document.getElementById("grat_gaa").checked == false
            && document.getElementById("grat_gazr").checked == true
            && document.getElementById("grat_gaee").checked == true) {
            document.getElementById('soma_vencimento_gratificacoes').innerText = (ven + gaped + GAZR + GAEE).toFixed(2);
            document.getElementById('v_soma').value = (ven + gaped + GAZR + GAEE).toFixed(2);
            document.getElementById('um_doze_avos').innerText = ((ven + gaped + GAZR + GAEE) / 12).toFixed(2);
            document.getElementById('v_um_doze_avos').value = ((ven + gaped + GAZR + GAEE) / 12).toFixed(2);
        }

        //COM GAEE
        if (document.getElementById("grat_gaa").checked == false
            && document.getElementById("grat_gazr").checked == false
            && document.getElementById("grat_gaee").checked == true) {
            document.getElementById('soma_vencimento_gratificacoes').innerText = (ven + gaped + GAEE).toFixed(2);
            document.getElementById('v_soma').value = (ven + gaped + GAEE).toFixed(2);
            document.getElementById('um_doze_avos').innerText = ((ven + gaped + GAEE) / 12).toFixed(2);
            document.getElementById('v_um_doze_avos').value = ((ven + gaped + GAEE) / 12).toFixed(2);
        }

        //COM GAEE e GAA
        if (document.getElementById("grat_gaa").checked == true
            && document.getElementById("grat_gazr").checked == false
            && document.getElementById("grat_gaee").checked == true) {
            document.getElementById('soma_vencimento_gratificacoes').innerText = (ven + gaped + GAEE + GAA).toFixed(2);
            document.getElementById('v_soma').value = (ven + gaped + GAEE + GAA).toFixed(2);
            document.getElementById('um_doze_avos').innerText = ((ven + gaped + GAEE + GAA) / 12).toFixed(2);
            document.getElementById('v_um_doze_avos').value = ((ven + gaped + GAEE + GAA) / 12).toFixed(2);
        }

    }

    function atualizar() {
        location.reload()
    }


</script>


<script type="text/javascript">


  $(".js-example-basic-single").select2({

  });

</script>

<script>
  CKEDITOR.replace('observacoes');
</script>
