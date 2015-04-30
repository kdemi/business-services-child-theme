<?php
	while ( have_posts() ){ the_post();
		$content = gdlr_content_filter(get_the_content(), true);
		if(!empty($content)){
			?>
			<div class="main-content-container container gdlr-item-start-content">
				<div class="gdlr-item gdlr-main-content">
          <div id="document-section">
						<div id="must-have">
            	<div class="container">
               <div class="inner">
					<?php
              echo $content;
							$required_menus = get_field('page_menu_required');
  				     if( $required_menus ):
  						?>
  							<?php foreach( $required_menus as $required_menu ): ?>
									<div class="document-row group">
										<div class="list ten columns">
	  									<a href="<?php echo get_permalink( $required_menu->ID ); ?>">
	  										<?php echo get_the_title( $required_menu->ID );
	                    ?>
	  									</a>
	                    <?php echo  '<p>' . get_post($required_menu->ID)->post_excerpt . '</p>';?>
  									</div>
										<?php echo '<div class="more one columns">' . '<a href="' . $required_menu->guid .'" class="button full"><i class="fa fa-arrow-circle-right"></i>' . 'Read More' . '</a></div>'; ?>
									</div>
								</div>
  							<?php endforeach; ?>
						</div>
  							<?php endif; ?>
						</div>
						<div id="might-need">
							<div class="container">
								<div class="inner">
									<h4>You might need</h4>

								<?php
								$maybe_menus = get_field('page_menu_may_need');
								if( $maybe_menus ):
								?>
									<?php foreach( $maybe_menus as $maybe_menu ): ?>
										<div class="document-row group">
											<div class="list ten columns">
												<a href="<?php echo get_permalink( $maybe_menu->ID ); ?>">
													<?php echo get_the_title( $maybe_menu->ID );
												?>
												</a>
												<?php echo  '<p>' . get_post($maybe_menu->ID)->post_excerpt . '</p>';?>
											</div>
											<?php echo '<div class="more one columns">' . '<a href="' . $maybe_menu->guid .'" class="button full"><i class="fa fa-arrow-circle-right"></i>' . 'Read More' . '</a></div>'; ?>
										</div>
									<?php endforeach; ?>
								</div>
									<?php endif; ?>
								</div>
			 				</div>
           </div>
				</div>
			</div>
	</div>
        <?php
		}
	}
?>
