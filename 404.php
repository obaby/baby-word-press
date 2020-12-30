<?php get_header(); ?>
<div class="row">
<div class="col-lg-12 col-12">
<main id="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
<div class="row">
<div class="col-md-12">
<img style="border-radius:20px; " alt="  I love highheels!  " src="http://h4ck.org.cn/highheels/pink.jpg"/>
<article class="entry">
<h2 class="entry-title">
<?php esc_html_e( 'Page not found' , 'olsen-light' ); ?>
</h2>
<div class="entry-content">
<?php esc_html_e( 'The page you were looking for can not be found! Perhaps try searching?', 'olsen-light' ); ?>
<?php get_search_form(); ?>
</div>
</article>
<h4 class="entry-title">
<?php esc_html_e( 'Similar Posts' , 'olsen-light' ); ?>
</h4>
<div>
<?php
                        global $wp;
                        // 获取当前url路径
                        $current_slug = add_query_arg( array(), $wp->request );
                        //echo($current_slug);
                        // 路径进行拆分
                        $keywords = explode('/', $current_slug);
                        $search_keyword_string = $keywords[count($keywords)-1];
                        // urldecode 进行关键字处理
                        $search_keyword_string = urldecode_deep($search_keyword_string);
                        $search_keyword_string = str_replace('-', '', $search_keyword_string);
                        // echo($search_keyword_string);
                        // 使用 - 进行关键词拆分
                        $result = jieba($search_keyword_string);
    //echo($result);
    foreach($result as $value){
    //echo "{$value}<br />";
    $args = array('s'=>$value);
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
        //_e("<h2 style='font-weight:bold;color:#000'>Search Results for: ".get_query_var('s')."</h2>");
        while ( $the_query->have_posts() ) {
        $the_query->the_post();
        ?>
        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?> - <?php the_modified_date(); ?></a></li>
        <?php
        }
        }
    }
                    ?>              
 
<hr />
</div>
<!-- 显示随机文章 -->
<h4 class="entry-title">
<?php esc_html_e( 'Random Posts' , 'olsen-light' ); ?>
</h4>
<div>
<?php           
                        $args = array( 'numberposts' => 20, 'orderby' => 'rand', 'post_status' => 'publish' );
                        $rand_posts = get_posts( $args );
                        foreach( $rand_posts as $post ) : ?>
    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?> - <?php the_modified_date(); ?></a></li>
<?php endforeach; ?>
</div>
</div>
</div>
</main>
</div>
<!-- 
 
<div class="col-lg-4 col-12">
<?php 
        // 禁用侧边栏
        //get_sidebar(); 
        ?>
</div>
 
    -->
</div>
<?php get_footer(); ?>