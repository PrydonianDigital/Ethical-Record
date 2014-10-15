<form id="search" name="searchform" method="get" action="<?php bloginfo("url"); ?>">
	<div class="field">
		<input type="search" class="input wide" id="s" name="s" placeholder="Search" value="<?php the_search_query(); ?>" /> 
		<div class="btn secondary medium">
			<a href="#" id="submitForm"><i class="icon-search"></i></a>
		</div>
		<br /><a href="#" id="searchAnchor"><i id="toggle" class="icon-down-open-big"></i> Search Options</a>
	</div>
	<div class="field" id="options">
		<select name="category_name">
			<option value="" selected>Everything</option>
			<?php
				$categories = get_categories();
				foreach ($categories as $category) {
				    echo '<option value="', $category->slug, '">', $category->name, "</option>\n";
				}
			?>
		</select>
	</div>
</form>