<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Informações</b></a>
                </li>
            </ul>
        
             <?php if( $informacoesMensagem != '' ){ ?>
            <div class="alert alert-success">
                <b><?php echo $informacoesMensagem; ?></b>
            </div>
            <?php } ?>

            <a style="width: 25%;" href="/admin/informacoes/registro"class="btn btn-primary btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i><b> Registrar Informação</b></a>
        
            <div class="search" style="float: right">
                <form action="/admin/informacoes" method="get">
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
              
              <?php $counter1=-1;  if( isset($informacoes) && ( is_array($informacoes) || $informacoes instanceof Traversable ) && sizeof($informacoes) ) foreach( $informacoes as $key1 => $value1 ){ $counter1++; ?>
                <div class="card">
                  <div class="card-header">
                    <h5><b>Autor: <?php echo $value1["nome_user"]; ?></b></h5> 
                <i class="fa fa-calendar-alt"></i>&nbsp;&nbsp;<?php echo formatDate($value1["data_registro"]); ?>
                  </div>
                 
                  <Center><h2 class="card-title"><?php echo $value1["titulo"]; ?></h2></Center>
                 
                   <?php echo $value1["informacoes"]; ?>

                 
                   <div class="card-footer text-muted">
                    
                      <?php if( $value1["alteracao"] != NULL OR $value1["alteracao"] != '' ){ ?>
                      <center>
                      <i>Última alteração registrada pelo(a) usuário(a)<b> <?php echo $value1["alteracao"]; ?></b> em
                        <b><?php echo formatDateHoras($value1["dt_alteracao_informacao"]); ?>.</b></i><br>
                      <?php } ?>
                     <center><a  href="/admin/informacoes/alterar/<?php echo $value1["id_informacao"]; ?>"  class="btn btn-success btn-sm">
                      <i class="fas fa-pen"></i>
                      <b>Alterar</b></a>

                    <button
                    onclick="deletar('<?php echo $value1["id_informacao"]; ?>','<?php echo $value1["titulo"]; ?>','/admin/informacoes/delete/<?php echo $value1["id_informacao"]; ?>,<?php echo $usuario["nome_user"]; ?>','Excluir Informação')"
                    class="btn btn-danger btn-sm">
                    <i class="fas fa-trash-alt"></i>
                    <b> Excluir</b></button>
                  </center>
                    </div> 
                   
               
                </div>
               

                <hr class="my-4" />


                 <?php } ?>

             

                 <br>
                  <center>
            <div class="box-footer clearfix">
              <ul class="pagination">
               <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>
                          <?php if( $pages == $value1["link"] ){ ?> 
                       <li> <a class="active"href="<?php echo $value1["link"]; ?>"><?php echo $value1["page"]; ?></a></li>
                        <?php }else{ ?>
                        <li><a href="<?php echo $value1["link"]; ?>"><?php echo $value1["page"]; ?></a></li>
                          <?php } ?>
                        <?php } ?>
              </ul>
            </div>
          </center>
          
              
          </div>
          
          <a href="/admin" class="btn btn-info btn-xs"><i class="fas fa-chevron-circle-left"></i><b>
            Voltar</b></a>
          </div>

          
            <hr class="my-4" />


        </div>
    </div>
</div>

    
