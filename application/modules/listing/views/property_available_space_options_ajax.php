<fieldset>
	<label>Now choose a property type</label>
	<select name="property_available_space" id="available_space_select" class="form-control">
		<option value="">Select One</option>
		<?php foreach ($available_options as $option) { ?>
		<option value="<?php echo $option['id']; ?>"> <?php echo $option['name']; ?> </option>
		<?php } ?>
	</select>
</fieldset>


<script type="text/javascript">
	$("#available_space_select").change(function() {
		var a_space_id = $(this).val();
		$.ajax({
			url:'<?php echo base_url(); ?>become_space_provider/get_a_option_description',
			type:'post',
			data:{ a_space_id : a_space_id },
			dataType:'json',
			success:function(status){
				if(status.msg=='success'){
					if(status.response != null) {
						$("#available_description").text(status.response);
					} else {
						$("#available_description").text("");
					}
				}
			}
		});
	});
</script>