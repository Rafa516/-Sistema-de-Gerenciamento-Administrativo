<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Unidades Escolares - 
                            <?php if( totalUnidades() == 0 ){ ?>
                            Nenhuma cadastrada
                            <?php }elseif( totalUnidades() == 1 ){ ?>
                            <?php echo totalUnidades(); ?> cadastrada
                            <?php }else{ ?>
                            <?php echo totalUnidades(); ?> cadastradas 
                            <?php } ?></b></a>
                       
                </li>
            </ul>


            
            <center><a style="width: 25%;" href="/usuario/cadastrar-unidade"class="btn btn-primary btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i><b> Cadastrar Unidade Escolar</b></a>
            <a style="width: 25%;" href="/usuario/dados-unidades"class="btn btn-info btn-sm"><i class="fa fa-table" aria-hidden="true"></i><b> Visualizar dados </b></a></center><br>
            <div id="map" style="z-index: 0;"></div><br>

            

            <a href="/usuario/home" class="btn btn-info btn-xs"><i class="fas fa-chevron-circle-left"></i><b>
                Voltar</b></a>

            

                <hr class="my-4" />


        </div>
    </div>
</div>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
    var planes = [
       <?php $counter1=-1;  if( isset($unidadesEscolares) && ( is_array($unidadesEscolares) || $unidadesEscolares instanceof Traversable ) && sizeof($unidadesEscolares) ) foreach( $unidadesEscolares as $key1 => $value1 ){ $counter1++; ?>["<?php echo $value1["sigla"]; ?>","<?php echo $value1["localidade"]; ?>","<?php echo $value1["telefone"]; ?>","<?php echo $value1["etapa"]; ?>",<?php echo $value1["lat"]; ?>,<?php echo $value1["lng"]; ?>,<?php echo $value1["id_unidade"]; ?>],<?php } ?>
       ];

       var planes1 = [
       <?php $counter1=-1;  if( isset($unidadesAdministrativas) && ( is_array($unidadesAdministrativas) || $unidadesAdministrativas instanceof Traversable ) && sizeof($unidadesAdministrativas) ) foreach( $unidadesAdministrativas as $key1 => $value1 ){ $counter1++; ?>["<?php echo $value1["sigla"]; ?>","<?php echo $value1["localidade"]; ?>","<?php echo $value1["telefone"]; ?>","<?php echo $value1["etapa"]; ?>",<?php echo $value1["lat"]; ?>,<?php echo $value1["lng"]; ?>,<?php echo $value1["id_unidade"]; ?>],<?php } ?>
       ];

       
 
         var map = L.map('map').setView([-15.897206278031227,-47.76960440960691], 13);
         mapLink = 
             '<a href="http://openstreetmap.org">OpenStreetMap</a>';
         L.tileLayer(
             'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
             attribution: '&copy; ... SS - DF',
             
             }).addTo(map);

   // create the control
    var command = L.control({position: 'topright'});

    command.onAdd = function (map) {
        var div = L.DomUtil.create('div', 'command');

        div.innerHTML = '<form><input id="command" type="checkbox"/><b> Mostrar nomes</b</form>'; 
        return div;
    };
    command.addTo(map);

             
   
    var muxiIconProperties = {
       iconUrl: "/res/map/unidade.png"
     , iconSize: [44, 59]
     , iconAnchor: [22, 59]
     , popupAnchor: [0, -50]
     };

     var muxiIconProperties1 = {
        iconUrl: "/res/map/cre.png"
      , iconSize: [44, 59]
      , iconAnchor: [22, 59]
      , popupAnchor: [0, -50]
      };
    

 
 
     var muxiIcon = L.icon(muxiIconProperties);

     for (var i = 0; i < planes.length; i++) {
        marker = new L.marker([planes[i][4],planes[i][5]],{icon: muxiIcon})             
           .bindPopup("<b style='font-size:12px;'>" +planes[i][0]+"</b>",{autoClose:false})
           .addTo(map)
           .openPopup();
                     
     }

     var muxiIcon1 = L.icon(muxiIconProperties1);

     for (var i = 0; i < planes1.length; i++) {
        marker = new L.marker([planes1[i][4],planes1[i][5]],{icon: muxiIcon1})             
           .bindPopup("<b style='font-size:12px;'>" +planes1[i][0]+"</b>",{autoClose:false})
           .addTo(map)
           .openPopup();
                     
     }
    
     function handleCommand(e) {
        e.stopPropagation();
        if(this.checked) { 
            for (var i = 0; i < planes.length; i++) {
                marker = new L.marker([planes[i][4],planes[i][5]],{icon: muxiIcon})             
                   .bindPopup("<b style='font-size:12px;'>" +planes[i][0]+"</b>",{autoClose:false})
                   .addTo(map)
                   .openPopup();
              
             } 
      }
    }

    function handleCommand1(e) {
        e.stopPropagation();
        if(this.checked) { 
            for (var i = 0; i < planes1.length; i++) {
                marker = new L.marker([planes1[i][4],planes1[i][5]],{icon: muxiIcon1})             
                   .bindPopup("<b style='font-size:12px;'>" +planes1[i][0]+"</b>",{autoClose:false})
                   .addTo(map)
                   .openPopup();
              
             } 
      }
    }

 

    
  

   document.getElementById ("command").addEventListener ("click", handleCommand, false); 
   document.getElementById ("command").addEventListener ("click", handleCommand1, false);               
</script>

     <!-- for (var i = 0; i < planes.length; i++) {
        marker = new L.marker([planes[i][4],planes[i][5]],{icon: muxiIcon})
           .bindPopup("<b style='font-size:16px;'>" +planes[i][0]+"</b>"
              +"<br><b> Localidade:</b> " +planes[i][1]
              +"<br> <b>Etapa:</b>" +planes[i][3]
              +"<br>" +planes[i][2]
              + "<center><br><a href='/usuario/unidades/imagens/"+planes[i][6]
              +"'' style='width: 100px;color:white;'' class='btn btn-info btn-sm' ><b> Ver Fotos</b></a>")
           .addTo(map)
           .openPopup();

           
     } -->