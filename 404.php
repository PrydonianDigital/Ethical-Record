<?php get_header(); ?>
	
	<div class="row article">
			
		<div class="nine columns">
			<h2>Page not found</h2>
			<p>We're very sorry, but whatever you were looking for has not been found. Please try the menu to the left or the search below.</p>
			<?php get_search_form(); ?>		
		</div>
		<div class="three columns">
			<div class="row">
				<div class="twelve columns">
					<ul>
						<?php dynamic_sidebar( 'homepage' ); ?>
					</ul>
				</div>
			</div>	
		</div>
	</div>
	
<?php get_footer(); ?>