<?php get_header();  ?>
	<div id="primary" class="row-fluid">
		<div id="content" role="main" class="span12">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<article class="post">
						<div class="post-content">
<?php //echo get_field('test'); ?>


							<h1><?php the_title(); ?></h1><?php the_content(); ?>
		<h4 class="home-header"><span>Grantee Information</span> <a href="http://<?php echo ereg_replace("(https?)://", "", get_field('website')); ?>" target="_blank" class="granteelink"><?php echo ereg_replace("(https?)://", "", get_field('website')); ?></a></h4>
	<div class="row-fluid">
				<div class="span3 grantee-img">  <?php if ( has_post_thumbnail() ) { ?>
							<?php the_post_thumbnail(); ?>
						<?php } ?></div>
							<div class="span9"><?php if(get_field('website')):?><strong>Website(s):</strong> <a href="http://<?php echo ereg_replace("(https?)://", "", get_field('website')); ?>" target="_blank"><?php echo ereg_replace("(https?)://", "", get_field('website')); ?></a><br/><?php endif; ?>
							<?php if(get_field('secondary_link')):?><a href="http://<?php echo ereg_replace("(https?)://", "", get_field('secondary_link')); ?>" target="_blank"><?php echo ereg_replace("(https?)://", "", get_field('secondary_link')); ?></a><br/><?php endif; ?>
		  <strong>Year(s) Awarded:</strong> <?php
						   $terms = wp_get_post_terms($post->ID, 'grantee_year');
						 $count = count($terms);
						 if ( $count > 0 ){
						     foreach ( $terms as $term ) {
						      $theterms[] = $term->name;

						     }

						     echo ''.implode(', ' , $theterms);
						 }

						  ?>
						  <br/>

<?php
				$related_posts = get_posts(array(
							'post_type' => 'post',
							'meta_query' => array(
								array(
									'key' => 'related_grantee', // name of custom field
									  'value' => get_the_ID(),
									//'value' => '"' . get_the_ID() . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
									'compare' => 'LIKE'
								)
							)
						));

						?>
						<?php if( $related_posts ): ?>
						<br/><strong>Related Nexus Stories:</strong>
							<div class="related-posts">
							<?php foreach( $related_posts as $related ): ?>

									<a href="<?php echo get_permalink( $related->ID ); ?>">
										<?php echo get_the_title( $related->ID ); ?>
									</a>
								<br/>
							<?php endforeach; ?>
							</div>
						<?php endif; ?>




</div>





</div>
<div class="bottom-meta">
  <div class="share-this">


		   <?php echo get_share_icons(get_permalink(), get_the_title()) ?>

		</div>
			<div class="newer-older">
			<div class="older"><?php previous_post_link('%link', '<i class="icon-angle-left icon-2x"></i>') ?></div><!--.older-->
			<div class="newer"><?php next_post_link('%link', '<i class="icon-angle-right icon-2x"></i>') ?></div><!--.older-->
		</div><!--.newer-older-->
</div>


						</div><!-- the-content -->

					</article>


				<?php endwhile;  ?>


			<?php else :  ?>

				<article class="post error">
					<h1 class="404">Nothing has been posted like that yet</h1>
				</article>

			<?php endif;  ?>

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->
<?php get_footer(); ?>
