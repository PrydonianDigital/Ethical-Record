<?php get_header(); ?>

<div class="row">
	<div class="nine columns" id="scroll">
		<h2><i class="icon-tag"></i><?php single_tag_title(); ?></h2>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>		

		<div class="row article">
			<div <?php post_class('twelve columns'); ?>>
				<?php if ( has_post_thumbnail() ) { ?>
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('featured'); ?></a>
					<small><?php the_post_thumbnail_caption(); ?></small>
				<?php } ?>
				<?php if(has_term('talks-lectures','section')) { ?>
		    		<h5>Lecture</h5>
		    	<?php } ?>
				<?php if(has_term('notices','section')) { ?>
		    		<h5>Notices</h5>
		    	<?php } ?>
		    	<?php if(has_term('book-reviews','section')) { ?>
		    		<h5>Book Review</h5>
		    	<?php } ?>
		    	<?php if(has_term('videos','section')) { ?>
		    		<h5>Video</h5>
		    	<?php } ?>
				<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    			
    			<h6>Posted on: <?php the_time( 'D, jS M, Y' ); ?></h6>
    			<?php global $post; $date = get_post_meta( $post->ID, '_cmb_lecdate', true ); if( $date != '' ) :  ?>
    				<h6>Lecture date: <?php global $post; $date = get_post_meta( $post->ID, '_cmb_lecdate', true ); echo date('D, jS M, Y', strtotime($date))  ?></h6>
    			<?php endif; ?>
    			<?php if(has_term('talks-lectures','section')) { ?>
    				<h6><?php post_read_time(); ?></h6>
    				<?php global $post; $abstract = get_post_meta( $post->ID, '_cmb_abstract', true ); if( $abstract != '' ) :  ?>
    					<p><?php global $post; $abstract = get_post_meta( $post->ID, '_cmb_abstract', true ); echo $abstract;  ?> ...<a href="<?php the_permalink(); ?>">Read More &raquo;</a></p>
    				<?php endif; ?>
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
    			<?php } elseif (has_term('book_reviews')) { ?>
    				<h6><?php post_read_time(); ?></h6>
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
   				<?php global $post; $video = get_post_meta( $post->ID, '_cmb_video', true ); if( $video != '' ) :  ?>
					<?php echo apply_filters( 'the_content', get_post_meta( get_the_ID(), $prefix . '_cmb_video', true ) );  ?>
				<?php endif; ?>	
			</div>
		</div>
		<?php endwhile; ?>
    	<div class="row article">
    		<div class="twelve columns">
    			<div class="navigation">
    				<div class="six columns textalignleft"><?php previous_posts_link('&laquo; Previous page') ?></div>
    				<div class="six columns textalignright"><?php next_posts_link('Next page &raquo;','') ?></div>
    			</div>			
    		</div>
    	</div>	
    	<?php else: ?>
    
    	<h2>Sorry, no posts matched your criteria.</h2>
    	
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