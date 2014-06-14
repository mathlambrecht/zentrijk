<div class="container">
<?php
	if($isArrGridPhotos)
	{
		foreach($arrGridPhotos as $photo)
		{ ?>
			<div class="marker">
				<img src="<?php echo $photo['photopath']; ?>" />
			</div>
		<?php } 
	} ?>
	
	<section id='grid'>
	  	<?php for($i = 1; $i < 10; $i++)
		{?>
			<div class="marker">
				<form method='POST' action="index.php?page=grid&action=showphotos">
					<input type="hidden" name="gridid" value="<?php echo $i; ?>" />
					<input type="submit" value="+" />
				</form>
			</div>
		<?php } ?>
	</section>	
</div>