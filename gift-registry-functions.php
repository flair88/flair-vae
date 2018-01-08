<?  $userId = $_SESSION['__v:logged_in']['id']; 
		$user = vae($userId);
		
		function print_items($user){
		  $i = 0; 
		  foreach ($user->items as $item): 
		    $items .=  ($i > 0) ? "," . $item->id: $item->id; 
		    $i++; 
		  endforeach; 
		  return $items;
		}
    if (isset($_REQUEST['itemId'])): 
      
      $itemId = $_REQUEST['itemId']; 
      $additems = print_items($user); 
      vae_update($userId, array('items' =>"$itemId,$additems"));          
      
    endif; 
		  
		   if ($_REQUEST['removeId']): 
		     $items = print_items($user); 
		     $curritems = explode(",", $items);
		     foreach($curritems as $key => $value):
          if($value == $_REQUEST['removeId'] ):
            unset($curritems[$key]);
          endif;
          endforeach; 
         $removeitems = implode(",", $curritems);
          if ($removeitems != ""):
            vae_update($userId, array('items' =>"$removeitems"));   
          else:
            vae_update($userId, array('items' =>"661767"));
          endif;
		   endif; 
		   header("Location:/gift-registry.php");
?>