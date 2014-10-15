<?php get_header(); ?>
	
	<div class="row">
	
		<div class="nine columns">
			<h2>Videos<div class="alignright"><a href="feed/"><i class="icon-rss"></i></a></div></h2>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<div class="row article">
			
				<div <?php post_class('twelve columns'); ?>>
						<h4><?php the_title(); ?></h4>
		    			
		    			<h6><?php the_time( 'l, jS M, Y' ); ?> at <?php the_time('g:i a'); ?></h6>
						<?php global $post; $video = get_post_meta( $post->ID, '_cmb_video', true ); if( $video != '' ) :  ?>
							<?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), $prefix . '_cmb_video', true ) );  ?>
						<?php endif; ?>							
				</div>
				
			</div>

			<?php endwhile; ?>
			<div class="twelve columns">
				<?php wp_pagenavi(); ?>			
			</div>				
				<?php else : ?>
				<h4>Sorry, no Videos have been published yet.</h4>
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