### How to Setup ###

To get tweets, require twitter authentication. Twitter not serve user RSS feed no longer. So you have to take key and secret string for twitter app. That is very easy. Follow below description and screenshot.

1. First, go to [page that request app key](https://dev.twitter.com/apps). Sign in as your username.
1. Click __Create a new application__ button.
1. At __Create an application__ page, fill __Application Details__ fields.
    * Name: Fill you want.
    * Description: Fill you want.
    * Website: Your blog URL. __http://__ is required.
    * Callback URL: Let blank.
    * Developer Rules of the Road: Check __Yes, I agree__.
1. Fill CAPTCHA and click __Create your Twitter application__ button.
1. You can see app page. If you are on app list page, enter app you made. Watch __Details__ tab. Check __Consumer Key__ and __Consumer Secret__. Now, scroll down.
1. Bottom of __Details__, there is __Create my access token__ button. Click. So, __Access Token__ and __Access Token Secret__ will be generated. Check.
1. Return to Tweet Collection Setup page. (__Setup > Tweet Collection__) Fill __Consumer key__, __Consumer Secret__, __Access Token__, __Access Token Secret__.
1. When you save settings, that is first time getting tweets. Afterward, get tweets by each 20m.

Below is screenshot description.

![1. dev page login]({{slides}}/01-dev-page-login.png)
![2. create a new application]({{slides}}/02-create-a-new-application.png)
![3. application detail]({{slides}}/03-application-detail.png)
![4. create your twitter application]({{slides}}/04-create-your-twitter-application.png)
![5. oauth setting]({{slides}}/05-oauth-setting.png)
![6. create my access token]({{slides}}/06-create-my-access-token.png)
![7. your access token]({{slides}}/07-your-access-token.png)

### Code Usage Info ###

If you want to show searching tweets form to customer, write this code to location you want.

    tc_print_searchform();

If do not work, use below.

    <?php tc_print_searchform();?>

Insert below code to archive.php file. So, You can show search tweets form to customers only on tweet archive.

    if(get_post_type() == 'tweet'){ 
    	tc_print_searchform();	
    }

If do not work, use below.

    <?php if(get_post_type() == 'tweet'){ 
    	tc_print_searchform();	
    } ?>

Location I recommend is right above of `<?php while ( have_posts() ) : the_post(); ?>` line in archive.php on theme folder

### Showing 'search tweet' form on search result page. ###

Search result file is mostly search.php file. Of course, vary depending on the theme.
Find below code.

    <div id="content" role="main">

And put code below directly below of the code mentioned above.

    <? if( $_GET['post_type'] == 'tweet' AND function_exists('tc_print_searchform') ){
    	?><div style="margin-bottom: 1em;"><? 
    	tc_print_searchform();
    	?></div><?	
    }?>

You also put code to 'Nothing Found' page. Depending on the theme, there are big differences. So I can not explain simply. But, use the code below.

    <? if( $_GET['post_type'] == 'tweet' AND function_exists('tc_print_searchform') ){
    	tc_print_searchform();
    }else{
    	get_search_form();
    }?>