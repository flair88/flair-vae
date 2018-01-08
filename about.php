<? $_REQUEST['loc'] = 'about'; ?>
<? // ajax logic ?>
<? if( $_REQUEST['ajax'] ): ?>
	<? $page = vae($_REQUEST['id']); ?>
	<?php require_once('lib/includes/about.html'); ?>
<? exit; endif; ?>

<? $page = vae($_REQUEST['id']); ?>

<? // title logic
$_title = array('About');
if( (string)$page->title ) { $_title[] = $page->title; }

$_title = ' | ' . implode( ' | ', $_title );
?>

<? include('lib/includes/head.html'); ?>


<body id="aboutPg" class="aboutUsSubPg">  
	<?php vae_include('/lib/includes/header.html'); ?>
	
	<div id="page">
	 <?php vae_include('/lib/includes/logo.php'); ?>
	  <? if(is_null($_REQUEST['id'])): ?>	    
	    <? $pages = vae('/about_pages'); ?>
	    <? foreach($pages as $id=>$page): ?>
	    
	      <? require_once('lib/includes/about.html'); ?>
			
			<? break; ?>
		<? endforeach; ?>
		<? else: ?>
		  
		  <? $page = vae($_REQUEST['id']); ?>
		  <? require_once('lib/includes/about.html'); ?>
			
		<? endif; ?>
	</div><!-- #page -->
	<div class="clear"></div>
	<?php vae_include('/lib/includes/footer.html'); ?>
	
	<style type="text/css">
	#pageHeader {
    background: black;
	}
	</style>
</body>
</html>
