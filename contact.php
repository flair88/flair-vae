<? $_REQUEST['loc'] = 'contact'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Flair Home Collection New York | Contact</title>
	<link href="lib/css/import.css" rel="stylesheet" type="text/css" media="all" />
	<!--[if lte IE 7]><link href="lib/css/ie7.css" rel="stylesheet" type="text/css" media="all"> <![endif]-->
	<!--[if lte IE 6]><link href="lib/css/ie6.css" rel="stylesheet" type="text/css" media="all"> <![endif]-->
 	<script src="lib/js/jquery.js" type="text/javascript" charset="utf-8"></script>
 	<script src="lib/js/jquery.cycle.all.min.js" type="text/javascript" charset="utf-8"></script>
 	<script src="lib/js/jquery.validate.min.js" type="text/javascript" charset="utf-8"></script>
	<script src="lib/js/jquery.tools.min.js" type="text/javascript"></script>
	<script src="lib/js/global.js" type="text/javascript"></script>
</head>

<body id="contactPg">
	<?php vae_include('/lib/includes/header.html'); ?>
	
	<? $contact = vae('/contact'); ?>
	
	<div id="page">
	 <?php vae_include('/lib/includes/logo.php'); ?>
		<div id="pageHeader" class="col12">
		  <? if((string)$contact->banner): ?>
			  <img src="<? echo vae_data_url() . vae_sizedimage( $contact->banner, 'Banner'); ?>" width="940" height="220" />
			<? endif; ?>
		</div>
		<div id="primeContent" class="col5plus">
		
			<? if( $_REQUEST['thanks'] ): ?>
				<h2><? echo $contact->thank_you_text; ?></h2>
				
				<p><? echo $contact->thank_you_body; ?></p>
				
				<?php else: ?>
				
				<h2><? echo $contact->form_title; ?></h2>

				<div>
		          <v:formmail to="<? echo $contact->recipient_email; ?>" id="contactForm" redirect="/contact?thanks=1" newsletter="6026311ea" newsletter_confirm="newsletter" newsletter_email_field="email">
		            <fieldset>
		                <p>
  		                <label for="name">Name</label>
  		                <v:text_field name="name" value="" id="name" class="text required" />
  		              </p>
	
  		              <p>
  		                <label for="email">Email</label>
  		                <v:text_field name="email" value="" id="email" class="text required email" />
  		              </p>
	
  		              <p>
  		                <label for="subject">Subject</label>
  		                <v:text_field name="subject" value="" id="subject" class="text required" />
  		              </p>
	
  		              <p id="cfMessage">
  		                <label for="message">Message</label>
  		                <v:text_area name="message" id="message" rows="6" cols="20" class="required" />
  		              </p>
		              
  		              <p>
  		                <v:checkbox type="checkbox" value="1" name="newsletter" id="newsletter" style="float:left;margin:0px;margin-right:5px;" />
  		                <label style="float:left;"> <? echo $contact->newsletter_label; ?></label>
  		                <br>
  		              </p>
  		              <v:captcha />
		            </fieldset>

		            <p><button type="submit" class="button">Submit</button></p>
		          </v:formmail>
		        </div>
	        
			<? endif; ?>
		</div>
		<div id="secondaryContent" class="col6">
			<div class="col2">
				<address>
					<?
					$locations = vae('/locations');
					echo nl2br( $locations->address );
					?>
				</address>
				<span>Tel: <?= $locations->phone; ?><br />Fax: <?= $locations->fax; ?></span>
				<ul class="contactNav">
					  <? $pages = vae('/about_pages'); ?>
					  <? $i=1; ?>
					  <? foreach($pages as $id=>$page): ?>
					    <? if($i>=2): ?>
					      <li><a href="<? echo vae_permalink($id); ?>"><? echo $page->title; ?></a></li>
					    <? endif; ?>
				      <? $i++; ?>
					  <? endforeach; ?>
				</ul>
			</div>
			<div class="copyright col3 last">
				<? echo nl2br($contact->text); ?>
			</div>
		</div>
		
	</div><!-- #page -->
	<?php vae_include('/lib/includes/footer.html'); ?>
</body>
</html>
