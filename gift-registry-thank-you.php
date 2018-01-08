<?	

$_title = '| Thank You'; 
include('lib/includes/head.html');

$_REQUEST['vars']['loc'] = "shop";
$_REQUEST['vars']['title'] = " | Shop | Thank You";

vae_include("/verify/functions.php");

$hash = create_code();
$mail = $_POST['email'];
$existing = vae("/gift_registry/registries[email='$mail']");


if(validEmail($_POST['email'])):
  if((string)$existing->title):
      $repeat = true; 
  else:
    connect();
  
    $q = "select * from registries where hash = '$hash';";
    $results = q($q);
    
    $name = mysql_real_escape_string($_POST['name']);
    $title = mysql_real_escape_string($_POST['title']);
      $email = mysql_real_escape_string($_POST['email']);
    $password = mysql_real_escape_string($_POST['password']);
    $title = mysql_real_escape_string($_POST['title']);
    
    if (count($results) == 0): 
      $q = "insert into registries (name, email, password, title, hash, verified) values ('$name', '$email', '$password', '$title', '$hash', 0);";
      mysql_query($q);
      
     sendMail($email, $hash);  
    endif;

  endif;

endif;


?>

<body id="thankYou">
	<? require_once('lib/includes/header.html'); ?>
	
	<div id="page">
	 <h1 id="logo"><a href="/" title="Flair">Flair</a></h1>  
	 <div id="pageHeader" class="col12">
	   <v:img path="/thank_you_text/header_image" image_size="Header" />
	 </div>


    <div id="primeContent" class="col5plus registerThanks">
    <? if ($repeat == true):?>
			<h2>There is already a registry using that email.</h2>
			Did you <a href="/forgot-password">forget your password</a>? Or would you like to <a href="/gift-register">create another registry</a> using a different email address?
		</div>
    <? endif; ?>
    <h2>Thank You for Registering.</h2>
			Please check your email to confirm registration.
		</div>
	</div>
	
<? require_once('lib/includes/footer.html'); ?>
	
</body>
</html>