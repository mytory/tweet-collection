<div class='wrap'>
	<div class="icon32" id="icon-options-general"><br></div>
	<h2><?php _e( 'Import Tweets from Backup', 'tweet-collection' ); ?></h2>
	<?php if ( isset( $message ) ) { ?>
		<div class="updated">
			<p><?php echo $message; ?></p>
		</div>
	<?php } ?>
	<form method="post" class="tc" enctype="multipart/form-data">
		<?php wp_nonce_field( 'import_tweets_from_backup' ); ?>
		<table class="form-table">
			<tr>
				<th scope="row">
					<label for="backup_file"><?php _e( 'Backup File', 'tweet-collection' ); ?></label>
				</th>
				<td>
					<input type="file" name="backup_file" id="backup_file" required>
				</td>
			</tr>
		</table>
		<p class="submit">
			<input type="submit" value="Import" class="button-primary">
		</p>
	</form>
</div>
