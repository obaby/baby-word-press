function custom_search( $search_result, $wp_query ) {
  global $wpdb;
 if( !$wp_query->is_search ) {
   return $search_result; 
  }
  if( !isset( $wp_query->query_vars ) ) {
   return $search_result; 
  }
$key_string=$wp_query->query_vars['s'];
  $keywords =jieba($key_string);
  if ( count( $keywords ) > 0 ) {
   $search_result = '';
   foreach ( $keywords as $keyword ) {
    if ( !empty( $keyword ) ) {
     $keywords = '%' . esc_sql( $keyword ) . '%';
     $search_result .= " 
      AND (
       {$wpdb->posts}.post_title LIKE '{$keywords}'
        OR {$wpdb->posts}.post_content LIKE '{$keywords}'
        OR {$wpdb->posts}.ID IN (
         SELECT distinct post_id
         FROM {$wpdb->postmeta}
         WHERE meta_value LIKE '{$keywords}'
        )
      ) ";
    }
   }
  }
  return $search_result;
 }
 add_filter( 'posts_search','custom_search', 10, 2 );