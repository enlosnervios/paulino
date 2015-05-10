<?php
add_theme_support( 'custom-header' );

function register_enqueue_scripts()
{
  wp_register_script( 'slick', '//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js', array( 'jquery', 'jquery-migrate' ), '1.5.0', true );

  wp_register_script( 'modernizr', get_template_directory_uri() . '/bower_components/modernizr/modernizr.js' );

  wp_register_script( 'foundation', get_template_directory_uri() . '/bower_components/foundation/js/foundation.min.js', array( 'jquery', 'modernizr' ), null, true );

  wp_register_style( 'main', get_template_directory_uri() . '/assets/css/main.css'  );

  wp_register_style( 'slick_css', '//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.css' );

  wp_register_style( 'slick_theme', '//cdn.jsdelivr.net/jquery.slick/1.5.0/slick-theme.css' );

  wp_enqueue_script( 'slick' );

  wp_enqueue_script( 'foundation' );

  wp_enqueue_style( 'slick_css' );

  wp_enqueue_style( 'slick_theme' );

  wp_enqueue_style( 'main' );
}
add_action( 'wp_enqueue_scripts', 'register_enqueue_scripts' );

function add_link_meta_box()
{
  add_meta_box( 'record_link_box', 'Link de descarga', 'link_meta_box_callback' );
}
add_action( 'add_meta_boxes', 'add_link_meta_box' );

function link_meta_box_callback( $post )
{
  wp_nonce_field( basename( __FILE__ ), 'download_nonce' );

  $post_meta = get_post_meta( $post->ID ); ?>

  <input type="text" name="download-link" id="meta-text" size="50" value="<?php if ( isset ( $post_meta['download-link'] ) ) echo $post_meta['download-link'][0]; ?>" />
<?php
}

function link_meta_box_save( $post_id )
{
  $is_autosave = wp_is_post_autosave( $post_id );
  $is_revision = wp_is_post_revision( $post_id );
  $is_valid_nonce = ( isset( $_POST[ 'download_nonce' ] ) && wp_verify_nonce( $_POST[ 'download_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';

  if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
    return;
  }

  if( isset( $_POST[ 'download-link' ] ) ) {
    update_post_meta( $post_id, 'download-link', sanitize_text_field( $_POST[ 'download-link' ] ) );
  }
}
add_action( 'save_post', 'link_meta_box_save' );

