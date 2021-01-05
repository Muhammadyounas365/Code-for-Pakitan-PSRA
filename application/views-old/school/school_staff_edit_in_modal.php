<form id="Form1" method="post" enctype="multipart/form-data" action="<?php echo base_url('school/update_staff_info');?>">
<div class="modal-body">
	<div class="alert alert-success" id="msg_one" style="display: none;"></div>
	<div id="validation_one" class="text-center"></div>
	<div class="form-group">
	   <label class="col-sm-6">
	   <input type="text" name="schoolStaffName" value="<?php echo $staff_info->schoolStaffName; ?>" required="required" form="Form1" class="form-control" id="schoolStaffName" placeholder="Name">
	   </label>
	   <label class="col-sm-6">
	   <input type="text" class="form-control" name="schoolStaffFatherOrHusband" value="<?php echo $staff_info->schoolStaffFatherOrHusband; ?>" required="required" form="Form1" id="schoolStaffFatherOrHusband" placeholder="Father/Husband Name">
	   </label>
	</div>

	<div class="form-group">

		<label class="col-sm-6">
		<input type="text" class="form-control" data-inputmask='"mask": "99999-9999999-9"' data-mask name="schoolStaffCnic" required="required" value="<?php echo $staff_info->schoolStaffCnic; ?>" form="Form1" id="schoolStaffCnic">
		</label>

	  <div class="col-sm-6">
	     <select class="form-control select2" id="schoolStaffGender" form="Form1" name="schoolStaffGender" style="width: 100%;">
	     	<?php if(!empty($gender)): ?>
	     		<?php foreach($gender as $gen): ?>
	     			<?php if($gen->genderId == $staff_info->schoolStaffGender): ?>
	        			<option value="<?php echo $gen->genderId ?>" selected><?php echo $gen->genderTitle; ?></option>
	        		<?php else: ?>
	        			<option value="<?php echo $gen->genderId ?>"><?php echo $gen->genderTitle; ?></option>
	        		<?php endif;?>
	    		<?php endforeach;?>
	    	<?php else: ?>
	    	No gender found.
	    	<?php endif;?>
	     </select>
	  </div>
	</div>
	<div class="clearfix"></div>
	<div class="form-group">
		<div class="col-sm-6">
		   <select class="form-control select2" form="Form1" id="schoolStaffType" name="schoolStaffType" style="width: 100%;">
		   	 	<?php if(!empty($staff_type)): ?>
		   	 		<?php foreach($staff_type as $s_type): ?>
		   	 			<?php if($s_type->staffTypeId == $staff_info->schoolStaffType): ?>
		   	    			<option value="<?php echo $s_type->staffTypeId ?>" selected><?php echo $s_type->staffTtitle; ?></option>
		   	    		<?php else: ?>
		   	    			<option value="<?php echo $s_type->staffTypeId ?>"><?php echo $s_type->staffTtitle; ?></option>
		   	    		<?php endif;?>
		   			<?php endforeach;?>
		   		<?php else: ?>
		   		No Staff Type Found.
		   		<?php endif;?>
		   </select>
		</div>

		<label class="col-sm-6">
		<input type="text" class="form-control" name="schoolStaffQaulificationAcademic"  required="required" form="Form1" id="schoolStaffQaulificationAcademic" value="<?php echo $staff_info->schoolStaffQaulificationAcademic; ?>" placeholder="Enter Academic Qualification">
		</label>
	</div>



	<div class="form-group">
	  <label class="col-sm-6">
	  <input type="text" class="form-control" name="schoolStaffQaulificationProfessional" form="Form1" id="schoolStaffQaulificationProfessional" placeholder="Enter Professional Qualification" value="<?php echo $staff_info->schoolStaffQaulificationProfessional; ?>">
	  </label>

	   <label class="col-sm-6">
	      <input type="text" class="form-control" name="TeacherTraining" value="<?php echo $staff_info->TeacherTraining; ?>" form="Form1" id="TeacherTraining" placeholder="Relevant Teaching Training In Months">
	   </label>
	</div>

	<div class="form-group">
		<label class="col-sm-6">
		   <input type="text" class="form-control" name="TeacherExperience" form="Form1" id="TeacherExperience" placeholder="Teacher Experience In Months" value="<?php echo $staff_info->TeacherExperience; ?>">
		</label>

	  <label class="col-sm-6">
	  <input type="text" class="form-control" name="schoolStaffDesignition" required="required" form="Form1" id="schoolStaffDesignition" placeholder="Enter Designation" value="<?php echo $staff_info->schoolStaffDesignition; ?>">
	  </label>
	</div>
	<div class="form-group">
		<label class="col-sm-6">
		<input type="text" onfocus = "(this.type = 'date')" class="form-control" placeholder="Date of Appointment" name="schoolStaffAppointmentDate" required="required" form="Form1" id="schoolStaffAppointmentDate" value="<?php echo $staff_info->schoolStaffAppointmentDate; ?>">
		</label>

		<label class="col-sm-6">
		<input type="text" class="form-control" name="schoolStaffNetPay" required="required" id="schoolStaffNetPay" form="Form1" placeholder="Enter Net Pay i-e 10000, 15000, 17000 etc." value="<?php echo @$staff_info->schoolStaffNetPay; ?>">
		</label>
	</div>
	


	<div class="form-group">
	   <label class="col-sm-6">
	   <input type="text" class="form-control" name="schoolStaffAnnualIncreament" form="Form1" id="schoolStaffAnnualIncreament" placeholder="Annual Increment" value="<?php echo @$staff_info->schoolStaffAnnualIncreament; ?>">
	   </label>
	</div>
         



</div>
</div>
<div class="modal-footer">
  <div class="form-group">
      <label class="col-sm-offset-3 col-sm-6">
	   <input type="submit" class="form-control btn-sm btn-primary btn-block btn-flat" form="Form1" id="update" value="Update">
	   </label>
  </div>
</div>
</form>



<script type="text/javascript">
	$('form[id="Form1"] input:submit').on('click', function(e) {
	    e.preventDefault();
	    $("#update").prop('disabled', true);
	    $("#update").val("Please Wait...");
	    // $('#create_school_user_process_response').html('');
	    // $('#create_school_user_process_response_alert').html('');
	    $.ajax({
	         type: 'POST',
	         url: $('#Form1').attr('action')+"/"+<?php echo $staff_info->schoolStaffId; ?>,
	         data: $('#Form1').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
	         success: function(data){
	            obj = $.parseJSON(data);
	            // console.log(data);
	            // fails
	            if(obj.status == false){
	                $('#msg_one').html(obj.msg);
	                $("#update").val("update");
	                $("#update").prop('disabled', false);
	            }
	            // pass
	            if(obj.status == true){
	              $('#myModal').modal('show');
	              // $('#myModal').modal('hide');
	                $('#msg_one').show().html(obj.msg).fadeOut(3000);
	                 // $('#modal_one').modal('hide');
	                 setTimeout(function() {
	                     $("#modal_one").modal('hide');
	                 }, 3000);
	                $("#Form1").trigger('reset');
	            }

	         },
	          error:function (data) {
	            alert("not update staff info :"+data);

	          }
	    });


	    // return false;
	});
</script>

<script type="text/javascript">
    $(document).ready(function(){

         $('[data-mask]').inputmask();
    });  
</script>