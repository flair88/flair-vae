<? $_REQUEST['loc'] = 'locations'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Flair Home Collection New York | Locations</title>
	<link href="lib/css/import.css" rel="stylesheet" type="text/css" media="all" />
	<!--[if lte IE 7]><link href="lib/css/ie7.css" rel="stylesheet" type="text/css" media="all"> <![endif]-->
	<!--[if lte IE 6]><link href="lib/css/ie6.css" rel="stylesheet" type="text/css" media="all"> <![endif]-->
 	<script src="lib/js/jquery.js" type="text/javascript" charset="utf-8"></script>
 	<script src="lib/js/jquery.cycle.all.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="lib/js/jquery.tools.min.js" type="text/javascript"></script>
	<script src="lib/js/global.js" type="text/javascript"></script>
	
	<!-- this is one is for flair.verbsite.com -->
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	
	<script type="text/javascript" src="lib/js/google-maps.js"></script>
</head>

<body id="locationsPg">
	<?php vae_include('/lib/includes/header.html'); ?>
	<?php
	$locations = vae('/locations');
	?>
	
	<div id="page">
    <?php vae_include('/lib/includes/logo.php'); ?>  
		<div id="pageHeader" class="col12">
			<div class="mapOverlayLeft">
				<h3><? echo $locations->title; ?></h3>
				<address>
					<? echo nl2br( $locations->address ); ?>
				</address>
			</div>
			<div class="mapOverlayRight">
				<strong>Phone:</strong> <? echo $locations->phone; ?><br />
				<strong>Fax:</strong> <? echo $locations->fax; ?><br />
				<strong>Email:</strong> <a href="mailto:<? echo $locations->email; ?>"><? echo $locations->email; ?></a>
			</div>
			<div class="google-maps" style="width:940px;height:220px;display:block;" title="<? echo $locations->google_address; ?>"></div>
		</div>
		
		<? $i = 1; ?>
		<? foreach( $locations->other_locations as $location ): ?>
			<div class="mapBox col4 <?=$i;?> <?=($i % 3 == 0 ? 'last' : '' ); ?>">
			
				<!-- <img src="images/fpo-sm-map.gif" width="300" height="132" alt="Fpo Sm Map" /> -->
				<div class="google-maps" title="<? echo $location->google_maps_address; ?>" style="width:300px;height:132px;display:block;"></div>
				<br />
				<h3><? echo $location->title ?></h3>
				<address>
					<? echo nl2br( $location->address ); ?>
				</address>
				<? echo $location->phone; ?><br />
				<a href="<? echo $location->url; ?>" target="_blank"><? echo $location->display_url; ?></a>
			</div>
			
			<? $i++; ?>
		<? endforeach; ?>

		<div class="clear"></div>
	</div><!-- #page -->
	<?php vae_include('/lib/includes/footer.html'); ?>
</body>
</html>
