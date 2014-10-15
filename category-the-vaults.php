<?php get_header(); ?>
	
	<div class="row">
	
		<div class="nine columns">
			<h2>The Vaults<div class="alignright"><a href="feed/"><i class="icon-rss"></i></a></div></h2>
			<?php
			$args = array (
				'category_name' => 'The Vaults',
			);
			$query = new WP_Query( $args );
			?>
			<?php if ( $query->have_posts() ) { while ( $query->have_posts() ) { $query->the_post(); ?>
		
			<div class="row article">
			
				<div <?php post_class('twelve columns'); ?>>
					<div class="row article">
					<?php if ( has_post_thumbnail() ) { ?>
    					<div class="twelve columns">
    						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured'); ?></a><small><?php the_post_thumbnail_caption(); ?></small>
    						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    						<?php the_excerpt(); ?>
    					</div>
    				<?php } else { ?>
    					<div class="twelve columns">
    						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
    						<?php the_excerpt(); ?>
    					</div>
    				<?php } ?>		
					</div>					
				</div>
				
			</div>

			<?php } ?>
			<div class="twelve columns">
				<?php wp_pagenavi(); ?>		
			</div>				
				<?php } else { ?>
				<h4>Sorry, no notices have been found.</h4>
				<?php } wp_reset_postdata(); ?>			
			
			
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