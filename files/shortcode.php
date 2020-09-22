<?php
// Tạo News Shortcode

add_shortcode('gg-pagination', 'showPagination');
function showPagination( $echo = true ) {
    ob_start();
    global $wp_query, $wp_rewrite, $t;
    $total = $wp_query->max_num_pages;
    if (!$current = get_query_var('paged')) $current = 1;
    $big = 999999999; // need an unlikely integer
    if(wp_is_mobile()) {
      $pages = paginate_links( array(
          'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          'format' => '?paged=%#%',
          'current' => $current,
          'total' => $total,
          'type'  => 'array',
          'prev_next'   => false,
          'prev_text'    => '',
          'next_text'    => '',
          'mid_size' => 1, //how many links to show on the left and right of the current
          'end_size' => 1, //how many links to show in the beginning and end
        )
      );
    } else {
      $pages = paginate_links( array(
          'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
          'format' => '?paged=%#%',
          'current' => $current,
          'total' => $total,
          'type'  => 'array',
          'prev_next'   => false,
          'prev_text'    => '',
          'next_text'    => '',
        )
      );
    }
    if( is_array( $pages ) ) {
      $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
  
      $pagination = '<ul class="pagination" role="menubar" aria-label="Pagination">';
      if ($current != 1) {
        $pagination .= '<li><a href="'.get_pagenum_link(1).'" class="first"></a></li>';
        $pagination .= '<li><a href="'.get_pagenum_link($current - 1).'" class="previous"></a></li>';
      } else {
        $pagination .= '<li><a href="#" class="first disabled"></a></li>';
        $pagination .= '<li><a href="#" class="previous disabled"></a></li>';
      }
  
      foreach ( $pages as $page ) {
        $pagination .= "<li class=''>$page</li>";
      }
  
      if ($current != $total) {
        $pagination .= '<li><a href="'.get_pagenum_link($current + 1).'" class="next"></a></li>';
        $pagination .= '<li><a href="'.get_pagenum_link($total).'" class="last"></a></li>';
      } else {
        $pagination .= '<li><a href="#" class="next disabled"></a></li>';
        $pagination .= '<li><a href="#" class="last disabled"></a></li>';
      }
      $pagination .= '</ul>';
  
      if ( $echo ) {
        echo $pagination;
      } else {
        return $pagination;
      }
    }
    $myvariable = ob_get_clean();
        return $myvariable;
}
?>