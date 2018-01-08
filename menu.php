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

 <div id="header" class="new">
  
  <div id="mainNav">
    <ul id="topNav">
      <li>
        <a href="/shop" class="shopBtn">Shop</a>            
      </li>    
      <li>
        <a href="/about" class="aboutBtn">About</a>			
  		</li>
  		<li><a href="/locations" class="locationsBtn">Locations</a></li>
  		<li><a href="/contact" class="contactBtn">Contact</a></li>
  		<? if ($shop->show_extra_section == "1"): ?>
        <li class="wallpapersBtn"><a href="http://flairhomecollection.com/shop/carte-renzo-mongiardino-wallpapers">Carte - Renzo Mongiardino's Wallpapers</a></li>
  		<? endif; ?>
  		<li><a href="/gift-registry" class="registryBtn">Registry</a></li>
    </ul>
    
    <div id="headerRight">
      <? $shop = vae("/shop"); ?>
  		<? if ($shop->show_extra_section == "1"): ?>        
        <a class="featureBtn" href="http://flairhomecollection.com/shop/carte-renzo-mongiardino-wallpapers">Carte - Renzo Mongiardino's Wallpapers</a>
		  <? endif; ?>
		  <div class="extraButtons">
        <div class="cartButton">
      		<span><a href="/cart">View Cart</a> |</span>
      		<span class="numberOfItems"><? echo count(vae_store_cart_items()); ?> Items</span>
        </div>

		  </div>
    </div>
  </div><!-- mainNav -->
 </div><!-- header -->
   
  <div id="panelShopNav">
    <?
      $cats = vae('/shop/categories[hide!=1]');
      
      $perCol = 10;
      
      $i=1;
      $thisCol=$ind=0;
      foreach($cats as $cat):
        $catItemCount = (string)$cat->subcategories->count + 1;
        if($thisCol == 0):          
          $results[$ind][] = (string)$cat->id;
          $thisCol += $catItemCount;
        elseif($thisCol < $perCol):
          if($thisCol + $catItemCount > $perCol-$thisCol):
            $ind++;
            $thisCol = 0;
            $results[$ind][] = (string)$cat->id;
            $thisCol += $catItemCount;
          else:
            $results[$ind][] = (string)$cat->id;
            $thisCol += $catItemCount;
          endif;
        elseif($thisCol >= $perCol):          
          $ind++;
          $thisCol = 0;
          $results[$ind][] = (string)$cat->id;
          $thisCol += $catItemCount;
        endif;
        $i++;
      endforeach;
    ?>  
    

    <? $i=1; ?>
    <? foreach($results as $column): ?>
      <? if($i==4): ?>
      <ul class="panelColumn last">
      <? else: ?>
      <ul class="panelColumn">
      <? endif; ?>
        <? foreach($column as $catId): ?>
          <? $cat = vae($catId); ?>
          <li class="mainCat">
            <a href="<? echo $cat->permalink; ?>"><? echo $cat->title; ?></a>
          </li>
          <? if($cat->subcategories->count): ?>
            <? foreach($cat->subcategories as $subcat): ?>
              <li class="panelSubCat">
                <a href="<? echo $subcat->permalink; ?>"><? echo $subcat->title; ?></a>
              </li>
            <? endforeach; ?>
          <? endif; ?>
        <? endforeach; ?>        
      </ul>
      <? $i++; ?>
    <? endforeach; ?>
    
    <div class="clear"></div>
  </div><!-- panelShopNav -->
 
 
  <div id="page">

    <div id="register" class="clear">
    <? if (!vae_loggedin()): ?>
      <? $image = vae("/gift_registry/image"); ?>
  <img src="<?= vae_data_url().vae_sizedimage($image, "Top"); ?>"/>
    <fieldset id="billingInfo">
      <h2>Login</h2>
      <v:users:login path="/gift_registry/registries" redirect="/gift-registry" required="email,password" invalid="Login information incorrect.">
      
        <p class="input">
          <label for="email">Email</label>
          <v:text_field path="email"  class="text" />
        </p>
        <p class="input">
          <label for="password">Password</label>
          <v:password_field path="password" class="text" />
        </p>
        <a href="/forgot-password"><button type="button"/>Forgot Password?</button></a><button type="submit" class="right-button"/>Login</button>
        
      </v:users:login>
    </fieldset>

    <fieldset id="shippingInfo" class="registry-column-2">
      <?= vae("/gift_registry/text");?></br>  
      <a href="/gift-register"><button class="right-button" type="submit"/>Register NOW</button></a>
    </fieldset>     
    <? else: ?>

    <?  $userId = $_SESSION['__v:logged_in']['id']; 
		      $user = vae_find($userId); ?>

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
}?>	



		  <div id="page">
		  <v:users:logout class="right-button">Click here to logout.</v:users:logout>
      <h4 ><?= $user->title; ?></h4>
      <p style="font-size:14px;">Your registry URL: <a href="<?= "http://flairhomecollection.com".$user->permalink;?>"><?= "http://flairhomecollection.com".$user->permalink;?></a></p>
      <h4>Wishlist (<?= ($user->items->count > 0)? $user->items->count:"0";?> items)</h4>
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
			
			       <h4>Purchased Items (<?= ($user->purchased_items->count > 0)? $user->purchased_items->count: "0" ; ?> Items)</h4>
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
