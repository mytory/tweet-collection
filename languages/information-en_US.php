<h2>Code Usage Info</h2>
<p>If you want to show searching tweets form to customer, write this code to location you want.</p>
<pre>tc_print_searchform();</pre>
<p>If do not work, use below.</p>
<pre>&lt;?php tc_print_searchform();?&gt;</pre>
<p>Insert below code to archive.php file. So, You can show search tweets form to customers only on tweet archive.</p>
<pre>if(get_post_type() == 'tweet'){ 
	tc_print_searchform();	
}</pre>
<p>If do not work, use below.</p>
<pre>&lt;?php if(get_post_type() == 'tweet'){ 
	tc_print_searchform();	
} ?&gt;</pre>
<p>Location I recommend is right above of <code>&lt;?php while ( have_posts() ) : the_post(); ?&gt;</code> line in archive.php on theme folder</p>
<h2>Showing 'search tweet' form on search result page.</h2>
<p>Search result file is mostly search.php file. Of course, vary depending on the theme.
Find below code.</p>
<pre>&lt;div id="content" role="main"&gt;</pre>
<p>And put code below directly below of the code mentioned above.</p>
<pre>&lt;? if( $_GET['post_type'] == 'tweet' AND function_exists('tc_print_searchform') ){
	?&gt;&lt;div style="margin-bottom: 1em;"&gt;&lt;? 
	tc_print_searchform();
	?&gt;&lt;/div&gt;&lt;?	
}?&gt;</pre>
<p>You also put code to 'Nothing Found' page. Depending on the theme, there are big differences. So I can not explain simply. But, use the code below.</p>
<pre>&lt;? if( $_GET['post_type'] == 'tweet' AND function_exists('tc_print_searchform') ){
	tc_print_searchform();
}else{
	get_search_form();
}?&gt;</pre>