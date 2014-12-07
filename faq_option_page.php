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
	<form method="POST" action="">
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
			<input id="submit" class="button button-primary" type="submit" value="Generate"/>
		</p>
	</form>
	<?php
	if ($_POST) {
		$output	 = "[mdc_faq";
		if($_POST['number'] != ''){
			$output	.= " number='".$_POST['number']."'";
		}
		if($_POST['category'][0] != ''){
			$output	.= " category='";
			foreach($_POST['category'] as $cat){
				$output	.= $cat.", ";
			}
			$output .= "'";
		}
		if($_POST['keyword'][0] != ''){
			$output	.= " keyword='";
			foreach($_POST['keyword'] as $key){
				$output	.= $key.", ";
			}
			$output .= "'";
		}
		$output .= "]";
		$output = str_replace(", '", "'", $output);
		echo "<input onClick=\"this.setSelectionRange(0, this.value.length)\" type=\"text\" value=\"".$output."\" style=\"width:400px;\" readonly />";
	}
	?>
</div>
<?php
} 