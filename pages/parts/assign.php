<?php

foreach($arrPhotos as $photo)
{ ?>
	<img src=<?php echo $photo['path']; ?> />
<?php } ?>