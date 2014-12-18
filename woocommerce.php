<?php get_header(); ?>
	
	<div class="row article">
			
		<div class="nine columns">
		
			<?php woocommerce_content(); ?>
								
		</div>
		
		<div class="three columns side">
		
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