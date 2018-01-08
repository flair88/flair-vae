<?php

$_REQUEST['loc'] = 'shop';

if( $_REQUEST['id'] ) {
	$xpath = '';
	$id = $_REQUEST['id'];
	
	$xpath = array();
	
	$xpath[] = 'category=' . $id;
	
	$subcategories = vae($id . '/subcategories');
	foreach( $subcategories as $subcategory ) {
		$xpath[]= 'category=' . $subcategory->id;
		// $xpath[] = "shop/items[category=' . $subcategory->id . '][featured='1']";
	}

	$xpath = "/shop/items[inventory>0][" . implode( $xpath, ' or ' ) . "]";
	
	// echo $xpath;
	// exit;
}

$_REQUEST['xpath'] = $xpath;

function sanitize_tooltip_html( $input ) {
	// return addslashes(preg_replace("/[^\w\s]/", ' ', $input));
	return htmlentities($input);
}

function get_items( $filter ) {
	global $_REQUEST;
	
	$xpath = $_REQUEST['xpath'];

			
		// shop.php
		$items = vae('/gift_cards/cards[inventory>0]', $filter);
	
	return $items;
}

$category = vae( $_REQUEST['id'] );
$parent_category = $category->get('..');
?>

<?
// title logic
$_title = array('Shop');
if( (string)$parent_category->title ) { $_title[] = $parent_category->title; }
if( (string)$category->title ) { $_title[] = $category->title; };

$_title = ' | ' . implode( $_title, ' | ');
?>

<? include('lib/includes/head.html'); ?>
<!-- <script type="text/javascript" src="/lib/js/jquery.lazyload.js"></script> -->

<body id="shopPg">
	<?php vae_include('/lib/includes/header.html'); ?>
	<div id="page">
	   <h1 id="logo"><a href="/" title="Flair">Flair</a></h1>  
		<div id="shopBox" class="col12">
			
			<div class="shopRow1 col12">
				<ul>
					<?php
					$max = 4;
					$items = get_items( array('limit' => 4) );
				  include 'shop-row.php';
					?>
				</ul>
			</div>

			<div class="shopRow2 col6">
				<ul>
					<?php
					$max = 2;
					$items = get_items( array('limit' => 2, 'skip'=>4) );
				  include 'shop-row.php';
					?>
				</ul>
			</div>

			<div class="shopRow3 col12">
				<ul>
					<?php
					$max = 4;
					$items = get_items( array('limit' => 4, 'skip'=>6) );
				  include 'shop-row.php';
					?>
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
							$max = 4;
						  include 'shop-row.php';
							?>

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