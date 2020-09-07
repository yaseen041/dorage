
<?php $this->load->view('common/header'); ?>
<!-- Edit Profile -->

<section class="panel-bg">
	<div class="container">
		<div class="row">

			<?php $this->load->view('common/dashboard_sidebar'); ?>

			<div class="col-md-9">
				<div class="single-agent profile-box usr-profile urs-inbox">
					<div class="row">
						<div class="col-md-4 col-sm-4 col-xs-12 no-padd-right">
							<div class="people-list" id="people-list">
								<div class="search">
									<input type="text" placeholder="search" />
									<i class="fa fa-search"></i>
								</div>
								<ul class="list scrollbar" id="style-4">
									<?php if (!empty($messages)) {
										foreach ($messages as $key => $msg) {
											if ($msg['chat_to'] == get_session('user_id')) {
												$user = $msg['username'];
												$profile_dp = $msg['profile_dp'];
												$chatWith = $msg['chat_from'];
											}else{
												$user = $msg['username_other'];
												$profile_dp = $msg['profile_dp_other'];
												$chatWith = $msg['chat_to'];
											} ?>
											<li class="clearfix <?php echo ($key == 0)?"active":""; ?>">
												<a class="chatWithUser" href="javascript:void(0)" data-chatwith="<?php echo $chatWith; ?>">
													<img style="width: 55px" src="<?php echo base_url(); ?>assets/profile_pictures/<?php echo $profile_dp; ?>" alt="avatar" />
													<div class="about">
														<div class="name"><?php echo ucwords($user); ?></div>
														<div class="status">
															<?php if ($msg['chat_read'] == 0 && $msg['chat_to'] == get_session('user_id')) { ?>
															<!-- <i class="fa fa-circle online"></i>  -->New Messages
															<?php } ?>
														</div>
													</div>
												</a>
											</li>
											<?php }
										} ?>
									</ul>
								</div>
							</div>


							<div class="col-md-8 col-sm-8 col-xs-12 no-padd-left">
								<div class="chat" style="width: 100% !important">
									<div>
										<div class="chat-header clearfix">
											<?php $arrFirst = reset($first_messages);
											$chatWith = "";
											$profile_dp = "";
											if (!empty($arrFirst)) {
												if ($arrFirst['chat_to'] == get_session('user_id')) {
													$profile_dp = $arrFirst['profile_dp'];
													$chatWith = $arrFirst['chat_from'];
													$username = $arrFirst['username'];
												}else{
													$profile_dp = $arrFirst['profile_dp_other'];
													$chatWith = $arrFirst['chat_to'];
													$username = $arrFirst['username_other'];
												}
												?>
												<img class="chatUserImg" style="width: 55px;" src="<?php echo base_url(); ?>assets/profile_pictures/<?php echo $profile_dp; ?>" />

												<div class="chat-about">
													<div class="chat-with">Chat with <span class="chatUserName"><?php echo ucwords($username); ?></span></div>
													<div class="chat-num-messages">already <span class="total_msg"><?php echo count($first_messages); ?></span> messages</div>
												</div>
												<!-- <i class="fa fa-star"></i> -->
												<?php } ?>
											</div> <!-- end chat-header -->

											<div class="chat-history">
												<ul class="chatBox">
													<?php foreach ($first_messages as $recentMsg) { 
														if ($recentMsg['chat_to'] == get_session('user_id')) {
															$myName = $recentMsg['username_other'];
														}else{
															$myName = $recentMsg['username'];
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
													</ul>
												</div> 
											</div>
											<!-- end chat-history -->
											<?php if (!empty($messages)) { ?>
											<div class="chat-message clearfix">
												<textarea name="message-to-send" id="message-to-send" placeholder ="Type your message" rows="3"></textarea>
												<button class="sendMessageBtn" data-chatwith="<?php echo $chatWith; ?>" data-username="<?php echo ucwords($myName); ?>">Send</button>
											</div>
											<?php } ?>
										</div>
									</div>
								</div>
								<!-- end chat -->



								<script id="message-template" type="text/x-handlebars-template">
									<li class="clearfix">
										<div class="message-data align-right">
											<span class="message-data-time" >{{time}}, Today</span> &nbsp; &nbsp;
											<span class="message-data-name" >Olia</span> <i class="fa fa-circle me"></i>
										</div>
										<div class="message other-message float-right">
											{{messageOutput}}
										</div>
									</li>
								</script>

								<script id="message-response-template" type="text/x-handlebars-template">
									<li>
										<div class="message-data">
											<span class="message-data-name"><i class="fa fa-circle online"></i> Vincent</span>
											<span class="message-data-time">{{time}}, Today</span>
										</div>
										<div class="message my-message">
											{{response}}
										</div>
									</li>
								</script>

							</div>
						</div>	


					</div>
				</div>		
			</section>

			<?php $this->load->view('common/footer'); ?>
			<script type="text/javascript">
				$(document).ready(function(){
					setTimeout(function () {
						$(".chat-history").stop().animate({ scrollTop: $(".chat-history ul")[0].scrollHeight}, 500);
					}, 100);
				});
				$(document).on('click', '.sendMessageBtn', function(){
					var message = $('#message-to-send').val();
					if (message.trim() == "") {
						$.gritter.add({
							title: 'Error!',
							sticky: false,
							time: '5000',
							before_open: function(){
								if($('.gritter-item-wrapper').length >= 3)
								{
									return false;
								}
							},
							text: "Please fill the message field",
							class_name: 'gritter-error'
						});
						return false;
					}
					var chatwith = $(this).attr('data-chatwith');
					var username = "<?php echo $user_detail['first_name']. ' '.$user_detail['last_name']; ?>";
					var timeStamp = Math.round((new Date()).getTime() / 1000);
					var time = "<?php echo date('h:i A'); ?>";
					$('#message-to-send').val('');
					var str = '<li class="clearfix"><div class="message-data align-right"> <span class="message-data-time" >'+time+', Today</span> &nbsp; &nbsp; <span class="message-data-name" >'+username+'</span> </div> <div class="message other-message float-right">'+message+'</div></li>';
					$.ajax({
						url:"<?php echo base_url(); ?>chatting/sendMessage",
						data:"message="+message+"&chatwith="+chatwith,
						type:"post",
						success:function(output){
							$('.chat-history ul').append(str);
							var total_msg = $('.total_msg').text()
							$('.total_msg').text(parseInt(total_msg)+1);
							$(".chat-history").stop().animate({ scrollTop: $(".chat-history ul")[0].scrollHeight}, 500);
						}
					});
				});

				$(document).on('click', '.chatWithUser', function(){
					$('.scrollbar li').removeClass('active');
					$(this).parent().addClass('active');
					$('.status').text('');
					var chatWith = $(this).attr('data-chatwith');
					var username = "<?php echo $user_detail['first_name']. ' '.$user_detail['last_name']; ?>";
					$('.sendMessageBtn').attr('data-chatwith', chatWith);
					$('.sendMessageBtn').attr('data-username', username);
					getMessages(chatWith);
				});

				function getMessages(user_id){
					$.ajax({
						url:"<?php echo base_url(); ?>chatting/getMessage",
						data:"user="+user_id,
						type:"post",
						dataType:"json",
						success:function(output){
							$('.chatBox').html(output.html);
							$('.chatUserImg').attr('src','<?php echo base_url(); ?>assets/profile_pictures/'+output.user.profile_dp);
							$('.chatUserName').text(output.user.first_name +" "+output.user.last_name);
							$('.total_msg').text(output.total_msg);
							$(".chat-history").stop().animate({ scrollTop: $(".chat-history ul")[0].scrollHeight}, 500);
						}
					});
				}

				setInterval(function(){
					getMessagesAjax();
				},5000);

				function getMessagesAjax(){
					var chatWith = $('.scrollbar li.active').find('a').attr('data-chatwith');
					console.log(chatWith);
					$.ajax({
						url:"<?php echo base_url(); ?>chatting/getMessage",
						data:"user="+chatWith,
						type:"post",
						dataType:"json",
						success:function(output){
							$('.chatBox').html(output.html);
							$('.chatUserName').text(output.user.first_name +" "+output.user.last_name);
						}
					});
				}
				setInterval(function(){
					$.ajax({
						url:"<?php echo base_url(); ?>chatting/notifications",
						type:"post",
						success: function(output){
							$('.notificationCount').text(output);
						}
					});
				}, 5000); 
			</script>