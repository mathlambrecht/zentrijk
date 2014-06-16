<div class="container">
  <div class="corner topleft"></div>
  <div class="corner topright"></div>
  <div class="corner bottomleft"></div>
  <div class="corner bottomright"></div>
  <div class="frame"></div>

  <section id='loginsection'>
    <header id="headerhome">
        <hgroup>
          <h1 class="centercontent"><span class="invisible">Zentrijk</span></h1>
        </hgroup>
      </header>
	<form method='POST' action='index.php?page=grid&action=login' autocomplete='off'>
		<fieldset>
			<label for="txtcode">1. Dagcode *</label><br/>
			<label for="selectgroup">2. Selecteer je groep *</label>
		</fieldset>
		<fieldset>
			<input type="text" name='txtcode' id="txtcode" tabindex="1" /></br>			
			<span>1</span><input type="radio" name="selectgroup" value="1">
			<span>2</span><input type="radio" name="selectgroup" value="2">
			<span>3</span><input type="radio" name="selectgroup" value="3">
			<span>4</span><input type="radio" name="selectgroup" value="4">
			<span>5</span><input type="radio" name="selectgroup" value="5"></br>
			<input type="submit" name="btnsubmit" id="btnsubmit" tabindex="2"/></br>
		</fieldset><div id="clear"></div>
			<?php 
				if(!empty($isError) && $isError)
				{ ?>
					<span class='errormessage'><?php echo $error; ?></span>
			<?php } ?>
	</form>  	
  </section>
</div>
