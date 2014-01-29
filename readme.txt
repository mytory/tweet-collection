=== Tweet Collection ===
Contributors: mytory
Tags: twitter
Requires at least: 3.0
Tested up to: 3.8
Stable tag: 1.1.5
License: GPLv2 or later
Donate link:http://mytory.net/paypal-donation

This plugin collect tweets from specified Twitter account. Post_type of collected tweets will be ‘tweet’ so that normal posts and tweets will not be mixed.

== Description ==

This plugin collect tweets from specified Twitter account. Post_type of collected tweets will be ‘tweet’ so that normal posts and tweets will not be mixed. The purpose of this plugin is to search for your tweets on your blog and to collect more than 3,200 tweets. (Twitter does not show you more than 3,200 tweets.)

This plugin collects tweets that are posted since its installation. Tweets that posted before its installation will not be collected.

= Feature =

* __You can search Individually__ : One tweet is one post(custom post type `tweet`). So you can search tweet individually. This feature is provided by tweet search widget.
* __Tweet search widget__ : You can simply provide tweet search by widget.
* __Tweet archive page__ : This plugin provides tweet archive page. This archive page shows only tweets.
* __Tweet RSS__ : Tweet RSS feed provided. This feed can be used for a variety of purposes. I use this feature to send tweets to my facebook page by facebook app RSS Graffiti.

= detail =

Please see the [screenshots](http://wordpress.org/extend/plugins/tweet-collection/screenshots/) to know usage.

This plugin use [php-markdown-1.0.1q](http://michelf.ca/projects/php-markdown/classic/), [twitteroauth](https://github.com/abraham/twitteroauth). 

[Suggest new features and improvements by email.](mailto:mytory@gmail.com)

[Project GitHub](https://github.com/mytory/tweet-collection)

이 플러그인은 특정 트위터 계정에서 트윗을 긁어 모읍니다. 트윗을 모아서 한 포스트로 만드는 게 아니라, 각각의 트윗은 `tweet`이라는 `post_type`이 됩니다. 트윗을 저장할 때, 일반 글과 트윗이 섞이지 않습니다. 이 플러그인의 목적은 내가 쓴 트윗을 검색하고, 3200개 이상의 트윗을 저장하도록 하는 것입니다. (트위터는 3200개 이상의 트윗은 보여 주지 않습니다. 자신이 쓴 거라 해도 말입니다. 순차적으로 백업 서비스가 개방되고 있기는 합니다만.)

이 플러그인은 설치한 직후에 나온 트윗부터 모으기 시작합니다. 과거의 tweet을 모두 가져오는 것은 아닙니다.

= 특징 =

* __트윗 개별 검색 가능__ : 하나의 트윗은 하나의 포스트입니다. (`tweet`이라는 사용자 포스트 타입이 됩니다.) 그래서 트윗을 개별적으로 검색하는 것이 가능해집니다. 트윗 검색 위젯을 활용해야 합니다.
* __트윗 검색 위젯__ : 위젯으로 트윗 검색을 간편하게 제공할 수 있습니다.
* __트윗 아카이브 페이지__ : 이 플러그인은 트윗 아카이브 페이지를 제공합니다. 트윗 아카이브 페이지에는 트윗만 표시됩니다.
* __트윗 RSS__ : 트윗 RSS 피드가 제공됩니다. 이 피드는 다양한 방식으로 활용할 수 있습니다. 저 같은 경우는 페이스북의 RSS Graffiti 앱과 연동해서 페이스북 페이지로 제 트윗을 보내는 데 활용합니다.

= 상세 =

사용법은 [스크린샷](http://wordpress.org/extend/plugins/tweet-collection/screenshots/)을 참고하세요.

이 플러그인은 [php-markdown-1.0.1q](http://michelf.ca/projects/php-markdown/classic/), [twitteroauth](https://github.com/abraham/twitteroauth)를 사용합니다. 

[요청이나 개선사항은 이메일로.](mailto:mytory@gmail.com)

[Project GitHub](https://github.com/mytory/tweet-collection)

== Installation ==

Extract the zip file and just drop the contents in the `wp-content/plugins/` directory of your WordPress installation and then activate the Plugin from Plugins page.

To get tweets, require twitter authentication. Twitter not serve user RSS feed no longer. So you have to take key and secret string for twitter app. That is very easy. Follow below description. Consider installation description in screenshot page.

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

zip 압축을 풀고 내용을 `wp-content/plugins/` 폴더에 넣습니다. 그리고 플러그인을 활성화합니다.

트위터를 긁어 오려면 트위터의 인증이 필요합니다. 더이상 개인 트위터 계정의 RSS 피드를 제공하지 않기 때문입니다. 그래서 트위터에 가서 '앱'용 key를 발급받아야 합니다. 키를 발급받는 것은 아주 쉬우니 겁먹지 않아도 됩니다.

1. 우선 [트위터 앱용 key 신청 페이지](https://dev.twitter.com/apps)로 갑니다. 로그인하라고 하면 자기 트위터의 아이디와 비밀번호를 입력하면 됩니다.
1. __Create a new application__ 버튼을 누릅니다.
1. 위 버튼을 누르면 __Create an application__ 페이지가 나옵니다. __Application Details__의 각 항목에 다음과 같이 입력합니다.
    * Name: 알아서 적당한 이름을 넣으세요.
    * Description: 알아서 적당한 설명을 넣으세요.
    * Website: 자기 블로그 URL을 적습니다. __http://__를 포함해서 적어야 합니다.
    * Callback URL: 비워 놓습니다.
    * Developer Rules of the Road: __Yes, I agree__에 체크합니다.
1. CAPTCHA를 입력하고, __Create your Twitter application__ 버튼을 누릅니다.
1. 자신이 만든 앱 화면으로 들어갔을 것입니다. 만약 다시 목록 화면이 나왔다면 방금 만든 어플리케이션으로 들어갑시다. __Details__ 탭을 봅니다. __Consumer Key__와 __Consumer Secret__이 있는 것을 확인하고 아래로 스크롤합니다.
1. __Details__ 탭의 아래쪽에 보면 __Create my access token__ 버튼이 있습니다. 이걸 누릅니다. 그러면 버튼의 바로 위에 __Access Token__과 __Access Token Secret__이 생긴 것을 알 수 있습니다.
1. 이제 Tweet Collection의 설정 화면으로 갑니다. 워드프레스 관리자 페이지의 __설정 > 트윗 모으기__로 가서, __Consumer key__, __Consumer Secret__, __Access Token__, __Access Token Secret__을 비롯한 설정값을 입력해 줍니다. 
1. 저장을 하면 처음으로 트윗을 긁어오게 됩니다. 이후로는 20분에 한 번씩 트윗을 긁어 옵니다.

== Frequently Asked Questions ==

= When I went to the individual Tweet page, the page can not be found. =

Problems that are caused by Permalink Settings. Please go to Settings > Permalinks, press Save once.

= How to use? =

Please see the [screenshots](http://wordpress.org/extend/plugins/tweet-collection/screenshots/) to know usage.

= tweet 개별 페이지로 가면 페이지를 찾을 수 없다고 합니다. =

고유주소 때문에 발생하는 문제입니다. 설정 > 고유주소로 가서 저장을 한 번 눌러 주세요.

= 사용법은? =

[스크린샷](http://wordpress.org/extend/plugins/tweet-collection/screenshots/)을 봐 주세요.

== Screenshots ==

1. Tweet Collection menu in admin page.
1. Setting page. You can go Tweet archive page on here.
1. Tweet archive page and widgets.
1. widgets Tweet Collection provide.
1. How add Tweet archive page to menu.

= Usage =

[View screenshot.](http://wordpress.org/extend/plugins/tweet-collection/screenshots/)

= Installation =

![1. dev page login](http://dl.dropboxusercontent.com/u/15546257/wordpress-plugin/tweet-collection/01-dev-page-login.png)
![2. create a new application](http://dl.dropboxusercontent.com/u/15546257/wordpress-plugin/tweet-collection/02-create-a-new-application.png)
![3. application detail](http://dl.dropboxusercontent.com/u/15546257/wordpress-plugin/tweet-collection/03-application-detail.png)
![4. create your twitter application](http://dl.dropboxusercontent.com/u/15546257/wordpress-plugin/tweet-collection/04-create-your-twitter-application.png)
![5. oauth setting](http://dl.dropboxusercontent.com/u/15546257/wordpress-plugin/tweet-collection/05-oauth-setting.png)
![6. create my access token](http://dl.dropboxusercontent.com/u/15546257/wordpress-plugin/tweet-collection/06-create-my-access-token.png)
![7. your access token](http://dl.dropboxusercontent.com/u/15546257/wordpress-plugin/tweet-collection/07-your-access-token.png)

== Changelog ==

= 1.1.5 =

* If deactivated collecting tweet schedule, reactivate it.
* When deactivate tweet collection, not delete settings. 
  If you want to delete click 'delete all settings' link in __Setting > Tweet Collection__ page.

= 1.1.4 =

* excluded tweets from default search.

= 1.1.3 =

* changed tweet collection rss feed URL. But old URL remains, too.

= 1.1.2 =

* remove deprecated code.

= 1.1.1 =

* provide tweet rss feed.

= 1.1 =

* update for twitter api v1.1

= 1.0.4 =

* correct html special characters in title. (제목에서 HTML 특수문자 제대로 표시하게 함.)

= 1.0.3 =

* set input value by current search term. (인풋 value에 방금 검색한 검색어 넣어 줌.)
* Add description that print search tweet form on search result page. (검색 결과 페이지에서 트윗 검색 폼 출력하도록 하는 설명 추가.)

= 1.0.2 =

* Add title length option.
* Remove registered Twitter username from title.