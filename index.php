<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo bloginfo('blogname'); ?> <?php wp_title( '|', true, 'left' ); ?></title>

    <?php wp_head(); ?>

  </head>
  <body>
    <div id="header" class="row">
        <div class="columns large-3 large-centered text-center">
            <img src="<?php header_image(); ?>" alt="Paulino Records">
            <h2>"<?php echo bloginfo('description'); ?> (formo parte del colectivo <a href="http://facebook.com/esquizodelia" title="Esquizodelia Records">Esquizodelia</a>)"</h2>
        </div>
    </div>

    <div id="content" class="row">
        <div id="item-wrapper" class="columns large-12 large-centered">
          <div class="single-item">
          <?php
          if ( have_posts() ) :
            while ( have_posts() ) : the_post();
              ?><div><?php

                  the_content(); ?>

                  <!--<span class="download-link">
                      <a href="<?php echo get_post_meta( $post->ID, 'download-link', true); ?>">Descarga este disco</a>
                  </span>-->

              </div><?php
            endwhile;
          endif;
          ?>
          </div>
        </div>
    </div>


    <div id="social" class="row">
      <div class="columns small-3 small-centered">
        <ul class="inline-list">
          <li>
            <a href="http://paulinorecords.bandcamp.com" title="Perfil de Paulino Records en Bandcamp" target="_blank">
              <img class="bandcamp" src="<?php echo get_template_directory_uri(); ?>/assets/img/bandcamp.png" alt="Bandcamp">
            </a>
          </li>
          <li>
            <a href="http://facebook.com/pauobianchi" title="Perfil de Paulino Records en Facebook.com" target="_blank">
              <img class="facebook" src="<?php echo get_template_directory_uri(); ?>/assets/img/facebook.png" alt="Facebook">
            </a>
          </li>
          <li>
            <a href="mailto:hola@paulinorecords.com" title="Correo electrónico">
              <img class="mail" src="<?php echo get_template_directory_uri(); ?>/assets/img/mail.png" alt="Correo electrónico">
            </a>
          </li>
          <li>
            <a href="http://twitter.com/paulinorecords" title="Cuenta de Twitter" target="_blank">
              <img class="mail" src="<?php echo get_template_directory_uri(); ?>/assets/img/twitter.png" alt="Twitter">
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div id="subscribe" class="row">
        <div class="columns large-4 large-centered text-center">
            <span role="button" class="button tiny secondary radius" data-reveal-id="subscribe-modal">Subscribite a las noticias</span>
        </div>
        <div id="subscribe-modal" class="reveal-modal small" data-reveal aria-hidden="true" role="dialog">
            <?php echo chimpy_lite_form(); ?>
        </div>
    </div>

    <?php wp_footer() ?>

    <script>
          jQuery('.single-item').slick({
            slidesToShow: 3,
          });

      jQuery( document ).foundation({
          tooltip: {
            append_to: '#social'
          }
      });

      jQuery( '.paypal' ).click( function() {
          jQuery( '#paypal-form' ).submit();
      });
    </script>
  </body>
</html>
