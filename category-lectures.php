<?php get_header(); ?>
	
	<div class="row">
	
		<div class="nine columns">
			<h2>Lectures<div class="alignright"><a href="feed/"><i class="icon-rss"></i></a></div></h2>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
			<div class="row article">
			
				<div <?php post_class('twelve columns'); ?>>
						<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured'); ?></a><small><?php the_post_thumbnail_caption(); ?></small>
						<?php } ?>
						<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
		    			<h6>Posted on: <?php the_time( 'D, jS M, Y' ); ?></h6>
		    			<?php global $post; $date = get_post_meta( $post->ID, '_cmb_lecdate', true ); if( $date != '' ) :  ?>
		    				<h6>Lecture date: <?php global $post; $date = get_post_meta( $post->ID, '_cmb_lecdate', true ); echo date('D, jS M, Y', strtotime($date))  ?></h6>
		    			<?php endif; ?>
		    			<h6><?php post_read_time(); ?></h6>
		    			<?php if(in_category('lectures')) { ?>
		    				<?php global $post; $abstract = get_post_meta( $post->ID, '_cmb_abstract', true ); if( $abstract != '' ) :  ?>
		    					<p><?php global $post; $abstract = get_post_meta( $post->ID, '_cmb_abstract', true ); echo $abstract;  ?>..<a href="<?php the_permalink(); ?>">Read More &raquo;</a></p>
								<?php
									$args = array (
										'connected_type' => 'lectures2speakers',
										'connected_items' => $post,
										'nopaging' => true,
									);
									$lecture_speaker = new WP_Query( $args );
									if ( $lecture_speaker->have_posts() ) {
										while ( $lecture_speaker->have_posts() ) {
											$lecture_speaker->the_post();
								?>
								<h6>Speaker: <?php the_title(); ?></h6>
								<?php
										}
									} else {
										// no posts found
									}
									wp_reset_postdata();				
								?>
		    				<?php endif; ?>
		    			<?php } elseif (in_category('book-reviews')) { ?>
		    				<?php global $post; $author = get_post_meta( $post->ID, '_cmb_author', true ); if( $author != '' ) :  ?>
		    					<p>By: <strong><?php global $post; $publisher = get_post_meta( $post->ID, '_cmb_author', true ); echo $publisher;  ?></strong> 
		    					<?php global $post; $author = get_post_meta( $post->ID, '_cmb_publisher', true ); if( $author != '' ) :  ?>
		    						(<?php global $post; $publisher = get_post_meta( $post->ID, '_cmb_publisher', true ); echo $publisher;  ?>)
		    					<?php endif; ?>
		    					</p>
		    					<p>Review by: <?php the_author(); ?></p>
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
				<h4>Sorry, no Lectures have been published yet.</h4>
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