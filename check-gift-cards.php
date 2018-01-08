<? 
include('lib/includes/head.html');
$_title = '| Check Gift Cards'; 
$code = $_REQUEST['code'];
?>

<body id="checkCode">
	<?php vae_include('/lib/includes/header.html'); ?>
<div id="page">
	<div id="primeContent" class="col5plus">
		<div id="checkgiftcards">
		</div><v:users:if_logged_in>
			<h2>Check Gift Card Values</h2>
			<div id="checkGift">
				<form action="check-gift-cards.php" method="post">
					<p class="input">
					<label for="code">Please enter a Code:</label>
					<input type="text" class="text required name" name="code" />
					</p>
					<input type="submit" value="Find Code">
				</form>
				<br />
				<? if ($code): ?>
					<? $coupon = vae_store_find_coupon_code($code); ?>
					<? if ($coupon): ?>
						<? echo $coupon['description'] . "<br />" . 
							 "This coupon provides a fixed discount of " . $coupon['fixed_amount'];	?>
					<? else: ?>
						<? echo "This gift card code is invalid."; ?>  		
					<? endif; ?>
				<? endif; ?>
			<v:else>
				<v:users:login path="gift_card_login" redirect="/check-gift-cards" required="username,password" invalid="Login information incorrect.">
					<p class="input">
						<label for="username">Username: </label>
						<v:text_field path="username" class="text required name" name="username"/>
					</p>
					<p class="input">
						<label for="username">Password: </label>
						<v:password_field path="password" class="text required name" name="password"/>
					</p>
					<input type="submit" value="Login" />
				</v:users:login>
				<br />
				You are not logged in.
			</v:else>
			<v:users:logout redirect=".."><br/>Click here to logout.</v:users:logout>			
			</v:users:if_logged_in>
		</div>
		</div>
	</div>
</div>
	
<?php vae_include('/lib/includes/footer.html'); ?>

</body>
</html>
				