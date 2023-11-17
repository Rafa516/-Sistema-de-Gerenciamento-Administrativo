<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content">
    <div class="content-inside">
        <div class="my-4">
            <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                <li class="nav-item">
                    <a style="background-color: #2E9AFE;color: white" class="nav-link active" id="home-tab"
                        data-toggle="tab" role="tab" aria-controls="home" aria-selected="false"><b>Localização - <?php echo $values["nome"]; ?> </b></a>
                </li>
            </ul>
              <?php if( $unidadeOpenMsg!= '' ){ ?>
            <div class="alert alert-success">
                <b><?php echo $unidadeOpenMsg; ?></b>
            </div>
            <?php } ?>



             <div id="map"></div><br>

          <i>Última alteração de localização registrada pelo(a) usuário(a)<b> <?php echo $values["nome_user"]; ?></b> em <b><?php echo formatDateHoras($values["dt_registro_localidade"]); ?>.</b></i><br><br>
          <a  href="/usuario/unidade/localizacao-alterar/<?php echo $values["id_unidade"]; ?>"
                    class="btn btn-success btn-sm"><i class="fas fa-pen"></i><b> Alterar Localização</b></a>
                <hr class="my-4" />

                <a href="/usuario/unidade/informacoes/<?php echo $values["id_unidade"]; ?>" class="btn btn-info btn-xs"><i class="fas fa-chevron-circle-left"></i><b>
                    Voltar</b></a>


        </div>
    </div>
</div>

<script src="https://d19vzq90twjlae.cloudfront.net/leaflet-0.7/leaflet.js">
</script>
<?php if( $values["unidade"] == 'Unidade Escolar' ){ ?>
<script>

  var initialCoordinates = [<?php echo $values["lat"]; ?>, <?php echo $values["lng"]; ?>]; 
  var initialZoomLevel = 18;

  // create a map in the "map" div, set the view to a given place and zoom
  var map = L.map('map').setView(initialCoordinates, initialZoomLevel);

  // add an OpenStreetMap tile layer
  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: '&copy; ... SS - DF'
  }).addTo(map);


  var muxiCoordinates = [<?php echo $values["lat"]; ?>, <?php echo $values["lng"]; ?>];
  var muxiMarkerMessage = '<b style="font-size:16px;"><?php echo $values["nome"]; ?></b><br><b"><b><br><?php echo $values["localidade"]; ?></b><br><br><b>Latitude:</b><?php echo $values["lat"]; ?><br><b>Longitude:</b><?php echo $values["lng"]; ?>';

  var muxiIconProperties = {
    iconUrl: "/res/map/unidade.png"
  , iconSize: [44, 59]
  , iconAnchor: [22, 59]
  , popupAnchor: [0, -50]
  };

  var muxiIcon = L.icon(muxiIconProperties);

  L.marker(muxiCoordinates, {icon: muxiIcon})
    .addTo(map)
    .bindPopup(muxiMarkerMessage)
    .openPopup();
  ;
        

           
</script>
<?php }else{ ?>

<script>

  var initialCoordinates = [<?php echo $values["lat"]; ?>, <?php echo $values["lng"]; ?>]; 
  var initialZoomLevel = 18;

  // create a map in the "map" div, set the view to a given place and zoom
  var map = L.map('map').setView(initialCoordinates, initialZoomLevel);

  // add an OpenStreetMap tile layer
  L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
      attribution: '&copy; ... SS - DF'
  }).addTo(map);


  var muxiCoordinates = [<?php echo $values["lat"]; ?>, <?php echo $values["lng"]; ?>];
  var muxiMarkerMessage = '<b style="font-size:16px;"><?php echo $values["nome"]; ?></b><br><b"><b><br><?php echo $values["localidade"]; ?></b><br><br><b>Latitude:</b><?php echo $values["lat"]; ?><br><b>Longitude:</b><?php echo $values["lng"]; ?>';

  var muxiIconProperties = {
    iconUrl: "/res/map/cre.png"
  , iconSize: [44, 59]
  , iconAnchor: [22, 59]
  , popupAnchor: [0, -50]
  };

  var muxiIcon = L.icon(muxiIconProperties);

  L.marker(muxiCoordinates, {icon: muxiIcon})
    .addTo(map)
    .bindPopup(muxiMarkerMessage)
    .openPopup();
  ;
        

           
</script>
<?php } ?>


