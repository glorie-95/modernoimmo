<?php
/**
 * The template part for displaying audio post
 *
 * @package VW Corporate Lite 
 * @subpackage vw_corporate_lite
 * @since VW Corporate Lite 1.0
 */
?>

<?php
	$content = apply_filters( 'the_content', get_the_content() );
	$audio = false;

	// Only get audio from the content if a playlist isn't present.
	if ( false === strpos( $content, 'wp-playlist-script' ) ) {
		$audio = get_media_embedded_in_content( $content, array( 'audio' ) );
	}

?>

<div id="post-<?php the_ID(); ?>" <?php post_class('inner-service'); ?>>    
  <h3 class="section-title"><a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title();?></a></h3>
  <div class="metabox">
    <?php if(get_theme_mod('vw_corporate_lite_toggle_postdate',true)==1){ ?>
      <span class="entry-date"><i class="fas fa-calendar-alt"></i><?php echo get_the_date(); ?></span>
    <?php } ?>

    <?php if(get_theme_mod('vw_corporate_lite_toggle_author',true)==1){ ?>
      <i class="far fa-user"></i><span class="entry-author"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></span>
    <?php } ?>

    <?php if(get_theme_mod('vw_corporate_lite_toggle_comments',true)==1){ ?>
      <i class="fas fa-comments"></i><span class="entry-comments"><?php comments_number( __('0 Comments','vw-corporate-lite'), __('0 Comments','vw-corporate-lite'), __('% Comments','vw-corporate-lite')); ?></span>
    <?php } ?>
  </div>
  <div class="box-image">
    <?php
      if ( ! is_single() ) {

        // If not a single post, highlight the audio file.
        if ( ! empty( $audio ) ) {
          foreach ( $audio as $audio_html ) {
            echo '<div class="entry-audio">';
              echo $audio_html;
            echo '</div><!-- .entry-audio -->';
          }
        };

      };
    ?>
  </div>
  <div class="new-text">
    <p><?php $excerpt = get_the_excerpt(); echo esc_html( vw_corporate_lite_string_limit_words( $excerpt, esc_attr(get_theme_mod('vw_corporate_lite_excerpt_number','30')))); ?></p>
  </div>
  <div class="cat-box">
    <i class="fas fa-folder-open"></i>
    <?php foreach((get_the_category()) as $category) { echo esc_html($category->cat_name) . ' '; } ?>
  </div>
  <div class="clearfix"></div> 
</div>