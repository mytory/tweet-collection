=== Tweet Collection ===
Contributors: mytory
Tags: twitter
Requires at least: 3.0
Tested up to: 3.5
Stable tag: 1.1
License: GPLv2 or later
Donate link:http://mytory.net/paypal-donation

This plugin collect tweets from specified Twitter account. Post_type of collected tweets will be ‘tweet’ so that normal posts and tweets will not be mixed.


== Description ==

This plugin collect tweets from specified Twitter account. Post_type of collected tweets will be ‘tweet’ so that normal posts and tweets will not be mixed. The purpose of this plugin is to search for your tweets on your blog and to collect more than 3,200 tweets. (Twitter does not show you more than 3,200 tweets.)

This plugin collects tweets that are posted since its installation. Tweets that posted before its installation will not be collected.

I will develope the plugin for all the tweets as soon as possible.

Please see the [screenshots](http://wordpress.org/extend/plugins/tweet-collection/screenshots/) to know usage.

이 플러그인은 특정 트위터 계정에서 트윗을 긁어 모읍니다. 트윗을 모아서 한 포스트로 만드는 게 아니라, 각각의 트윗은 `tweet`이라는 `post_type`이 됩니다. 트윗을 저장할 때, 일반 글과 트윗이 섞이지 않습니다. 이 플러그인의 목적은 내가 쓴 트윗을 검색하고, 3200개 이상의 트윗을 저장하도록 하는 것입니다. (트위터는 3200개 이상의 트윗은 보여 주지 않습니다. 자신이 쓴 거라 해도 말입니다. 순차적으로 백업 서비스가 개방되고 있기는 합니다만.)

이 플러그인은 설치한 직후에 나온 트윗부터 모으기 시작합니다. 과거의 tweet을 모두 가져오는 것은 아닙니다.

과거의 tweet을 import하는 플러그인은 시간이 나는대로 개발해서 내놓겠습니다.

사용법은 [스크린샷](http://wordpress.org/extend/plugins/tweet-collection/screenshots/)을 참고하세요.

== Installation ==

Extract the zip file and just drop the contents in the `wp-content/plugins/` directory of your WordPress installation and then activate the Plugin from Plugins page.

zip 압축을 풀고 내용을 `wp-content/plugins/` 폴더에 넣습니다. 그리고 플러그인을 활성화합니다.

트위터를 긁어 오려면 트위터의 인증이 필요합니다. 더이상 개인 트위터 계정의 RSS 피드를 제공하지 않기 때문입니다. 그래서 트위터에 가서 '앱'용 key를 발급받아야 합니다. 키를 발급받는 것은 아주 쉬우니 겁먹지 않아도 됩니다.

1. 우선 [트위터 앱용 key 신청 페이지](https://dev.twitter.com/apps)로 갑니다. 로그인하라고 하면 자기 트위터의 아이디와 비밀번호를 입력하면 됩니다.
2. __Create a new application__ 버튼을 누릅니다.
3. 위 버튼을 누르면 __Create an application__ 페이지가 나옵니다. __Application Details__의 각 항목에 다음과 같이 입력합니다.
    * Name: 알아서 적당한 이름을 넣으세요.
    * Description: 알아서 적당한 설명을 넣으세요.
    * Website: 자기 블로그 URL을 적습니다. __http://__를 포함해서 적어야 합니다.
    * Callback URL: 비워 놓습니다.
    * Developer Rules of the Road: __Yes, I agree__에 체크합니다.
4. CAPTCHA를 입력하고, __Create your Twitter application__ 버튼을 누릅니다.
5. 자신이 만든 앱 화면으로 들어갔을 것입니다. 만약 다시 목록 화면이 나왔다면 방금 만든 어플리케이션으로 들어갑시다. __Details__ 탭을 봅니다. __Consumer Key__와 __Consumer Secret__이 있는 것을 확인하고 아래로 스크롤합니다.
6. __Details__ 탭의 아래쪽에 보면 __Create my access token__ 버튼이 있습니다. 이걸 누릅니다. 그러면 버튼의 바로 위에 __Access Token__과 __Access Token Secret__이 생긴 것을 알 수 있습니다.
7. 이제 Tweet Collection의 설정 화면으로 갑니다. 워드프레스 관리자 페이지의 __설정 > 트윗 모으기__로 가서, __Consumer key__, __Consumer Secret__, __Access Token__, __Access Token Secret__을 비롯한 설정값을 입력해 줍니다. 
8. 저장을 하면 처음으로 트윗을 긁어오게 됩니다. 이후로는 20분에 한 번씩 트윗을 긁어 옵니다.

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

1. [Tweet Collection menu in admin page.](http://s-plugins.wordpress.org/tweet-collection/assets/screenshot-1.png)
1. [Setting page. You can go Tweet archive page on here.](http://s-plugins.wordpress.org/tweet-collection/assets/screenshot-2.png)
1. [Tweet archive page and widgets.](http://s-plugins.wordpress.org/tweet-collection/assets/screenshot-3.png)
1. [widgets Tweet Collection provide.](http://s-plugins.wordpress.org/tweet-collection/assets/screenshot-4.png)
1. [How add Tweet archive page to menu.](http://s-plugins.wordpress.org/tweet-collection/assets/screenshot-5.png)

== Changelog ==

= 1.1 =

* update to twitter api v1.1

= 1.0.4 =

* correct html special characters in title. (제목에서 HTML 특수문자 제대로 표시하게 함.)

= 1.0.3 =

* set input value by current search term. (인풋 value에 방금 검색한 검색어 넣어 줌.)
* Add description that print search tweet form on search result page. (검색 결과 페이지에서 트윗 검색 폼 출력하도록 하는 설명 추가.)

= 1.0.2 =

* Add title length option.
* Remove registered Twitter username from title.