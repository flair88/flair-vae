<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Flair Home Collection New York</title>
	<link href="lib/css/import.css" rel="stylesheet" type="text/css" media="all" />
	<link href="lib/css/home.css" rel="stylesheet" type="text/css" media="all" />
	<!--[if lte IE 7]><link href="lib/css/ie7.css" rel="stylesheet" type="text/css" media="all"> <![endif]-->
	<!--[if lte IE 6]><link href="lib/css/ie6.css" rel="stylesheet" type="text/css" media="all"> <![endif]-->
 	<script src="lib/js/jquery.js" type="text/javascript" charset="utf-8"></script>
 	<script src="lib/js/jquery.cycle.all.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="lib/js/jquery.tools.min.js" type="text/javascript"></script>
	<script src="lib/js/global.js" type="text/javascript"></script>
</head>

<body id="homePg">
	<?php vae_include('/lib/includes/header.html'); ?>
	<div id="page">
		<?php vae_include('/lib/includes/logo.php'); ?>
		<div class="slide">
			<?php
			$slides = vae('/home_slides');

			foreach( $slides as $slide ) {
				// echo get_slide_class( $slide );
				$fields = $slide->data;
				ksort($fields);

				echo '<div class="' . get_slide_class($slide) . '">';

				$i = 1;
				foreach( $slide->data as $field => $value ) {
					if( (string)$field != 'option' ): ?>

						<div class="slide-<?=$i;?>">
							<v:img path="<?=$slide->id;?>/<?=(string)$field;?>" image_size="CROP" />
						</div>

					<? $i++;
					endif;
				}

				echo '</div>';
			}

			function get_slide_class( $slide ) {
				switch( $slide->option->option ) {
					case 'A':
						return 'one-horz-a';
					break;

					case 'B':
						return 'three-stack-a';
					break;

					case 'C':
						return 'four-stack-a';
					break;

					case 'D':
						return 'five-stack-a';
					break;

					case 'E':
						return 'six-stack-a';
					break;

					case 'F':
						return 'six-stack-b';
					break;

					case 'G':
						return 'seven-stack-a';
					break;
				}

				return '';
			}
			?>

		</div>
	</div><!-- #page -->
	<?php vae_include('/lib/includes/footer.html'); ?>
</body>
</html>
