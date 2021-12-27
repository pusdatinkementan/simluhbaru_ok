 <?= $this->extend('layout/main_template') ?>

 <?= $this->section('content') ?>
 <!-- Styles -->

 <div class="container-fluid py-4">
     <div class="row">
         <!-- Map -->
         <div class="col-xs-12 col-md-12 col-lg-12 mb-4">
             <div class="panel panel-primary">
                 <div class="panel-heading">Sebaran BPP </div>
                 <div class="panel-body">
                     <div id="chartdiv"></div>
                 </div>
             </div>
         </div>

         <?php
            if (empty(session()->get('kodebapel'))) {
                $kode = '00';
            } else {
                $kode = session()->get('kodebapel');
            }
            $api = 'https://api.pertanian.go.id/api/simantap/dashboard/list?&api-key=f13914d292b53b10936b7a7d1d6f2406&kode=' . $kode;
            $result = file_get_contents($api, false);
            $json = json_decode($result, true);
            $data = $json[0];
            ?>
         <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
             <div class="card">
                 <div class="card-body p-3">
                     <div class="row">
                         <div class="col-8">
                             <div class="numbers">
                                 <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh PNS</p>
                                 <h5 class="font-weight-bolder mb-0">
                                     <?= number_format($data['jumpenyuluhpns']); ?>
                                 </h5>
                             </div>
                         </div>
                         <div class="col-4 text-end">
                             <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                 <i class="fas fa-user"></i>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
             <div class="card">
                 <div class="card-body p-3">
                     <div class="row">
                         <div class="col-8">
                             <div class="numbers">
                                 <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh THL APBN</p>
                                 <h5 class="font-weight-bolder mb-0">
                                     <?= number_format($data['jumpenyuluhthlapbn']); ?>
                                 </h5>
                             </div>
                         </div>
                         <div class="col-4 text-end">
                             <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                 <i class="fas fa-user"></i>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
             <div class="card">
                 <div class="card-body p-3">
                     <div class="row">
                         <div class="col-8">
                             <div class="numbers">
                                 <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh THL APBD</p>
                                 <h5 class="font-weight-bolder mb-0">
                                     <?= number_format($data['jumpenyuluhthlapbd']); ?>
                                 </h5>
                             </div>
                         </div>
                         <div class="col-4 text-end">
                             <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                 <i class="fas fa-user"></i>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="col-xl-3 col-sm-6">
             <div class="card">
                 <div class="card-body p-3">
                     <div class="row">
                         <div class="col-8">
                             <div class="numbers">
                                 <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Penyuluh Swadaya</p>
                                 <h5 class="font-weight-bolder mb-0">
                                     <?= number_format($data['jumpenyuluhswadaya']); ?>
                                 </h5>
                             </div>
                         </div>
                         <div class="col-4 text-end">
                             <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                 <i class="fas fa-user"></i>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <?php echo view('layout/footer'); ?>
 </div>
 <style>
     #chartdiv {
         width: 100%;
         height: 300px;
         overflow: hidden;
     }
 </style>
 <?= $this->endSection() ?>

 <?= $this->section('script') ?>

 <!-- Chart code -->
 <script>
     am4core.ready(function() {

         // Themes begin
         am4core.useTheme(am4themes_animated);
         // Themes end

         // Create map instance
         var chart = am4core.create("chartdiv", am4maps.MapChart);

         // Set map definition
         chart.geodata = am4geodata_indonesiaLow;

         // Set projection
         chart.projection = new am4maps.projections.Miller();

         // Create map polygon series
         var polygonSeries = chart.series.push(new am4maps.MapPolygonSeries());

         // Exclude Antartica
         polygonSeries.exclude = ["AQ"];

         // Make map load polygon (like country names) data from GeoJSON
         polygonSeries.useGeodata = true;

         // Configure series
         var polygonTemplate = polygonSeries.mapPolygons.template;
         polygonTemplate.tooltipText = "{name}";
         polygonTemplate.polygon.fillOpacity = 0.6;


         // Create hover state and set alternative fill color
         var hs = polygonTemplate.states.create("hover");
         hs.properties.fill = chart.colors.getIndex(0);

         // Add image series
         var imageSeries = chart.series.push(new am4maps.MapImageSeries());
         imageSeries.mapImages.template.propertyFields.longitude = "longitude";
         imageSeries.mapImages.template.propertyFields.latitude = "latitude";
         imageSeries.mapImages.template.tooltipText = "{title}";
         imageSeries.mapImages.template.propertyFields.url = "url";

         var circle = imageSeries.mapImages.template.createChild(am4core.Circle);
         circle.radius = 3;
         circle.propertyFields.fill = "color";

         var circle2 = imageSeries.mapImages.template.createChild(am4core.Circle);
         circle2.radius = 3;
         circle2.propertyFields.fill = "color";


         circle2.events.on("inited", function(event) {
             animateBullet(event.target);
         })


         function animateBullet(circle) {
             var animation = circle.animate([{
                 property: "scale",
                 from: 1,
                 to: 5
             }, {
                 property: "opacity",
                 from: 1,
                 to: 0
             }], 1000, am4core.ease.circleOut);
             animation.events.on("animationended", function(event) {
                 animateBullet(event.target.object);
             })
         }

         var colorSet = new am4core.ColorSet();

         imageSeries.data = [
             <?php
                foreach ($profilbpp as $row) {
                    $koordinat = explode(',', $row['koordinat_lokasi_bpp']);
                ?> {
                     "title": "<?= $row['nama_bpp'] ?>",
                     "latitude": <?= $koordinat[0]; ?>,
                     "longitude": <?= $koordinat[1]; ?>,
                     "color": colorSet.next()
                 },
             <?php } ?>
         ];

         // Zoom control
         chart.zoomControl = new am4maps.ZoomControl();

         var homeButton = new am4core.Button();
         homeButton.events.on("hit", function() {
             //   polygonSeries.show();
             //   countrySeries.hide();
             chart.goHome();
         });

         homeButton.icon = new am4core.Sprite();
         homeButton.padding(7, 5, 7, 5);
         homeButton.width = 30;
         homeButton.icon.path = "M16,8 L14,8 L14,16 L10,16 L10,10 L6,10 L6,16 L2,16 L2,8 L0,8 L8,0 L16,8 Z M16,8";
         homeButton.marginBottom = 10;
         homeButton.parent = chart.zoomControl;
         homeButton.insertBefore(chart.zoomControl.plusButton);

     }); // end am4core.ready()
 </script>
 <?= $this->endSection() ?>