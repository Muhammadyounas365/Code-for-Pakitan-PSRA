
<form id="Form1" method="post" enctype="multipart/form-data" action="<?php echo base_url('school/update_fee_info');?>">
	<input type="hidden" name="feeId" value="<?php echo $fee_info->feeId; ?>">
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
	       	<?php if($class->classId==$fee_info->class_id): ?>

	         <option value="<?= $class->classId;?>" selected><?= $class->classTitle; ?></option>
	     <?php else: ?>
	     	<option value="<?= $class->classId;?>"><?= $class->classTitle; ?></option>
	     <?php endif; ?>
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
	      <input type="text"  name="addmissionFee" placeholder="Addmission Fees i-e 500, 600, 700 etc" value="<?php echo $fee_info->addmissionFee ?>" class="form-control" form="Form1" id="addmissionFee" />
	   </div>
	</div>
	<br />
   <div class="clearfix"></div>
	<div class="form-group" style="padding-top:8px;">

	  <!-- <span class="col-sm-2"></span> -->
	   <label class="control-label col-sm-2" for="tuitionFee">Tuition Fees:</label>
	   <div class="col-sm-10"> 
	      <input type="text"  name="tuitionFee" placeholder="Tuition Fees i-e 500, 600, 700 etc" value="<?php echo $fee_info->tuitionFee ?>" class="form-control" form="Form1" id="tuitionFee" />
	   </div>
	</div>

	<br />
   <div class="clearfix"></div>
	<div class="form-group" style="padding-top:8px;">

	  <!-- <span class="col-sm-2"></span> -->
	   <label class="control-label col-sm-2" for="securityFund">Security Fund:</label>
	   <div class="col-sm-10"> 
	      <input type="text"  name="securityFund" placeholder="Security Fund i-e 500, 600, 700 etc" value="<?php echo $fee_info->securityFund ?>" class="form-control" form="Form1" id="securityFund" />
	   </div>
	</div>

	<br />
    <div class="clearfix"></div>
	<div class="form-group" style="padding-top:8px;">

	  <!-- <span class="col-sm-2"></span> -->
	   <label class="control-label col-sm-2" for="securityFund">Other Fund:</label>
	   <div class="col-sm-10"> 
	      <input type="text"  name="otherFund" placeholder="Other Fund i-e 500, 600, 700 etc" class="form-control" value="<?php echo $fee_info->otherFund ?>" form="Form1" id="otherFund" />
	   </div>
	</div>



</div>
</div>
<br>
<div class="modal-footer" style="padding-top:8px;">
  <div class="form-group">
      <label class="col-sm-offset-3 col-sm-6">
	   <input type="submit" class="form-control btn-sm btn-primary btn-block btn-flat" form="Form1" id="update" value="Update">
	   </label>
  </div>
</div>
</form>



<script type="text/javascript">
  $('#Form1').on('submit', function(e) {
      e.preventDefault();
      $("#update").prop('disabled', true);
      $("#update").val("Please Wait...");
      // $('#create_school_user_process_response').html('');
      // $('#create_school_user_process_response_alert').html('');
      $.ajax({
           type: 'POST',
           url: "<?php echo base_url('school/update_fee_info');?>",
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
                  //$("#Form1").trigger('reset');
                  location.reload();
              }

           },
            error:function (data) {
              alert("not update fee  info :"+data);
               $("#update").val("update");
               $("#update").prop('disabled', false);

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