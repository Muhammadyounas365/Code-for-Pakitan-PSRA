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
                          <h2 class="text-center">Section-D: Staff Detail</h2>
                          <div class="text-center">
                             <span><i>STAFF STATEMENT</i> <small>(Teaching and Non-Teaching)</small></span>
                          </div>
                          <!-- form creation -->
                          <script type="text/javascript">
                             // console.log($);
                             function callme(e) {

                              var staff_id = $('select[name="teaching_or_non_teaching_staff"] option:selected').val();
                              var staff_text = $('select[name="teaching_or_non_teaching_staff"] option:selected').text();       
                              // var gender_id = $("input[name='gender']:checked").val();
                              var gender_id = $('select[name="gender"] option:selected').val();
                              var gender_text = $('select[name="gender"] option:selected').text();
                                 e.preventDefault();                                  
                                 var name = $("#name").val();
                                 var fatherName = $("#fatherName").val();
                                 var cnic = $("#cnic").val();
                                 var qualificationProfessional = $("#qualificationProfessional").val();
                                 var qualificationAcademic = $("#qualificationAcademic").val();
                                 var appointmentDate = $("#appointmentDate").val();
                                 var designation = $("#designation").val();
                                 var netPay = $("#netPay").val();
                                 var annualIncrement = $("#annualIncrement").val();
                                 var TeacherTraining = $("#TeacherTraining").val();;
                                 var TeacherExperience = $("#TeacherExperience").val();;
                                 var markup = "<tr class='extra_small'><td><input type='checkbox' form='Form2' name='record'></td><td><input type='hidden' form='Form2' name='name[]' value='" + name + "' />" + name + " </td> <td><input type='hidden' form='Form2' name='fatherName[]' value='"+fatherName + "' /> "+fatherName + "</td> <td><input type='hidden' form='Form2' name='cnic[]' value='" + cnic + "' /> " + cnic + "</td> <td><input type='hidden' form='Form2' name='gender[]' value='" + gender_id + "' /> " + gender_text + "</td>  <td><input type='hidden' form='Form2' name='staff[]' value='" + staff_id + "' /> " + staff_text + "</td>  <td><input type='hidden' form='Form2' name='qualificationAcademic[]' value='" + qualificationAcademic + "' /> " + qualificationAcademic + "</td> <td><input type='hidden' form='Form2' name='qualificationProfessional[]' value='" + qualificationProfessional + "' /> " + qualificationProfessional + "</td>   <td><input type='hidden' form='Form2' name='TeacherTraining[]' value='"+TeacherTraining + "' /> "+TeacherTraining + "</td> <td><input type='hidden' form='Form2' name='TeacherExperience[]' value='"+TeacherExperience + "' /> "+TeacherExperience + "</td> <td><input type='hidden' form='Form2' name='designation[]' value='" + designation + "' /> " + designation + "</td> <td><input type='hidden' form='Form2' name='appointmentDate[]' value='" + appointmentDate + "' /> " + appointmentDate + "</td>  <td><input type='hidden' form='Form2' name='netPay[]' value='" + netPay + "' /> " + netPay + "</td> <td><input type='hidden' form='Form2' name='annualIncrement[]' value='" + annualIncrement + "' /> " + annualIncrement + "</td> </tr>";
                                 $("#formdata").append(markup);
                                 $("#appointmentDate").attr("type", "text");
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

                               $("#appointmentDate").focusout(function(){
                                 var value = $(this).val();
                                 alert(value);
                               });
                          </script>

                          <div class="form-group">
                             <label class="col-sm-4">
                             <input type="text" name="name" required="required" form="Form1" class="form-control" id="name" placeholder="Name">
                             </label>
                             <label class="col-sm-4">
                             <input type="text" class="form-control" name="fatherName" required="required" form="Form1" id="fatherName" placeholder="Father/Husband Name">
                             </label>
                             <label class="col-sm-4">
                             <input type="text" class="form-control" data-inputmask='"mask": "99999-9999999-9"' data-mask name="cnic" required="required" form="Form1" id="cnic">
                             </label>
                          </div>

                          <div class="form-group">
                            <div class="col-sm-4">
                               <select class="form-control select2" id="gender" form="Form1" name="gender" style="width: 100%;">
                                  <option>Select Gender</option>
                                  <option value="1">Male</option>
                                  <option value="2">Female</option>
                               </select>
                            </div>

                            <div class="col-sm-4">
                               <select class="form-control select2" form="Form1" id="teaching_or_non_teaching_staff" name="teaching_or_non_teaching_staff" style="width: 100%;">
                                  <option>Select Staff Type</option>
                                  <option value="1">Teaching</option>
                                  <option value="2">Non-Teaching</option>
                               </select>
                            </div>

                            <label class="col-sm-4">
                            <input type="text" class="form-control" name="qualificationAcademic" required="required" form="Form1" id="qualificationAcademic" placeholder="Enter Academic Qualification">
                            </label>

                          </div>



                          <div class="form-group">
                            <label class="col-sm-4">
                            <input type="text" class="form-control" name="qualificationProfessional" form="Form1" id="qualificationProfessional" placeholder="Enter Professional Qualification">
                            </label>

                             <label class="col-sm-4">
                                <input type="text" class="form-control" name="TeacherTraining" form="Form1" id="TeacherTraining" placeholder="Relevant Teaching Training In Months">
                             </label>
                             <label class="col-sm-4">
                                <input type="text" class="form-control" name="TeacherExperience" form="Form1" id="TeacherExperience" placeholder="Teacher Experience In Months">
                             </label>
                          </div>

                          <div class="form-group">
                            <label class="col-sm-4">
                            <input type="text" class="form-control" name="designation" required="required" form="Form1" id="designation" placeholder="Enter Designation">
                            </label>

                            <label class="col-sm-4">
                            <input type="text" onfocus = "(this.type = 'date')" class="form-control" placeholder="Date of Appointment" name="appointmentDate" required="required" form="Form1" id="appointmentDate">
                            </label>

                            <label class="col-sm-4">
                            <input type="text" class="form-control" name="netPay" required="required" id="netPay" form="Form1" placeholder="Enter Net Pay i-e 10000, 15000, 17000 etc.">
                            </label>
                          </div>

                          <div class="form-group">
                             <label class="col-sm-4">
                             <input type="text" class="form-control" name="annualIncrement" form="Form1" id="annualIncrement" placeholder="Annual Increment">
                             </label>
                             <label class="col-sm-4">
                             <input type="submit" class="form-control add-row btn-sm btn-primary btn-block btn-flat" form="Form1" value="Add Record">
                             </label>
                          </div>
                          <div class="row">
                            <div class="col-md-12" style="overflow-x:auto; padding: 3px 20px;">
                              <table class="table table-responsive table-bordered table-condensed">
                                 <thead>
                                    <tr style="font-size: 12px;">
                                       <th class="text-center"></th>
                                       <th class="text-center">Name</th>
                                       <th class="text-center">Father/Husband <br/> Name</th>
                                       <th class="text-center">CNIC</th>
                                       <th class="text-center">Gender</th>
                                       <th class="text-center">Type Of Staff</th>
                                       <th class="text-center">Qualification <br />Academic</th>
                                       <th class="text-center">Qualification <br />Professional</th>
                                       <th class="text-center">Training <br /><small style="font-size: 10px;">(in months)</small></th>
                                       <th class="text-center">Experience <br /><small style="font-size: 10px;">(in months)</small></th>
                                       <th class="text-center">Designation</th>
                                       <th class="text-center">Date of <br />Appointment</th>
                                       <th class="text-center">Net Pay</th>
                                       <th class="text-center">Annual <br />Increment <small>(if any)</small></th>
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

<form id="Form2" method="post" enctype="multipart/form-data" action="<?php echo base_url('school/form_d_process');?>" onsubmit="return confirm('Have you revised the data you have entered if yes,then click Ok otherwise click cancel button.');" >
  <input type="hidden" name="school_id" name="Form1" value="<?php echo $school_id; ?>">
</form>

