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
    
}
</style>
<?php if(!empty($school_info) && count($school_info)>0) {  ?>
<div class="col-sm-12" style="background-color: #fff;padding-bottom: 50px;">
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
          <br><br>
          <h3>Login Information</h3>
          <hr>
          <?php if(!empty($school_info->userName)): ?>
          <?php echo "<i class='fa fa-user'></i> User Name : <span style='color:darkgreen;font-size:20px;font-weight:bold;'>".$school_info->userName."</span>"; ?>
          <br>
          <?php endif; ?>
          <?php if(!empty($school_info->userPassword)): ?>
          <?php echo "<i class='fa fa-lock'></i> Password   :<span style='color:red;font-size:20px;font-weight:bold;'>".$school_info->userPassword."</span>"; ?>
          <br>
          <?php endif; ?>
          </address>

        
         

          </div>
          <?php } 
           else
           {
            echo "<h3  style='font-size:22px;margin:0 auto;margin-top:100px;margin:40px;'>Record Not Found for this School</h3>";
           }
          ?>




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