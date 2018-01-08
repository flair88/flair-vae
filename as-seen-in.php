<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Flair Home Collection New York | As Seen In</title>
	<link href="lib/css/import.css" rel="stylesheet" type="text/css" media="all" />
	<link href="lib/css/fb.css" rel="stylesheet" type="text/css" media="all" />
	<!--[if lte IE 6]><link href="lib/css/ie6.css" rel="stylesheet" type="text/css" media="all"> <![endif]-->
	<!--[if lte IE 7]><link href="lib/css/ie7.css" rel="stylesheet" type="text/css" media="all"> <![endif]-->	
 	<script src="lib/js/jquery.js" type="text/javascript" charset="utf-8"></script>
 	<script src="lib/js/jquery.cycle.all.min.js" type="text/javascript" charset="utf-8"></script>
 	<script src="lib/js/jquery.fancybox.js" type="text/javascript" charset="utf-8"></script>
	<script src="lib/js/jquery.tools.min.js" type="text/javascript"></script>
	<script src="lib/js/global.js" type="text/javascript"></script>
</head>

<body id="aboutPg" class="pressSubPg">
	<?php $press = true; vae_include('/lib/includes/header.html'); ?>
	<div id="page" class="press">
		<div id="primeContent" class="col12">
			<ul class="slide">
			
		  <? foreach( vae('/as_seen_in_slides') as $slide ): ?>

					<li>
						<a href="<?= vae_data_url() . vae_image($slide->large_image); ?>" title="<?= $slide->title; ?>">
							<img
								src="<?= vae_data_url() . vae_sizedimage($slide->large_image, 'Large'); ?>"
								width="460"
								height="460"
								alt="<?= $slide->title; ?>"
							/>
						</a>
					</li>

				<? endforeach; ?>
				
				<li>
					<a href="images/media/zoom/test1.jpg" title="New York Magazine - Best of New York Shopping 2010"><img src="images/media/1.jpg" width="460" height="460" alt=" " /></a>
				</li>
				<li>
					<img src="images/media/2.jpg" width="460" height="460" alt=" " />
				</li>
				<li>
					<img src="images/media/3.jpg" width="460" height="460" alt=" " />
				</li>
				<li>
					<img src="images/media/4.jpg" width="460" height="460" alt=" " />
				</li>
				<li>
					<img src="images/media/5.jpg" width="460" height="460" alt=" " />
				</li>
				<li>
					<img src="images/media/6.jpg" width="460" height="460" alt=" " />
				</li>
				<li>
					<img src="images/media/7.jpg" width="460" height="460" alt=" " />
				</li>
				<li>
					<img src="images/media/8.jpg" width="460" height="460" alt=" " />
				</li>
				<li>
					<img src="images/media/9.jpg" width="460" height="460" alt=" " />
				</li>
				<li>
					<img src="images/media/10.jpg" width="460" height="460" alt=" " />
				</li>
				<li>
					<img src="images/media/11.jpg" width="460" height="460" alt=" " />
			  </li>
				<li>
					<img src="images/media/12.jpg" width="460" height="460" alt=" " />
				</li>
			</ul>
		</div>
		
			<?
			$press = array();
			foreach( vae('/as_seen_in_slides') as $single_press ) {
				$press[ $single_press->id ] = $single_press;
			}
			
			$as_seen_in_slides = array_chunk( $press, 6, true );
			?>
		
		<div id="secondaryContent">
		
			<!-- this needs to get finished -->
		

			
			<? foreach( $as_seen_in_slides as $press_items ): ?>

				<ul class="thumbs">
					<? foreach( $press_items as $press ): ?>
						<li>
							<a href="<?= vae_data_url() . vae_image($press->thumb_image); ?>" title="<?= $press->title; ?>">
								<img
									src="<?= vae_data_url() . vae_sizedimage($press->thumb_image, 'Thumb'); ?>"
									width="138"
									height="172"
									alt="<?= $press->title; ?>"
								/>
							</a>
						</li>
					<? endforeach; ?>
				</ul>
				
			<? endforeach; ?>
			
			<!--
			<ul class="thumbs">
				<li><a href="#"><img src="images/media/thumbs/1.jpg" width="138" height="172" alt="thumb" /></a></li>
				<li><a href="#"><img src="images/media/thumbs/2.jpg" width="138" height="172" alt="thumb" /></a></li>
				<li><a href="#"><img src="images/media/thumbs/3.jpg" width="138" height="172" alt="thumb" /></a></li>
				<li><a href="#"><img src="images/media/thumbs/4.jpg" width="138" height="172" alt="thumb" /></a></li>
				<li><a href="#"><img src="images/media/thumbs/5.jpg" width="138" height="172" alt="thumb" /></a></li>
				<li><a href="#"><img src="images/media/thumbs/6.jpg" width="138" height="172" alt="thumb" /></a></li>
			</ul>
			<ul class="thumbs">
				<li><a href="#"><img src="images/media/thumbs/7.jpg" width="138" height="172" alt="thumb" /></a></li>
				<li><a href="#"><img src="images/media/thumbs/8.jpg" width="138" height="172" alt="thumb" /></a></li>
				<li><a href="#"><img src="images/media/thumbs/9.jpg" width="138" height="172" alt="thumb" /></a></li>
				<li><a href="#"><img src="images/media/thumbs/10.jpg" width="138" height="172" alt="thumb" /></a></li>
				<li><a href="#"><img src="images/media/thumbs/11.jpg" width="138" height="172" alt="thumb" /></a></li>
				<li><a href="#"><img src="images/media/thumbs/12.jpg" width="138" height="172" alt="thumb" /></a></li>
			</ul>
			-->
			
			
		</div>
	</div><!-- #page -->
	<?php vae_include('/lib/includes/footer.html'); ?>
</body>
</html>
