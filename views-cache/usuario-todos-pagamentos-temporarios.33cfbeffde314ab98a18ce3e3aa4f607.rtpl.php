<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="content-inside">
    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
            role="tab" aria-controls="home" aria-selected="false"><b>Cálculos de Pagamentos -
              <?php if( $total == 0 ){ ?>
              Nenhum Registrado
              <?php }elseif( $total == 1 ){ ?>
              <?php echo $total; ?> Registrado
              <?php }else{ ?>
              <?php echo $total; ?> Registrados
              <?php } ?> </b></a>

        </li>

      </ul>



      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalCalcularPagamento"><i
          class="fas fa-calculator"></i> Calcular Pagamento</button>

      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalInformacoesGrade"><i
          class="fas fa-info-circle"></i> Grade Horária</button>

      <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalInformacoesHorasPagas"><i
          class="fas fa-info-circle"></i> Horas Pagas</button><br><br>




      <?php if( $total > 0 ){ ?>
      <div class="search" style="float: right">
        <form action="/usuario/pagamentos-temporarios" method="get">
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Digite sua pesquisa...">
            <span class="input-group-btn">
              <button class="btn btn" style="background-color: #2E9AFE;color: white" type="submit" id="search-btn"><i
                  class="fa fa-search" style="font-size:13px;"> PESQUISAR</i>
              </button>
            </span>
          </div>
        </form>
      </div><br><br>

      <?php if( $profileMsg != '' ){ ?>
      <div class="alert alert-success">
        <b><?php echo $profileMsg; ?></b>
      </div>
      <?php } ?>


      <div class="table-responsive">
        <table class=" table table-hover table-sm  table-bordered">
          <thead class="table table-dark">
            <tr style="font-size: 16px; font-weight: bold; ">




              <th>
                <center>Cod. Carência <b>
              </th>

              <th>
                <center>Nome <b>
              </th>
              <th>
                <center>Matrícula <b>
              </th>

              <th>
                <center>CPF <b>
              </th>


              <th>
                <center>Mês de Referência
              </th>


              <th>
                <center>Visualizar
              </th>

              <th>
                <center>Excluir
              </th>


            </tr>
          </thead>
          <tbody>
            <?php $counter1=-1;  if( isset($pagamentos) && ( is_array($pagamentos) || $pagamentos instanceof Traversable ) && sizeof($pagamentos) ) foreach( $pagamentos as $key1 => $value1 ){ $counter1++; ?>
            <tr style="font-size: 15px;font-weight: normal;">

              <td>
                <center><?php echo $value1["cod_carencia"]; ?>

              </td>

              <td>
                <center><?php echo $value1["nome"]; ?>
              </td>

              <td>
                <center><?php echo $value1["matricula"]; ?>
              </td>

              <td>
                <center><?php echo $value1["cpf"]; ?>
              </td>

              <td>
                <center><?php echo $value1["mes"]; ?>
              </td>

              <td>
                <center> <a href="/usuario/pagamento-visualizar/<?php echo $value1["id_pagamento"]; ?>" class="btn btn-primary btn-sm"><i
                      class="fas fa-eye" aria-hidden="true"></i><b></b></a>

              </td>

              <center>
                </td>
                <td>
                  <center>
                    <button
                      onclick="deletar('<?php echo $value1["id_pagamento"]; ?>','<?php echo $value1["nome"]; ?>','/usuario/pagamentos/delete/<?php echo $value1["id_pagamento"]; ?>','Excluir Cálculo de Pagamento')"
                      class="btn btn-danger btn-sm">
                      <i class="fas fa-trash-alt"></i>
                      <b></b></button>
                </td>


            </tr>

            <?php } ?>

          </tbody>

        </table><br>

      </div>



      <center>
        <div class="box-footer clearfix">
          <ul class="pagination">
            <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>
            <?php if( $pages == $value1["link"] ){ ?>
            <li> <a class="active" href="<?php echo $value1["link"]; ?>"><?php echo $value1["page"]; ?></a></li>
            <?php }else{ ?>
            <li><a href="<?php echo $value1["link"]; ?>"><?php echo $value1["page"]; ?></a></li>
            <?php } ?>
            <?php } ?>
        </div>
      </center>

      <?php } ?>
      <br><br><a href="/usuario/utilidades"  class="btn btn-info btn-xs"><i
          class="fas fa-chevron-circle-left"></i><b>
          Voltar</b></a>


      <hr class="my-4" />

    </div>


  </div>

  <!-- MODAL CALCULAR PAGAMENTO -->
  <div class="modal fade" id="modalCalcularPagamento" tabindex="-1" role="dialog"
    aria-labelledby="modalCalcularPagamentoTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Calcular <b>Pagamento</b> do Servidor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-group" name="form_pagamento" action="/usuario/registrar-pagamentos/enviar" method="post">

            <input class="form-control py-1" value="<?php echo $usuario["id_usuario"]; ?>" name="id_usuario" type="hidden">

            <label><b>Nome - Matrícula - CPF - Componente Curricular</b></label><br>
            <select class="form-control py-1" id="id_temporario" name="id_temporario" required
              style="width: 80%;display: inline-block">
              <option value=""></option>
              <?php $counter1=-1;  if( isset($temporarios) && ( is_array($temporarios) || $temporarios instanceof Traversable ) && sizeof($temporarios) ) foreach( $temporarios as $key1 => $value1 ){ $counter1++; ?>
              <option value="<?php echo $value1["id_temporario"]; ?>"><?php echo $value1["nome"]; ?> - <?php echo $value1["matricula"]; ?> - <?php echo $value1["cpf"]; ?> -
                <?php echo $value1["componente"]; ?>
              </option>

              
              <?php } ?>
            </select>


            <button style="margin-left:3%;" type="button" class="btn btn-primary" data-toggle="modal"
              data-target="#modalTemporarios" id="buttonsUtilidade"><b>
                <i class="fa fa-user"></i> Cadastrar CT</b>
            </button><br>


            <label><b>Código da Carência</b></label><input name="cod_carencia" id="cod_carencia" type="text"
              class="form-control py-1" required>

            <label><b>Grade</b></label> <select class="form-control py-1" name="id_grade">
              <option value=""></option>
              <?php $counter1=-1;  if( isset($grades) && ( is_array($grades) || $grades instanceof Traversable ) && sizeof($grades) ) foreach( $grades as $key1 => $value1 ){ $counter1++; ?>
              <option value="<?php echo $value1["id_grade"]; ?>"><?php echo $value1["nome_progressao"]; ?>
              </option>
              <?php } ?>
            </select>



            <label><b>Mês de Referência</b></label> <select class="form-control py-1" name="id_horas_pagas">
              <option value=""></option>
              <?php $counter1=-1;  if( isset($horasPagas) && ( is_array($horasPagas) || $horasPagas instanceof Traversable ) && sizeof($horasPagas) ) foreach( $horasPagas as $key1 => $value1 ){ $counter1++; ?>
              <option value="<?php echo $value1["id_horas_pagas"]; ?>"><?php echo $value1["mes"]; ?>
              </option>
              <?php } ?>

            </select>

            <label><b>Valor da Hora Paga</b></label> <select class="form-control py-1" id="valor_horas">
              <option value=""></option>
              <?php $counter1=-1;  if( isset($horasPagas) && ( is_array($horasPagas) || $horasPagas instanceof Traversable ) && sizeof($horasPagas) ) foreach( $horasPagas as $key1 => $value1 ){ $counter1++; ?>
              <option value="<?php echo $value1["valor_horas"]; ?>"><?php echo $value1["id_horas_pagas"]; ?> - R$ <?php echo $value1["valor_horas"]; ?>
              </option>
              <?php } ?>

            </select>


            <label for="date_ini"><b>Data Inicial</b> </label>
            <input name="data_inicial" id="date_ini" type="date" class="form-control py-1" required>

            <label for="date_end"><b>Data Final</b> </label>
            <input name="data_final" id="date_end" type="date" class="form-control py-1" required><br>

            <label><b>Gratificações</b> </label>

            <div class="form-check">
              <input onclick="pagamento()" class="form-check-input" type="checkbox" id="grat_gaa" value="0.15">
              <label class="form-check-label">
                <b>GAA</b>

              </label>
            </div>

            <div class="form-check">
              <input onclick="pagamento()" class="form-check-input" type="checkbox" id="grat_gazr" value="0.15">
              <label class="form-check-label">
                <b>GAZR</b>

              </label>
            </div>

            <div onclick="pagamento()" class="form-check">
              <input class="form-check-input" type="checkbox" id="grat_gaee" value="0.15">
              <label class="form-check-label">
                <b>GAEE</b>

              </label>
            </div><br>


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
                    <td><span id="dias_pagos"></span><input type="hidden" id="d_pagos" name="dias_pagos" value=""></td>
                    <td><span id="horas_pagas"> </span><input type="hidden" id="h_pagas" name="horas_pagas" value="">
                    </td>
                    <td><span id="valor_horas_pagas"></span><input type="hidden" id="v_horas_pagas"
                        name="valor_horas_pagas" value=""></td>
                    <td><b><span id="vencimento"></b></span></span><input type="hidden" id="v_vencimento"
                        name="vencimento_pag" value=""></td>
                    <td><b><span id="gaped"></b></span><input type="hidden" id="v_gaped" name="gaped" value=""></td>
                    <td><b><span id="GAA"></b></span><input type="hidden" id="v_gaa" name="gaa" value=""></td>
                    <td><b><span id="GAZR"></b></span><input type="hidden" id="v_gazr" name="gazr" value=""></td>
                    <td><b><span id="GAEE"></b></span><input type="hidden" id="v_gaee" name="gaee" value=""></td>
                    <td><b><span id="soma_vencimento_gratificacoes"></b></span><input type="hidden" id="v_soma"
                        name="soma" value=""></td>
                    <td><b><span id="um_doze_avos"></b></span><input type="hidden" id="v_um_doze_avos"
                        name="um_doze_avos" value=""></td>

                  </tr>

                </tbody>

              </table>
            </div>




        </div>
        <div class="modal-footer">
          <button type="button" onclick="pagamento()" class="btn btn-primary">Calcular</button>
          <button type="button" onclick="limparDados()" class="btn btn-warning">Limpar Dados</button>
          <input class="btn btn-info" type="submit" value="Salvar">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>
          </form>

        </div>
      </div>
    </div>
  </div>


  <!-- MODAL CADASTRAR NOVO TEMPORÁRIO -->
  <div class="modal fade" id="modalTemporarios" tabindex="-1" role="dialog" aria-labelledby="modalTemporariosTitle"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Cadastrar Contrato Temporário</h5>
          <button onclick="atualizar()" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form class="form-group" action="/usuario/registrar-temporarios-modal-pagamentos/enviar" method="post">

            <div class="form-group"><label class="small mb-1"><b>Nome</b></label>
              <input class="form-control py-1" type="text" name="nome" required />
            </div>

            <div class="form-group"><label class="small mb-1"><b>Matrícula</b></label>
              <input class="form-control py-1" type="text" name="matricula" />
            </div>

            <div class="form-group"><label class="small mb-1"><b>CPF</b></label>
              <input class="form-control py-1" type="text" name="cpf" />
            </div>


            <div class="form-group"><label class="small mb-1"><b>Componente</b></label>
              <select class="form-control py-1" id="componente" name="componente" required>
                <option value="">
                  <?php $counter1=-1;  if( isset($componentes) && ( is_array($componentes) || $componentes instanceof Traversable ) && sizeof($componentes) ) foreach( $componentes as $key1 => $value1 ){ $counter1++; ?>
                <option value="<?php echo $value1["componente"]; ?>"><?php echo $value1["componente"]; ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group"><label class="small mb-1"><b>Ano</b></label>
              <select class="form-control py-1" id="ano" name="ano" required>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
              </select>
            </div>


            <input class="btn btn-primary btn btn-block" type="submit" value="Enviar">
          </form>


          <div class="modal-footer">

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL INFORMAÇÕES GRADE -->
  <div class="modal fade" id="modalInformacoesGrade" tabindex="-1" role="dialog"
    aria-labelledby="modalInformacoesGradeTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Informações da Grade Horária</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalGrade"> Cadastrar Grade
            Horária</button><br><br>

          <table class="table table-hover table-bordered">
            <thead class="table table-dark">
              <tr>
                <th>
                  <center>Nome
                </th>

                <th>
                  <center>Valor
                </th>

                <th>
                  <center>SEG
                </th>

                <th>
                  <center>TER
                </th>

                <th>
                  <center>QUA
                </th>

                <th>
                  <center>QUI
                </th>

                <th>
                  <center>SEX
                </th>

                <th>
                  <center>Ações
                </th>
              </tr>
            </thead>
            <tbody>
              <?php $counter1=-1;  if( isset($grades) && ( is_array($grades) || $grades instanceof Traversable ) && sizeof($grades) ) foreach( $grades as $key1 => $value1 ){ $counter1++; ?>
              <tr>

                <td>
                  <center> <?php echo $value1["nome_progressao"]; ?>

                </td>

                <td>
                  <center><?php echo $value1["valor"]; ?>

                </td>

                <td>
                  <center><?php echo $value1["hora_padrao"]; ?>

                </td>

                <td>
                  <center><?php echo $value1["hora_padrao"]; ?>

                </td>

                <td>
                  <center><?php echo $value1["hora_padrao"]; ?>

                </td>

                <td>
                  <center><?php echo $value1["hora_padrao"]; ?>

                </td>

                <td>
                  <center><?php echo $value1["hora_padrao"]; ?>

                </td>

                <td>
                  <center>
                    <button
                      onclick="deletar('<?php echo $value1["id_grade"]; ?>','<?php echo $value1["nome_progressao"]; ?>','/usuario/grade/delete/<?php echo $value1["id_grade"]; ?>','Excluir Grade')"
                      class="btn btn-danger btn-sm">
                      <i class="fas fa-trash-alt"></i>
                      <b></b></button>

                </td>




              </tr>
              <?php } ?>
            </tbody>
          </table>

        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>




        </div>
      </div>
    </div>
  </div>

  <!-- MODAL GRADE -->
  <div class="modal fade" id="modalGrade" tabindex="-1" role="dialog" aria-labelledby="modalCalcularPagamentoTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Cadastrar Grade Horária</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form class="form-group" action="/usuario/registrar-grade/enviar" method="post">
            <label><b>Nome Progressão</b></label><input name="nome_progressao" type="text" class="form-control py-1">
            <label><b>Valor</b></label> <select class="form-control py-1" id="valor" name="valor">
              <option value=""></option>
              <?php $counter1=-1;  if( isset($grades) && ( is_array($grades) || $grades instanceof Traversable ) && sizeof($grades) ) foreach( $grades as $key1 => $value1 ){ $counter1++; ?>
              <option value="<?php echo $value1["valor"]; ?>"><?php echo $value1["nome_progressao"]; ?> + 4

              </option>
              <?php } ?>
            </select><br>



            <input class="btn btn-primary btn btn-block" type="submit" value="Cadastrar">
          </form>

        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>




        </div>
      </div>
    </div>
  </div>

  <!-- MODAL INFORMAÇÕES DAS HORAS VAGAS  -->
  <div class="modal fade" id="modalInformacoesHorasPagas" tabindex="-1" role="dialog"
    aria-labelledby="modalInformacoesHorasPagasTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Informações das Horas Pagas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <table class="table table-hover table-bordered">
            <thead class="table table-dark">
              <tr>
                <th>
                  <center>Mês
                </th>

                <th>
                  <center>Valor da Hora Paga
                </th>

                <th>
                  <center>Vencimento
                </th>

                <th>
                  <center>Referência 1
                </th>

                <th>
                  <center>Referência 2
                </th>

                <th>
                  <center>Alterar
                </th>


              </tr>
            </thead>
            <tbody>
              <?php $counter1=-1;  if( isset($horasPagas) && ( is_array($horasPagas) || $horasPagas instanceof Traversable ) && sizeof($horasPagas) ) foreach( $horasPagas as $key1 => $value1 ){ $counter1++; ?>
              <tr>

                <td>
                  <center><?php echo $value1["mes"]; ?>

                </td>

                <td>
                  <center><?php echo $value1["valor_horas"]; ?>

                </td>

                <td>
                  <center><?php echo $value1["vencimento"]; ?>

                </td>

                <td>
                  <center><?php echo $value1["referencia1"]; ?>

                </td>

                <td>
                  <center><?php echo $value1["referencia2"]; ?>

                </td>

                <td>
                  <center>
                    <a href="/usuario/horas_pagas/editar/<?php echo $value1["id_horas_pagas"]; ?>" class="btn btn-success btn-sm"><i
                        class="fas fa-pen"></i>
                      <b></b></a>
                </td>





              </tr>
              <?php } ?>
            </tbody>
          </table>

        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>




        </div>
      </div>
    </div>
  </div>

  <!-- MODAL GRADE -->
  <div class="modal fade" id="modalHorasPagas" tabindex="-1" role="dialog" aria-labelledby="modalHorasPagasTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Alterar Valores das Horas Pagas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <form class="form-group" action="/usuario/registrar-grade/enviar" method="post">
            <label><b>Vencimento</b></label><input name="nome" type="text" class="form-control py-1">

            <label><b>Referência 1</b></label><input name="hora_padrao" value="9.6" type="number"
              class="form-control py-1">

            <label><b>Referência 2</b></label><input name="hora_padrao" value="9.6" type="number"
              class="form-control py-1"><br>

            <input class="btn btn-primary btn btn-block" type="submit" value="Cadastrar">
          </form>

        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Voltar</button>




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

  // FUNÇÃO PARA LIMPAR TODOS OS DADOS
  function limparDados() {


    document.form_pagamento.date_ini.value = "";
    document.form_pagamento.date_end.value = "";
    document.form_pagamento.valor_horas.value = "";
    document.form_pagamento.grat_gaa.value = "";
    document.form_pagamento.grat_gazr.value = "";
    document.form_pagamento.grat_gaee.value = "";

    document.getElementById('valor_horas_pagas').innerText = "";
    document.getElementById('v_horas_pagas').value = "";
    document.getElementById('days').innerText = "";
    document.getElementById('dias').value = "";
    document.getElementById('dias_pagos').innerText = "";
    document.getElementById('d_pagos').value = "";
    document.getElementById('seg').innerText = "";
    document.getElementById('ter').innerText = "";
    document.getElementById('qua').innerText = "";
    document.getElementById('qui').innerText = "";
    document.getElementById('sex').innerText = "";

    document.getElementById('horas_pagas').innerText = "";
    document.getElementById('h_pagas').value = "";
    document.getElementById('vencimento').innerText = "";
    document.getElementById('v_vencimento').value = "";

    document.getElementById('gaped').innerText = "";
    document.getElementById('v_gaped').value = "";
    document.getElementById('GAA').innerText = "";
    document.getElementById('v_gaa').value = "";
    document.getElementById('GAZR').innerText = "";
    document.getElementById('v_gazr').value = "";
    document.getElementById('GAEE').innerText = "";
    document.getElementById('v_gaee').value = "";
    document.getElementById('soma_vencimento_gratificacoes').innerText = "";
    document.getElementById('v_soma').value = "";
    document.getElementById('um_doze_avos').innerText = "";
    document.getElementById("grat_gaa").checked = false
    document.getElementById("grat_gazr").checked = false
    document.getElementById("grat_gaee").checked = false



  }
  function atualizar() {
    location.reload()
  }

</script>