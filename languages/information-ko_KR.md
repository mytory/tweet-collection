### 트윗 가져오기를 작동하게 하려면... ###

트위터를 긁어 오려면 트위터의 인증이 필요합니다. 더이상 개인 트위터 계정의 RSS 피드를 제공하지 않기 때문입니다. 그래서 트위터에 가서 '앱'용 key를 발급받아야 합니다. 키를 발급받는 것은 아주 쉬우니 겁먹지 않아도 됩니다. 설명 아래쪽에 있는 이미지도 참고하세요.

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

아래는 이미지 설명들입니다. 크게 보려면 클릭하세요.

![1. dev page login]({{slides}}/01-dev-page-login.png)
![2. create a new application]({{slides}}/02-create-a-new-application.png)
![3. application detail]({{slides}}/03-application-detail.png)
![4. create your twitter application]({{slides}}/04-create-your-twitter-application.png)
![5. oauth setting]({{slides}}/05-oauth-setting.png)
![6. create my access token]({{slides}}/06-create-my-access-token.png)
![7. your access token]({{slides}}/07-your-access-token.png)

### 코드 활용 정보 ###

특정 위치에 트위터 검색을 달고 싶다면, 달고 싶은 위치에 아래와 같이 넣어 주세요.

    tc_print_searchform();

위와 같이 했을 때 아무런 반응이 없다면 아래와 같이 넣어 보세요.

    <?php tc_print_searchform();?>

아래와 같이 넣으면 플러그인이 설치돼 있고, 트위터 목록을 보는 경우에만 트위터 검색창이 나옵니다.

    if(get_post_type() == 'tweet' AND function_exists('tc_print_searchform') ){ 
    	tc_print_searchform();	
    }

역시 아무런 반응이 없다면 아래와 같이 넣어 보세요.

    <?php if(get_post_type() == 'tweet' AND function_exists('tc_print_searchform') ){ 
    	tc_print_searchform();	
    } ?>

추천하는 위치는 테마 폴더의 `archive.php` 파일에 있는 `<?php while ( have_posts() ) : the_post(); ?>` 바로 윗줄입니다.

### 검색 결과에 트윗 검색 달기 ###

검색결과 파일은 테마에 따라 약간씩 다를 수 있지만, 대체로는 search.php 파일입니다. 이 파일에서 아래 줄을 찾아 바로 밑에 코드를 넣습니다.

    <div id="content" role="main">

이 위치 바로 아래에 아래 코드를 넣습니다.

    <? if( $_GET['post_type'] == 'tweet' AND function_exists('tc_print_searchform') ){
    	?><div style="margin-bottom: 1em;"><? 
    	tc_print_searchform();
    	?></div><?	
    }?>

한 군데 더 넣어야 하는 곳이 있습니다. '검색 결과가 없습니다' 페이지입니다. 이건 테마별로 차이가 있어서 간단히 설명할 수 없습니다. 다만, 검색 폼을 뿌려 주는 코드는 아래 코드를 사용하시길 바랍니다.

    <? if( $_GET['post_type'] == 'tweet' AND function_exists('tc_print_searchform') ){
    	tc_print_searchform();
    }else{
    	get_search_form();
    }?>
