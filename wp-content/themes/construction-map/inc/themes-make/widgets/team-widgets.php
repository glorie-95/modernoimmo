<?php
if ( ! class_exists( 'Construction_Map_Team_Widget' ) ) {
	class Construction_Map_Team_Widget extends WP_Widget {

		private function defaults() {

			$defaults = array(
                'themesmake_page_items' => '',
				'title'     => esc_html__( 'Our Team', 'construction-map' ),


			);

			return $defaults;
		}

		public function __construct() {
			parent::__construct(
				'construction-map-team-widget',
				esc_html__( 'CM: Team Widget', 'construction-map' ),
				array( 'description' => esc_html__( 'Construction Team Section', 'construction-map' ) )
			);
		}

		public function form( $instance ) {
			$instance = wp_parse_args( (array ) $instance, $this->defaults() );
            $themesmake_page_items      = $instance['themesmake_page_items'];
			$title    = esc_attr( $instance['title'] );

			?>

            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
					<?php esc_html_e( 'Title', 'construction-map' ); ?>
                </label><br/>
                <input type="text" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" class="widefat"
                       id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" value="<?php echo $title; ?>">
            </p>


            <!--updated code-->
            <label><?php _e( 'Select Pages', 'construction-map' ); ?>:</label>
            <br/>
            <small><?php _e( 'Add Page, Reorder and Remove. Please do not forget to add Icon and Excerpt  on selected pages.', 'construction-map' ); ?></small>
            <div class="themesmake-repeater">
                <?php
                $total_repeater = 0;
                if  (is_array($themesmake_page_items) ){
                    foreach ($themesmake_page_items as $about){
                        $repeater_id  = $this->get_field_id( 'themesmake_page_items') .$total_repeater.'page_id';
                        $repeater_name  = $this->get_field_name( 'themesmake_page_items' ).'['.$total_repeater.']['.'page_id'.']';
                        ?>
                        <div class="repeater-table">
                            <div class="themesmake-repeater-top">
                                <div class="themesmake-repeater-title-action">
                                    <button type="button" class="themesmake-repeater-action">
                                        <span class="themesmake-toggle-indicator" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <div class="themesmake-repeater-title">
                                    <h3><?php _e( 'Select Item', 'construction-map' )?><span class="in-themesmake-repeater-title"></span></h3>
                                </div>
                            </div>
                            <div class='themesmake-repeater-inside hidden'>
                                <?php
                                /* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
                                $args = array(
                                    'selected'         => $about['page_id'],
                                    'name'             => $repeater_name,
                                    'id'               => $repeater_id,
                                    'class'            => 'widefat themesmake-select',
                                    'show_option_none' => __( 'Select Page', 'construction-map'),
                                    'option_none_value'     => 0 // string
                                );
                                wp_dropdown_pages( $args );
                                ?>
                                <div class="themesmake-repeater-control-actions">
                                    <button type="button" class="button-link button-link-delete themesmake-repeater-remove"><?php _e('Remove','construction-map');?></button> |
                                    <button type="button" class="button-link themesmake-repeater-close"><?php _e('Close','construction-map');?></button>
                                    <?php
                                    if( get_edit_post_link( $about['page_id'] ) ){
                                        ?>
                                        <a class="button button-link themesmake-postid alignright" target="_blank" href="<?php echo esc_url( get_edit_post_link( $about['page_id'] ) ); ?>">
                                            <?php _e('Full Edit','construction-map');?>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        $total_repeater = $total_repeater + 1;
                    }
                }
                $structure_repeater_depth = 'structureRepeaterDepth_'.'0';
                $repeater_id  = $this->get_field_id( 'themesmake_page_items') .$structure_repeater_depth.'page_id';
                $repeater_name  = $this->get_field_name( 'themesmake_page_items' ).'['.$structure_repeater_depth.']['.'page_id'.']';
                ?>
                <script type="text/html" class="themesmake-code-for-repeater">
                    <div class="repeater-table">
                        <div class="themesmake-repeater-top">
                            <div class="themesmake-repeater-title-action">
                                <button type="button" class="themesmake-repeater-action">
                                    <span class="themesmake-toggle-indicator" aria-hidden="true"></span>
                                </button>
                            </div>
                            <div class="themesmake-repeater-title">
                                <h3><?php _e( 'Select Item', 'construction-map' )?><span class="in-themesmake-repeater-title"></span></h3>
                            </div>
                        </div>
                        <div class='themesmake-repeater-inside hidden'>
                            <?php
                            /* see more here https://codex.wordpress.org/Function_Reference/wp_dropdown_pages*/
                            $args = array(
                                'selected'         => '',
                                'name'             => $repeater_name,
                                'id'               => $repeater_id,
                                'class'            => 'widefat themesmake-select',
                                'show_option_none' => __( 'Select Page', 'construction-map'),
                                'option_none_value'     => 0 // string
                            );
                            wp_dropdown_pages( $args );
                            ?>
                            <div class="themesmake-repeater-control-actions">
                                <button type="button" class="button-link button-link-delete themesmake-repeater-remove"><?php _e('Remove','construction-map');?></button> |
                                <button type="button" class="button-link themesmake-repeater-close"><?php _e('Close','construction-map');?></button>
                            </div>
                        </div>
                    </div>

                </script>
                <?php
                /*most imp for repeater*/
                echo '<input class="themesmake-total-repeater" type="hidden" value="'.$total_repeater.'">';
                $add_field = __('Add Item', 'construction-map');
                echo '<span class="button-primary themesmake-add-repeater" id="'.$structure_repeater_depth.'">'.$add_field.'</span><br/>';
                ?>
            </div>
            <!--updated code-->

            <hr>
			<?php
		}

		public function update( $new_instance, $old_instance ) {
			$instance              = $old_instance;
            /*updated code*/
            $page_ids = array();
            if( isset($new_instance['themesmake_page_items'] )){
                $themesmake_page_items    = $new_instance['themesmake_page_items'];
                if  (count($themesmake_page_items) > 0 && is_array($themesmake_page_items) ){
                    foreach ($themesmake_page_items as $key=>$about ){
                        $page_ids[$key]['page_id'] = absint( $about['page_id'] );
                    }
                }
            }
            $instance['themesmake_page_items'] = $page_ids;

            $instance['title']     = sanitize_text_field( $new_instance['title'] );


			return $instance;

		}

		public function widget( $args, $instance ) {

			if ( ! empty( $instance ) ) {
				$instance = wp_parse_args( (array ) $instance, $this->defaults() );
                $themesmake_page_items    = $instance['themesmake_page_items'];
				$title    = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? esc_html( $instance['title'] ) : '', $instance, $this->id_base );

				echo $args['before_widget'];
				?>
                <div class="team-sec pt-50 pb-20">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="sec-title">
                                    <h2><?php echo $title; ?></h2>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                <?php

                $post_in = array();
                if  (count($themesmake_page_items) > 0 && is_array($themesmake_page_items) ){
                    foreach ( $themesmake_page_items as $our_team ){
                        if( isset( $our_team['page_id'] ) && !empty( $our_team['page_id'] ) ){
                            $post_in[] = $our_team['page_id'];
                        }
                    }
                }
                if( !empty( $post_in )) :
                    $our_team_page_args = array(
                        'post__in'         => $post_in,
                        'orderby'             => 'post__in',
                        'posts_per_page'      => count( $post_in ),
                        'post_type'           => 'page',
                        'no_found_rows'       => true,
                        'post_status'         => 'publish'
                    );
                    $our_team_query = new WP_Query( $our_team_page_args );

                    /*The Loop*/
                    if ( $our_team_query->have_posts() ):
                        $i = 1;
                        while ( $our_team_query->have_posts() ):$our_team_query->the_post();

                            ?>
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="team-member">
	                                <?php
	                                if ( has_post_thumbnail() ) {
		                                $image_id  = get_post_thumbnail_id();
		                                $image_url = wp_get_attachment_image_src( $image_id, 'medium', true );
		                                ?>
                                        <img src="<?php echo esc_url( $image_url[0] ); ?>" alt=""/>

	                                <?php } ?>

                                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <h3><?php if ( has_excerpt() ) {
		                                    the_excerpt();
	                                    } else {
		                                    the_content();
	                                    }
	                                    ?></h3>

                                    <div class="team-overlay">
	                                    <?php
	                                    if ( has_post_thumbnail() ) {
		                                    $image_id  = get_post_thumbnail_id();
		                                    $image_url = wp_get_attachment_image_src( $image_id, 'medium', true );
		                                    ?>
                                            <img src="<?php echo esc_url( $image_url[0] ); ?>" alt=""/>

	                                    <?php } ?>
                                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                        <h3>
                                            <?php if ( has_excerpt() ) {
		                                        the_excerpt();
	                                        } else {
		                                        the_content();
	                                        }
	                                        ?></h3>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $i++;

                        endwhile;
                    endif;
                    wp_reset_postdata();
                endif;
                ?>


                        </div>
                    </div>
                </div>

				<?php
				echo $args['after_widget'];
			}
		}

	}
}
add_action( 'widgets_init', 'construction_map_team_widget' );
function construction_map_team_widget() {
	register_widget( 'construction_map_Team_Widget' );

}