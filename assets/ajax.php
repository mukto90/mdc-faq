<?php
if($_POST['gene-code']){
	$output	 = "[mdc_faq";
	if($_POST['number'] != ''){
		$output	.= " number='".$_POST['number']."'";
	}
	if(isset($_POST['category'][0]) && $_POST['category'][0] != ''){
		$output	.= " category='";
		foreach($_POST['category'] as $cat){
			$output	.= $cat.", ";
		}
		$output .= "'";
	}
	if(isset($_POST['keyword'][0]) && $_POST['keyword'][0] != ''){
		$output	.= " keyword='";
		foreach($_POST['keyword'] as $key){
			$output	.= $key.", ";
		}
		$output .= "'";
	}
	$output .= "]";
	$output = str_replace(", '", "'", $output);
	echo "<input onClick=\"this.setSelectionRange(0, this.value.length)\" type=\"text\" name=\"shortcode\" value=\"".$output."\" style=\"width:400px;\" readonly />";
}
