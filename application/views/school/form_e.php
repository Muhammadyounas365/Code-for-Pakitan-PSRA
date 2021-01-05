  <style type="text/css">
    .extra_small{
      font-size: 14px;
    }
  </style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2 style="display:inline;">
        <?php echo @ucfirst($title); ?>
      </h2>
      <small><?php echo @$description; ?></small>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('module');?>"><?php echo @$title; ?></a></li>
        <li><a href="#">Create <?php echo @$title; ?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Create New <?php echo @ucfirst($title); ?></h3>
        </div>
         
        <div class="box-body">
        <div class="progress">
        <div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar"
  aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width:55%">55% 
  </div>
  </div>
          <div class="row">
            <!-- col-md-offset-1 -->
                <div class="col-md-12">
                          <h2 class="text-center">Section-E: Student Dues/Funds Details</h2>
                          <div class="text-center">
                             <span></span>
                          </div>
                          <!-- form creation -->
                          <script type="text/javascript">
                             // console.log($);
                             function callme(e) {

                              var class_id = $('select[name="class_id"] option:selected').val();
                              var class_text = $('select[name="class_id"] option:selected').text();       
                                 e.preventDefault();
                                 // var addmissionFee = $("#addmissionFee").val();
                                 var tuitionFee = $("#tuitionFee").val();
                                 var securityFund = $("#securityFund").val();
                                 var otherFund = $("#otherFund").val();
                                 

                                 // $('select[name="class_id"] option:selected').val('');
                                 $('select[name="class_id"] option:selected').text();       
                                 // var total = parseInt(addmissionFee) + parseInt(tuitionFee)+ parseInt(securityFund) + parseInt(otherFund); //$("#annualIncrement").val();
                                 var markup = "<tr class='text-center extra_small'><td><input type='checkbox' form='Form2' name='record'></td><td><input type='hidden' form='Form2' name='class_id[]' value='" + class_id + "' />" + class_text + " </td>  <td><input type='hidden' form='Form2' name='tuitionFee[]' value='" + tuitionFee + "' /> " + tuitionFee + "</td><td><input type='hidden' form='Form2' name='securityFund[]' value='" + securityFund + "' /> " + securityFund + "</td>  <td><input type='hidden' form='Form2' name='otherFund[]' value='" + otherFund + "' /> " + otherFund + "</td> </tr>";
                                 $("#formdata").append(markup);
                                 $('#Form1').trigger("reset");
                                 $("select.select2").select2('data', {}); // clear out values selected
                                 $("select.select2").select2({ allowClear: true }); // re-init to show default status
                             
                             }
                             
                               $(document).ready(function(){
                                   
                                   // Find and remove selected table rows
                                   $(".delete-row").click(function(){
                                       $("table tbody").find('input[name="record"]').each(function(){
                                         if($(this).is(":checked")){
                                               $(this).parents("tr").remove();
                                           }
                                       });
                                   });
                               });    
                          </script>

                          <!-- <div class="form-group"> -->
                              
<!-- 
                             <label class="col-sm-4">
                             <input type="text" name="addmissionFee" required="required" form="Form1" class="form-control" id="addmissionFee" placeholder="Admission Fee">
                             </label> -->
                             
                          <!-- </div> -->
                          <div class="form-group">
                            <div class="col-sm-4">
                                <?php if(!empty($class_list)): ?>
                              <select class="form-control select2" name="class_id" form="Form1">
                                  <option>Select Class</option>
                                  <?php foreach ($class_list as $class) : ?>
                                    <option value="<?= $class->classId;?>"><?= $class->classTitle; ?></option>
                                  <?php endforeach; ?>
                              </select>
                              <?php else: ?>
                                <h5 class="text-danger">No Class found.</h5>
                              <?php endif;?>
                            </div>
                            <label class="col-sm-4">
                             <input type="text" class="form-control" name="tuitionFee" required="required" form="Form1" id="tuitionFee" placeholder="Tuition Fee">
                             </label>
                             <label class="col-sm-4">
                             <input type="text" class="form-control" name="securityFund" required="required" form="Form1" id="securityFund" placeholder="Security Fund">
                             </label>
                           </div><br> 
                           <div class="form-group"><br> 
                             <label class="col-sm-4">
                             <input type="text" class="form-control" name="otherFund" id="otherFund" form="Form1" placeholder="Other Funds (if any)">
                             </label>
                             <label class="col-sm-4">
                             <input type="submit" class="form-control add-row btn-sm btn-primary btn-block btn-flat" form="Form1" value="Add Record">
                             </label>
                          </div>
                          <br />
                          
                          <div class="row">
                            <div class="col-md-12" style="overflow-x:auto; padding: 3px 20px;">
                              <table class="table table-responsive table-bordered table-condensed">
                                 <thead>
                                    <tr>
                                       <th class="text-center"></th>
                                       <th class="text-center">Class</th>
                                       <!-- <th class="text-center">Admission Fee</th> -->
                                       <th class="text-center">Tuition Fee</th>
                                       <th class="text-center">Security Fund</th>
                                       <th class="text-center">Other Funds</th>
                                    </tr>
                                 </thead>
                                 <tbody id="formdata">
                                 </tbody>
                              </table>
                              <div class="form-group">
                                 <label class="checkbox-inline">
                                 <input type="checkbox" name="feeMentionedInForm" form='Form2' value="Yes"> Whether the above fees are mentioned in the prospectus/admission form if yes then mark checked.
                                 </label>
                              </div>
                            </div>
                            <div class="row" style="padding: 3px 35px;">
                              <div class="col-sm-6"></div>
                              <div class="col-sm-6 text-right">
                                <button type="button" class="btn btn-danger btn-sm delete-row btn-flat col-sm-3">Delete Selected</button>
                                <button type="submit"  style="margin-left:15px;" form='Form2' class="btn btn-primary btn-flat btn-sm col-sm-3">Add All</button>
                              </div>
                            </div>
                          </div>
                         
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <!-- Footer -->
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->
</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<form id="Form1" method="post" onsubmit="callme(event);" enctype="multipart/form-data" action="<?php echo base_url('school/form_e_process');?>">
</form>

<form id="Form2" method="post" enctype="multipart/form-data" action="<?php echo base_url('school/form_e_process');?>" onsubmit="return confirm('Have you revised the data you have entered if yes,then click Ok otherwise click cancel button.');" >
  <input type="hidden" name="school_id" name="Form1" value="<?php echo $school_id; ?>">
</form>