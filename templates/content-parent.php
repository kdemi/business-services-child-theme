<div id="must-have">
  <div class="container">
    <?php
      $business_page_category = get_the_category();
      $business_page_cat_id = $business_page_category[0]->cat_ID;

      // Set up the objects needed
      $my_wp_query = new WP_Query();
      $all_wp_pages = $my_wp_query->query(array('post_type' => 'business_page', 'posts_per_page' => -1));
      $current_id = get_the_ID();

      // Filter through all pages and find this pages's children
      $children = get_page_children( $current_id, $all_wp_pages );

      foreach($children as $child) {

        $current_child_ID = $child->ID;
        $required_docs = get_field('required', $current_child_ID);

    if( $required_docs )  {
      ?><div class="container">

          <h3><?php echo $child->post_title; ?> </h3>
            <div class="inner">
              <div class="right one columns label">Download PDF</div>
              <div class="right one columns label">Online Service</div>
          <?php
                foreach( $required_docs as $required_doc ){

                    $content_types =  wp_get_post_terms( $required_doc->ID, 'content_type' );
                    $pdf =  rwmb_meta( 'business_pdf', $args = array(), $required_doc->ID );
                    $link =  rwmb_meta( 'business_link', $args = array(), $required_doc->ID );

                    foreach ( $content_types as $content_type ){

                    ?><div class="document-row group">
                              <div class="list nine columns"><?php

                        echo '<a class="h3" href="' . $required_doc->guid .'">'  . $required_doc->post_title . '</a>';

                          //pass the post ID to get_post, then extract the excerpt. BOOYAH
                          echo  '<p>' . get_post($required_doc->ID)->post_excerpt . '</p>';

                        echo '</div>';// ten

                        echo '<div class="more one columns">' . '<a href="' . $required_doc->guid .'" class="button full"><i class="fa fa-arrow-circle-right"></i>' . 'Read More' . '</a></div>';

                     echo '<div class="link one columns">';
                        if ( !$link == '' ){
                          echo '<a href="' . $link . '" class="button red">
                            <i class="fa fa-link fa-inverse"></i>
                        </a>';
                      }else {
                        echo '<span class="button red inactive"><i class="fa fa-link fa-inverse"></i></span>';
                      }
                      echo '</div>';//one
                     echo '<div class="pdf one columns">';
                        if ( !$pdf == '' ){
                            echo '<a href="' . $pdf . '" class="button red">
                            <i class="fa fa-file-pdf-o fa-inverse"></i>
                            </a>';
                        }else {
                            echo '<span class="button red inactive"><i class="fa fa-file-pdf-o fa-inverse"></i></span>';
                        }
                      echo '</div>';//one
                    echo '</div>';
                      }
                    }//end foreach
                }//end required docs
                echo '</div>';
            }
          ?>
        </div>
      </div><!--.container-->
    </div><!--#must-have-->
<?php
        $business_page_category = get_the_category();
        $business_page_cat_id = $business_page_category[0]->cat_ID;

        // Set up the objects needed
        $my_wp_query = new WP_Query();
        $all_wp_pages = $my_wp_query->query(array('post_type' => 'business_page', 'posts_per_page' => -1));
        $current_id = get_the_ID();

        // Filter through all pages and find this pages's children
        $children = get_page_children( $current_id, $all_wp_pages );
        ?>
        <div id="might-need">
          <div class="container">
            <h2>Documents You May Need</h2>
              <div class="inner">

          <?php
        foreach($children as $child) {


          $current_child_ID = $child->ID;
          $maybe_docs = get_field('might_need', $current_child_ID);

            if( !$maybe_docs == '' ) {

              foreach( $maybe_docs as $maybe_doc ){

                $content_types =  wp_get_post_terms( $maybe_doc->ID, 'content_type' );
                $pdf =  rwmb_meta( 'business_pdf', $args = array(), $maybe_doc->ID );
                $link =  rwmb_meta( 'business_link', $args = array(), $maybe_doc->ID );
                $unique_id = $maybe_doc->ID;

                  foreach ( $content_types as $content_type ){

                      echo '<div class="document-row group ' . 'pg-' . $unique_id   . '">
                              <div class="list nine columns">';
                              $cat_child_args = array(
                                'type'                     => 'post',
                                'child_of'                 => $business_page_cat_id,
                                'orderby'                  => 'name',
                                'taxonomy'                 => 'category',
                                'pad_counts'               => false

                              );
                            $category_children = get_categories( $cat_child_args );

                            $categories = get_the_category($maybe_doc->ID);
                            echo '<div class="business-flag">';
                              foreach ( $categories as $category ) {
                                foreach ( $category_children as $child ) {

                                  if ( $category->term_id == $child->term_id ){

                                    echo '<span>' . $category->name . '</span>';
                                  }
                                }
                              }
                              echo '</div>';
                              echo '<a class="h3" href="' . $maybe_doc->guid .'">'  . $maybe_doc->post_title . '</a>';
                                //pass the post ID to get_post, then extract the excerpt. BOOYAH
                                echo  '<p>' . get_post($maybe_doc->ID)->post_excerpt . '</p>';
                              echo '</div>';// ten

                              echo '<div class="more one columns">' . '<a href="' . $maybe_doc->guid .'" class="button full"><i class="fa fa-arrow-circle-right"></i>' . 'Read More' . '</a></div>';

                            echo '<div class="pdf one columns">';
                              if ( !$pdf == '' ){
                                  echo '<a href="' . $pdf . '" class="button red">
                                  <i class="fa fa-file-pdf-o fa-inverse"></i>
                                  </a>';
                              }else {
                                  echo '<span class="button red inactive"><i class="fa fa-file-pdf-o fa-inverse"></i></span>';
                              }
                            echo '</div>';//one

                           echo '<div class="link one columns">';
                              if ( !$link == '' ){
                                echo '<a href="' . $link . '" class="button red">
                                  <i class="fa fa-link fa-inverse"></i>
                              </a>';
                            }else {
                              echo '<span class="button red inactive"><i class="fa fa-link fa-inverse"></i></span>';
                            }
                            echo '</div>';//one
                          echo '</div>';

                          }
                      }//end foreach
                    }//end if
                 ?>

           <?php
                }
                  ?>
