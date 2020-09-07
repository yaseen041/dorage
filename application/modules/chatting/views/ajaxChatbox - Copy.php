<?php foreach ($messages as $msg) {
	if (!empty($this->session->userdata('employee'))) {
        $user = $this->session->userdata('employee');
    }else{
        $user = $this->session->userdata('employer');
    }
	if ($msg['chat_from'] == $user['user_id']) { ?>
		<div class="message out no-avatar media">
			<div class="body media-body text-right p-l-50">
				<div class="content msg-reply f-12 bg-primary d-inline-block">
					<?php echo $msg['message']; ?>
				</div>
				<div class="seen">
					<i class="icon-clock f-12 m-r-5 txt-muted d-inline-block"></i>
					<span>
						<p class="d-inline-block"><?php echo date('M d, Y - h:i A', $msg['sent']); ?></p>
					</span>
					<div class="clear"></div> 
				</div>
			</div> 
			<div class="sender media-right friend-box">
				<a href="javascript:void(0);" title="Me">
					<?php if (!empty($msg['chat_from_picture'])) { ?>
						<img class="media-object img-circle m-t-5" src="<?php echo base_url(); ?>uploads/profile_avatar/<?php echo $msg['chat_from_picture']; ?>" alt="User">
					<?php }else{ ?>
						<img class="media-object img-circle m-t-5" src="<?php echo base_url(); ?>assets/images/no-image.png" alt="User">
					<?php } ?>
				</a> 
			</div>
		</div>

	<?php }else{ ?>
		<div class="message in no-avatar media">
			<div class="sender friend-box">
				<a href="javascript:void(0);" title="User">
					<?php if (!empty($msg['chat_from_picture'])) { ?>
						<img class="media-object img-circle m-t-5" src="<?php echo base_url(); ?>uploads/profile_avatar/<?php echo $msg['chat_from_picture']; ?>" alt="User">
					<?php }else{ ?>
						<img class="media-object img-circle m-t-5" src="<?php echo base_url(); ?>assets/images/no-image.png" alt="User">
					<?php } ?>
				</a>
			</div>
			<div class="body media-body text-left p-r-50">
				<div class="content msg-receive f-12 bg-danger d-inline-block">
					<?php echo $msg['message']; ?>
				</div>
				<div class="seen">
					<i class="icon-clock f-12 m-r-5 txt-muted d-inline-block"></i>
					<span>
						<p class="d-inline-block"><?php echo date('M d, Y - h:i A', $msg['sent']); ?></p>
					</span>
					<div class="clear"></div> 
				</div>
			</div> 
		</div>
	<?php }
} ?>