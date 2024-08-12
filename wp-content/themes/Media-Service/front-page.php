<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package media-service
 */

get_header();
?>



    <!-- <p style="text-align: center;font-size:32px;line-height:45px;font-family: 'Noto Sans JP', sans-serif;margin-top:80px;">Coming soon.</p> -->
  <div class="top-hero">
		<?php
    if ( have_posts() ) :

    	if ( is_front_page() ) :
        if ( has_post_thumbnail() ) :
          $image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
          if ($image_url) :
            ?>
              <div class="featured-image-background" style="background-image: url('<?php echo esc_url($image_url[0]); ?>');">
                <div class="inner">

                  <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>

                  <style>
                    .lottie-container {
                      opacity: 0;
                      transition: opacity 0.3s ease-in-out;
                    }
                    .lottie-container.loaded {
                      opacity: 1;
                    }
                  </style>

                  <div class="lottie-container">
                    <dotlottie-player background="transparent" speed="1" style="width: 120px; height: 204px;" autoplay></dotlottie-player>
                  </div>

                  <script type="module">
                    import { DotLottiePlayer } from 'https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs';

                    document.addEventListener('DOMContentLoaded', function() {
                      const player = document.querySelector('dotlottie-player');
                      const container = document.querySelector('.lottie-container');

                      player.addEventListener('ready', () => {
                        container.classList.add('loaded');
                      });

                      player.load('https://lottie.host/4fa70ab9-5536-4ab9-994b-ef0addf06cc6/yISnWY4vQG.json');
                    });
                  </script>

                </div>
                <!-- Your content here -->
              </div>
            <?php
          endif;
        endif;
      endif;

    	/* Start the Loop */
// while ( have_posts() ) :
// 	the_post();

// 	/*
// 	 * Include the Post-Type-specific template for the content.
// 	 * If you want to override this in a child theme, then include a file
// 	 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
// 	 */
// 	get_template_part( 'template-parts/content', get_post_type() );

// endwhile;

// the_posts_navigation();

    else :

//    	get_template_part( 'template-parts/content', 'none' );

    endif;
		?>
  </div>

  <main id="primary" class="site-main">


  <?php
    if (have_rows('business_area_container')) :
  ?>
    <div class="business-area-container">
    <?php
      while (have_rows('business_area_container')) {
          the_row();
          $business_area = get_sub_field('business_area');
          if ($business_area) {
              echo '<p class="business-area">' . esc_html($business_area) . '</p>';
          }
      }
    ?>
    </div>
  <?php
    if ( have_posts() ) :

      while ( have_posts() ) :
        // the_title( '<h1 class="entry-title">', '</h1>' );
      	the_post();
        // the_title( '<h1 class="entry-title">', '</h1>' );
      	get_template_part( 'template-parts/content', get_post_type() );
      endwhile;
  ?>

  <div class="separator">
    <div class="separator-inner"></div>
  </div>



  <div class="services-container">
    <h2 class="services-title">Our Services</h2>
    <p class="services-subtitle">当社のサービスと強み</p>
    <?php
    $args = array(
        'post_type' => 'service',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'ASC'
    );

    $service_query = new WP_Query($args);

    if ($service_query->have_posts()) :
        echo '<div class="services-grid">';
        while ($service_query->have_posts()) : $service_query->the_post();
            $image = get_the_post_thumbnail_url(get_the_ID(), 'full');
    ?>
        <div class="service-item">
            <div class="service-image">
                <img src="<?php echo $image; ?>" alt="<?php the_title(); ?>">
            </div>
            <h2><?php the_title(); ?></h2>
            <div class="service-content">
                <?php the_excerpt(); ?>
            </div>
        </div>
    <?php
        endwhile;
        echo '</div>';
        wp_reset_postdata();
    else :
        echo 'No services found.';
    endif;
    ?>

    <a class="services-link" href="#">
      <span class="services-link-text">当社の施工実績へ</span>
    </a>

  </div>


<div style="background:#000;">
<!-- <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>

<dotlottie-player intermission="1" src="https://lottie.host/4fa70ab9-5536-4ab9-994b-ef0addf06cc6/yISnWY4vQG.json" background="transparent" speed="1" style="width: 300px; height: 300px;" autoplay></dotlottie-player> -->

<!--
<script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>

<style>
  .lottie-container {
    opacity: 0;
    transition: opacity 0.3s ease-in-out;
  }
  .lottie-container.loaded {
    opacity: 1;
  }
</style>

<div class="lottie-container">
  <dotlottie-player background="transparent" speed="1" style="width: 300px; height: 300px;" autoplay></dotlottie-player>
</div>

<script type="module">
  import { DotLottiePlayer } from 'https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs';

  document.addEventListener('DOMContentLoaded', function() {
    const player = document.querySelector('dotlottie-player');
    const container = document.querySelector('.lottie-container');

    player.addEventListener('ready', () => {
      container.classList.add('loaded');
    });

    player.load('https://lottie.host/4fa70ab9-5536-4ab9-994b-ef0addf06cc6/yISnWY4vQG.json');
  });
</script> -->



<?php
// if (function_exists('lottie_player_block_init')) {
//     echo do_shortcode('[lottie_player src="https://lottie.host/4fa70ab9-5536-4ab9-994b-ef0addf06cc6/yISnWY4vQG.json" background="transparent" speed="1" style="width: 300px; height: 300px;" loop autoplay]');
// }
?>

</div>

  <?php
    endif;
  ?>
  <?php
    endif;
  ?>

	</main><!-- #main -->

<?php
// echo '------ Side bar -----';
// get_sidebar();
// echo '------ /Side bar -----';

// echo '------ Footer -----';
get_footer();
// echo '------ /Footer -----';
