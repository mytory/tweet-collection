<?php
/*
Plugin Name: Tweet collection
Description: This plugin collect tweets from specific Twitter account. tweets` post_type is ‘tweet’, when you save tweets general post and tweet do not mixed.
Author: Ahn, Hyoung-woo
Version: 1.0.4
*/

//언어 파일 등록
function tweet_collection_init() {
	load_plugin_textdomain( 'tweet-collection', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action('plugins_loaded', 'tweet_collection_init');

//커스텀 포스트 타입 등록
function tc_register_custom_post_type() {
	$labels = array(
		'name' => _x('Tweets', 'post type general name', 'tweet-collection'),
		'singular_name' => _x('Tweet', 'post type singular name', 'tweet-collection'),
		'add_new' => _x('Add New', 'tweet', 'tweet-collection'),
		'add_new_item' => __('Add New Tweet', 'tweet-collection'),
		'edit_item' => __('Edit Tweet', 'tweet-collection'),
		'new_item' => __('New Tweet', 'tweet-collection'),
		'all_items' => __('All Tweets', 'tweet-collection'),
		'view_item' => __('View Tweet', 'tweet-collection'),
		'search_items' => __('Search Tweets', 'tweet-collection'),
		'not_found' =>	__('No tweets found', 'tweet-collection'),
		'not_found_in_trash' => __('No tweets found in Trash', 'tweet-collection'), 
		'parent_item_colon' => '',
		'menu_name' => __('Tweets', 'tweet-collection')

	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'has_archive' => true, 
		'hierarchical' => false,
		'menu_position' => 4,
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'revisions' )
	); 
	register_post_type('tweet', $args);
}
add_action( 'init', 'tc_register_custom_post_type' );

//옵션 페이지 html, action 등록.
add_action('admin_menu', 'tc_top_menu');
function tc_top_menu() {
	add_options_page(__('Tweet Collection', 'tweet-collection'), __('Tweet Collection', 'tweet-collection'), 9, 'tweet-collection', 'tc_menu_page');
}
function tc_menu_page() {
	if (!current_user_can('manage_options')) 
		wp_die( __('You do not have sufficient permissions to access this page.', 'tweet-collection') );
	if( isset($_POST['title_length']) ){
		update_option('tweet-collection-title-length', $_POST['title_length']);
	}
	
	if( isset($_POST['tweet_username']) AND ! empty($_POST['tweet_username']) ){
		if( get_option( 'tweet-collection-twitter-username' ) == $_POST['tweet_username'] ){
			$message = __('Saved!', 'tweet-collection');
			//옵션 저장하면 한 번 긁어 와 준다.
			do_action('collect_tweets');
		}else{
			$result = update_option('tweet-collection-twitter-username', $_POST['tweet_username']);
			if( $result ){
				$message = __('Saved!', 'tweet-collection');
				do_action('collect_tweets');
			} else {
				$message = __('Failed!', 'tweet-collection');
			}
		}
	}else if( isset($_POST['tweet_username']) AND empty($_POST['tweet_username'])){
		$message = __('Fill User ID!', 'tweet-collection');
	}
	include 'tc-menu-page.php';
}

// 트위터 아이디 설정을 하지 않은 경우 등록하라고 메시지를 뿌린다.
function tc_shoud_set_username_admin_notice(){
	if( ! isset($_POST['tweet_username']) ){ ?>
	<div class="updated">
       	<p>
       	<?php _e('Set your collecting twitter target username!', 'tweet-collection') ?> 
       	<a href="options-general.php?page=tweet-collection"><?php _e('Go to Tweet Collection Option page!', 'tweet-collection') ?></a>
       	</p>
    </div>
	<? }
}
if( ! get_option('tweet-collection-twitter-username') ){
	add_action('admin_notices', 'tc_shoud_set_username_admin_notice');
}

// 20분에 한 번씩 실행되는 옵션을 cron에 등록한다. (나중엔 얼마에 한 번씩 긁어올 지도 설정할 수 있게 한다.)
 add_filter( 'cron_schedules', 'tc_cron_add_20m' );
 
 function tc_cron_add_20m( $schedules ) {
 	// Adds once weekly to the existing schedules.
 	$schedules['20m'] = array(
 		'interval' => 60*20,
 		'display' => __( 'Once by 20 minutes', 'tweet-collection')
 	);
 	return $schedules;
 }

//텍스트로 있는 링크에 a 태그를 붙여서 실제 링크로 만들어 주는 함수
function tc_linkfy($s) {
  return preg_replace('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', '<a class="link-shared" href="$1">$1</a>', $s);
}

// 텍스트를 받아서 첫 번째로 나오는 URL을 리턴해 주는 함수다.
function tc_extract_link($s) {
  preg_match('@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-]*(\?\S+)?[^\.\s])?)?)@', $s, $matches);
  if( count($matches) > 0 ){
	return $matches[0];
  }else{
	return FALSE;
  }
}

// 트위터의 xml을 긁어서 집어 넣을 콘텐츠를 만든다.
function tc_get_tweets_xmldom(){
	// 내 트위터 RSS
	$url = 'http://api.twitter.com/1/statuses/user_timeline.rss?screen_name=' . get_option('tweet-collection-twitter-username');

	// cURL로 트위터 RSS XML을 받아 온다.
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$tweets = curl_exec($ch);
	curl_close($ch);

	// SimpleXML을 이용해서 XML을 PHP 객체와 배열로 만든다. 
	// http://www.php.net/manual/en/simplexml.examples-basic.php 참고
	$xmldom = new SimpleXMLElement($tweets);

	$item_count = count($xmldom->channel->item);

	// 트위터 글에 링크가 있으면 RSS의 목적지 URL을 그 링크로 대체한다.
	// 이렇게 하지 않으면 RSS의 목적지 URL이 트위터 글이 된다.
	for($i = $item_count-1 ; $i > -1; $i--){
		$desc = $xmldom->channel->item[$i]->description;
		$link = tc_extract_link($desc);
		$title = str_replace($link,'',$xmldom->channel->item[$i]->title);
		$twitter_username = get_option('tweet-collection-twitter-username');
		if(trim($title) != $twitter_username.':'){
			$xmldom->channel->item[$i]->title = $title;
		}
		if( strlen($link)>19 ){
			$xmldom->channel->item[$i]->description = tc_linkfy($desc);
		}
	}

	return $xmldom;
}

/**
 * 제목을 넣을 때 사용하는 특수문자 디코딩 함수. 
 * PHP5부터 있기 때문에 4에서는 함수 정의를 해 줘야 한다.
 */
if ( ! function_exists('htmlspecialchars_decode') ){
	function htmlspecialchars_decode($string,$style=ENT_COMPAT)
	{
		$translation = array_flip(get_html_translation_table(HTML_SPECIALCHARS,$style));
		if($style === ENT_QUOTES){ $translation['&#039;'] = '\''; }
		return strtr($string,$translation);
	}
}

// 트위터의 xml을 긁어 와서 새 Tweet Post Type으로 등록하는 함수를 만든다.
function tc_insert_tweet_custom_post(){
	//설정이 제대로 안 돼 있으면 중단.
	if( ! get_option('tweet-collection-twitter-username') ){
		return false;
	}
	$xmldom = tc_get_tweets_xmldom();
	$item_count = count($xmldom->channel->item);
	for($i = 0; $i < $item_count; $i++){
		$title = htmlspecialchars_decode($xmldom->channel->item[$i]->title);
		$desc = $xmldom->channel->item[$i]->description;
		$tweet_guid = $xmldom->channel->item[$i]->guid;
		if( tc_is_already_insert($tweet_guid) > 0 ){
			continue;
		}
		$gmt_offset = get_option('gmt_offset');
		$timestamp = $gmt_offset*60*60 + strtotime($xmldom->channel->item[$i]->pubDate);
		$datetime = date_i18n(get_option('date_format') .' '. get_option('time_format') , $timestamp);
		$post_date = date('Y-m-d H:i:s', strtotime($xmldom->channel->item[$i]->pubDate));
		$post_date_gmt = date('Y-m-d H:i:s', $gmt_offset*60*60 + strtotime($xmldom->channel->item[$i]->pubDate));
		$args = array(
			'comment_status' => 'closed', // 'closed' means no comments.
			'post_date'=>$post_date_gmt,
			'ping_status'    => 'closed', // 'closed' means pingbacks or trackbacks turned off
			'post_content'   => $desc . "\n\n" . "<a class='tweet-permalink' href='{$tweet_guid}' title='Tweet Permalink'>{$datetime}</a>", //The full text of the post.
			'post_status'    => 'publish', //Set the status of the new post.
			'post_title'     => $title, //The title of your post.
			'post_type'      => 'tweet', //You may want to insert a regular post, page, link, a menu item or some custom post type
		);
		$post_id = wp_insert_post($args);

		if($post_id){
			add_post_meta($post_id, 'tc_tweet_guid', (string)$tweet_guid, true);
		}else{
		}
	}

}

//중복 컨텐츠 확인을 위한 함수
function tc_is_already_insert($tweet_guid){
	$query = new WP_Query( 'meta_key=tc_tweet_guid&meta_value='.$tweet_guid.'&post_type=tweet&post_status=publish,future' );
	return $query->post_count;
}

// 플러그인 활성화할 때 wp_cron 등록
add_action('collect_tweets', 'tc_insert_tweet_custom_post');
function tweet_collection_activate(){
	wp_schedule_event( time(), '20m', 'collect_tweets');
}
register_activation_hook( __FILE__, 'tweet_collection_activate' );

// 플러그인 비활성화할 때 wp_cron 해제
function tweet_collection_deactivate(){
	wp_clear_scheduled_hook( 'collect_tweets' );
	delete_option('tweet-collection-twitter-username');
}
register_deactivation_hook( __FILE__, 'tweet_collection_deactivate' );

//트윗 검색
function tc_print_searchform(){ ?>
	<form id="searchform" class="search-tweets-form" method="get" action="<?php bloginfo('url')?>">
		<label class="assistive-text" for="s"><?php _e('Search Tweets', 'tweet-collection')?></label>
		<input type="text" placeholder="<?php _e('Search Tweets', 'tweet-collection')?>" value="<?=get_search_query()?>" id="s" name="s" class="field">
		<input type="hidden" name="post_type" value="tweet">
		<input type="submit" value="<?php _e('Search Tweets', 'tweet-collection')?>" id="searchsubmit" class="submit button-primary">
	</form>
<? }

include_once 'widget.php';

function tc_text_dot($text, $len){
	$text = strip_tags($text);
	if(strlen($text)<=$len) {
		return $text;
	} else {
		$text = wp_specialchars_decode($text);
		$text = mb_substr($text, 0, $len, 'utf-8');
		$text = wp_specialchars($text);
		return $text."…";
	}
}

//트윗 제목에서 내 ID 제거
function tc_remove_my_username_from_title($title){
	if( get_post_type() == 'tweet' ){
		$username = get_option( 'tweet-collection-twitter-username' );
		$username_length = mb_strlen($username);
		if( mb_substr($title, 0, $username_length+2) == $username . ': '){
			return mb_substr($title, $username_length+2);
		}else{
			return $title;
		}
	}
	return $title;
}
add_action('the_title', 'tc_remove_my_username_from_title', 1);
add_filter('single_post_title', 'tc_remove_my_username_from_title', 1);

//트윗 제목 길이
function tc_apply_title_length($title){
	if( get_post_type() == 'tweet' ){
		$title_length = get_option( 'tweet-collection-title-length' );
		return tc_text_dot($title, $title_length);
	}
	return $title;
}

if( get_option( 'tweet-collection-title-length' ) AND get_option( 'tweet-collection-title-length' ) !== 0 ){
	add_action('the_title', 'tc_apply_title_length');
	add_filter('single_post_title', 'tc_apply_title_length');
} 