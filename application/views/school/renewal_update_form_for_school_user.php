          <div class="row" style="padding: 10px 25px;">
            <!-- col-md-offset-1 -->
                <div class="col-md-12">
               
                  <?php echo validation_errors(); ?>
                  <form class="form-horizontal" method="post" enctype="multipart/form-data" id="role_form" action="<?php echo base_url('school/school_update_by_school_user_after_copying_data_process');?>">
                    <?php  date_default_timezone_set("Asia/Karachi"); $dated = date("d-m-Y h:i:sa");?>
                    <input type="hidden" name="school_id" value="<?php echo $school_id; ?>" />
                    <input type="hidden" name="createdDate" value="<?php echo $dated; ?>">
                    <div class="box-body">
                      <div class="form-group">
                          <strong class="col-sm-2 text-right">Registration:</strong>
                          <label class="radio-inline col-sm-2"> <input type="radio" name="reg_type_id" checked="" class="flat-red" value="2" /> Renewal </label>
                          <label class="radio-inline col-sm-4"> <input type="radio" name="reg_type_id" class="flat-red" value="4" /> Up-Gradation And Renewal </label>
                      </div>
                      <br/>
                      <div id="TextBoxesGroup" class="row">
                        <div class="col-md-5" style="padding-left: 47px;">
                            <div class="form-group">
                                <label class="">Bank Transaction No (STAN) </label>                                
                                <input maxlength="6" type="text" autocomplete="off" onkeydown="return isNumber(event);changeValue(this)" id="bt_no" name="bt_no[]" class="form-control" />
                            <p>"STAN can be found on the upper right corner of bank generated receipt"</p>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label class="">Bank transaction Date</label>
                                <input onchange="changeValue(this)" min="2014-05-11" max="2014-05-20" type="date" name="bt_date[]" class="form-control bt_date" />
                                <p style="color: rgb(223,239,252); margin-top: 50px;"></p>
                            </div>
                            
                        </div>
                      </div>                      
                      <div class="col-md-4" style="padding-left: 35px;">
                          <div class="form-group">
                              <input type="button" class="btn btn-info" value="Add" id="add_form" />&nbsp;
                              <input type="button" class="btn btn-primary" value="Remove" id="removeForm" />
                          </div>
                      </div>
                    <script type="">
                      function changeValue(event){
                          var vl1 =document.getElementById('bt_no').value;
                          var vl2 =document.getElementById('bt_date').value;
                          if (vl1 && vl2) { 
                            $('#df').attr('disabled', false);
                          }else{
                            $('#df').attr('disabled', true);
                          }
                      }
                    </script>                  
                      <div class="form-group">
                          <div class="col-md-2 col-sm-offset-10">
                              <button type="submit" id="df"   style="margin-left:15px;" class="btn btn-primary btn-flat">Proceed</button>
                          </div>
                      </div>
                    </div>
                  </form>

                </div>
            </div>
            <script type="text/javascript">
                    $(document).ready(function(){
                        var counter = 1;
                        $("#add_form").click(function (){
                        var newTextBoxDiv = $(document.createElement('div')).attr("id", 'TextBoxDiv' + counter);
                        newTextBoxDiv.after().html("<div class='col-md-5' style='padding-left: 47px;'><div class='form-group'><label>Bank Transaction No (STAN)</label><input  type='text' onkeydown='return isNumber(event)' maxlength='6' name='bt_no[]' class='form-control' /></div></div><div class='col-md-1'></div><div class='col-md-5'> <div class='form-group'><label>Bank transaction Date</label><input type='date'  min='2014-05-11' max='' name='bt_date[]' class='form-control bt_date' /></div>");
                        newTextBoxDiv.appendTo("#TextBoxesGroup");
                        applydate();
                        counter++;
                        });
                        $("#removeForm").click(function (){
                          
                          if(counter < 2){
                              alert("No more textbox to remove");
                              return false;
                          }   
                          counter--;
                          $("#TextBoxDiv" + counter).remove();
                        });
                        $("#getButtonValue").click(function () {
                        var msg = '';
                        for(i=1; i<counter; i++){
                            msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
                        }
                        alert(msg);
                        });
                    });

            </script>

            <script type="text/javascript">
        function isNumber(evt) {
          evt = (evt) ? evt : window.event;
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
        }
        return true;
      }
    </script>
    <script type="text/javascript">
      $(function(){
          var dtToday = new Date();

          var month = dtToday.getMonth() + 1;
          var day = dtToday.getDate();
          var year = dtToday.getFullYear();

          if(month < 10)
              month = '0' + month.toString();
          if(day < 10)
              day = '0' + day.toString();

          var maxDate = year + '-' + month + '-' + day;    
          $('.bt_date').attr('max', maxDate);
      });

     function applydate(){
      $(function(){
          var dtToday = new Date();

          var month = dtToday.getMonth() + 1;
          var day = dtToday.getDate();
          var year = dtToday.getFullYear();

          if(month < 10)
              month = '0' + month.toString();
          if(day < 10)
              day = '0' + day.toString();

          var maxDate = year + '-' + month + '-' + day;    
          $('.bt_date').attr('max', maxDate);
       });
     }
  </script>