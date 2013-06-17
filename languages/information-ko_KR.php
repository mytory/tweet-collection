<h2>코드 활용 정보</h2>
<p>특정 위치에 트위터 검색을 달고 싶다면, 달고 싶은 위치에 아래와 같이 넣어 주세요.</p>
<pre>tc_print_searchform();</pre>
<p>위와 같이 했을 때 아무런 반응이 없다면 아래와 같이 넣어 보세요.</p>
<pre>&lt;?php tc_print_searchform();?&gt;</pre>
<p>아래와 같이 넣으면 플러그인이 설치돼 있고, 트위터 목록을 보는 경우에만 트위터 검색창이 나옵니다.</p>
<pre>if(get_post_type() == 'tweet' AND function_exists('tc_print_searchform') ){ 
	tc_print_searchform();	
}</pre>
<p>역시 아무런 반응이 없다면 아래와 같이 넣어 보세요.</p>
<pre>&lt;?php if(get_post_type() == 'tweet' AND function_exists('tc_print_searchform') ){ 
	tc_print_searchform();	
} ?&gt;</pre>
<p>추천하는 위치는 테마 폴더의 <code>archive.php</code> 파일에 있는 <code>&lt;?php while ( have_posts() ) : the_post(); ?&gt;</code> 바로 윗줄입니다.</p>
<h2>검색 결과에 트윗 검색 달기</h2>
<p>검색결과 파일은 테마에 따라 약간씩 다를 수 있지만, 대체로는 search.php 파일입니다. 이 파일에서 아래 줄을 찾아 바로 밑에 코드를 넣습니다.</p>
<pre>&lt;div id="content" role="main"&gt;</pre>
<p>이 위치 바로 아래에 아래 코드를 넣습니다.</p>
<pre>&lt;? if( $_GET['post_type'] == 'tweet' AND function_exists('tc_print_searchform') ){
	?&gt;&lt;div style="margin-bottom: 1em;"&gt;&lt;? 
	tc_print_searchform();
	?&gt;&lt;/div&gt;&lt;?	
}?&gt;</pre>
<p>한 군데 더 넣어야 하는 곳이 있습니다. '검색 결과가 없습니다' 페이지입니다. 이건 테마별로 차이가 있어서 간단히 설명할 수 없습니다. 다만, 검색 폼을 뿌려 주는 코드는 아래 코드를 사용하시길 바랍니다.</p>
<pre>&lt;? if( $_GET['post_type'] == 'tweet' AND function_exists('tc_print_searchform') ){
	tc_print_searchform();
}else{
	get_search_form();
}?&gt;</pre>