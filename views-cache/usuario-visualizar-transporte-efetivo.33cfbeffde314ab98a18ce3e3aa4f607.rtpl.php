<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="content-inside">
    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color: #2E9AFE;color: white" class="nav-link
              active" id="home-tab" data-toggle="tab" role="tab" aria-controls="home"
            aria-selected="false"><b><?php echo $value["nome_servidor"]; ?> </b></a>
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
                    <h2>Auxílio Transporte <?php if( $value["referencia"] == 'Efetivos' ){ ?> Efetivos
                      <?php }elseif( $value["referencia"] == 'Vigilantes' ){ ?> Vigilantes
                      <?php } ?>

                      - <?php echo $value["mes"]; ?> - <?php echo $value["ano"]; ?> <h2>
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
                    <center>Unidade
                  </th>

                  <th>
                    <center>Nome
                  </th>

                  <th>
                    <center>Matrícula
                  </th>

                  <th>
                    <center>Carreira
                  </th>

                </thead>
                <td>
                  <center><?php echo $value["nome"]; ?>
                </td>

                <td>
                  <center><?php echo $value["nome_servidor"]; ?>
                </td>

                <td>
                  <center><?php echo $value["matricula"]; ?>

                </td>
                <td>
                  <center><?php echo $value["carreira"]; ?>

                </td>


                <b>Dados do servidor</b><br>
                <table class="table table-hover table-bordered">
                  <thead class="table table-dark">
                    <th colspan="4">
                      <center>Processo SEI
                    </th>
                    <th colspan="4">
                      <center>Data Processo SEI
                    </th>
                    <th colspan="4">
                      <center>Cidade
                    </th>

                  </thead>
                  <td colspan="4">
                    <center><?php echo $value["processo"]; ?>
                  </td>

                  <td colspan="4">

                    <?php if( $value["data_processo"] != '0000-00-00' ){ ?> <center><?php echo formatDate($value["data_processo"]); ?>
                      <?php }else{ ?> <center> ----
                        <?php } ?>

                  </td>

                  <td colspan="4">
                    <center><?php echo $value["cidade"]; ?>
                  </td>

                  <?php if( $value["referencia"] == 'Efetivos' ){ ?>
                  <b>Dados do Processo</b><br>
                  <?php } ?>

                  <?php if( numRepags($value["id_beneficio_efetivo"]) > 0 ){ ?>

                  <?php if( $value["referencia"] == 'Efetivos' ){ ?>
                  <table class="table table-hover table-bordered">
                    <thead class="table table-dark">

                      <th colspan="4">
                        <center>Total para Receber
                      </th>
                      <th colspan="4">
                        <center>Total para Devolver
                      </th>
                    </thead>

                    <td colspan="4">
                      <center><b>R$ <?php echo formatValor($value["total_transporte"]); ?></b>
                    </td>
                    <td colspan="4">
                      <center><b style="color: red;">R$ <?php echo formatValor($value["total_devolver"]); ?></b>
                    </td>
                    <?php } ?>

                      <?php if( $value["referencia"] == 'Vigilantes' ){ ?>
                      <b>Dados para o Auxílio Transporte</b><br>
                      <?php }else{ ?>
                      <b>Dados para o REPAG</b><br>
                      <?php } ?>

                    <?php } ?>

                    <?php $counter1=-1;  if( isset($repags) && ( is_array($repags) || $repags instanceof Traversable ) && sizeof($repags) ) foreach( $repags as $key1 => $value1 ){ $counter1++; ?>

                    <!-- ----------------------------- -->



                    <!-- TABELA REPAGS-->

                    <table class="table table-hover table-bordered">
                      <thead class="table table-dark">

                        <th>
                          <center>Folha Frequência
                        </th>
                        <th colspan="2">
                          <center>Itinerário
                        </th>
                        <th>
                          <center>Dias Trabalhados
                        </th>

                        <th colspan="2">
                          <center>Vencimento
                        </th>

                      </thead>

                      <td>
                        <center><b><?php echo $value1["frequencia"]; ?> - <?php echo $value1["ano_frequencia"]; ?></b>
                      </td>
                      <td colspan="2">
                        <center><a target="_blank"
                            href="/usuario/itinerario-visualizar/<?php echo $value1["id_itinerarios"]; ?>"><?php echo $value1["nome_itinerario"]; ?></a>
                      </td>
                      <td>
                        <center><?php echo $value1["dias"]; ?>
                      </td>

                      <td colspan="2">
                        <center>R$ <?php echo formatValor($value1["vencimento"]); ?>
                      </td>
                      <thead class="table table-dark">
                        <th colspan="8">
                          <center>Valores
                        </th>
                      </thead>
                      <thead style="background-color:#D3D3D3">



                        <th>
                          <center><button type="button" class="btn btn-secondary  btn-sm" disabled>
                              <b style="color: black;">Jus</b>
                            </button>
                        </th>

                        <th>
                          <center><button type="button" class="btn btn-secondary  btn-sm" disabled>
                              <b style="color: black;">Recebeu</b>
                            </button>
                        </th>

                        <th>
                          <center><button type="button" class="btn btn-secondary  btn-sm" disabled>
                              <b style="color: black;">Custeio</b>
                            </button>
                        </th>

                        <th>
                          <center><button type="button" class="btn btn-primary  btn-sm" disabled>
                              <b style="color: black;">Receber</b>
                            </button>
                        </th>

                        <th>
                          <center><button type="button" class="btn btn-danger  btn-sm" disabled>
                              <b style="color: black;">Devolver</b>
                            </button>
                        </th>

                        <th>
                          <center> Ações

                            </tr>
                      </thead>
                      <tbody>

                        <tr>
                          <td>
                            <center>R$ <?php echo formatValor($value1["jus"]); ?>
                          </td>

                          <td>
                            <center>R$ <?php echo formatValor($value1["valor_recebido"]); ?>
                          </td>

                          <td>
                            <center>R$ <?php echo formatValor($value1["custeio"]); ?>
                          </td>

                          <td>
                            <center><b>R$ <?php echo formatValor($value1["receber"]); ?></b>
                          </td>

                          <td>
                            <center><b style="color: red;">R$ <?php echo formatValor($value1["devolver"]); ?></b>
                          </td>

                          <td>
                            <center><a href="/usuario/alterar-repag-transporte-efetivo/<?php echo $value1["id_repag_efetivo"]; ?>"
                                class="btn btn-success btn-sm"><i class="fas fa-pen"></i><b></b></a>


                              <button
                                onclick="deletar('<?php echo $value1["id_repag_efetivo"]; ?>','<?php echo $value1["frequencia"]; ?>','/usuario/repag/delete/<?php echo $value1["id_repag_efetivo"]; ?>,<?php echo $usuario["nome_user"]; ?>','Excluir Repag')"
                                class="btn btn-danger btn-sm">
                                <i class="fas fa-trash-alt"></i>
                                <b></b></button>
                            </center>
                          </td>



                        </tr>


                        <?php } ?>
                        <!-- ----------------------------- -->
                      </tbody>
                    </table>



                    <?php if( $value["obs_transporte_efetivo"] != NULL OR $value["obs_transporte_efetivo"] != ''  ){ ?>
                    <table class="table table-hover table-bordered">
                      <thead class="table table-dark">

                        <b>Observações</b><br>
                        <th>
                          <center>Observações em geral
                        </th>

                        </tr>
                      </thead>
                      <tbody>

                        <tr>
                          <td><?php echo $value["obs_transporte_efetivo"]; ?>
                          </td>
                        </tr>


                    </table>
                    <?php } ?>


        </div>


      </div>
    </div>


    <i>Última alteração registrada pelo(a) usuário(a)<b> <?php echo $value["nome_user"]; ?></b> em
      <b><?php echo formatDateHoras($value["dt_registro_beneficio"]); ?>.</b></i><br>


    <br><button id='btn' value='Print' onclick='printtag("DivIdToPrint");' class="btn btn-primary btn-sm">
      <i class="fa fa-print"></i><b> Imprimir</b>
    </button>

    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalAlterarDados"><i
        class="fas fa-pen"></i> Alterar</button>

    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalObservacoes"><i
        class="fas fa-info-circle"></i><b> Observações</b></button>


    <?php if( $value["referencia"] == 'Vigilantes' ){ ?>
    <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalCalcularRepag"><i
        class="fas fa-calculator"></i><b> Calcular Benefício</b></button>
    <?php }else{ ?>
    <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalCalcularRepag"><i
        class="fas fa-calculator"></i><b> Calcular REPAG</b></button>
    <?php } ?>



    <hr class="my-4" />

    <a href="/usuario/beneficio/transporte-efetivos" class="btn btn-info btn-xs"><i
        class="fas fa-chevron-circle-left"></i><b>
        Voltar</b></a>
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
        <form class="form-group" action="/usuario/incluir-observacao/enviar/<?php echo $value["id_beneficio_efetivo"]; ?>"
          method="post">
          <input class="form-control py-1" value="<?php echo $value["id_beneficio_efetivo"]; ?>" type="hidden">

          <input class="form-control py-1" value="<?php echo $usuario["id_usuario"]; ?>" name="id_usuario" type="hidden">

          <label><b>Observações</b></label><textarea style="height: 110px;" class="form-control py-1"
            value="obs_transporte_efetivo" type="text"
            name="obs_transporte_efetivo"><?php echo $value["obs_transporte_efetivo"]; ?> </textarea>
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


<!-- MODAL CALCULAR REPAG -->
<div class="modal fade" id="modalCalcularRepag" tabindex="-1" role="dialog" aria-labelledby="modalCalcularRepagTitle"
  aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <?php if( $value["referencia"] == 'Vigilantes' ){ ?>
        <h5 class="modal-title" id="exampleModalLongTitle">Calcular Auxílio Transporte</h5>
        <?php }else{ ?>
        <h5 class="modal-title" id="exampleModalLongTitle">Calcular REPAG</h5>
        <?php } ?>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-group" name="form_repag"
          action="/usuario/registrar-repag-transporte-efetivo/<?php echo $value["id_beneficio_efetivo"]; ?>" method="post">


          <input value="<?php echo $value["id_beneficio_efetivo"]; ?>" name="id_beneficio_efetivo" type="hidden">

          <label>Folha Frequência</label> <select class="form-control py-1" id="frequencia" name="frequencia" required>
            <option value=""></option>
            <option value="1-Janeiro">1-Janeiro</option>
            <option value="2-Fevereiro">2-Fevereiro</option>
            <option value="3-Março">3-Março</option>
            <option value="4-Abril">4-Abril</option>
            <option value="5-Maio">5-Maio</option>
            <option value="6-Junho">6-Junho</option>
            <option value="7-Julho">7-Julho</option>
            <option value="8-Agosto">8-Agosto</option>
            <option value="9-Setembro">9-Setembro</option>
            <option value="10-Outubro">10-Outubro</option>
            <option value="11-Novembro">11-Novembro</option>
            <option value="12-Dezembro">12-Dezembro</option>
          </select>

          <label>Folha Frequência Ano</label> <select class="form-control py-1" name="ano_frequencia" required>
            <option value=""></option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2026">2027</option>
          </select>


          <!-- <label>Itinerário</label> <select class="form-control py-1" id="itinerarios" name="itinerarios">
            <option value=""></option>
            <?php $counter1=-1;  if( isset($itinerarios) && ( is_array($itinerarios) || $itinerarios instanceof Traversable ) && sizeof($itinerarios) ) foreach( $itinerarios as $key1 => $value1 ){ $counter1++; ?>
            <option value="<?php echo $value1["valor_total"]; ?>"><?php echo $value1["nome_itinerario"]; ?> - R$
              <?php echo formatValor($value1["valor_total"]); ?>
            </option>

            <?php } ?>
          </select> -->

          <label>Itinerário</label><input value="<?php echo $value["nome_itinerario"]; ?>" type="text" class="form-control py-1"
            disabled>
          <input value="<?php echo $value["valor_total"]; ?>" name="itinerarios" id="itinerarios" type="hidden"
            class="form-control py-1" disabled>

          <label>Dias Trabalhados</label><input min="0" max="31" name="dias" id="dias" type="number"
            class="form-control py-1">

          <label>Valor Recebido R$</label><input min="0" max="10000" step=".01" type="number" name="valor_recebido"
            id="vr_recebido" class="form-control py-1">

          <label>Vencimento R$</label><input min="0" max="10000" step=".01" type="number" name="vencimento"
            id="vencimento_b" class="form-control py-1"><br>



          <div class="table-responsive">
            <table class="table table-hover table-bordered">
              <thead style="background-color:#D3D3D3">
                <th>
                  <center><button type="button" class="btn btn-secondary  btn-sm" data-toggle="tooltip"
                      data-placement="top" title="Dias trabalhados * valor total diário do Itinerário" disabled>
                      Jus
                    </button>
                </th>
                <th>
                  <center><button type="button" class="btn btn-secondary  btn-sm" data-toggle="tooltip"
                      data-placement="top"
                      title="Caso haja algum valor já lançado na folha referente ao benefício, adicione-o" disabled>
                      Recebeu
                    </button>
                </th>
                <th>
                  <center><button type="button" class="btn btn-secondary  btn-sm" data-toggle="tooltip"
                      data-placement="top" title="Vencimento (Salário) * 6% (0,06), 6% em cima do Salário ou Vencimento, vale lembrar se o Custeio for maior que o Jus 
                          não terá valor pra receber, o sistema SIGRH automaticamente não lança." disabled>
                      Custeio
                    </button>
                </th>
                <th>
                  <center><button type="button" class="btn btn-primary  btn-sm" data-toggle="tooltip"
                      data-placement="top" title="Jus - Recebeu - Custeio" disabled>
                      Receber
                    </button>
                </th>
                <th>
                  <center><button type="button" class="btn btn-danger  btn-sm" data-toggle="tooltip"
                      data-placement="top" title="Recebeu - Jus - Custeio" disabled>
                      Devolver
                    </button>
                </th>

                </tr>
              </thead>
              <tbody>

                <tr>
                  <td><span id="jus_b"></span><input type="hidden" id="jus_beneficio" name="jus" value=""></td>
                  <td><span id="valorRecebido"></span> <input type="hidden" id="vr_beneficio" name="valor_recebido"
                      value=""></td>
                  <td><span id="custeio_b"></span><input type="hidden" id="custeio_beneficio" name="custeio" value="">
                  </td>
                  <td><b><span id="receber_b"></b></span><input type="hidden" id="receber_beneficio" name="receber"
                      value=""></td>
                  <td><b style="color: red;"><span id="devolver_b"></b></span><input type="hidden"
                      id="devolver_beneficio" name="devolver" value=""></td>

                </tr>

              </tbody>

            </table>
          </div>



      </div>
      <div class="modal-footer">
        <button type="button" onclick="calcularRepag()" class="btn btn-primary">Calcular</button>
        <button type="button" onclick="limparDados()" class="btn btn-warning">Limpar Dados</button>
        <input class="btn btn-info" type="submit" value="Salvar">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>

        </form>

      </div>


    </div>
  </div>
</div>
</div>


<!-- MODAL ALTERAR DADOS  -->
<div class="modal fade" id="modalAlterarDados" tabindex="-1" role="dialog" aria-labelledby="modalAlterarDadosTitle"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Alterar dados do Auxílio Transporte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-group" action="/usuario/transporte/editar/<?php echo $value["id_beneficio_efetivo"]; ?>" method="post">

          <input type="hidden" name="beneficio" value="Auxílio Transporte">
          <input value="<?php echo $usuario["id_usuario"]; ?>" name="id_usuario" type="hidden">

          <label>Servidor - Matrícula - Carreira - Unidade</label>
          <select class="form-control py-1" id="componente" name="id_efetivo" required>
            <option value="<?php echo $value["id_efetivo"]; ?>"><?php echo $value["nome_servidor"]; ?> - <?php echo $value["matricula"]; ?> - <?php echo $value["carreira"]; ?> -
              <?php echo $value["sigla"]; ?></option>
            <?php $counter1=-1;  if( isset($efetivos) && ( is_array($efetivos) || $efetivos instanceof Traversable ) && sizeof($efetivos) ) foreach( $efetivos as $key1 => $value1 ){ $counter1++; ?>
            <option value="<?php echo $value1["id_efetivo"]; ?>"><?php echo $value1["nome_servidor"]; ?> - <?php echo $value1["matricula"]; ?> - <?php echo $value1["carreira"]; ?> -
              <?php echo $value1["sigla"]; ?> </option>
            <?php } ?>
          </select>

          <label>Itinerário</label> <select class="form-control py-1" name="id_itinerarios" required>
            <option value="<?php echo $value["id_itinerarios"]; ?>"><?php echo $value["nome_itinerario"]; ?>
            </option>
            <?php $counter1=-1;  if( isset($itinerarios) && ( is_array($itinerarios) || $itinerarios instanceof Traversable ) && sizeof($itinerarios) ) foreach( $itinerarios as $key1 => $value1 ){ $counter1++; ?>
            <option value="<?php echo $value1["id_itinerarios"]; ?>"><?php echo $value1["nome_itinerario"]; ?>
            </option>

            <?php } ?>
          </select>


          <label>Mês</label> <select class="form-control py-1" id="mes" name="mes" required>
            <option value="<?php echo $value["mes"]; ?>"><?php echo $value["mes"]; ?>
            </option>
            <option value="01 - Janeiro">01 - Janeiro</option>
            <option value="02 - Fevereiro">02 - Fevereiro</option>
            <option value="03 - Março">03 - Março</option>
            <option value="04 - Abril">04 - Abril</option>
            <option value="05 - Maio">05 - Maio</option>
            <option value="06 - Junho">06 - Junho</option>
            <option value="07 - Julho">07 - Julho</option>
            <option value="08 - Agosto">08 - Agosto</option>
            <option value="09 - Setembro">09 - Setembro</option>
            <option value="10 - Outubro">10 - Outubro</option>
            <option value="11 - Novembro">11 - Novembro</option>
            <option value="12 - Dezembro">12 - Dezembro</option>

          </select>

          <label>Ano</label> <select class="form-control py-1" name="ano" required>
            <option value="<?php echo $value["ano"]; ?>"><?php echo $value["ano"]; ?>
            </option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2026">2027</option>
          </select>

          <label>Processo SEI</label><input name="processo" type="text" class="form-control py-1"
            value="<?php echo $value["processo"]; ?>">

          <label>Data Processo</label><input name="data_processo" type="date" class="form-control py-1"
            value="<?php echo $value["data_processo"]; ?>">

          <label>Situação</label> <select class="form-control py-1" id="situacao" name="situacao" required>
            <option value="<?php echo $value["situacao"]; ?>"><?php echo $value["situacao"]; ?>
            </option>
            <option value="Incluído no Sistema e Solicitar REPAG">Incluído no Sistema e Solicitar REPAG</option>
            <option value="Incluído no Sistema">Incluído no Sistema</option>
            <option value="Falta Incluir no Sistema">Falta Incluir no Sistema</option>
            <option value="Ajustar Benefício">Ajustar Benefício</option>
            <option value="Incluído no Sistema e REPAG Solicitado">Incluído no Sistema e REPAG Solicitado</option>
            <option value="Incluído no Sistema e REPAG Efetuado">Incluído no Sistema e REPAG Efetuado</option>
          </select>

          <label>Referência</label> <select class="form-control py-1" id="referencia" name="referencia" required>
            <option value="<?php echo $value["referencia"]; ?>"><?php echo $value["referencia"]; ?>
            </option>
            <option value="Efetivos">Efetivos</option>
            <option value="Vigilantes">Vigilantes</option>

          </select>





      </div>
      <div class="modal-footer">

        <input onclick="alterarRepag()" class="btn btn-success" type="submit" value="Alterar">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>

        </form>

      </div>
    </div>
  </div>
</div>




</div>
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

<script type="text/javascript">


  //FUNÇÃO PARA REALIZAR OS CALCULOS DO REPAG
  function calcularRepag() {
    let dias = document.form_repag.dias.value;
    let valor_itinerario = document.form_repag.itinerarios.value;
    let jus = dias * valor_itinerario;
    let valor_recebido = document.form_repag.vr_recebido.value;
    let vencimento = document.form_repag.vencimento_b.value;
    let custeio = vencimento * 0.06;
    let receber = jus.toFixed(2) - valor_recebido - custeio;
    let devolver = valor_recebido - jus.toFixed(2);


    document.getElementById('jus_b').innerText = jus.toFixed(2).replace(".", ",");
    document.getElementById('jus_beneficio').value = jus.toFixed(2);

    document.getElementById('valorRecebido').innerText = valor_recebido.replace(".", ",");
    if (valor_recebido > 0) {
      document.getElementById('vr_beneficio').value = valor_recebido.replace(".", ",");
    }

    document.getElementById('custeio_b').innerText = custeio.toFixed(2).replace(".", ",");
    document.getElementById('custeio_beneficio').value = custeio.toFixed(2);




    if (jus > valor_recebido) {
      document.getElementById('receber_b').innerText = receber.toFixed(2).replace(".", ",");
      document.getElementById('receber_beneficio').value = receber.toFixed(2);
      document.getElementById('devolver_beneficio').value = 0;
      document.getElementById('devolver_b').innerText = 0;
      document.getElementById('vr_beneficio').value = 0;
    }
    if (jus < valor_recebido || receber < 0) {
      document.getElementById('devolver_b').innerText = devolver.toFixed(2).replace(".", ",");
      document.getElementById('receber_b').innerText = 0;
      document.getElementById('devolver_beneficio').value = devolver.toFixed(2);
      document.getElementById('receber_beneficio').value = 0;
    }
    if (jus > valor_recebido && custeio > jus) {
      document.getElementById('receber_b').innerText = "0,00"
      document.getElementById('receber_beneficio').value = 0;
      document.getElementById('devolver_beneficio').value = 0;
      document.getElementById('devolver_b').innerText = 0;
    }

  }


  // FUNÇÃO PARA LIMPAR TODOS OS DADOS
  function limparDados() {

    document.getElementById('jus_b').innerText = "";
    document.getElementById('valorRecebido').innerText = "";
    document.getElementById('custeio_b').innerText = "";
    document.getElementById('receber_b').innerText = "";
    document.getElementById('devolver_b').innerText = "";
    document.form_repag.dias.value = "";
    document.form_repag.itinerarios.value = "";
    document.form_repag.vr_recebido.value = "";
    document.form_repag.vencimento.value = "";
    document.form_repag.frequencia.value = "";
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
  CKEDITOR.replace('obs_transporte_efetivo');
</script>