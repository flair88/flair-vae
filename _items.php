<? include('lib/includes/head.html'); ?>
<? $item = vae($_REQUEST['id']); ?>

<body id="productDetailPg">
	<?php require_once('lib/includes/header.html'); ?>
	<div id="page">
		<div id="primeContent" class="col5plus">

			<div class="productPic slide">
				<img src="images/fpo-product.jpg" width="429" height="419" alt="Fpo Product" />
				<img src="images/fpo-product.jpg" width="429" height="419" alt="Fpo Product" />
				<img src="images/fpo-product.jpg" width="429" height="419" alt="Fpo Product" />
			</div>

			<div class="productContent">
				<h4>Name of Product Goes Here</h4>

				<div class="productAdd">
					<form method="post" action="cart.php">
						<ul>
							<li class="price">$1,600.00</li>
							<li class="pipe">|</li>
							<li class="addToCart"><button type="submit" class="button">Add to Cart</button></li>
						</ul>
					</form>
				</div>

				<p>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
				</p> 

				<div class="productSpecs">
					<dl>
						<dt>Size:</dt>
						<dd>26''l x 26''d x 17''h</dd>
						<dt>Item #:</dt>
						<dd>1911</dd>
						<dt>Color:</dt>
						<dd>Cillum</dd>
					</dl>
				</div>

				<div class="custShip">This product requires <a href="#">Custom Shipping</a></div>

			</div>
		</div>
		<div id="secondaryContent" class="col6">
			<div class="productDetailPic col6"><img src="images/fpo-product-detail.jpg" width="460" height="220" alt="Fpo Product Detail" /></div>			

			<div id="productTools">
				<ul>
					<li><a href="#">Request Information</a><span>|</span></li>
					<li><a href="#">Print Product</a><span>|</span></li>
					<li><a href="#">Email Item</a></li>
				</ul>     
			</div>
		</div>

				
		<div class="clear"></div>
	</div><!-- #page -->
	<?php vae_include('/lib/includes/footer.html'); ?>
</body>
</html>
