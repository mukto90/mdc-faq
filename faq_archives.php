<?php
//archive of all faqs
function mdc_faq_archive($atts){
	extract( shortcode_atts( array (
		'number'	=>	-1,	//integer, default unlimited
		'category'	=>	'',	//faq_category slug, default all
		'keyword'	=>	''	//keyword slug, default all
	), $atts ) );
	$all = array(
		'post_type'			=>	'mdc_faq',
		'posts_per_page'	=>	$number,
		'faq_category'		=>	$category,
		'keyword'			=>	$keyword,
	);
	$all_faq = new WP_Query($all);
	if($all_faq->have_posts()):
		echo "<ul>";
		while($all_faq->have_posts()): $all_faq->the_post();
			echo "<li>".get_the_title()."</li>";
		endwhile;
		echo "</ul>";
	else:
		echo "No FAQs found!";
	endif;
}
add_shortcode('mdc_faq', 'mdc_faq_archive');