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
          <div class="row">
            <!-- col-md-offset-1 -->
                <div class="col-md-12">
                  <form class="form-horizontal" method="post" enctype="multipart/form-data" name="Form2">
                   
                    <?php  date_default_timezone_set("Asia/Karachi"); $dated = date("d-m-Y h:i:sa"); ?>
                    <!-- <input type="hidden" name="createdBy" value="<?php echo $this->session->userdata('userId'); ?>" />
                    <input type="hidden" name="createdDate" value="<?php echo $dated; ?>"> -->
                    <div class="box-body">
                      <h2 class="text-center">Section-C: Class & Age Wise Enrollement</h2><br/>
                      <div class="form-group">
                         <label class="col-sm-2 col-md-2 control-label"><span class="text-danger">*</span>Age</label>
                         <div class="col-sm-4 col-md-4">
                           <?php if(!empty($age_list)): ?>
                         <select class="form-control select2" name="age" form="Form2" style="width: 100%;">
                             <option>Select Age</option>
                             <?php foreach ($age_list as $age) : ?>
                               <option value="<?= $age->ageId;?>"><?= $age->ageTitle; ?></option>
                             <?php endforeach; ?>
                         </select>
                         <?php else: ?>
                           <h5 class="text-danger">No age found.</h5>
                         <?php endif;?>
                       </div>

                         <label class="col-sm-2 col-md-2 control-label"><span class="text-danger">*</span>Class</label>
                         <div class="col-sm-4 col-md-4">
                           <?php if(!empty($class_list)): ?>
                         <select class="form-control select2" name="class" form="Form2" style="width: 100%;">
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


                      <div class="form-group">
                        <label class="control-label col-sm-2" for="gender">Gender:</label>
                        <div class="col-sm-4">
                           <select class="form-control select2" id="gender" form="Form2" name="gender" style="width: 100%;">
                              <option>Select Gender</option>
                              <option value="1">Boys</option>
                              <option value="2">Girls</option>
                           </select>
                        </div> 

                        <!-- <span class="col-sm-2"></span> -->
                         <label class="control-label col-sm-2 col-md-2" for="numberOfClassroom">Enrolled:</label>
                         <div class="col-sm-4 col-md-4" style="width: 32.4061234%;">
                            <input type="text"  name="numberOfClassroom" placeholder="No. of students" class="form-control" form="Form2" id="enrolled" />
                         </div>
                      </div>
                      <div class="form-group">
                         <label class="col-sm-2 pull-right">
                         <button type="submit" class="btn btn-sm add-row btn-primary btn-flat" form="Form2">Add Record</button>
                         </label>
                      </div>

                    </div>
                  </form>

                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="table-responsive">
                           <table class="table-bordered table-condensed table-hover" style="width: 100%;">
                              <thead>
                                 <tr>
                                    <th class='text-center'>Select</th>
                                    <th class='text-center'>Age</th>
                                    <th class='text-center'>Class</th>
                                    <th class='text-center'>Gender</th>
                                    <th class='text-center'>Enrolled</th>
                                 </tr>
                              </thead>
                                <tbody id="formdata2">
                                </tbody>
                              
                           </table>

                        </div>
                        <br>
                        <button type="button" class="btn btn-danger btn-sm delete-row btn-flat">Delete Selected</button>
                        <button type="submit"  style="margin-left:15px;" form='Form1' class="btn btn-primary btn-flat btn-sm">Add All</button>
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

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<form id="Form2" onsubmit="addRecord(event);"></form>
<form id="Form1" method="post" enctype="multipart/form-data" action="<?php echo base_url('school/form_c_process');?>" onsubmit="return confirm('Have you revised the data you have entered if yes,then click Ok otherwise click cancel button.');" >
  <input type="hidden" name="school_id" name="Form1" value="<?php echo $school_id; ?>">
</form>

  <script type="text/javascript">
     // console.log($);
     function addRecord(e) { 
         e.preventDefault();
         var age_id = $('select[name="age"] option:selected').val();         
         var age_text =  $('select[name="age"] option:selected').text();
         var class_id = $('select[name="class"] option:selected').val();
         var class_text = $('select[name="class"] option:selected').text();
         var enrolled = $("#enrolled").val();
         var gender_id = $("select[name='gender'] option:selected").val();
         var gender_text = $('select[name="gender"] option:selected').text();
 
         var markup = "<tr class='text-center'><td ><input type='checkbox' name='record'></td><td><input type='hidden' form='Form1' name='age[]' value='" + age_id + "' /> " + age_text + "</td><td><input type='hidden' form='Form1' name='class[]' value='"+ class_id + "' /> "+ class_text +" </td><td><input type='hidden' form='Form1' name='gender[]' value='" + gender_id + "' />"+ gender_text +" </td><td><input form='Form1' type='hidden' name='enrolled[]' value='" + enrolled + "' />" + enrolled + "</td></tr>";
         $("#formdata2").append(markup);
         $('#Form2').trigger("reset");
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