<?php
add_theme_support( 'custom-header' );

function register_enqueue_scripts()
{
  wp_register_script( 'slick', '//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.min.js', array( 'jquery', 'jquery-migrate' ), '1.5.0', true );

  wp_register_style( 'main', get_template_directory_uri() . '/assets/css/main.css'  );

  wp_register_style( 'slick_css', '//cdn.jsdelivr.net/jquery.slick/1.5.0/slick.css' );

  wp_register_style( 'slick_theme', '//cdn.jsdelivr.net/jquery.slick/1.5.0/slick-theme.css' );

  wp_enqueue_script( 'slick' );

  wp_enqueue_style( 'slick_css' );

  wp_enqueue_style( 'slick_theme' );

  wp_enqueue_style( 'main' );
}
add_action( 'wp_enqueue_scripts', 'register_enqueue_scripts' );


function add_link_meta_box()
{
  add_meta_box( 'record_link_box', 'Link de descarga del disco', 'link_meta_box_callback' );
}
add_action( 'add_meta_boxes', 'add_link_meta_box' );

function link_meta_box_callback( $post )
{
  $value = get_post_meta( $post->ID, 'record_link', true );

?>
  <input type="text" id="record_link_field" name="record_link_field" value="<?php esc_attr( $value ); ?>" size="50">
<?php
}

function link_meta_box_data( $post_id )
{
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
    return;
  }

  if ( ! isset( $_POST['record_link_field'] ) ) {
    return;
  }

  $data = sanitize_text_field( $_POST['record_link_field'] );

  update_post_meta( $post_id, 'record_link', $data );
}
add_action( 'save_post', 'link_meta_box_data' );
