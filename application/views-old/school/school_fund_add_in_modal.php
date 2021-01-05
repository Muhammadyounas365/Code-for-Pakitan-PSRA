
<form id="Form1" method="post" enctype="multipart/form-data" action="<?php echo base_url('school/school_fund_add_process_ajax');?>">
	<input type="hidden" name="school_id" value="<?php echo $school_id; ?>">
<div class="modal-body">
	<div class="alert alert-success" id="msg_one" style="display: none;"></div>
	<div id="validation_one" class="text-center"></div>

	<h2 class="text-center">Student Dues/Funds Details</h2><br />

	<div class="form-group" style="padding-top:8px;">
	   <label class="col-sm-2 col-md-2 control-label"><span class="text-danger">*</span>Class</label>
	   <div class="col-sm-10 col-md-10">
	     <?php if(!empty($class_list)): ?>
	   <select class="form-control select2" name="class_id" form="Form1" style="width: 100%;">
	       <option>Select Class</option>
	       <?php foreach ($class_list as $class) : ?>
	         <option value="<?= $class->classId;?>"><?= $class->classTitle; ?></option>
	       <?php endforeach; ?>
	   </select>
	   <?php else: ?>
	     <h5 class="text-danger">No Class found.</h5>
	   <?php endif;?>
	 </div>
	</div>

	<br />
	<div class="form-group" style="padding-top:8px;">

	  <!-- <span class="col-sm-2"></span> -->
	   <label class="control-label col-sm-2" for="addmissionFee">Addmission Fees:</label>
	   <div class="col-sm-10">
	      <input type="text"  name="addmissionFee" placeholder="Addmission Fees i-e 500, 600, 700 etc" class="form-control" form="Form1" id="addmissionFee" />
	   </div>
	</div>
	<br />

	<div class="form-group" style="padding-top:8px;">

	  <!-- <span class="col-sm-2"></span> -->
	   <label class="control-label col-sm-2" for="tuitionFee">Tuition Fees:</label>
	   <div class="col-sm-10"> 
	      <input type="text"  name="tuitionFee" placeholder="Tuition Fees i-e 500, 600, 700 etc" class="form-control" form="Form1" id="tuitionFee" />
	   </div>
	</div>

	<br />

	<div class="form-group" style="padding-top:8px;">

	  <!-- <span class="col-sm-2"></span> -->
	   <label class="control-label col-sm-2" for="securityFund">Security Fund:</label>
	   <div class="col-sm-10"> 
	      <input type="text"  name="securityFund" placeholder="Security Fund i-e 500, 600, 700 etc" class="form-control" form="Form1" id="securityFund" />
	   </div>
	</div>

	<br />

	<div class="form-group" style="padding-top:8px;">

	  <!-- <span class="col-sm-2"></span> -->
	   <label class="control-label col-sm-2" for="securityFund">Other Fund:</label>
	   <div class="col-sm-10"> 
	      <input type="text"  name="otherFund" placeholder="Other Fund i-e 500, 600, 700 etc" class="form-control" form="Form1" id="otherFund" />
	   </div>
	</div>



</div>
</div>
<br>
<div class="modal-footer" style="padding-top:8px;">
  <div class="form-group">
      <label class="col-sm-offset-3 col-sm-6">
	   <input type="submit" class="form-control btn-sm btn-primary btn-block btn-flat" form="Form1" id="add_fund" value="Add Dues/Funds">
	   </label>
  </div>
</div>
</form>



<script type="text/javascript">
	$('form[id="Form1"] input:submit').on('click', function(e) {
	    e.preventDefault();
	    $("#add_fund").prop('disabled', true);
	    $("#add_fund").val("Please Wait...");
	    $('#create_school_user_process_response').html('');
	    $('#create_school_user_process_response_alert').html('');
	    $.ajax({
	         type: 'POST',
	         url: $('#Form1').attr('action'),
	         data: $('#Form1').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
	         success: function(data){
	            obj = $.parseJSON(data);
	            console.log(data);
	            // fails
	            if(obj.status == false){
	                $('#validation_one').html(obj.msg);
	                $("#add_fund").val("Add Dues/Funds");
	                $("#add_fund").prop('disabled', false);
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
	                 		// $("#empty_td_staff").remove();
	                 		get_last_inserted_row(id, 'School/get_fund_record_by_id', 'fund_row_', 'fund_tbody');
	                 		// get_last_inserted_row(id, 'School/get_staff_record_by_id', 'staff_row_');
	                 	}
	                    $("#modal_one").modal('hide');
	                 }, 3000);
	                

	            }

	         },
	          error:function (data) {
	            alert("Enrollement data error:"+data);

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