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
		echo "<div id=\"accordion\">";
		while($all_faq->have_posts()): $all_faq->the_post();
			echo "<h3><a href=\"\">".get_the_title()."</a></h3>";
			echo "<div>";
			echo get_the_content();
			//attachment images
			if(have_rows('faq_images')):
				echo "<div class=\"faq-attach attach-img\">
						<h3>Images</h3>";
				while(have_rows('faq_images')): the_row();
					// echo "<span>".get_sub_field('image_title')."</span>";
					echo "<a href='".get_sub_field('image')."'><img src='".get_sub_field('image')."' title='".get_sub_field('image_title')."' /></a>";
					//echo get_sub_field('image')."<br />";
				endwhile;
				echo "</div>";
			endif;
			//attachment videos
			if(have_rows('faq_videos')):
				echo "<div class=\"faq-attach attach-vdo\">
						<h3>Videos</h3>";
				while(have_rows('faq_videos')): the_row();
					echo "<span>".get_sub_field('video_title')."</span>";
					$virray = explode('?v=',get_sub_field('video'));
					echo "<iframe width=\"560\" height=\"315\" src=\"//www.youtube.com/embed/".substr($virray[1],0,11)."\" frameborder=\"0\" allowfullscreen></iframe>";
				endwhile;
				echo "</div>";
			endif;
			//attachment docs
			if(have_rows('faq_docs')):
				echo "<div class=\"faq-attach attach-doc\">
						<h3>Documents</h3>
						<ul>";
				while(have_rows('faq_docs')): the_row();
					echo "<li><a href='".get_sub_field('doc_pdf_ppt')."'>".get_sub_field('document_name')."</a></li>";
				endwhile;
				echo "</ul>
					</div>";
			endif;
			//attachment ends
			echo "</div>";
		endwhile;
		echo "</div>";
	else:
		echo "No FAQs found!";
	endif;
}
add_shortcode('mdc_faq', 'mdc_faq_archive');