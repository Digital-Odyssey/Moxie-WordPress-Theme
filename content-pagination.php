<?php
/**
 * Use this file to quickly insert pagination where necessary
 */
?>

<div class="pm-clear-overflow">

<?php 
		
	if(function_exists('moxie_theme_kriesi_pagination')){
		
		moxie_theme_kriesi_pagination();		
		
	} else {
		posts_nav_link();	
	} 

?>

</div>