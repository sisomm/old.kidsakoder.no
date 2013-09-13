<!-- #home-blocks -->
<div id="home-blocks" class="row half-gutter stacked">
<?php  $args = array(
           'post_type' => 'st_hpfeatures',
          'posts_per_page' => '-1',
          'orderby' => 'menu_order',
          'order' => 'ASC',
          'paged' => $paged
          );
    $wp_query = new WP_Query($args);
if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>

        <?php if (of_get_option('st_hp_feature_block_layout') == '2col') { ?>
        <div class="column col-half">
        <?php } elseif (of_get_option('st_hp_feature_block_layout') == '3col') { ?>
        <div class="column col-third">
        <?php } elseif (of_get_option('st_hp_feature_block_layout') == '4col') { ?>
        <div class="column col-fourth">
        <?php } else  { ?>
        <div class="column col-half">
        <?php } ?>

        <a href="<?php the_field('link') ?>">
          <?php the_post_thumbnail(); ?>
          <div class="block-wrap">
            <h3>
              <?php the_title(); ?>
            </h3>
            <?php the_content(); ?>
          </div>
        </a>
        </div>
<?php endwhile; endif; wp_reset_postdata(); ?>
</div>
<!-- /#home-blocks -->
