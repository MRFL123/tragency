<?php
// GET FEATURED IMAGE
  function Mirrorful_get_featured_image($post_ID) {
    $post_thumbnail_id = get_post_thumbnail_id($post_ID);
    if ($post_thumbnail_id) {
      $post_thumbnail_img = wp_get_attachment_image_src($post_thumbnail_id, 'thumbnail');
      if($post_thumbnail_img) {
        return $post_thumbnail_img[0];
      }
    }
    return false;
  }

  // ADD COLUMNS TO ALL POST TYPES
  function Mirrorful_add_columns_to_all_post_types() {
    $post_types = get_post_types(['public' => true], 'names');

    foreach ($post_types as $post_type) {
      add_filter("manage_{$post_type}_posts_columns", 'Mirrorful_columns_head');
      add_action("manage_{$post_type}_posts_custom_column", 'Mirrorful_columns_content', 10, 2);
    }
  }
  add_action('init', 'Mirrorful_add_columns_to_all_post_types');

  // DEFINE COLUMNS HEADERS
  function Mirrorful_columns_head($columns) {
    $columns['featured_image'] = 'Featured Image';
    $columns['view_post'] = 'Views';
    return $columns;
  }

  // DEFINE COLUMNS CONTENT
  function Mirrorful_columns_content($column_name, $post_ID) {
    if ($column_name == 'featured_image') {
      $img = Mirrorful_get_featured_image($post_ID);
      if ($img) {
        echo '<img src="' . esc_url($img) . '" style="max-width:80px; height:auto;" />';
      } else {
        echo '—';
      }
    }

    if ($column_name == 'view_post') {
      if (!function_exists('Mirrorful_get_post_views')) {
        echo '<em>No view function</em>';
        return;
      }
      $views = Mirrorful_get_post_views($post_ID);
      $color = $views > 100 ? 'red' : 'green';
      echo "<div style='color:$color'><span class='dashicons dashicons-visibility'></span> $views</div>";
    }
  }

/*
Author:
Description:
Domain Path: /lang
Plugin Name: Post Format Filter
Plugin URI:
Text Domain: pff-lang
Version: 1.0.0
*/

if( !function_exists('add_action') ) {
  header('Status: 403 Forbidden');
  header('HTTP/1.1 403 Forbidden');
  exit;
}
if( version_compare( PHP_VERSION, '5.0.0', '<' ) ) {
  add_action( 'admin_notices', 'pff_version_require' );
  function t31os_pff_version_require() {
    if( current_user_can( 'manage_options' ) )
    echo '<div class="error"><p>This plugin requires at least PHP 5.</p></div>';
  }
  return;
}

class PostFormat_Filter {

  private $formats = array();
  private $current = '';
  private $supported_types = array();

  public function __construct() {
    add_action( 'admin_init',            array( $this, 'pff_admin_init' ), 2000 );
  }
  public function pff_admin_init() {

    add_action( 'parse_query',           array( $this, 'pff_parse_query' ) );
    add_action( 'restrict_manage_posts', array( $this, 'pff_restrict_manage_posts' ) );

    global $wp_post_types;

    foreach( $wp_post_types as $type => $type_object ) {

      if( !post_type_supports( $type, 'post-formats' ) )
      continue;

      $this->supported_types[] = $type;
    }
  }
  public function pff_parse_query( $query ) {

    if( !$this->is_supported_type_listing() )
    return;

    // $this->formats = get_post_format_strings();
    // dd($this->formats);
    $this->formats = [
      'standard' => 'Standard',
      'video' => 'Video',
      'gallery' => 'Gallery',
      'aside' => 'Aside',
      'chat' => 'Chat',
      'link' => 'Link',
      'image' => 'Image',
      'quote' => 'Quote',
    ];


    // array_shift( $this->formats );

    $this->formats = apply_filters( 'pff_post_formats', $this->formats );
    // dd($this->formats);
    if( !$this->is_set_format() )
    return;

    $format = $this->get_format();

    if( empty( $format ) )
    return;

    $tax_group = array(
      'taxonomy' => 'post_format',
      'terms' => array( 'post-format-' . $format ),
      'field' => 'slug',
      'operator' => 'IN',
      'include_children' => 1
    );

    if($format === 'standard') {
      $tax_group['terms'] = array('post-format-video', 'post-format-gallery');
      $tax_group['operator'] = 'NOT IN';
    }

    set_query_var( 'tax_query', array( $tax_group ) );
  }
  public function pff_restrict_manage_posts() {

    if( $this->is_supported_type_listing() )
    $this->pff_postformat_dropdown();
  }
  private function get_format() {

    if( !$this->is_set_format() )
    return '';

    foreach( $this->formats as $slug => $name ) {
      if( $slug != $_GET['post_format_filter'] )
      continue;

      if( empty( $this->current ) )
      $this->current = $slug;

      return $this->current;
    }
    return '';
  }
  private function is_supported_type_listing() {

    global $pagenow, $post_type;

    if( 'edit.php' != $pagenow )
    return false;

    if( !in_array( $post_type, $this->supported_types ) )
    return false;

    return true;
  }
  private function is_set_format() {
    return (bool) ( isset( $_GET['post_format_filter'] ) );
  }
  private function pff_postformat_dropdown() {
    ?>
    <select name="post_format_filter" id="post_format_filter">
      <option value=""> <?php _e( 'Show all') .  _e(' post formats' ); ?> </option>
      <?php foreach( $this->formats as $slug => $name ) : ?>
        <option value="<?php echo $slug; ?>"<?php selected( $this->get_format() == $slug ); ?>><?php _e( $name ); ?></option>
      <?php endforeach;?>
    </select>
    <?php
  }
}

$htf = new PostFormat_Filter;
