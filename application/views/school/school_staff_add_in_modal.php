
<form id="Form1" method="post" enctype="multipart/form-data" action="<?php echo base_url('school/school_staff_add_process_ajax');?>">
	<input type="hidden" name="school_id" value="<?php echo $school_id; ?>">
<div class="modal-body">
	<div class="alert alert-success" id="msg_one" style="display: none;"></div>
	<div id="validation_one" class="text-center"></div>
	<div class="form-group">
	   <label class="col-sm-6">
	   <input type="text" name="schoolStaffName" required="required" form="Form1" class="form-control" id="schoolStaffName" placeholder="Name">
	   </label>
	   <label class="col-sm-6">
	   <input type="text" class="form-control" name="schoolStaffFatherOrHusband" required="required" form="Form1" id="schoolStaffFatherOrHusband" placeholder="Father/Husband Name">
	   </label>
	</div>
	<div class="form-group">

		<label class="col-sm-6">
		<input type="text" class="form-control" data-inputmask='"mask": "99999-9999999-9"' data-mask name="schoolStaffCnic" required="required" placeholder="CNIC" form="Form1" id="schoolStaffCnic">
		</label>

	  <div class="col-sm-6">
	     <select class="form-control select2" id="schoolStaffGender" form="Form1" required="required" name="schoolStaffGender" style="width: 100%;">
	     	<?php if(!empty($gender)): ?>
	     		<option>Select Staff Gender</option>
	     		<?php foreach($gender as $gen): ?>
	        		<option value="<?php echo $gen->genderId ?>"><?php echo $gen->genderTitle; ?></option>
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
		   	 		<option>Select Staff Type</option>
		   	 		<?php foreach($staff_type as $s_type): ?>
		   	    		<option value="<?php echo $s_type->staffTypeId ?>"><?php echo $s_type->staffTtitle; ?></option>
		   			<?php endforeach;?>
		   		<?php else: ?>
		   		No Staff Type Found.
		   		<?php endif;?>
		   </select>
		</div>

		<label class="col-sm-6">
		<input type="text" class="form-control" name="schoolStaffQaulificationAcademic"  required="required" form="Form1" id="schoolStaffQaulificationAcademic" placeholder="Enter Academic Qualification">
		</label>
	</div>



	<div class="form-group">
	  <label class="col-sm-6">
	  <input type="text" class="form-control" name="schoolStaffQaulificationProfessional" form="Form1" id="schoolStaffQaulificationProfessional" placeholder="Enter Professional Qualification">
	  </label>

	   <label class="col-sm-6">
	      <input type="text" class="form-control" name="TeacherTraining" form="Form1" id="TeacherTraining" placeholder="Relevant Teaching Training In Months">
	   </label>
	</div>

	<div class="form-group">
		<label class="col-sm-6">
		   <input type="text" class="form-control" name="TeacherExperience" form="Form1" id="TeacherExperience" placeholder="Teacher Experience In Months">
		</label>

	  <label class="col-sm-6">
	  <input type="text" class="form-control" name="schoolStaffDesignition" required="required" form="Form1" id="schoolStaffDesignition" placeholder="Enter Designation">
	  </label>
	</div>
	<div class="form-group">
		<label class="col-sm-6">
		<input type="text" onfocus = "(this.type = 'date')" class="form-control" placeholder="Date of Appointment" name="schoolStaffAppointmentDate" required="required" form="Form1" id="schoolStaffAppointmentDate">
		</label>

		<label class="col-sm-6">
		<input type="text" class="form-control" name="schoolStaffNetPay" required="required" id="schoolStaffNetPay" form="Form1" placeholder="Enter Net Pay i-e 10000, 15000, 17000 etc.">
		</label>
	</div>
	


	<div class="form-group">
	   <label class="col-sm-6">
	   <input type="text" class="form-control" name="schoolStaffAnnualIncreament" form="Form1" id="schoolStaffAnnualIncreament" placeholder="Annual Increment">
	   </label>
	</div>
         



</div>
</div>
<div class="modal-footer">
  <div class="form-group">
      <label class="col-sm-offset-3 col-sm-6">
	   <input type="submit" class="form-control btn-sm btn-primary btn-block btn-flat" form="Form1" id="add_staff" value="Add Staff">
	   </label>
  </div>
</div>
</form>



<script type="text/javascript">
	$('form[id="Form1"] input:submit').on('click', function(e) {
	    e.preventDefault();
	    $("#add_staff").prop('disabled', true);
	    $("#add_staff").val("Please Wait...");
	    $('#create_school_user_process_response').html('');
	    $('#create_school_user_process_response_alert').html('');
	    $.ajax({
	         type: 'POST',
	         url: $('#Form1').attr('action'),
	         data: $('#Form1').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
	         success: function(data){
	            obj = $.parseJSON(data);
	            // fails
	            if(obj.status == false){
	                $('#msg_one').html(obj.msg);
	                $("#add_staff").val("Add Staff");
	                $("#add_staff").prop('disabled', false);
	            }
	            // pass
	            if(obj.status == true){
	              $('#myModal').modal('show');
	              // $('#myModal').modal('hide');
	                $('#msg_one').show().html(obj.msg).fadeOut(3000);
	                 // $('#modal_one').modal('hide');
	                 $("#Form1").trigger('reset');
	                 setTimeout(function() {
	                 	var id = obj.id;
	                 	if(id !=""){
	                 		$("#empty_td_staff").remove();
	                 		get_last_inserted_row(id, 'School/get_staff_record_by_id', 'staff_row_', 'staff_tbody');
	                 		// get_last_inserted_row(id, 'School/get_staff_record_by_id', 'staff_row_');
	                 	}
	                    $("#modal_one").modal('hide');
	                 }, 3000);
	                

	            }

	         },
	          error:function (data) {
	            alert("not add staff info :"+data);

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