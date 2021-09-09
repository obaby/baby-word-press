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
 
 function reply_to_read($atts, $content=null) {
	extract(shortcode_atts(array("notice" => '<p class="reply-to-read">温馨提示: 此处隐藏内容需要<a href="#respond" title="发表评论">发表评论</a>，并且审核通过后才能查看。<br />（发表评论请勾选 <strong>在此浏览器中保存我的显示名称、邮箱地址和网站地址，以便下次评论时使用。</strong>）</p>'), $atts));
	$email = null;
	$user_ID = (int) wp_get_current_user()->ID;
	if ($user_ID > 0) {
		$email = get_userdata($user_ID)->user_email;
		$admin_email = array("root@obaby.org.cn","obaby.lh@gmail.com","obaby.lh@163.com");
		if(in_array($email,$admin_email)) {
			// if ($email == $admin_email){
			return $content;
		}
	} else if (isset($_COOKIE['comment_author_email_'.COOKIEHASH])) {
		$email = str_replace('%40', '@', $_COOKIE['comment_author_email_'.COOKIEHASH]);
		//return $email;
	} else {
		  return $notice;
	}
	if (empty($email)) {
		return $notice;
	}
	global $wpdb;
	$post_id = get_the_ID();
	$query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";
	if ($wpdb->get_results($query)) {
		return do_shortcode($content);
	} else {
		return $notice;
	}
}
add_shortcode('reply', 'reply_to_read');