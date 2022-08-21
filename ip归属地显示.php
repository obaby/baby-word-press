/*
	1. 安装 WP-UserAgent插件
	2. 修改vim wp-useragent.php 添加以下代码
	*/
include("show-useragent/show-useragent.php"); 

include("show-useragent/ip2c-text.php");

// 以下内容添加到 function wpua_display_useragent($wpua_wrapper_div = false)函数
$ip = get_comment_author_IP();
//      echo $ip;
//      echo CID_get_flag_without_template($ip);
//echo convertip($ip);
$wpua_useragent .= CID_get_flag_without_template($ip,true,false);
$wpua_useragent .= convertip($ip);


//添加到以下行的上面
        // Does the user want to display the full useragent string?
        if ($wpua_show_full_ua === 'true')
        {
                // Attach the full ua string to the output.
                $br = (strlen($wpua_useragent) > 0) ? (($wpua_doctype === 'html') ? '<br>' : '<br />') : '';
                $wpua_useragent .= "$br<small>".wpua_str_escape($comment->comment_agent)."</small>";
        }

        if ($wpua_wrapper_div === true)
        {
                // Wrap WP-UserAgent output in div
                $wpua_useragent = "<div class='wp-useragent'>$wpua_useragent</div>";
        }

        // The following conditional will hopefully prevent a problem where
        // the echo statement will interrupt redirects from the comment page.
        if (empty($_POST['comment_post_ID']) || is_admin()) echo $wpua_useragent;
