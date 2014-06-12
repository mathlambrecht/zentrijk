<div id="container">
  <div class="corner topleft"></div>
  <div class="corner topright"></div>
  <div class="corner bottomleft"></div>
  <div class="corner bottomright"></div>
  <div id="frame"></div>

  <section id='loginsection' >
	<form method='POST' action='index.php?page=grid&action=create'>
		<fieldset>
			<label for="txtcode">1.Dagcode</label>
			<input type="text" name='txtcode' id="txtcode" tabindex="1" /></br>
			<label for="selectgroup">2.Selecteer je groep</label></br>
			<span>1</span><input type="radio" name="selectgroup" value="1">
			<span>2</span><input type="radio" name="selectgroup" value="2">
			<span>3</span><input type="radio" name="selectgroup" value="3">
			<span>4</span><input type="radio" name="selectgroup" value="4">
			<span>5</span><input type="radio" name="selectgroup" value="5"></br>
			<input type="submit" name="btnsubmit" id="btnsubmit" tabindex="2"/>
		</fieldset>
	</form>  	
  </section>
</div>