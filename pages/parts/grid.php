<div class="container">
  <div class="corner topleft"></div>
  <div class="corner topright"></div>
  <div class="corner bottomleft"></div>
  <div class="corner bottomright"></div>
  <div class="frame"></div>

	<section id='grid'>
		<?php 
			$arrPhotos =  array();
			$arrForms =  array();

			for($i = 1; $i < 13; $i ++)
			{	
				$arrForms[] = $i;
			}

			if($isArrGridPhotos)
			{
				$gridcount = 0;

				foreach($arrGridPhotos as $photo)
				{ ?>
					<div id="marker<?php echo $photo['gridid'];?>">

					<?php 
						if($photo['iswashed'] == 'true')
						{ ?>
							<div class="washed"></div>
						<?php }
						else
						{
							if($_SESSION['isWashable'])
							{ ?>
								<form class="formwashed" method='POST' action="index.php?page=grid&action=washphoto">
									<input type="hidden" name="gridid" value="<?php echo $photo['gridid'];?>" />
									<input type="submit" value="" />
								</form>
							<?php }
						} 
					?>
						<img class="gridimage" src="<?php echo $photo['photopath']; ?>" />
					</div>					
				<?php
					$gridcount ++; 
				}

				if($gridcount < 9)
				{
					foreach($arrGridPhotos as $photo)
					{
						$arrPhotos[] = $photo['gridid'];
					}

					$result = array_diff($arrForms, $arrPhotos);

					foreach($result as $number)
					{
						?>			
						<div id="marker<?php echo $number; ?>">
							<form method='POST' action="index.php?page=grid&action=showphotos">
								<input type="hidden" name="gridid" value="<?php echo $number; ?>" />
								<input type="submit" value="+" />
							</form>
						</div>
						<?php
					}
				}
			}
			else
			{
				for($i = 1; $i < 13; $i ++)
				{	
					?>			
					<div id="marker<?php echo $i; ?>">
						<form method='POST' action="index.php?page=grid&action=showphotos">
							<input type="hidden" name="gridid" value="<?php echo $i; ?>" />
							<input type="submit" value="+" />
						</form>
					</div>
					<?php
				}
			}
		?>
	</section>
	<a href="index.php?page=grid&action=logout">Logout</a>
</div>