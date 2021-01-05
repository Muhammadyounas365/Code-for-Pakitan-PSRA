<style type="text/css">
 fieldset {
    display: block;
    margin-inline-start: 2px;
    margin-inline-end: 2px;
    padding-block-start: 0.35em;
    padding-inline-start: 0.75em;
    padding-inline-end: 0.75em;
    padding-block-end: 0.625em;
    min-inline-size: min-content;
    border-width: 1px;
    border-style: groove;
    border:1px solid #bbb;
    border-image: initial;
    font-size: 16px;
    margin-bottom: 10px;
    margin-top:10px;

}
legend {
    width: auto;
    display: block;
    padding-inline-start: 2px;
    padding-inline-end: 2px;
    border-width: initial;
    border-style: none;
    border-color: initial;
    border-image: initial;
    font-size: 16px;
    font-weight: bold;
    
}
.shadow {
  -moz-box-shadow:    3px 3px 5px 6px #ccc;
  -webkit-box-shadow: 3px 3px 5px 6px #ccc;
  box-shadow:         3px 3px 5px 6px #ccc;
}
</style>
<div class="col-sm-12" style="background-color: #fff;">
<h2><i class="fa fa-university"></i> <?php echo @$school_info->schoolName; ?></h2>
<address>
          <strong>About School</strong><br>
          <strong>School Id #<?php echo $school_info->schoolId; ?></strong><br />
          
          
          
          <strong>Registration #
          <?php if($school_info->registrationNumber != 0 ): ?>
          <?php echo @$school_info->registrationNumber; ?><?php endif; ?>
          </strong><br />
          <?php if(!empty($school_info->yearOfEstiblishment)): ?>
          <?php echo "Estiblished In: ".$school_info->yearOfEstiblishment; ?>
          <br>
          <?php endif; ?>
          <?php if(!empty($school_info->telePhoneNumber)): ?>
          <?php echo "Tele-Phone #: ".$school_info->telePhoneNumber; ?>
          <br>
          <?php endif; ?>
         
          </address>

        

         <div class="shadow" style="padding-top:20px;">
           <?php if($school_info->isfined==1){ ?>
          <h4 class="label label-danger text-center" style="padding:7px;font-size: 16px;">The school Has been fined on <?php echo date(" d F Y",strtotime($school_info->fined_date));?> for amount <?php echo $school_info->fine_amount; ?> </h4>
          <?php }
          else
          { ?>
            <h4 class=" label label-success text-center" style="padding:7px;font-size: 16px;">No Fine against the School</h4>
            <?php } ?>
         <br>
         <br>
         <br>
         <?php if(!empty($school_info->remarks)){ ?>
         <div style="padding:10px;background-color: #fff;">
         <h4 style="font-weight: bold;text-decoration: underline;">Remarks</h4>
           <?php echo $school_info->remarks; ?>
         </div>
         <?php } ?>
         </div>
       <?php if(count($school_fine_history)){ ?>   
       <div style="min-height: 100px;">
          <fieldset><legend><h3>Fine History</h3></legend>
          <table class="table table-bordered">
          <tr>
            <th>Fine status</th>
            <th>Amount</th>
            <th>Remarks</th>
            <th>On Dated</th>
            
          </tr>
         
           <?php foreach($school_fine_history as $history){ ?>
           <tr>
           <td><?php if($history->is_fined==1) echo"<span class='label label-danger'>Unpaid</span>";
                      else echo "<span class='label label-success'>Paid</span>"; ?></td>
           <td><?php echo $history->fine_amount; ?></td>
           <td><?php echo $history->remarks; ?></td>
           <td><?php echo date(" d F Y",strtotime($history->created_date));?></td>
           
           </tr>
           <?php }?>

            </table>
         </fieldset>
         </div>
         <?php } ?>
         <fieldset><legend>Change Fine Details</legend>
         <form id="Form1" method="post" enctype="multipart/form-data" action="<?php echo base_url('fine_management/add_fine_details');?>">
	<input type="hidden" id="school_id" name="school_id" value="<?php echo $school_info->schoolId; ?>">
<div class="modal-body">
	<div class="alert alert-success" id="msg_one" style="display: none;"></div>
	<div id="validation_one" class="text-center"></div>

	
	
	

	<div class="form-group" style="padding-top:8px;">
	  <label class="control-label col-sm-2" for="gender">Fine Status:</label>
	  <div class="col-sm-8 ">
	     <select class="form-control select2" id="isfined" form="Form1" name="isfined" style="width: 100%;">
	        
          
	        <option value="1">Unpaid</option>
	        <option value="0">Paid</option>
	     </select>
	  </div>
	 </div>
	  	  <br />
	  <div class="form-group" style="padding-top:8px;">

	  <!-- <span class="col-sm-2"></span> -->
	   <label class="control-label col-sm-2" for="numberOfClassroom">Amount:</label>
	   <div class="col-sm-8">
	      <input type="number" value=""  name="amount" placeholder="Example 2000 etc." class="form-control" form="Form1" id="enrolled" />
	   </div>
	</div>

 <div class="clearfix"></div>
<div class="form-group" style="padding-top:8px;">

    <!-- <span class="col-sm-2"></span> -->
     <label class="control-label col-sm-2" for="numberOfClassroom">Remarks:</label>
     <div class="col-sm-8">
        <textarea class="form-control" placeholder="Remarks about fine" cols="50" rows="5" name="remarks"></textarea>
     </div>
  </div>
  <br />


<div class="clearfix"></div>


  <div class="form-group " style="padding-top:8px;">
      <label class=" col-sm-2 pull-right	">
	   <input type="submit" class="pull-right form-control btn-sm btn-primary  btn-flat" form="Form1" id="save_fine_details" value="Save">
	   
	   </label>
	    <label class=" col-sm-2 pull-right	">
	  
	    <input type="reset" class="pull-right form-control btn-sm btn-danger  btn-flat" form="Form1" id="save_fine_details" value="Cancel">
	   </label>
	 
	  
	   
  </div>
</div>
</form>
         </fieldset>
         
         </div>




<script type="text/javascript">
	$('form[id="Form1"] input:submit').on('click', function(e) {
	    e.preventDefault();
	    var isfined=$("#isfined").val();
	    var school_id=$("#school_id").val();
	    if(isfined==1)
	    {
          $("#"+school_id).html("<span class='label label-danger'>Yes</span>");
	    }
	    else
	    {
          $("#"+school_id).html("<span class='label label-success'>No</span>");
	    }
	    $("#add_enrolled").prop('disabled', true);
	    $("#add_enrolled").val("Please Wait...");
	    $('#create_school_user_process_response').html('');
	    $('#create_school_user_process_response_alert').html('');
	    $.ajax({
	         type: 'POST',
	         url: $('#Form1').attr('action'),
	         data: $('#Form1').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
	         success: function(data){
	              console.log(data);
                 try
                 {
                    obj = $.parseJSON(data);
                    if(obj.status==true)
                    {
                    	if(obj.fine_status==1)
					    {
				          $("#"+school_id).html("<span class='label label-danger'>Yes</span>");
					    }
					    else
					    {
				          $("#"+school_id).html("<span class='label label-success'>No</span>");
					    }
					  $('#fine_details_modal').modal('hide');
                      alert("Success! fine details Saved.")
                    }
                    else
                    {
                    	alert("failed to Save the fine details")
                    }
                 }
                 catch (e)
                 {
                  location.reload();
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