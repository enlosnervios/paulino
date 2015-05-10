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
        <div class="columns large-4 large-centered">
          <div class="single-item">
          <?php
          if ( have_posts() ) :
            while ( have_posts() ) : the_post();
              ?><div><?php

                  the_content(); ?>

                  <span class="download-link">
                      <a href="<?php echo get_post_meta( $post->ID, 'download-link', true); ?>" title="Descarga este disco">Descarga este disco</a>
                  </span>

              </div><?php
            endwhile;
          endif;
          ?>
          </div>
        </div>
    </div>


    <div id="social" class="row">
      <div class="columns small-4 small-centered">
        <ul class="inline-list">
          <li>
            <a href="http://pauobianchi.bandcamp.com" title="Perfil de Paulino Records en Bandcamp">
              <img class="bandcamp" src="<?php echo get_template_directory_uri(); ?>/assets/img/bandcamp.png" alt="Bandcamp">
            </a>
          </li>
          <li>
            <a href="http://facebook.com/pauobianchi" title="Perfil de Paulino Records en Facebook.com">
              <img class="facebook" src="<?php echo get_template_directory_uri(); ?>/assets/img/facebook.png" alt="Facebook">
            </a>
          </li>
          <li>
            <a href="mailto:hola@paulinorecords.com" title="Correo electrónico">
              <img class="mail" src="<?php echo get_template_directory_uri(); ?>/assets/img/mail.png" alt="Correo electrónico">
            </a>
          </li>
          <li>
            <a href="http://twitter.com/paulinorecords" title="Cuenta de Twitter">
              <img class="mail" src="<?php echo get_template_directory_uri(); ?>/assets/img/twitter.png" alt="Twitter">
            </a>
          </li>
          <li class="right">
            <form id="paypal-form" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
              <input type="hidden" name="cmd" value="_s-xclick">
              <input type="hidden" name="hosted_button_id" value="9Z79U8V4WQU8E">
              <input type="button" data-tooltip aria-haspopup="true" class="paypal has-tip tip-right radius" value="Donar" title="¡Una monedita pal disco!">
              <img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
            </form>
          </li>
        </ul>
      </div>
    </div>

    <div id="subscribe" class="row">
        <div class="columns large-8 large-centered text-center">
          <?php echo chimpy_lite_form() ?>
        </div>
    </div>

    <?php wp_footer() ?>

    <script>
      jQuery('.single-item').slick();

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
