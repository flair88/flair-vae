<? $i=1; ?>
<? foreach($items as $id=>$item): ?>

  <? if($i==$max): ?>
  <li class="last">
  <? else: ?>
  <li>
  <? endif; ?>

  <a href="<? echo vae_permalink($item->id); ?>" title="" class="single-item">

		<? if( (string)$item->main_image ): ?>
	    <img src="<? echo vae_data_url().vae_image($item->main_image, '218', '218', 'Square'); ?>" width="218" height="218" alt="<? echo sanitize_tooltip_html($item->title); ?>" />
			
			<? else: ?>
	
				<? foreach( $item->images as $img): ?>
			    <img src="<? echo vae_data_url().vae_image($img->image, '218', '218', 'Square'); ?>" width="218" height="218" alt="<? echo sanitize_tooltip_html($item->title); ?>" />
					<? break;?>
				<? endforeach; ?>
	
		<? endif; ?>
		
		<span><a href='<?=vae_permalink($item->id);?>' class="tooltip"><? echo $item->title; ?> <br />$<? echo sanitize_tooltip_html($item->price); ?></a></span>
		
  </a>
  </li>
  <? $i++; ?>
<? endforeach; ?>