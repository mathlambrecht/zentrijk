<div id='selectphoto'>
	<?php
	foreach($arrPhotos as $photo)
	{ ?>
		<form method="POST" action="index.php?page=grid&action=assignphoto">
			<input type="hidden" name="photoid" value="<?php echo $photo["id"]; ?>" />
			<input type="hidden" name="photopath" value="<?php echo $photo['path']; ?>" />
			<input type="submit" value="add" />
		</form>
		<img src=<?php echo $photo['path']; ?> />	
	<?php } ?>
</div>