# Tweet Collection #
**Contributors:** mytory  
Donate link:http://mytory.net/paypal-donation
**Tags:** twitter  
**Requires at least:** 3.0  
**Tested up to:** 3.5  
**Stable tag:** 1.0.4  
**License:** GPLv2 or later  

This plugin collect tweets from specified Twitter account. Post_type of collected tweets will be ‘tweet’ so that normal posts and tweets will not be mixed.


## Description ##

tweet api is changed. so this plugin not work. I'll update as soon as possible.

This plugin collect tweets from specified Twitter account. Post_type of collected tweets will be ‘tweet’ so that normal posts and tweets will not be mixed. The purpose of this plugin is to search for your tweets on your blog and to collect more than 3,200 tweets. (Twitter does not show you more than 3,200 tweets.)

This plugin collects tweets that are posted since its installation. Tweets that posted before its installation will not be collected.

I will develope the plugin for all the tweets as soon as possible.

Please see the [screenshots](http://wordpress.org/extend/plugins/tweet-collection/screenshots/) to know usage.

이 플러그인은 특정 트위터 계정에서 트윗을 긁어 모읍니다. 트윗을 모아서 한 포스트로 만드는 게 아니라, 각각의 트윗은 'tweet'이라는 post_type이 됩니다. 트윗을 저장할 때, 일반 글과 트윗이 섞이지 않습니다. 이 플러그인의 목적은 내가 쓴 트윗을 검색하고, 3200개 이상의 트윗을 저장하도록 하는 것입니다. (트위터는 3200개 이상의 트윗은 보여 주지 않습니다. 자신이 쓴 거라 해도 말입니다. 순차적으로 백업 서비스가 개방되고 있기는 합니다만.)

이 플러그인은 설치한 직후에 나온 트윗부터 모으기 시작합니다. 과거의 tweet을 모두 가져오는 것은 아닙니다.

과거의 tweet을 import하는 플러그인은 시간이 나는대로 개발해서 내놓겠습니다.

사용법은 [스크린샷](http://wordpress.org/extend/plugins/tweet-collection/screenshots/)을 참고하세요.

## Installation ##

Extract the zip file and just drop the contents in the wp-content/plugins/ directory of your WordPress installation and then activate the Plugin from Plugins page.

## Frequently Asked Questions ##

### When I went to the individual Tweet page, the page can not be found. ###

Problems that are caused by Permalink Settings. Please go to Settings > Permalinks, press Save once.

### How to use? ###

Please see the [screenshots](http://wordpress.org/extend/plugins/tweet-collection/screenshots/) to know usage.

### tweet 개별 페이지로 가면 페이지를 찾을 수 없다고 합니다. ###

고유주소 때문에 발생하는 문제입니다. 설정 > 고유주소로 가서 저장을 한 번 눌러 주세요.

### 사용법은? ###

[스크린샷](http://wordpress.org/extend/plugins/tweet-collection/screenshots/)을 봐 주세요.

## Screenshots ##

###1. [Tweet Collection menu in admin page.](http://s-plugins.wordpress.org/tweet-collection/assets/screenshot-1.png)###
![[Tweet Collection menu in admin page.](http://s-plugins.wordpress.org/tweet-collection/assets/screenshot-1.png)](http://s.wordpress.org/extend/plugins/tweet-collection/screenshot-1.png)

###2. [Setting page. You can go Tweet archive page on here.](http://s-plugins.wordpress.org/tweet-collection/assets/screenshot-2.png)###
![[Setting page. You can go Tweet archive page on here.](http://s-plugins.wordpress.org/tweet-collection/assets/screenshot-2.png)](http://s.wordpress.org/extend/plugins/tweet-collection/screenshot-2.png)

###3. [Tweet archive page and widgets.](http://s-plugins.wordpress.org/tweet-collection/assets/screenshot-3.png)###
![[Tweet archive page and widgets.](http://s-plugins.wordpress.org/tweet-collection/assets/screenshot-3.png)](http://s.wordpress.org/extend/plugins/tweet-collection/screenshot-3.png)

###4. [widgets Tweet Collection provide.](http://s-plugins.wordpress.org/tweet-collection/assets/screenshot-4.png)###
![[widgets Tweet Collection provide.](http://s-plugins.wordpress.org/tweet-collection/assets/screenshot-4.png)](http://s.wordpress.org/extend/plugins/tweet-collection/screenshot-4.png)

###5. [How add Tweet archive page to menu.](http://s-plugins.wordpress.org/tweet-collection/assets/screenshot-5.png)###
![[How add Tweet archive page to menu.](http://s-plugins.wordpress.org/tweet-collection/assets/screenshot-5.png)](http://s.wordpress.org/extend/plugins/tweet-collection/screenshot-5.png)


## Changelog ##

### 1.0.4 ###
* correct html special characters in title. (제목에서 HTML 특수문자 제대로 표시하게 함.)

### 1.0.3 ###
* set input value by current search term. (인풋 value에 방금 검색한 검색어 넣어 줌.)
* Add description that print search tweet form on search result page. (검색 결과 페이지에서 트윗 검색 폼 출력하도록 하는 설명 추가.)

### 1.0.2 ###
* Add title length option.
* Remove registered Twitter username from title.