<?php
class RandomAccessButton extends WP_Widget{
    function __construct(){
        parent::__construct(
            'RandomAccessButton', //ID
            'ランダムアクセスボタン', //名前
            array('description' => 'ランダム記事にアクセスするボタンを表示するウィジェット')  //概要
        );
    }
  
    public function widget($args, $instance){
        echo $args['before_widget'];
        //ここから本体
        $random_article = get_random_article(); //ランダム記事を取得
        $url = esc_url(get_permalink($random_article->ID)); //URLを取得
        echo "<a href=".$url." class=\"a-wrap\" style=\"z-index:10; margin-top:10px;\">ランダム記事にアクセス</a>";
        //ここまで本体
        echo $args['after_widget'];
    }
}

//ウィジェットとして登録
add_action( 
    'widgets_init',
    function(){
        register_widget('RandomAccessButton');
    }
);

//ランダム記事取得関数
function get_random_article() { 
    $args = array( 
        'posts_per_page' => 1,  //1ページ
        'orderby' => 'rand',    //ランダム順
        'post_type' => 'post',  //投稿記事
    );
    $my_posts = get_posts( $args );
    wp_reset_postdata();
    return $my_posts[0];
}
?>