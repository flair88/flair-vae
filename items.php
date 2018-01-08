<? $_REQUEST['loc'] = 'shop'; ?>

<? $item = vae($_REQUEST['id']); 
if ($_GET['registry']):
  $registry = vae($_GET['registry']); 
endif; ?>
<? $_title = ' | ' . implode( array('Shop', $item->title), ' | ' ); ?>
<? include('lib/includes/head.html'); ?>

<!-- <script src="/lib/js/jquery.ajaxform.js" type="text/javascript" charset="utf-8"></script>  -->
<script src="/lib/js/jquery.validate.min.js" type="text/javascript" charset="utf-8"></script> 
<script src="/lib/js/jquery.fancybox.js" type="text/javascript" charset="utf-8"></script>
<script src="/lib/js/cloud-zoom.1.0.2.min.js" type="text/javascript" charset="utf-8"></script>

<style type="text/css">
@import url('/lib/css/fb.css');
</style>

<body id="productDetailPg">
	<?php vae_include('/lib/includes/header.html'); ?>
	<div id="page">
	 <?php vae_include('/lib/includes/logo.php'); ?>
		<div id="primeContent" class="col5plus">

			<div class="productPic slide">
			  <? foreach($item->images as $id=>$img): ?>
			   <!--  <a href="<? echo vae_data_url().vae_image($img->image, '1200', '1200', 'Square'); ?>" class="cloud-zoom" rel="position: 'inside', showTitle: false, zoomWidth: 429, zoomHeight: 419" > -->
				    <img src="<? echo vae_data_url().vae_image($img->image, '429', '429', 'Square'); ?>" width="429" height="419" alt="<? echo $item->title; ?>" />
				  <!-- </a> -->
				<? endforeach; ?>
			</div>

			<div class="productContent">
				<h4><? echo $item->title; ?></h4>

				<div class="productAdd">
					<form method="post" action="/cart.php">
						<input type="hidden" name="id" value="<?= $item->id; ?>" />
						<input type="hidden" name="notes" value="<?= $registry->name; ?>, <?= $registry->title; ?> #<?= $registry->id;?>" />
						<ul>
						  <? if ((string)$item->original_price):?>
	            <li class="original price">$<? echo $item->original_price; ?></li>
	            <? endif;?>
							<li class="price">$<? echo $item->price; ?></li>
							<li class="pipe">|</li>
							<li class="addToCart">
								<v:if path="<?=$item->id;?>/inventory">
									<button type="submit" class="button">Add to Cart</button>
						      </form>
									<v:users:if_logged_in>
									<form action="/gift-registry-functions.php" method="get">
								    <input type="hidden" value="<?= $item->id?>" name="itemId">
									   <button type="submit" class="button registry">Add to Registry</button>
									</form>
									</v:users:if_logged_in>
									<v:else>
										<button type="submit" class="button" disabled="disabled">Out Of Stock</button>
								    </form>
									</v:else>
								</v:if>
								</button>
						  </li>
						</ul>

				</div>

				<p>
					<? echo nl2br($item->description); ?>
				</p> 

				<div class="productSpecs">
					<dl>
						
						<dt>Item #:</dt>
						<dd><? echo $item->item_number; ?></dd>
						<dt>Info:</dt>
						<dd><? echo $item->color; ?></dd>
					</dl>
					<p><? echo nl2br($item->specs); ?></p>
					  
				</div>
				
		        <? if($item->shipping_class=='custom'): ?>
				  <div class="custShip">This product requires <a href="/about/custom-shipping">Custom Shipping</a>.</div>
				<? endif; ?>

			</div>
		</div>
		<div id="secondaryContent" class="col6">

			  <div class="productDetailPic col6">
			  	<? if( isset($item->detail_image) ): ?>
				    <img src="<? echo vae_data_url().vae_sizedimage($item->detail_image, 'Detail'); ?>" width="460" height="220" alt="<? echo $item->title; ?>" />
				<? endif; ?>
			  </div>			


			<div id="productTools">
				<ul>
					<li><a href="#request_information" class="request-information">Request Information</a><span>|</span></li>
					<li><a href="/print?id=<v->" target="_blank">Print Product</a><span>|</span></li>
					<li><a href="#email_item" class="email-link">Email Item</a></li>
				</ul>     
				
				
				<?php vae_include('/lib/includes/request-information.html'); ?>
				<?php vae_include('/lib/includes/email-item.html'); ?>
			</div>
		</div>

				
		<div class="clear"></div>
	</div><!-- #page -->
	<?php vae_include('/lib/includes/footer.html'); ?>
</body>
</html>
