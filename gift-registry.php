<? $_REQUEST['loc'] = 'registry'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Flair Home Collection New York | Register</title>
	<link href="lib/css/import.css" rel="stylesheet" type="text/css" media="all" />
	<!--[if lte IE 7]><link href="lib/css/ie7.css" rel="stylesheet" type="text/css" media="all"> <![endif]-->
	<!--[if lte IE 6]><link href="lib/css/ie6.css" rel="stylesheet" type="text/css" media="all"> <![endif]-->
 	<script src="lib/js/jquery.js" type="text/javascript" charset="utf-8"></script>
 	<script src="lib/js/jquery.cycle.all.min.js" type="text/javascript" charset="utf-8"></script>
 	<script src="lib/js/jquery.validate.imin.js" type="text/javascript" charset="utf-8"></script>
	<script src="lib/js/jquery.tools.min.js" type="text/javascript"></script>
	<script src="lib/js/global.js" type="text/javascript"></script>

	<script src="lib/js/underscore.js" type="text/javascript"></script>
	<script src="lib/js/form-copy.js" type="text/javascript"></script>
</head>

<body id="registerPg">
	<?php vae_include('/lib/includes/header.html'); ?>
  <div id="page">

    <? if (!vae_loggedin()): ?>
      
      <? $image = vae("/gift_registry/image"); ?>
      <img src="<?= vae_data_url().vae_sizedimage($image, "Top"); ?>" class="registerImg"/>
      
      <div id="register" class="clear new">
      <fieldset id="billingInfo">
        <h2>Log In</h2>
        <v:users:login path="/gift_registry/registries" redirect="/gift-registry" required="email,password" invalid="Login information incorrect.">
        
          <p class="input">
            <label for="email">Email</label>
            <v:text_field path="email"  class="text" />
          </p>
          <p class="input">
            <label for="password">Password</label>
            <v:password_field path="password" class="text" />
          </p>
          <a href="/forgot-password">
            <button type="button" class="forgotP" />Forgot Password?</button>
          </a>
          <button type="submit" class="float_right"/>Log In</button>
          
        </v:users:login>
      </fieldset>

      <fieldset id="shippingInfo" class="registry-column-2">      
        <?= nl2br(vae("/gift_registry/text")); ?></br>  
        <a href="/gift-register"><button class="right-button" type="submit"/>Register NOW</button></a>
      </fieldset>     
    
    <? else: ?>

      <?  
      
      $userId = $_SESSION['__v:logged_in']['id']; 
      $user = vae_find($userId); 
      
      ?>
      
      <?
      
      function get_items( $filter ) {
      	$rId = $_REQUEST['id'];
      $userId = $_SESSION['__v:logged_in']['id']; 
      		      $user = vae_find($userId);
      	$items = $user->get('items', $filter);
      	return $items;
      }
      
      function sanitize_tooltip_html( $input ) {
      	// return addslashes(preg_replace("/[^\w\s]/", ' ', $input));
      	return htmlentities($input);
      }
      
      ?>	



		  <div id="page">
		  <v:users:logout class="right-button">Log out</v:users:logout>
      Your Registry: <h4><?= $user->title; ?></h4>
      <p style="font-size:14px;">Copy this URL and send to your Family and Friends: <a href="<?= "http://flairhomecollection.com".$user->permalink;?>"><?= "http://flairhomecollection.com".$user->permalink;?></a></p>
      <p style="font-size:14px;">Or use <a href="mailto:?subject=<? echo $user->title; ?> - FLAIR Gift Registry&body=http://flairhomecollection.com<? echo $user->permalink; ?>">this link</a> to send an email directly.</p>
      <p style="font-size:14px;"><? echo vae("/gift_registry/registry_page_text"); ?></p> 
      <p><a href="/print/registry.html?reg_id=<?= $user->id;?>">Print Version</a></p>
      <h4 class="registryTitle">Wishlist (<?= ($user->items->count > 0)? $user->items->count:"0";?> items)</h4>
		<div id="shopBox" class="col12 gift">
			
						<?php
				$items = get_items();

				$array_items = array(); foreach( $items as $item ) { $array_items[] = $item; }
				$groups = array_chunk( $array_items, 4, true );
				?>
			
				<? $shopRow=4; ?>
				<? foreach( $groups as $items ): ?>
				  <? echo $items->id; ?>
					<div class="shopRow3 shopRow<?=$shopRow;?> col12">
						<ul>
							
							<?php
							$max = 4;?>
							<? $i=1; ?>
					<? foreach($items as $item): ?>
					
						<li <? echo ($i == $max ) ? "class='last'" : ""; ?>>
						  <a href="/gift-registry-functions.php?removeId=<?= $item->id; ?>" class="remove">Remove</a>
							<a href="<? echo $item->permalink; ?>" title="" class="single-item">
							<img src="<? echo vae_data_url().vae_image($item->main_image, '218', '218', 'Square'); ?>" width="218" height="218" alt="<? echo $item->title; ?>" />
							<span><a href='<? echo $item->permalink;?>' class="tooltip"><? echo $item->title; ?> <br />$<? echo sanitize_tooltip_html($item->price); ?></a></span
							</a>
						</li>
					<? $i++; ?>
					<? endforeach; ?>

							</ul>
						</div>
					<? $shopRow++; ?>
				<? endforeach; ?>
			
			       <h4 class="registryTitle">Purchased Items (<?= ($user->purchased_items->count > 0)? $user->purchased_items->count: "0" ; ?> Items)</h4>
				<?php
				$items = $user->purchased_items;

				$array_items = array(); foreach( $items as $item ) { $array_items[] = $item; }
				$groups = array_chunk( $array_items, 4, true );
				?>
			
				<? $shopRow=4; ?>
				<? foreach( $groups as $items ): ?>
				  <? echo $items->id; ?>
					<div class="shopRow3 shopRow<?=$shopRow;?> col12">
						<ul>
							
							<?php
							$max = 4;?>
							<? $i=1; ?>
					<? foreach($items as $item): ?>
					
						<li <? echo ($i == $max ) ? "class='last'" : ""; ?>>
							<a href="<? echo $item->permalink; ?>" title="" class="single-item">
							<img src="<? echo vae_data_url().vae_image($item->main_image, '218', '218', 'Square'); ?>" width="218" height="218" alt="<? echo $item->title; ?>" />
							<span><a href='<? echo $item->permalink;?>' class="tooltip"><? echo $item->title; ?> <br />$<? echo sanitize_tooltip_html($item->price); ?></a></span
							</a>
						</li>
					<? $i++; ?>
					<? endforeach; ?>

							</ul>
						</div>
					<? $shopRow++; ?>
				<? endforeach; ?>
			

			<div class="clear"> </div>
		</div>
		
	</div><!-- #page -->

			

    <? endif; ?>

		  <div class="clear"></div>
		</div>
	</div><!-- #page -->

	<?php vae_include('lib/includes/footer.html'); ?>
</body>
</html>
