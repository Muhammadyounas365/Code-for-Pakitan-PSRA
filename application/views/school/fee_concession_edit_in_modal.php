<form id="Form1" method="post" enctype="multipart/form-data" action="<?php echo base_url('school/update_fee_concession_info');?>">
<input type="hidden" name="feeConcessionId" value="<?php echo $fee_concession_info->feeConcessionId ?>" form="Form1">
  <div class="modal-body">
    <div class="alert alert-success" id="msg_one" style="display: none;"></div>
    <div id="validation_one" class="text-center"></div>
    <div class="form-group">
      <div class="col-sm-12"><label>Concession Type</label>
        <select class="form-control select2" id="concession_id" name="concession_id" form="Form1">
          <option>Select Concession Type</option>
          <option value="1" <?php if($fee_concession_info->concession_id==1) echo "selected"; ?>>Sibling</option>
          <option value="2" <?php if($fee_concession_info->concession_id==2) echo "selected"; ?>>Orphan</option>
          <option value="3" <?php if($fee_concession_info->concession_id==3) echo "selected"; ?>>Other</option>
        </select>
      </div>
     
    </div>
    <br><br>
    <div class="form-group">
     <label class="col-sm-12">Percentage
        <input type="text" class="form-control" name="percentage" required="required" form="Form1" id="percentage" value="<?php echo $fee_concession_info->percentage ?>" placeholder="Percentage Of Concession" data-inputmask='"mask": "999 %"' data-mask>
      </label>
    </div>
    <br>
    <div class="form-group">
      <label class="col-sm-12">No of Students
        <input type="text" value="<?php echo $fee_concession_info->numberOfStudent ?>"  class="form-control" name="numberOfStudent" form="Form1" id="numberOfStudent" placeholder="No.of Student">
      </label>
      
    </div>
  </div>
  <div class="modal-footer">
    <div class="form-group">
      <label class="pull-right">
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
           url: "<?php echo base_url('school/update_fee_concession_info');?>",
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
              alert("not update fee Concession info :"+data);
               $("#update").val("update");
               $("#update").prop('disabled', false);

            }
      });


      // return false;
  });
</script>