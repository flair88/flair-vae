<?	

$_title = '| Thank You'; 
vae_include('/lib/includes/head.html');

$_REQUEST['vars']['loc'] = "shop";
$_REQUEST['vars']['title'] = " | Verify Registry";
$hash = $_GET['hid'];

vae_include("/verify/functions.php");

connect();

$q = "select * from registries where hash = '$hash';";
$result = q($q);

if(!is_null($result[0]['hash']) && $result[0]['verified'] != '1'):
  $id = $result[0]['id'];
  $name = $result[0]['name'];
  $title = $result[0]['title'];
  $email = $result[0]['email'];
  $password = $result[0]['password'];
  
  $q = "update registries set verified = 1 where id = '$id';";
  mysql_query($q);  
  
  vae_create(54201, 734250, array('name' => $name, 'title' => $title, 'email' => $email, 'password' => $password)); 
  $adminmail = vae("/contact/recipient_email");
  sendadminMail((string)$adminmail);
else:
  $expired = true;
endif;

?>
<body id="thankYou">
	<? vae_include('/lib/includes/header.html'); ?>
	
	<div id="page">
	 <h1 id="logo"><a href="/" title="Flair">Flair</a></h1>  
	 <div id="pageHeader" class="col12">
	   <v:img path="/thank_you_text/header_image" image_size="Header" />
	 </div>


    <div id="primeContent" class="col5plus registerThanks">
    <? if ($expired == true): ?>
      	<h2>This registry has already been created.</h2>
			Please <a href="/gift-registry-login.php">login</a> here.
		</div>
    <? else: ?>
			<h2>Thank You for Confirming your Gift Registry.</h2>
			You may now <a href="/gift-registry.php">login</a> and add items to your registry.
		</div>
  <? endif; ?>
	</div>
	
<? vae_include('/lib/includes/footer.html'); ?>
	
</body>
</html>