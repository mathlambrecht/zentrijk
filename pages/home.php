<div id="container">
  <div id="church"></div>
  <div id="tower"></div>
  <div class="corner topleft"></div>
  <div class="corner topright"></div>
  <div class="corner bottomleft"></div>
  <div class="corner bottomright"></div>
  <div id="frame"></div>

  <section id='home'>
    <a id="btngarden" href="http://localhost/zentrijk/index.php?page=grid">grid</a>
    <header id="headerhome">
      <hgroup>
        <h1 class="centercontent"><span class="invisible">Zentrijk</span></h1>
        <h2 class="centercontent">
          De stad is meer zen dan je denkt. </br>
          Vind de innerlijke geest van Kortrijk !
        </h2>
      </hgroup>
    </header>

    <p id="centerparagraph">
      Zentrijk is een app in samenwerking met En Route die jongeren </br>
      tussen 12 en 18 jaar de innerlijke geest van Kortrijk laat waarnemen </br>
      tijdens een interactieve dag. </br>
    </p>
    <a id="btndiscover" class="centercontent" href="#map">Ontdek Zentrijk</a>
  </section>

  <section id='zentrijk'>
    <div id='map'>
      <header>
        <hgroup>
          <h1>Kortrijk, de zen spots.</h1>
        </hgroup>
      </header>
      <div id='mapbox'></div>
      <script>
        var map = new L.mapbox.map('mapbox', 'mathlambrecht.ifcpbmpe').setView([50.826248, 3.262802999999991], 15);          

        <?php
          foreach($arrSpots as $spot)
          {?>
            L.mapbox.featureLayer(
            { 
              type: 'Feature',
              geometry:
              {
                type: 'Point',
                coordinates: 
                [
                  Number(<?php echo $spot['latitude']?>),
                  Number(<?php echo $spot['longitude']?>)
                ]
              },
              properties: 
              {
                title: "<?php echo $spot['title']?>",
                description: "<?php echo $spot['subtitle']?>",
                'marker-size': 'large',
                'marker-color': '#BE9A6B',
                'marker-symbol': 'cafe'
              }
            }).addTo(map);
          <?php } ?>
      </script>
    </div>
  </section>
</div>

