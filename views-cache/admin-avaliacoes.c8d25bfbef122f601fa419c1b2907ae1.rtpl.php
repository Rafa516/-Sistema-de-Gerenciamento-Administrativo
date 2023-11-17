<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
    <div class="content-inside">
      <div class="my-4">
        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
          <li class="nav-item">
            <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
              role="tab" aria-controls="home" aria-selected="false"><b>Avaliações
              </b></a>
  
          </li>
        </ul>
        <form action="/admin/avaliacoes" method="get">
  
          <a style="width: 20%;" href="/admin/cadastrar-avaliacao" class="btn btn-primary btn-sm"><i
              class="fa fa-plus-circle" aria-hidden="true"></i><b> Cadastrar Avaliação</b></a>
  
          <div style="float:right;" class="input-group-prepend">
  
  
            <select style="width: 80%;" class="form-control py-1" id="search" name="search">
              <option value=""></option>
              <option value="1° - 2023">1° - 2023</option>
              <option value="2° - 2023">2° - 2023</option>
              <option value="1° - 2024">1° - 2024</option>
              <option value="2° - 2024">2° - 2024</option>
              <option value="1° - 2025">1° - 2025</option>
              <option value="2° - 2025">2° - 2025</option>
              <option value="1° - 2026">1° - 2026</option>
              <option value="2° - 2026">2° - 2026</option>
            </select>
  
            <button class="btn btn" style="background-color: #2E9AFE;color: white" type="submit" id="search-btn"><i
                class="fa fa-search" style="font-size:13px;"> </i>
            </button>
  
  
  
  
          </div>
        </form>
  
  
  
        <?php if( $total > 0 ){ ?>
        <br><br>
  
        <?php if( $profileMsg != '' ){ ?>
        <div class="alert alert-success">
          <b><?php echo $profileMsg; ?></b>
        </div>
        <?php } ?>
        <div id="DivIdToPrint">
          <center>
            <h2>Avaliações Contratos Temporários<h2>
          </center><br>
  
  
  
          <div class="table-responsive">
            <table class=" table table-hover table-sm  table-bordered">
              <thead class="table table-dark">
                <tr style="font-size: 16px; font-weight: bold; ">
  
                  <th>
                    <center>Unidade Escolar<b>
                  </th>
                  <th>
                    <center>Código<b>
                  </th>
  
                  <th>
                    <center>Semestre<b>
                  </th>
  
                  <th>
                    <center>Situação<b>
                  </th>
  
  
  
                  <th>
                    <center>Observação<b>
                  </th>
  
  
                </tr>
              </thead>
              <tbody>
                <?php $counter1=-1;  if( isset($todasAvaliacoes) && ( is_array($todasAvaliacoes) || $todasAvaliacoes instanceof Traversable ) && sizeof($todasAvaliacoes) ) foreach( $todasAvaliacoes as $key1 => $value1 ){ $counter1++; ?>
                <tr style="font-size: 15px;font-weight: normal;">
  
                  <td>
                    <center><a style="text-decoration: none;" href="/admin/editar-avaliacao/<?php echo $value1["id_avaliacao"]; ?>"><?php echo $value1["sigla"]; ?></a>
                  </td>
                  <td>
                    <center>
                      <button
              onclick="deletar('<?php echo $value1["id_avaliacao"]; ?>','<?php echo $value1["sigla"]; ?>','/admin/avaliacao/delete/<?php echo $value1["id_avaliacao"]; ?>,<?php echo $usuario["nome_user"]; ?>','Excluir Avaliação')"
              class="btn btn-light btn-sm">
              <b><?php echo $value1["codigo"]; ?></b></button>
  
                  </td>
  
                  <td>
                    <center><?php echo $value1["semestre"]; ?>
                  </td>
                  <td>
                    <center><?php if( $value1["situacao"] == 'Finalizado' ){ ?>
                      <b style="color: green;"><center><?php echo $value1["situacao"]; ?></b>
                      <?php }elseif( $value1["situacao"] == 'Pendente' ){ ?>
                      <b style="color: red;"><center><?php echo $value1["situacao"]; ?></b>
                      <?php }else{ ?>
                      <b style="color: orange;"><center><?php echo $value1["situacao"]; ?></b>
                      <?php } ?>
                  </td>
  
  
  
                  <td >
                    <center><?php echo $value1["observacao"]; ?>
                  </td>
  
                </tr>
  
                <?php } ?>
  
              </tbody>
  
            </table><br>
  
          </div>
  
        </div><br>
  
        <button id='btn' value='Print' onclick='printtag("DivIdToPrint");' class="btn btn-primary btn-sm"
          style="margin-right: 5px;">
          <i class="fa fa-print"></i><b> Imprimir</b>
        </button>
  
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
  
        <hr class="my-4" />
  
        <a href="/admin/utilidades" class="btn btn-info btn-xs"><i class="fas fa-chevron-circle-left"></i><b>
            Voltar</b></a>
  
  
  
  
      </div>
  
  
    </div>
  
  </div>
  
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