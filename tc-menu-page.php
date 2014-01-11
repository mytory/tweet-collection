<?php 
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
    .tc-desc img {
        width: 600px;
        display: block;
        margin: 2em auto;
        border: 1px solid #ddd;
        cursor: pointer;
    }
    .tc-desc img.zoomin {
        width: auto;
        height: auto;
    }
    .tc-desc__toc {
        list-style: disc;
        padding-left: 20px;
    }
</style>
<script>
jQuery(document).ready(function($){
    $('.tc-desc img').click(function(){
        $(this).toggleClass('zoomin');
    });

    var h3index = 0;
    $('.tc-desc__content h3').each(function(){
        var text = $(this).text();
        var id = 'h3-' + h3index;
        h3index++;
        console.log(id);
        $(this).attr('id', id);
        var link = $('<a />', {
            'text': text,
            'href' : '#' + id
        });
        var li = $('<li />').append(link);
        li.appendTo('.tc-desc__toc');
    });

    $('[href^="#"]').click(function(e){
        e.preventDefault();
        var selector = $(this).attr('href');
        var top = $(selector).position().top + 100;
        window.scrollTo(0, top);
    });
});
</script>

<div class='wrap'>
<div class="icon32" id="icon-options-general"><br></div>
<h2><?php _e('Tweet Collection Options', 'tweet-collection') ?></h2>
<?php if( isset($message) ){ ?>
<div class="updated">
	<p><?php echo $message?></p>
</div>
<?php }	?>
<form method="post" class="tc">
    <p><?php _e('To get keys, read manual below.', 'tweet-collection') ?></p>
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
                <input class="small-text" type="text" name="title_length" id="title_length"
                       value="<?php echo get_option('tweet-collection-title-length')?>"/>
                <span class="help">
                    <?php _e("If 0, full length.", 'tweet-collection')?>
                    <?php _e("Even if you change the length, Title data does not deleted. Change the display only.", 'tweet-collection')?>
                </span>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="number_tweets"><?php _e('Number of import tweets at a time : ', 'tweet-collection') ?></label>
            </th>
            <td>
                <input class="small-text" required type="text" name="number_tweets" id="number_tweets"
                       value="<?php echo get_option('tweet-collection-number-tweets')?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="consumer_key"><?php _e('Consumer Key : ', 'tweet-collection') ?></label>
            </th>
            <td>
                <input class="large-text" required type="text" name="consumer_key" id="consumer_key"
                       value="<?php echo get_option('tweet-collection-consumer-key')?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="consumer_secret"><?php _e('Consumer Secret : ', 'tweet-collection') ?></label>
            </th>
            <td>
                <input class="large-text" required type="text" name="consumer_secret" id="consumer_secret"
                       value="<?php echo get_option('tweet-collection-consumer-secret')?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="access_token"><?php _e('Access Token : ', 'tweet-collection') ?></label>
            </th>
            <td>
                <input class="large-text" required type="text" name="access_token" id="access_token"
                       value="<?php echo get_option('tweet-collection-access-token')?>"/>
            </td>
        </tr>
        <tr>
            <th scope="row">
                <label for="access_token_secret"><?php _e('Access Token Secret : ', 'tweet-collection') ?></label>
            </th>
            <td>
                <input class="large-text" required type="text" name="access_token_secret" id="access_token_secret"
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
<p><a href="<?php echo plugin_dir_url(__FILE__)?>rss.php"><?php _e('Tweets RSS Feed', 'tweet-collection') ?></a></p>
<h3><?php _e('Search Tweets Example', 'tweet-collection')?></h3>
<?php tc_print_searchform();?>
<h3><?php _e('Feedback', 'tweet-collection') ?></h3>
<p><a href="mailto:mytory@gmail.com">mytory@gmail.com</a></p>
<h3><?php _e('Delete settings', 'tweet-collection') ?></h3>
<p>If you'll not use this plugin permanently, <a href="<?php echo $_SERVER['REQUEST_URI']?>&delete_all_settings=y">delete all settings</a>.</p>
<?php 
include 'php-markdown-1.0.1q/markdown.php';
$information_file = "languages/information-en_US.md";
$information_file_expected = dirname(__FILE__) . '/languages/information-' . WPLANG . '.md';
if( is_file($information_file_expected) ){
	$information_file = $information_file_expected;
} 
$info_markdown = file_get_contents($information_file);
$info_html = Markdown($info_markdown);
$info_html = str_replace('{{slides}}', plugin_dir_url(__FILE__) . 'slides', $info_html);
?>
<div class="tc-desc">
    <div class="icon32" id="icon-options-general"><br></div>
    <h2><?php _e('Tweet Collection Manual', 'tweet-collection')?></h2>
    <h3><?php _e('Table of Contents', 'tweet-collection')?></h3>
    <ul class="tc-desc__toc"></ul>
    <div class="tc-desc__content">
        <?php echo $info_html;?>
    </div>
</div>
</div><!-- .wrap -->