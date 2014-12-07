<?php
function enque_scripts(){
?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__).'assets/mdc-faq.css';?>">
<script src="<?php echo plugin_dir_url(__FILE__).'assets/mdc-faq.js'; ?>"></script>
<script>
$ = new jQuery.noConflict();
$(document).ready(function(){
	$( "#accordion" ).accordion({
		heightStyle: "content",
		collapsible: true,
		active: true
	});
});
</script>
<?php
}
add_action('wp_head', 'enque_scripts');


function admin_enqueue_script(){
?>
	<link rel="stylesheet" href="<?php echo plugin_dir_url(__FILE__);?>assets/chosen.css" />
	<script src="<?php echo plugin_dir_url(__FILE__);?>assets/jquery.js"></script>
	<script src="<?php echo plugin_dir_url(__FILE__);?>assets/chosen.jquery.js"></script>
	<script>
		jQuery(document).ready(function(){
			jQuery(".chosen").chosen();
		});
	</script>
<?php
}
if($_GET['page'] == 'mdc-shortcode-generator'){
add_action('admin_head', 'admin_enqueue_script');
}