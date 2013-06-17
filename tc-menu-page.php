<?
// TODO token 등 입력하도록 입력폼을 만들어야 한다.
// TODO 설명 번역 파일을 만들어야 한다.
?>
<style type="text/css">
	.assistive-text{display:none}
	form.tc{padding:20px;background:#ddd;border:1px solid #aaa;border-radius:5px;margin-top:20px;}
</style>

<div class='wrap'>

<h2><?php _e('Tweet Collection Options', 'tweet-collection') ?></h2>
<?php if( isset($message) ){ ?>
<div class="updated">
	<p><?php echo $message?></p>
</div>
<?php }	?>
<form method="post" class="tc">
	<label for="tweet_username"><?php _e('Twitter User ID : ', 'tweet-collection') ?></label>
	<input required type="text" name="tweet_username" id="tweet_username" value="<?php echo get_option('tweet-collection-twitter-username')?>"/>
	<br>
	<br>
	<label for="title_length"><?php _e('Title Length : ', 'tweet-collection')?></label>
	<input type="text" name="title_length" id="title_length" value="<?php echo get_option('tweet-collection-title-length')?>"/>
	<span class="help">
		<?php _e("If 0, full length.", 'tweet-collection')?>
		<?php _e("Even if you change the length, Title data does not deleted. Change the display only.", 'tweet-collection')?>
	</span>
	<br>
	<br>
	<input type="submit" value="Save" class="button-primary">
</form>
<p><?php printf(__('<a href="%s/?post_type=tweet">You can see tweets on here.</a>', 'tweet-collection'), get_bloginfo('url'))?></p>
<p><a href="widgets.php"><?php _e('Go to widget page. (Search Tweet Form, Tweet Archive Link)', 'tweet-collection')?></a></p>
<h2><?php _e('Search Tweets', 'tweet-collection')?></h2>
<?php tc_print_searchform();?>
<?php 
$information_file = "languages/information-en_US.php";
$information_file_expected = dirname(__FILE__) . '/languages/information-' . WPLANG . '.php';
if( is_file($information_file_expected) ){
	$information_file = $information_file_expected;
} 
include $information_file;
?>
</div><!-- .wrap -->