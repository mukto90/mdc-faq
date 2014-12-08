<?php
function mdc_faq_menu(){
	add_menu_page('MDC FAQ Configuration Page', 'FAQ Settings', 'administrator', 'mdc-faq-settings', 'mdc_faq_option_page_content', NULL, 42.01);
	add_submenu_page('mdc-faq-settings', 'Shortcode Generator', 'Shortcode Generator', 'administrator', 'mdc-shortcode-generator', 'mdc_faq_shortcode_generator');
}
add_action('admin_menu', 'mdc_faq_menu');

function mdc_faq_option_page_content(){
?>
<div class="wrap">
	<h2>FAQ Options</h2>
	<form method="POST" action="">
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label for="blogname">Site Title</label>
					</th>
					<td>
						<input id="blogname" class="regular-text" type="text" value="" name="blogname">
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input id="submit" class="button button-primary" type="submit" value="Save Changes" name="submit">
		</p>
	</form>
</div>
<?php
}

function mdc_faq_shortcode_generator(){
?>
<div class="wrap">
	<h2>Shortcode Generator</h2>
	<form method="POST" action="" class="gen-shortcode">
		<input type="hidden" name="gene-code" value="1" />
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label for="number">Number of FAQs to show</label>
					</th>
					<td>
						<input type="text" name="number" /><span>  (Leave empty to show all)</span>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="category">Choose Categories</label>
					</th>
					<td>
						<select id="category" name="category[]" class="chosen" multiple="true" style="width:400px;">
							<option value="">All</option>
						<?php
						$caregories = get_terms('faq_category');
						foreach ($caregories as $term) {
							echo "<option value=".$term->slug.">".$term->name."</option>";
						}
						?>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="keyword">Choose Keywords</label>
					</th>
					<td>
						<select id="keyword" name="keyword[]" class="chosen" multiple="true" style="width:400px;">
							<option value="">All</option>
						<?php
						$keyword = get_terms('keyword');
						foreach ($keyword as $term) {
							echo "<option value=".$term->slug.">".$term->name."</option>";
						}
						?>
						</select>
					</td>
				</tr>
			</tbody>
		</table>
		<p class="submit">
			<input id="submit" class="button button-primary gen-button" onclick="return false" type="submit" value="Generate"/>
		</p>
	</form>
	<div id="how-to-shortcode" style="display: none">
		<h3>How to create an FAQ page</h3>
		<form action="" method="POST">
			<input type="hidden" name="gene-page" value="1" />
			<ol>
				<li>Copy the shortcode below.<br /><span id="generate" ></span></li>
				<li>Go to <a href="<?php echo admin_url();?>post-new.php?post_type=page" target="_blank">Pages > Add New</a>. Give a title and paste the shortcode in the content editor area.</li>
				<li>Publish the page.</li>
				<li>Or, give a page title and click the button below to do it for you-</li>
			</ol>
			<input type="text" name="faq_title" placeholder="Page Title">
			<input id="submit" type="submit" class="button button-primary gen-page-btn" value="Generate FAQ Page" />
		</form>
	</div>
		<?php if($_POST['gene-page']){
		// Create post object
		$my_post = array(
		'post_title'	=>	$_POST['faq_title'],
		'post_content'	=>	$_POST['shortcode'],
		'post_status'	=>	'publish',
		'post_type'		=>	'page'
		);

		// Insert the post into the database
		$faq_pid = wp_insert_post( $my_post );
		echo "<span class=\"gen-success\">FAQ page has been created. <a href=\"".get_the_permalink($faq_pid)."\" target=\"_blank\">Click here</a> to view the page.</span>";
		}
		?>
</div>
<?php
} 