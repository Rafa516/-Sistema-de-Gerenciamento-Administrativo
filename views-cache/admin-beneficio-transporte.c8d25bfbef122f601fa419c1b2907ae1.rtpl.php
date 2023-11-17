<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
  <div class="content-inside">
    <div class="my-4">
      <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
        <li class="nav-item">
          <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
            role="tab" aria-controls="home" aria-selected="false"><b>Auxílio Transporte - 
              <?php if( $total == 0 ){ ?>
              Nenhum Registrado
              <?php }elseif( $total == 1 ){ ?>
              <?php echo $total; ?> Registrado
              <?php }else{ ?>
              <?php echo $total; ?> Registrados
              <?php } ?></b></a>

        </li>

      </ul>

          

        <a style="width: 20%;" href="/admin/registrar-beneficios"class="btn btn-primary btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i><b> Cadastrar Benefício</b></a>
        <a href="/admin/beneficio/alimentacao" class="btn btn-info btn-sm"><i class="fas fa-bread-slice"></i><b> Auxílio Alimentação</b></a> 

        <button class="btn btn-success  btn-sm" onclick="tableToExcel('Benefício_transporte.xls', '#tblExport')">
          <i class="fas fa-file-excel"></i><b> Exportar Excel</b></button>
        <a id="link-to-download" style="display: none;"></a>

      <?php if( $total > 0 ){ ?>  
      <div class="search" style="float: right">
        <form action="/admin/beneficio/transporte" method="get">
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


      <div  id="tblExport" class="table-responsive">
        <table class=" table table-hover table-sm  table-bordered">
          <thead class="table table-dark">
            <tr style="font-size: 16px; font-weight: bold; ">




             
              <th>
                <center>Nome
              </th>

               <th>
                <center>Matricula
              </th>
               <th>
                <center>CPF
              </th>
              <th>
                <center>Carência
              </th>
              <th>
                <center>Folha
              </th>
              <th>
                <center>Situação
              </th>
               <th>
                <center>Exercício
              </th>
             <th class="remover">
              <center >Visualizar
            </th>
            <th class="remover">
              <center>Excluir
            </th>
             

            </tr>
          </thead>
          <tbody>
            <?php $counter1=-1;  if( isset($beneficios) && ( is_array($beneficios) || $beneficios instanceof Traversable ) && sizeof($beneficios) ) foreach( $beneficios as $key1 => $value1 ){ $counter1++; ?>
            <tr style="font-size: 15px;font-weight: normal;">

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
                <center> <center><?php if( $value1["carencia"] == 'Curta' ){ ?>
                <b style="color:red"><?php echo $value1["carencia"]; ?></b>
                <?php }else{ ?>
                 <b style="color:green"><?php echo $value1["carencia"]; ?></b>
                 <?php } ?>
              </td>
              <td>
                <center><?php echo $value1["mes"]; ?>/<?php echo $value1["ano"]; ?>
              </td>

                <td>                
              <?php if( $value1["situacao"] == 'Incluído no Sistema' ){ ?>
              <b style="color: green;"><center><?php echo $value1["situacao"]; ?></b>
              <?php }elseif( $value1["situacao"] == 'Incluído no Sistema e REPAG Efetuado' ){ ?>
              <b style="color: green;"><center><?php echo $value1["situacao"]; ?></b>
              <?php }elseif( $value1["situacao"] == 'Falta Incluir no Sistema' ){ ?>
              <b style="color: red;"><center><?php echo $value1["situacao"]; ?></b>
             <?php }elseif( $value1["situacao"] == 'Ajustar Benefício' ){ ?>
              <b style="color: orange;"><center><?php echo $value1["situacao"]; ?></b>
              <?php }elseif( $value1["situacao"] == 'Incluído no Sistema e Solicitar REPAG' ){ ?>
              <b style="color: orange;"><center><?php echo $value1["situacao"]; ?></b>
              <?php }else{ ?>
              <b style="color: blue;"><center><?php echo $value1["situacao"]; ?></b>
              <?php } ?>

            </td>

              <td>                
                 <?php if( $value1["exercicio"] == 'Em Exercício' ){ ?>
              <b style="color: green;"><center><?php echo $value1["exercicio"]; ?></b>
              <?php }elseif( $value1["exercicio"] == 'Finalizado' ){ ?>
              <b style="color: red;"><center><?php echo $value1["exercicio"]; ?></b>
              <?php }elseif( $value1["exercicio"] == 'E. Provisória' ){ ?>
              <b style="color: purple;"><center><?php echo $value1["exercicio"]; ?></b>             
              <?php }else{ ?>
              <b style="color: orange;"><center><?php echo $value1["exercicio"]; ?></b>
              <?php } ?>

              </td>
              
              <td>    
                <center> <a  href="/admin/beneficios-visualizar/<?php echo $value1["id_beneficio"]; ?>"
                  class="btn btn-primary btn-sm"><i class="fas fa-eye" aria-hidden="true"></i><b></b></a>
              </td>

               <td>
                  <center>
                    <button
                    onclick="deletar('<?php echo $value1["id_beneficio"]; ?>','<?php echo $value1["nome"]; ?>','/admin/beneficio/delete/<?php echo $value1["id_beneficio"]; ?>,<?php echo $usuario["nome_user"]; ?>','Excluir Transporte')"
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


      <br><br><a href="javascript:history.back()" class="btn btn-info btn-xs"><i class="fas fa-chevron-circle-left"></i><b>
          Voltar</b></a>


      <hr class="my-4" />

    </div>


  </div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script type="text/javascript">



const tableToExcel = (nome, table) => {
  let mimetype = 'application/vnd.ms-excel';
  let link = document.querySelector('#link-to-download');
  let tabela = document.querySelector(table);
  let clone = tabela.cloneNode(true);
  let remover = clone.querySelectorAll('.remover');

  remover.forEach((td) => {
      if (td.parentElement) {
          td.parentElement.removeChild(td);
      }
  });

  
  link.href = window.URL.createObjectURL(new Blob(['\ufeff'+clone.outerHTML], {
      type: mimetype
  }));
  link.download = nome;
  link.click();
};

</script>