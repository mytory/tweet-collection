<?
// TODO token 등 입력하도록 입력폼을 만들어야 한다.
// TODO 설명 번역 파일을 만들어야 한다.
?>
<style type="text/css">
    form.tc {
        padding: 20px;
        background: #eee;
        border: 1px solid #aaa;
        border-radius: 5px;
        margin-top: 20px;
    }
</style>

<div class='wrap'>

<h2><?php _e('Tweet Collection Options', 'tweet-collection') ?></h2>
<?php if( isset($message) ){ ?>
<div class="updated">
	<p><?php echo $message?></p>
</div>
<?php }	?>
<form method="post" class="tc">
    <table class="form-table tc-table">
        <tr>
            <th scope="row">
                <label for="twitter_username"><?php _e('Twitter User ID : ', 'tweet-collection') ?></label>
            </th>
            <td>
                <input required type="text" name="twitter_username" id="twitter_username"
                       value="<?php echo get_option('tweet-collection-twitter-username')?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="title_length"><?php _e('Title Length : ', 'tweet-collection')?></label>
            </th>
            <td>
                <input type="text" name="title_length" id="title_length"
                       value="<?php echo get_option('tweet-collection-title-length')?>"/>
                <span class="help">
                    <?php _e("If 0, full length.", 'tweet-collection')?>
                    <?php _e("Even if you change the length, Title data does not deleted. Change the display only.", 'tweet-collection')?>
                </span>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="number_tweets"><?php _e('At a time, the number of Tweets : ', 'tweet-collection') ?></label>
            </th>
            <td>
                <input required type="text" name="number_tweets" id="number_tweets"
                       value="<?php echo get_option('tweet-collection-number-tweets')?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="consumer_key"><?php _e('Consumer Key : ', 'tweet-collection') ?></label>
            </th>
            <td>
                <input required type="text" name="consumer_key" id="consumer_key"
                       value="<?php echo get_option('tweet-collection-consumer-key')?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="consumer_secret"><?php _e('Consumer Secret : ', 'tweet-collection') ?></label>
            </th>
            <td>
                <input required type="text" name="consumer_secret" id="consumer_secret"
                       value="<?php echo get_option('tweet-collection-consumer-secret')?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="access_token"><?php _e('Access Token : ', 'tweet-collection') ?></label>
            </th>
            <td>
                <input required type="text" name="access_token" id="access_token"
                       value="<?php echo get_option('tweet-collection-access-token')?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="access_token_secret"><?php _e('Access Token Secret : ', 'tweet-collection') ?></label>
            </th>
            <td>
                <input required type="text" name="access_token_secret" id="access_token_secret"
                       value="<?php echo get_option('tweet-collection-access-token-secret')?>"/>
            </td>
        </tr>
    </table>
	<p class="submit">
        <input type="submit" value="Save" class="button-primary">
	</p>
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