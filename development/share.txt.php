<?=("Mail submitted at " . strftime("%B %d, %Y at %H:%M") . ":\n\n");?>
<?php
foreach( $_REQUEST as $key => $value ) {
  echo str_replace('_', ' ', $key) . ': ' . $value . "\n";
}
?>