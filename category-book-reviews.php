<?php get_header(); ?>
	
	<div class="row">
	
		<div class="nine columns">
			<h2>Book Reviews<div class="alignright"><a href="feed/"><i class="icon-rss"></i></a></div></h2>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<div class="row article">
			
				<div <?php post_class('twelve columns'); ?>>
						<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured'); ?></a><small><?php the_post_thumbnail_caption(); ?></small>
						<?php } ?>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		    			
		    			<h6><?php the_time( 'l, jS M, Y' ); ?> at <?php the_time('g:i a'); ?></h6>
		    			<h6><?php post_read_time(); ?></h6>
		    			<?php if(has_term('talks-lectures','section')) { ?>
		    				<?php global $post; $abstract = get_post_meta( $post->ID, '_cmb_abstract', true ); if( $abstract != '' ) :  ?>
		    					<p><?php global $post; $abstract = get_post_meta( $post->ID, '_cmb_abstract', true ); echo $abstract;  ?>..<a href="<?php the_permalink(); ?>">Read More &raquo;</a></p>
		    				<?php endif; ?>
		    			<?php } elseif (has_term('book-reviews','section')) { ?>
		    				<?php global $post; $author = get_post_meta( $post->ID, '_cmb_author', true ); if( $author != '' ) :  ?>
		    					<p>By: <strong><?php global $post; $publisher = get_post_meta( $post->ID, '_cmb_author', true ); echo $publisher;  ?></strong> 
		    					<?php global $post; $author = get_post_meta( $post->ID, '_cmb_publisher', true ); if( $author != '' ) :  ?>
		    						(<?php global $post; $publisher = get_post_meta( $post->ID, '_cmb_publisher', true ); echo $publisher;  ?>)
		    					<?php endif; ?>
		    					</p>
		    					<?php global $post; $reviewer = get_post_meta( $post->ID, '_cmb_vpauthor', true ); if( $reviewer != '' ) :  ?>
		    						<p>Review by: <?php global $post; $reviewer = get_post_meta( $post->ID, '_cmb_vpauthor', true ); echo $reviewer;  ?></p>
		    					<?php endif; ?>
		    					<?php the_excerpt(); ?>
		    				<?php endif; ?>
		    			<?php } ?>
				</div>
				
			</div>

			<?php endwhile; ?>
			<div class="twelve columns">
				<?php wp_pagenavi(); ?>			
			</div>				
				<?php else : ?>
				<h4>Sorry, no Book Reviews have been published yet.</h4>
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