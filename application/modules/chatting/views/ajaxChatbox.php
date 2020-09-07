
<?php foreach ($messages as $recentMsg) { 
	if ($recentMsg['chat_to'] == get_session('user_id')) {
		$user = $recentMsg['username_other'];
	}else{
		$user = $recentMsg['username'];
	}
	if ($recentMsg['chat_from'] == get_session('user_id')) { ?>
		<li class="clearfix">
			<div class="message-data align-right">
				<span class="message-data-time" ><?php echo getMessageDateTime($recentMsg['sent']); ?></span> &nbsp; &nbsp;
				<span class="message-data-name" ><?php echo ucwords($recentMsg['username']); ?></span> 
				<!-- <i class="fa fa-circle me"></i> -->

			</div>
			<div class="message other-message float-right">
				<?php echo nl2br($recentMsg['message']); ?>
				<?php if (!empty($recentMsg['listing_unique_id'])){ ?>
					<span class="pull-right">
						<a class="btn btn-sm btn-danger" href="<?php echo $recentMsg['listing_unique_id']; ?>" target="_blank">View Property</a>
					</span>
				<?php } ?>
			</div>
		</li>
	<?php }else{ ?>
		<li>
			<div class="message-data">
				<span class="message-data-name">
					<!-- <i class="fa fa-circle online"></i>  -->
					<?php echo ucwords($recentMsg['username']); ?></span>
					<span class="message-data-time"><?php echo getMessageDateTime($recentMsg['sent']); ?></span></span>
				</div>
				<div class="message my-message">
					<?php echo nl2br($recentMsg['message']); ?>
					<?php if (!empty($recentMsg['listing_unique_id'])){ ?>
						<br>
						<span>
							<a class="btn btn-sm btn-danger" href="<?php echo $recentMsg['listing_unique_id']; ?>" target="_blank">View Property</a>
						</span>
					<?php } ?>
				</div>
			</li>
		<?php } 
	} ?>