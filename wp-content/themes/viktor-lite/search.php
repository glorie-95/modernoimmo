<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @version 1.2.9
 * @package Viktor_lite
 */
$viktor_lite_option = new Viktor_Lite_Options();
get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">

            <!-- News Page start here -->
            <div class="news-page-area">
                <div class="container">
                    <div class="row"> 
                        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            <div class="news-main-content">
                                <?php if(have_posts()): ?>
                                <div class="masonry-loop">
                                    <?php 
                                    $i=1;
                                    while ( have_posts() ) : the_post(); ?>
                                        <div class="masonry-entry">
                                            <?php get_template_part( 'template-parts/content'); ?>
                                        </div>           
                                    <?php $i++; endwhile; ?> 
                                </div>                          
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                        <div class="pagination-area">
                                            <?php get_template_part('pagination'); ?> 
                                        </div>
                                    </div>
                                </div> 
                                <?php else: ?>
                                    <?php get_template_part( 'template-parts/content','none'); ?>
                                <?php endif; ?>
                            </div>
                        </div> 
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <div class="sidebar-area">
                                <?php get_sidebar(); ?> 
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- News Page end here -->

        </main><!-- #main -->
    </div><!-- #primary -->

<?php get_footer();
