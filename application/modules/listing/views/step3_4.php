<?php $this->load->view('common/header'); ?>	

<!-- Become Space Provider -->
<div id="ajax_wrapper" style="margin-top: 97px;">
	<section class="show-space section-bg">
		<div class="container">
			<div class="row">

				<div class="col-md-12 col-sm-12 col-xs-12">
					<h2>Set your calendar</h2>
					<div class="col-md-12 no-padding">	
						<p class="padd-top"><span class="dark-sky"><b>Tip:</b></span> Please drag your mouse to block unavailable dates each month.</p>
						
					</div>


					<div class="col-md-12 no-padding">
						<div id="calendar"></div> <br><br>
					</div>

					<form id="list_details" action="" method="">

						<input type="hidden" name="form_id" value="step3_4">
						<input type="hidden" name="unique_id" value="<?php echo @$unique_id; ?>">
					</form>

					<div class="col-md-12">
						<hr>
						<div class="form-group pull-left">
							<button id="back_to_step3_3" type="button" class="btn back-btn">Go Back</button>
						</div>
						<div class="form-group pull-right">
							<a href="javascript:void(0)" id="submit_list_details" class="btn next-btn">Next Step</a>
						</div>
					</div>
					
				</div>
			</div>
		</div>		
	</section>
</div>
<input id="startDate" name="event-start-date" class="form-control" type="hidden">

<input id="endDate" name="event-end-date" class="form-control" type="hidden">
<!-- Become Space Provider End-->
<?php $this->load->view('common/footer'); ?>


<script type="text/javascript">
	$("#back_to_step3_3").click(function() {
		$.ajax({
			url:'<?php echo base_url(); ?>listing/storage/back_to_step3_3',
			type:'post',
			data:{ unique_id : '<?php echo @$unique_id; ?>' },
			dataType:'json',
			success:function(status){
				if(status.msg=='success'){

					$("#ajax_wrapper").fadeOut(function(){$("#ajax_wrapper").html(status.response).fadeIn();}); 

					var stateObj = {};
					history.pushState(stateObj, "page 2", status.new_url);
				}
			}
		});
	});
</script>


<script type="text/javascript">
	function editEvent(event) {

		if(event.block == 0){
			$('input[name="event-start-date"]').datepicker('update', event.startDate );
			$('input[name="event-end-date"]').datepicker('update', event.endDate );
			saveEvent(event);
		} else {
			deleteEvent(event)
		}

		// $('#event-modal input[name="event-index"]').val(event ? event.id : '');
		// $('#event-modal input[name="event-name"]').val(event ? event.name : '');
		// $('#event-modal input[name="event-location"]').val(event ? event.location : '');
		// $('#event-modal input[name="event-start-date"]').datepicker('update', event ? event.startDate : '');
		// $('#event-modal input[name="event-end-date"]').datepicker('update', event ? event.endDate : '');
		// $('#event-modal').modal();
	}

	function deleteEvent(event) {

		$.ajax({
			url:'<?php echo base_url(); ?>listing/storage/unblock_booking_dates',
			type:'post',
			data:{ b_dates_id : event.id },
			dataType:'json',
			success:function(status){
				if(status.msg=='success'){

					var dataSource = $('#calendar').data('calendar').getDataSource();

					for(var i in dataSource) {
						if(dataSource[i].id == event.id) {
							dataSource.splice(i, 1);
							break;
						}
					}

					$('#calendar').data('calendar').setDataSource(dataSource);

					$.gritter.add({
						title: 'Success!',
						sticky: false,
						time: '3000',
						before_open: function(){
							if($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: status.response,
						class_name: 'gritter-success'
					});

				} else {
					$.gritter.add({
						title: 'Error!',
						sticky: false,
						time: '3000',
						before_open: function(){
							if($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: status.response,
						class_name: 'gritter-error'
					});
				}
			}
		});


		
	}

	function saveEvent(e) {
		// var event = {
			// id: $('#event-modal input[name="event-index"]').val(),
			// name: $('#event-modal input[name="event-name"]').val(),
			// location: $('#event-modal input[name="event-location"]').val(),
			startDate = $('input[name="event-start-date"]').val();
			endDate = $('input[name="event-end-date"]').val();
		// }


		$.ajax({
			url:'<?php echo base_url(); ?>listing/storage/block_booking_dates',
			type:'post',
			data:{ listings_id : '<?php echo @$stp_detail['id']; ?>' , startDate : startDate , endDate : endDate },
			dataType:'json',
			success:function(status){
				if(status.msg=='success'){

					var dataSource = $('#calendar').data('calendar').getDataSource();

					e.id = status.response;
					dataSource.push(e);

					$('#calendar').data('calendar').setDataSource(dataSource);

					$.gritter.add({
						title: 'Success!',
						sticky: false,
						time: '3000',
						before_open: function(){
							if($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: "Successfully Blocked.",
						class_name: 'gritter-success'
					});
				} else {

					$.gritter.add({
						title: 'Error!',
						sticky: false,
						time: '3000',
						before_open: function(){
							if($('.gritter-item-wrapper').length >= 3)
							{
								return false;
							}
						},
						text: status.response,
						class_name: 'gritter-error'
					});


				}
			}
		});



		// var dataSource = $('#calendar').data('calendar').getDataSource();

		// if(event.id) {
		// 	for(var i in dataSource) {
		// 		if(dataSource[i].id == event.id) {
		// 			dataSource[i].name = event.name;
		// 			dataSource[i].location = event.location;
		// 			dataSource[i].startDate = event.startDate;
		// 			dataSource[i].endDate = event.endDate;
		// 		}
		// 	}
		// }
		// else
		// {
			// var newId = 0;
			// for(var i in dataSource) {
			// 	if(dataSource[i].id > newId) {
			// 		newId = dataSource[i].id;
			// 	}
			// }

			// newId++;
			// event.id = newId;
			// dataSource.push(event);
		// }

		// $('#calendar').data('calendar').setDataSource(dataSource);
		// $('#event-modal').modal('hide');
	}

	$(function() {
		var currentYear = new Date().getFullYear();

		$('#calendar').calendar({

			enableContextMenu: true,
			enableRangeSelection: true,
			minDate: new Date(),
			style:'background',
			contextMenuItems:[
			// {
			// 	text: 'Update',
			// 	click: editEvent
			// },
			{
				text: 'Unblock Range',
				click: deleteEvent
			}
			],
			selectRange: function(e) {
				editEvent({ startDate: e.startDate, endDate: e.endDate , block: e.events.length });
			},
			mouseOnDay: function(e) {
				if(e.events.length > 0) {
					var content = '';

					for(var i in e.events) {
						content += '<div class="event-tooltip-content">'
						+ '<div class="event-name" style="color:red">' + e.events[i].name + '</div>'
						+ '<div class="event-location">' + e.events[i].location + '</div>'
						+ '</div>';
					}

					$(e.element).popover({
						trigger: 'manual',
						container: 'body',
						html:true,
						content: content
					});

					//$(e.element).popover('show');
				}
			},
			mouseOutDay: function(e) {
				if(e.events.length > 0) {
					$(e.element).popover('hide');
				}
			},
			clickDay: function(e){
				editEvent({ startDate: e.date, endDate: e.date , block: e.events.length });
			},
			dayContextMenu: function(e) {
				$(e.element).popover('hide');
			},
			dataSource: [
			<?php echo $dates; ?>
			]
		});
		$('#calendar').data('calendar').setAllowOverlap(false);
		$('#calendar').data('calendar').setRoundRangeLimits(true);
		//$('#calendar').data('calendar').setStyle('background');

		// $('#save-event').click(function() {
		// 	saveEvent();
		// });
	});
</script>