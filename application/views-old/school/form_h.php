  <style type="text/css">
    .extra_small{
      font-size: 12px;
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
          <div class="row">
            <!-- col-md-offset-1 -->
                <div class="col-md-12">
                          <h2 class="text-center">Section-H: Fee Concession</h2>
                          <!-- form creation -->
                          <script type="text/javascript">
                             // console.log($);
                             function callme(e) {

                              var concession_id = $('select[name="concession_id"] option:selected').val();
                              var concession_text = $('select[name="concession_id"] option:selected').text();       
                              // var gender_id = $("input[name='gender']:checked").val();
                              // var gender_text ='';
                              // if(gender_id == 1){
                              //    gender_text = 'Male';
                              // }else{
                              //    gender_text = 'Female';
                              // }
                                 e.preventDefault();                                  
                                 var percentage = $("#percentage").val();
                                 var numberOfStudent = $("#numberOfStudent").val();
                                 var markup = "<tr class='text-center'><td><input type='checkbox' form='Form2' name='record'></td>  <td><input type='hidden' form='Form2' name='concession_id[]' value='" + concession_id + "' /> " + concession_text + "</td> <td><input type='hidden' form='Form2' name='percentage[]' value='" + percentage + "' />" + percentage + " </td><td><input type='hidden' form='Form2' name='numberOfStudent[]' value='"+numberOfStudent + "' /> "+numberOfStudent + "</td></tr>";
                                 $("#formdata").append(markup);
                                 $('#Form1').trigger("reset");
                                 $("select.select2").select2('data', {}); // clear out values selected
                                 $("select.select2").select2({ allowClear: true }); // re-init to show default status
                             
                             }
                             
                               $(document).ready(function(){
                                   $('[data-mask]').inputmask();
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

                          <div class="form-group">
                            <div class="col-sm-3">
                               <select class="form-control select2" id="concession_id" name="concession_id">
                                  <option>Select Concession Type</option>
                                  <option value="1">Sibling</option>
                                  <option value="2">Orphan</option>
                                  <option value="3">Other</option>
                               </select>
                            </div>
                             <label class="col-sm-3">
                             <input type="text" class="form-control" name="percentage" required="required" form="Form1" id="percentage" placeholder="Percentage Of Concession" data-inputmask='"mask": "999 %"' data-mask>
                             </label>
                          </div>
                          <div class="form-group">
                             <label class="col-sm-3">
                             <input type="text" class="form-control" name="numberOfStudent" form="Form1" id="numberOfStudent" placeholder="No.of Student">
                             </label>
                             <label class="col-sm-3">
                             <input type="submit" class="form-control add-row btn-sm btn-primary btn-block btn-flat" form="Form1" value="Add Record">
                             </label>
                          </div>
                          <div class="row">
                            <div class="col-md-12" style="overflow-x:auto; padding: 3px 20px;">
                              <table class="table table-responsive table-bordered table-condensed">
                                 <thead>
                                    <tr>
                                       <th class="text-center"></th>
                                       <th class="text-center">Concession</th>
                                       <th class="text-center">Percent</th>
                                       <th class="text-center">Number of student</th>
                                    </tr>
                                 </thead>
                                 <tbody id="formdata">
                                 </tbody>
                              </table>
                            </div>
                            <div class="row" style="padding: 3px 35px;">
                              <div class="col-sm-6"></div>
                              <div class="col-sm-6 text-right">
                                <button type="button" class="btn btn-danger btn-sm delete-row btn-flat">Delete Selected</button>
                                <button type="submit"  style="margin-left:15px;" form='Form2' class="btn btn-primary btn-flat btn-sm">Add All</button>
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
<form id="Form1" method="post" onsubmit="callme(event);" enctype="multipart/form-data" action="<?php echo base_url('school/form_d_process');?>">
</form>

<form id="Form2" method="post" enctype="multipart/form-data" action="<?php echo base_url('school/form_h_process');?>" onsubmit="return confirm('Have you revised the data you have entered if yes,then click Ok otherwise click cancel button.');">
  <input type="hidden" name="school_id" name="Form1" value="<?php echo $school_id; ?>">
</form>