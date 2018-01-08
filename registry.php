<?php
	$registry = vae($_REQUEST['id']);
  $locations = vae('/locations');

function get_items( $filter ) {
	$rId = $_REQUEST['id'];
	$registry = vae($rId);
	$items = $registry->get('items', $filter);
	return $items;
}
function sanitize_tooltip_html( $input ) {
	// return addslashes(preg_replace("/[^\w\s]/", ' ', $input));
	return htmlentities($input);
}?>	

<? include('lib/includes/head.html'); ?>
<!-- <script type="text/javascript" src="/lib/js/jquery.lazyload.js"></script> -->

<body id="shopPg">
	
	<div id="header" class="new">
	<div id="registryDetail">
	 <span class="registryName"><? echo $registry->title ."</br>"; ?></span>
	 <? echo $registry->text; ?>	
	 <a href="/"><img src="/lib/css/images/Flair-mini-logo.gif"></a>		
	 <div id="contactInfo">
	   <p><? echo nl2br( $locations->address ); ?></p>
	   <p><? echo $locations->phone; ?></p>
	   <p><a href="/">flairhomecollection.com</a></p>
	 </div>
	</div>
	

  <? $shop = vae("/shop"); ?>

  <div id="mainNav">
    <ul id="topNav">
      <li>
        <a href="/shop" class="shopBtn<? if($_REQUEST['loc']=='shop'): ?> active<? endif; ?>">Shop</a>            
      </li>    
      <li>
        <a href="/about" class="aboutBtn<? if($_REQUEST['loc']=='about'): ?> active<? endif; ?>">About</a>			
  		</li>
  		<li><a href="/locations" class="locationsBtn<? if($_REQUEST['loc']=='locations'): ?> active<? endif; ?>">Locations</a></li>
  		<li><a href="/contact" class="contactBtn<? if($_REQUEST['loc']=='contact'): ?> active<? endif; ?>">Contact</a></li>
  		<li><a href="/gift-registry" class="registryBtn<? if($_REQUEST['loc']=='registry'): ?> active<? endif; ?>">Registry</a></li>
  		<li><a href="/design-services" class="designBtn<? if($_REQUEST['loc']=='design'): ?> active<? endif; ?>">Design Services</a></li>
  		<? if ($shop->extra_section == "1" && !isset($shop->extra_image)): ?>
  		  <li><a href="<? echo $shop->extra_category->permalink; ?>" <? if($_REQUEST['id']==$shop->extra_category->id): ?>class="active"<? endif; ?>><? echo $shop->extra_category->title; ?></a></li>
  		<? endif; ?>
    </ul>

    <div id="headerRight">
      <? if ($shop->extra_section == "1" && isset($shop->extra_image)): ?>   
        <a class="featureBtn" style="background: url('<? echo vae_data_url().vae_image($shop->extra_image, "menu");?>') no-repeat 0 0;" href="<? echo $shop->extra_category->permalink; ?>"><? echo $shop->extra_category->title; ?></a>
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
 	
	
	<div id="page">
	
		<div id="shopBox" class="col12">
			
			<div class="shopRow1 col12">
				<ul>
					<? $max = 4; ?>
					<? $items = get_items( array('limit' => 4) );?>
					<? $i=1; ?>
					<? foreach($items as $item): ?>
						<li <? echo ($i == $max ) ? "class='last'" : ""; ?>>
							<a href="<? echo $item->permalink . "?registry=" . $registry->id; ?>" title="" class="single-item">
							<img src="<? echo vae_data_url().vae_image($item->main_image, '218', '218', 'Square'); ?>" width="218" height="218" alt="<? echo $item->title; ?>" />
							<span><a href='<? echo $item->permalink;?>' class="tooltip"><? echo $item->title; ?> <br />$<? echo sanitize_tooltip_html($item->price); ?></a></span
							</a>
						</li>
					<? $i++; ?>
					<? endforeach; ?>
				</ul>
			</div>

			<div class="shopRow2 col6">
			
				<ul>
					<?php
					$max = 2;
					$items = get_items( array('limit' => 2, 'skip'=>4) );?>				  	
					<? $i=1; ?>
					<? foreach($items as $item): ?>
						<li <? echo ($i == $max ) ? "class='last'" : ""; ?>>
							<a href="<? echo $item->permalink . "?registry=" . $registry->id; ?>" title="" class="single-item">
							<img src="<? echo vae_data_url().vae_image($item->main_image, '218', '218', 'Square'); ?>" width="218" height="218" alt="<? echo $item->title; ?>" />
							<span><a href='<? echo $item->permalink;?>' class="tooltip"><? echo $item->title; ?> <br />$<? echo sanitize_tooltip_html($item->price); ?></a></span
							</a>
						</li>
					<? $i++; ?>
					<? endforeach; ?>

				</ul>
			</div>

			<div class="shopRow3 col12">
				<ul>
					<?php
					$max = 4;
					$items = get_items( array('limit' => 4, 'skip'=>6) );?>
					<? $i=1; ?>
					<? foreach($items as $item): ?>
						<li <? echo ($i == $max ) ? "class='last'" : ""; ?>>
							<a href="<? echo $item->permalink . "?registry=" . $registry->id; ?>" title="" class="single-item">
							<img src="<? echo vae_data_url().vae_image($item->main_image, '218', '218', 'Square'); ?>" width="218" height="218" alt="<? echo $item->title; ?>" />
							<span><a href='<? echo $item->permalink;?>' class="tooltip"><? echo $item->title; ?> <br />$<? echo sanitize_tooltip_html($item->price); ?></a></span
							</a>
						</li>
					<? $i++; ?>
					<? endforeach; ?>
				</ul>
			</div>
			
			
			<? if( !is_null($_REQUEST['id']) ):?>

				<?php
				$items = get_items( array('skip' => 10) );

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
							<a href="<? echo $item->permalink . "?registry=" . $registry->id; ?>" title="" class="single-item">
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
			
			<? endif; // if !is_null($_REQUEST['id']) ?>
			
			<div class="clear"> </div>
		</div>
		
	</div><!-- #page -->
	
	<?php vae_include('/lib/includes/footer.html'); ?>
	
</body>
</html>