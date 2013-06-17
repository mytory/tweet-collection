<?php
//search widget
class search_tweets_widget extends WP_Widget {
	function search_tweets_widget() {
		// Instantiate the parent object
		parent::__construct( false, __('Search Tweets Form','tweet-collection') );
	}

	function widget( $args, $instance ) {
		echo $args['before_widget'];
		echo $args['before_title'] . __('Search Tweets','tweet-collection') . $args['after_title'];
		tc_print_searchform();
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
	}

	function form( $instance ) {}
}

//tweet archive link widget
class tweet_archive_link_widget extends WP_Widget {
	function tweet_archive_link_widget() {
		// Instantiate the parent object
		parent::__construct( false, __('Tweet Archive Link', 'tweet-collection') );
	}

	function widget( $args, $instance ) {
		
		if( $instance['tc_link_text'] ){
			$link_text = $instance['tc_link_text'];
		}else{
			$link_text = __('My Tweet Archive', 'tweet-collection');
		}
		
		echo $args['before_widget'];
		echo $args['before_title'] . $link_text . $args['after_title'];
		?>
		<span class="tweet-archive-link">
			<a href="<?php bloginfo('url')?>/?post_type=tweet"><?php echo $link_text?></a>
		</span>
		<?php 
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance['tc_link_text'] = strip_tags( $new_instance['tc_link_text'] );
		return $instance;
	}

	function form( $instance ) {
		if ( $instance ) {
			$link_text = esc_attr( $instance['tc_link_text'] );
		}
		else {
			$link_text = __( 'My Tweet Archive', 'tweet-collection' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'tc_link_text' ); ?>">
				<?php _e('Tweet Archive Link Text:', 'tweet-collection'); ?>
			</label> 
			<input 
				class="widefat" 
				id="<?php echo $this->get_field_id( 'tc_link_text' ); ?>" 
				name="<?php echo $this->get_field_name( 'tc_link_text' ); ?>" 
				type="text" 
				value="<?php echo $link_text; ?>" />
		</p>
	
	<?php 
	}
}

function tc_register_widgets() {
	register_widget( 'search_tweets_widget' );
	register_widget( 'tweet_archive_link_widget' );
}
add_action( 'widgets_init', 'tc_register_widgets' );