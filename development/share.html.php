<?php
$item = vae($_REQUEST['id']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Flair Home Collection New York | <?=$item->title;?></title>
<style type="text/css">
<!--
h1 {
	font-family: Garamond, "Hoefler Text", Palatino, "Palatino Linotype", serif;
	font-weight: normal;
	font-size: 21px;
	margin-top: 0px;
}
p {
	font-family: "Helvetica Neue", Arial, Helvetica, sans-serif;
	font-size: 12px;
	line-height: 18px;
	margin-bottom: 0px;
	color: #666666;
}
.style1 {
	color: #000000;
	font-weight: bold;
}
-->
</style>
</head>

<body>
	
	
	<p class="style1">
	 Hello, <?=$_REQUEST['email_recipient_name'];?>.<br />
	 <?=$_REQUEST['email_sender_name'];?> shared an item on Flair Home Collection with you.
	</p>
	<p>
	 <?=$_REQUEST['email_message'];?>
	</p>
	
<div align="center">
  <table width="535" border="0" cellpadding="10" style="border:solid 3px black;">
    <tr>
      <th height="50" colspan="3" scope="col"><img src="http://flair.verbsite.com/print/flair.png" width="209" height="47" /></th>
    </tr>
    <tr>
      <td colspan="3" align="center" valign="middle">
        <p style="margin:0px;">
          <?php
          foreach($item->images as $image):
            ?>
              <img src="<?=vae_data_url().vae_sizedimage($image->image,'Square');?>" width="429" height="429" />            
            <?
            break;
          endforeach;
          ?>

          <br />
          <br />
        </p>
      </td>
    </tr>
    <tr>
      <td width="299" align="left" valign="top" style="padding-top:0px;">
      <h1><?=$item->title;?></h1>
      <p>
        <?=$item->description;?>
      </p>

      </td>
      
      <td width="1" rowspan="2" align="left" valign="top" style="background-color:#000000;padding:0px;"> </td>
      
      <td width="161" align="left" valign="top" style="padding-top:0px;">
      <h1>$<?=$item->price?></h1>
      <p class="style1">
        Item #: <?=$item->item_number;?><br />
	      <?=$item->specs;?><br />
        Info: <?=$item->color;?><br />
      
      </p>      </td>
    </tr>
    <tr>
      <td align="left" valign="top" style="padding-bottom:0px;"><h1>Item URL:</h1>
      <p><?=vae_permalink($item->id);?></p></td>
      <td align="left" valign="top" style="padding-bottom:0px;"><p>88 Grand St.<br />
        New York, NY 10013<br />
        Tel: 212-274-1750</p>      </td>
    </tr>
    <tr>
      <td colspan="3" align="center" valign="middle"><p><br />
        <img src="http://flair.verbsite.com/print/footer.png" width="234" height="8" /></p>
      </td>
    </tr>
  </table>
</div>
<p align="center">For more information about this item or FLAIR Home Collection products,<br />
please visit <a href="http://www.flairhomecollection.com">www.flairhomecollection.com</a></p>
</body>
</html>
