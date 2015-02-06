<?php get_header(); ?>
	
	<div class="row article">
	
		<div class="nine columns">
			<h2>Search results for <em>"<?php the_search_query(); ?>"</em></h2>
			<div class="row article">
				<div class="twelve columns">
					<?php get_search_form(); ?>
				</div>
			</div>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="row article">
				<div <?php post_class('twelve columns'); ?>>
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="row">
							<div class="four columns">
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('speaker'); ?></a>
								<small><?php the_post_thumbnail_caption(); ?></small>
							</div>
							<div class="eight columns">
								<h5>
									<?php if(has_term('talks-lectures','section')) { ?>
									<i class="icon-comment"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<?php } ?>
									<?php if(has_term('notices','section')) { ?>
									<i class="icon-info"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<?php } ?>
									<?php if(has_term('book-reviews','section')) { ?>
									<i class="icon-book"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<?php } ?>
									<?php if(has_term('videos','section')) { ?>
									<i class="icon-video"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<?php } ?>
									<?php if('speaker' == get_post_type()) { ?>
									<i class="icon-user"></i><?php the_title(); ?>
									<?php } ?>
									<?php if('issue' == get_post_type()) { ?>
									<i class="icon-book-open"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<?php } ?>
								</h5>
								<?php if(has_term('talks-lectures','section')) { ?>
	    							<h6><?php post_read_time(); ?></h6>
					    			<h6>Posted on: <?php the_time( 'D, jS M, Y' ); ?></h6>
					    			<?php global $post; $date = get_post_meta( $post->ID, '_cmb_lecdate', true ); if( $date != '' ) :  ?>
					    				<h6>Lecture date: <?php global $post; $date = get_post_meta( $post->ID, '_cmb_lecdate', true ); echo date('D, jS M, Y', strtotime($date))  ?></h6>
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
									<h6><i class="icon-user"></i><?php the_title(); ?></h6>
									<?php
											}
										} else {
											// no posts found
										}
										wp_reset_postdata();				
									?>
    							<?php } ?>
								<?php if(has_term('notices','section')) { ?>
	    							<h6><?php post_read_time(); ?></h6>
					    			<h6>Posted on: <?php the_time( 'D, jS M, Y' ); ?></h6>
					    			<?php the_excerpt(); ?>
					    		<?php } ?>	
								<?php if(has_term('book-reviews','section')) { ?>
	    							<h6><?php post_read_time(); ?></h6>
					    			<h6>Posted on: <?php the_time( 'D, jS M, Y' ); ?></h6>
				    				<?php global $post; $author = get_post_meta( $post->ID, '_cmb_author', true ); if( $author != '' ) :  ?>
				    					<h6>By: <?php global $post; $publisher = get_post_meta( $post->ID, '_cmb_author', true ); echo $publisher;  ?> 
				    					<?php global $post; $author = get_post_meta( $post->ID, '_cmb_publisher', true ); if( $author != '' ) :  ?>
				    						(<?php global $post; $publisher = get_post_meta( $post->ID, '_cmb_publisher', true ); echo $publisher;  ?>)
				    					<?php endif; ?>
				    					</h6>
				    					<?php global $post; $reviewer = get_post_meta( $post->ID, '_cmb_vpauthor', true ); if( $reviewer != '' ) :  ?>
				    						<h6>Review by: <?php global $post; $reviewer = get_post_meta( $post->ID, '_cmb_vpauthor', true ); echo $reviewer;  ?></h6>
				    					<?php endif; ?>
				    				<?php endif; ?>					    			
    							<?php } ?>	
    							<?php if('speaker' == get_post_type()) { ?>	
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
										<h6><i class="icon-comment"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
						    		<?php
						    				}
						    			} else {
						    				// no posts found
						    			}
						    			wp_reset_postdata();
						    		?>
    							<?php } ?>		
    							<?php if('issue' == get_post_type()) { ?>	
									<?php the_content(); ?>
									<?php global $post; $issue = get_post_meta( $post->ID, '_cmb_issue', true ); if( $issue != '' ) :  ?>
					        			<?php the_content(); ?>
					        			<p>Download PDF version of <a href="<?php global $post; $issue = get_post_meta( $post->ID, '_cmb_issue', true ); echo $issue;  ?>"><?php the_title(); ?><i class="icon-book-open"></i></a></p>
									<?php else: ?>
										<p>Read <a href="<?php the_permalink(); ?>"><?php the_title(); ?><i class="icon-monitor"></i></a></p>
									<?php endif; ?>
    							<?php } ?>	
								<?php if( has_tag() ) { ?>
								    <p><i class="icon-tag"></i><?php the_tags('', ', ', ''); ?></p>
								<?php } else { ?>
								
								<?php } ?>					
								<?php
								$terms = get_the_terms( $post->ID, 'taxonomy' );
								if ( $terms && ! is_wp_error( $terms ) ) : 
									$taxonomy_links = array();
									foreach ( $terms as $term ) {
										$taxonomy_links[] = '<a href="/taxonomy/'.$term->slug.'">'.$term->name.'</a>';
									}
									$taxonomy = join( ", ", $taxonomy_links );
								?>
								<p class="taxonomy">
									<i class="icon-address"></i><?php echo $taxonomy; ?>
								</p>
								<?php endif; ?>				

							</div>
						</div>
					<?php } else { ?>
						<div class="row">
							<div class="twelve columns">
								<h5>
									<?php if(has_term('talks-lectures','section')) { ?>
									<i class="icon-comment"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<?php } ?>
									<?php if(has_term('notices','section')) { ?>
									<i class="icon-info"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<?php } ?>
									<?php if(has_term('book-reviews','section')) { ?>
									<i class="icon-book"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<?php } ?>
									<?php if(has_term('videos','section')) { ?>
									<i class="icon-video"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<?php } ?>
									<?php if('speaker' == get_post_type()) { ?>
									<i class="icon-user"></i><?php the_title(); ?>
									<?php } ?>
									<?php if('issue' == get_post_type()) { ?>
									<i class="icon-book-open"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									<?php } ?>
								</h5>
	 							<?php if(is_page()) { ?>
									<?php the_excerpt(); ?>
    							<?php } ?>
								<?php if(has_term('talks-lectures','section')) { ?>
	    							<h6><?php post_read_time(); ?></h6>
					    			<h6>Posted on: <?php the_time( 'D, jS M, Y' ); ?></h6>
					    			<?php global $post; $date = get_post_meta( $post->ID, '_cmb_lecdate', true ); if( $date != '' ) :  ?>
					    				<h6>Lecture date: <?php global $post; $date = get_post_meta( $post->ID, '_cmb_lecdate', true ); echo date('D, jS M, Y', strtotime($date))  ?></h6>
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
									<h6><i class="icon-user"></i><?php the_title(); ?></h6>
									<?php
											}
										} else {
											// no posts found
										}
										wp_reset_postdata();				
									?>
    							<?php } ?>
								<?php if(has_term('notices','section')) { ?>
	    							<h6><?php post_read_time(); ?></h6>
					    			<h6>Posted on: <?php the_time( 'D, jS M, Y' ); ?></h6>
					    			<?php the_excerpt(); ?>
					    		<?php } ?>	
								<?php if(has_term('book-reviews','section')) { ?>
	    							<h6><?php post_read_time(); ?></h6>
					    			<h6>Posted on: <?php the_time( 'D, jS M, Y' ); ?></h6>
				    				<?php global $post; $author = get_post_meta( $post->ID, '_cmb_author', true ); if( $author != '' ) :  ?>
				    					<h6>By: <?php global $post; $publisher = get_post_meta( $post->ID, '_cmb_author', true ); echo $publisher;  ?> 
				    					<?php global $post; $author = get_post_meta( $post->ID, '_cmb_publisher', true ); if( $author != '' ) :  ?>
				    						(<?php global $post; $publisher = get_post_meta( $post->ID, '_cmb_publisher', true ); echo $publisher;  ?>)
				    					<?php endif; ?>
				    					</h6>
				    					<?php global $post; $reviewer = get_post_meta( $post->ID, '_cmb_vpauthor', true ); if( $reviewer != '' ) :  ?>
				    						<h6>Review by: <?php global $post; $reviewer = get_post_meta( $post->ID, '_cmb_vpauthor', true ); echo $reviewer;  ?></h6>
				    					<?php endif; ?>
				    				<?php endif; ?>					    			
    							<?php } ?>	
								<?php if(has_term('videos','section')) { ?>
					    			<h6>Posted on: <?php the_time( 'D, jS M, Y' ); ?></h6>			    			
    							<?php } ?>	
    							<?php if('speaker' == get_post_type()) { ?>	
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
										<h6><i class="icon-comment"></i><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
						    		<?php
						    				}
						    			} else {
						    				// no posts found
						    			}
						    			wp_reset_postdata();
						    		?>
    							<?php } ?>	
    							<?php if('issue' == get_post_type()) { ?>	
									<?php the_content(); ?>
									<?php global $post; $issue = get_post_meta( $post->ID, '_cmb_issue', true ); if( $issue != '' ) :  ?>
					        			<p>Download PDF version of <a href="<?php global $post; $issue = get_post_meta( $post->ID, '_cmb_issue', true ); echo $issue;  ?>"><?php the_title(); ?><i class="icon-book-open"></i></a></p>
									<?php else: ?>
										<p>Read <a href="<?php the_permalink(); ?>"><?php the_title(); ?><i class="icon-monitor"></i></a></p>
									<?php endif; ?>
    							<?php } ?>									
								<?php if( has_tag() ) { ?>
								    <p><i class="icon-tag"></i><?php the_tags('', ', ', ''); ?></p>
								<?php } else { ?>
								
								<?php } ?>	
								<?php
								$terms = get_the_terms( $post->ID, 'taxonomy' );
								if ( $terms && ! is_wp_error( $terms ) ) : 
									$taxonomy_links = array();
									foreach ( $terms as $term ) {
										$taxonomy_links[] = '<a href="/taxonomy/'.$term->slug.'">'.$term->name.'</a>';
									}
									$taxonomy = join( ", ", $taxonomy_links );
								?>
								<p class="taxonomy">
									<i class="icon-address"></i><?php echo $taxonomy; ?>
								</p>
								<?php endif; ?>				
							</div>
						</div>
					<?php } ?>
				</div>
			</div>	
			<?php endwhile; ?>
			<div class="row article">
				<div class="twelve columns">
					<?php wp_pagenavi(); ?>			
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