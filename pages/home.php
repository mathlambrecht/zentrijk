  <div class='container'>
    <div id="church"></div>
    <div id="tower"></div>
    <div class="corner topleft"></div>
    <div class="corner topright"></div>
    <div class="corner bottomleft"></div>
    <div class="corner bottomright"></div>

    <section id='home' class='frame'>
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
      <a id="btndiscover" class="centercontent" href="#zentrijk">Ontdek Zentrijk</a>
    </section>
</div>

<div class="container">
    <div class="corner topleft"></div>
    <div class="corner topright"></div>
    <div class="corner bottomleft"></div>
    <div class="corner bottomright"></div>
    <div class  ="frame"></div>
    <section id='zentrijk'>
        <header>
          <hgroup>
            <h1 id="headermap"><span class='invisible'>Kortrijk, de zen spots.</span></h1>
            <h2>Ontdek Zentrijk. Bezoek een van deze spots en word helemaal zen.</h2>
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
    </section>
  </div>
</div>

