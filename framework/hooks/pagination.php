<?php
/**
* Function Name: Mirrorful Pagination - Mirrorful_pagination();
* This Function can return WordPress Bootstrap Pagination
* @param  ()
* @return ()
*/
function Mirrorful_pagination( $args = array() ) {
  $defaults = array(
    'range'           => 4,
    'custom_query'    => FALSE,
    'previous_string' => __( 'Previous', 'Mirrorful' ),
    'next_string'     => __( 'Next', 'Mirrorful' ),
    'before_output'   => '<nav aria-label="Page navigation"><ul class="pagination custom-pagination">',
    'after_output'    => '</ul></nav>'
  );
  $args = wp_parse_args(
    $args,
    apply_filters( 'Mirrorful_pagination_defaults', $defaults )
  );
  $args['range'] = (int) $args['range'] - 1;
  if ( !$args['custom_query'] )
  $args['custom_query'] = @$GLOBALS['wp_query'];
  $count = (int) $args['custom_query']->max_num_pages;
  $page  = intval( get_query_var( 'paged' ) );
  $ceil  = ceil( $args['range'] / 2 );
  if ( $count <= 1 )
  return FALSE;
  if ( !$page )
  $page = 1;
  if ( $count > $args['range'] ) {
    if ( $page <= $args['range'] ) {
      $min = 1;
      $max = $args['range'] + 1;
    } elseif ( $page >= ($count - $ceil) ) {
      $min = $count - $args['range'];
      $max = $count;
    } elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) {
      $min = $page - $ceil;
      $max = $page + $ceil;
    }
  } else {
    $min = 1;
    $max = $count;
  }

  $echo = '';
  $previous = intval($page) - 1;
  $previous = esc_attr( get_pagenum_link($previous) );
  $firstpage = esc_attr( get_pagenum_link(1) );

  if ( $firstpage && (1 != $page) )
  $echo .= '<li class="page-item mx-1 mx-md-2"><a class="page-link fa fa-angle-left" aria-label="Previous" href="' . $previous . '" title="' . __( 'previous', 'Mirrorful') . '"><svg class="rotate-180 svg-arrow" width="9" height="17" viewBox="0 0 9 17" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 0.999999L8 8.5L1 16" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>' . '</a></li>';

  if ( !empty($min) && !empty($max) ) {
    for( $i = $min; $i <= $max; $i++ ) {
      if ($page == $i) {
        $echo .= '<li class="active page-item mx-1 mx-md-2"><span class="page-link">' . str_pad( (int)$i, 2, ' ', STR_PAD_LEFT ) . '</span></li>';
      } else {
        $echo .= sprintf( '<li class="page-item mx-1 mx-md-2"><a class="page-link" href="%s">%s</a></li>', esc_attr( get_pagenum_link($i) ), $i );
      }
    }
  }

  $next = intval($page) + 1;
  $next = esc_attr( get_pagenum_link($next) );
  $lastpage = esc_attr( get_pagenum_link($count) );

  if ( $lastpage && ($count != $page) ) {
    $echo .= '<li class="page-item mx-1 mx-md-2"><a class="page-link" href="' . $next . '" title="' . __( 'next', 'Mirrorful') . '"><svg class="svg-arrow" width="9" height="17" viewBox="0 0 9 17" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M1 0.999999L8 8.5L1 16" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>' . '</a>
    </li>';
  }

  if ( isset($echo) )
  echo $args['before_output'] . $echo . $args['after_output'];
}
