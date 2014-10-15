<?php get_header(); ?>
	
	<div class="row">
	
		<div class="nine columns">
			<h2>Notices<div class="alignright"><a href="feed/"><i class="icon-rss"></i></a></div></h2>
			
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
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

			<?php endwhile; ?>
			<div class="twelve columns">
				<?php wp_pagenavi(); ?>		
			</div>				
				<?php else : ?>
				<h4>Sorry, no notices have been found.</h4>
				<?php endif; ?>			
			
			
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