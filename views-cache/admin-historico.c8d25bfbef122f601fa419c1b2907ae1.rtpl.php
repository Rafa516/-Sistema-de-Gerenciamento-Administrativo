<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
    <div class="content-inside">
      <div class="my-4">
        <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
          <li class="nav-item">
            <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab" data-toggle="tab"
              role="tab" aria-controls="home" aria-selected="false"><b>Histórico de Exclusão - 
               <?php if( $total == 0 ){ ?>
                Nenhum Registrado
                <?php }elseif( $total == 1 ){ ?>
                <?php echo $total; ?> Registrado
                <?php }else{ ?>
                <?php echo $total; ?> Registrados
                <?php } ?> </b></a>
  
          </li>
  
        </ul>
  
  
          <?php if( $total > 0 ){ ?>
        <div class="search" style="float: right">
          <form action="/admin/historico" method="get">
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
                  <center>Usuário<b>
                </th>
  
                <th>
                  <center>Informações
                </th>
  
                <th>
                  <center>Data de exclusão
                </th>
                             
  
              </tr>
            </thead>
            <tbody>
              <?php $counter1=-1;  if( isset($historicos) && ( is_array($historicos) || $historicos instanceof Traversable ) && sizeof($historicos) ) foreach( $historicos as $key1 => $value1 ){ $counter1++; ?>
              <tr style="font-size: 15px;font-weight: normal;">
  
                <td>
                  <center><?php echo $value1["usuario"]; ?>
                </td>

                <td>
                    <center><?php echo $value1["informacao"]; ?>
                  </td>

                  <td>
                    <center><?php echo formatDate($value1["dt_registro"]); ?>
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
        <br><br><a href="/admin" class="btn btn-info btn-xs"><i class="fas fa-chevron-circle-left"></i><b>
            Voltar</b></a>
  
  
        <hr class="my-4" />
  
      </div>
  
  
    </div>
  
  </div>