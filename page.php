<?php get_header(); ?>
	
	<div class="row article">
	
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		
		<div class="nine columns">
		
			<?php if ( has_post_thumbnail() ) { ?>
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured'); ?></a><small><?php the_post_thumbnail_caption(); ?></small>
			<?php } ?>
			
			<h2><?php the_title(); ?></h2>
			
			<?php the_content(); ?>
								
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
		
		<?php endwhile; ?>
		<?php else: ?>
		
		<h2>Sorry, no posts matched your criteria.</h2>
		
		<?php endif; ?>

	</div>

<?php get_footer(); ?>