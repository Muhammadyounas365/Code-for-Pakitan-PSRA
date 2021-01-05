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
                  <form class="form-horizontal" method="post" onsubmit="return confirm('Have you revised the form if yes, click Ok otherwise click cancel button.');" enctype="multipart/form-data" id="role_form" action="<?php echo base_url('school/form_b_process');?>">
                    <input type="hidden" name="school_id" value="<?php echo $school_id; ?>">
                    <?php  date_default_timezone_set("Asia/Karachi"); $dated = date("d-m-Y h:i:sa"); ?>
                    <!-- <input type="hidden" name="createdBy" value="<?php echo $this->session->userdata('userId'); ?>" />
                    <input type="hidden" name="createdDate" value="<?php echo $dated; ?>"> -->
                    <div class="box-body">
                        <h2 class="text-center">Section-B: Physical Facilities</h2>
                        <?php // echo validation_error(); ?>
                        <div class="form-group">
                           <label class="control-label col-sm-2" for="building_id">Building:</label>
                           <div class="col-sm-4">
                              <select class="form-control select2" id="building_id" name="building_id" required  style="width: 100%;">
                                 <option>Select Building</option>
                                  <?php if(!empty($buildings)): ?>
                                 <?php foreach ($buildings as $building) : ?>
                                   <option value="<?= $building->physicalBuildingId;?>"><?= $building->physicalBuildingTitle; ?></option>
                                 <?php endforeach; ?>
                                 <?php else: ?>
                                   <option class="text-danger">No Building found.</option>
                                 <?php endif;?>

                              </select>
                           </div>
                           <label class="control-label col-sm-2" for="numberOfClassRoom">No. of Classroom(s):</label>
                           <div class="col-sm-4">
                              <input type="text" required name="numberOfClassRoom" placeholder="No. of Classroom(s)" class="form-control" id="numberOfClassRoom" />
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-sm-2" for="numberOfOtherRoom">No. of Other Room(s):</label>
                           <div class="col-sm-4">
                              <input type="text" required name="numberOfOtherRoom" placeholder="Office/Staff room/ Store etc." class="form-control" id="numberOfOtherRoom" />
                           </div>
                           <label class="control-label col-sm-2" for="totalArea">Total Area (in marlas):</label>
                           <div class="col-sm-4">
                              <input type="text" required name="totalArea" placeholder="Enter total Area" class="form-control" id="totalArea" />
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-sm-2" for="coveredArea">Covered Area <br>(in Marlas):</label>
                           <div class="col-sm-4">
                              <input type="text" required name="coveredArea" placeholder="Enter Covered Area" class="form-control" id="coveredArea" />
                           </div>
                        </div>
                        <h5><strong class="">Whether the following facilities are available in the School?</strong></h5>
                        <div class="form-group">
                           <div class="col-sm-2"><strong style="font-size: 15px; margin-top:5px;" class="pull-right">Physical:</strong></div>
                            <?php if(!empty($physical)): ?>
                           <?php foreach ($physical as $ph) : ?>
                              <label class="checkbox-inline col-sm-2">
                                <?php if($ph->physicalId == 2):?>
                                <?php $id ='latrines'; ?>
                                <?php else: ?>
                                  <?php $id =''; ?>
                                <?php endif; ?>
                              <input type="checkbox" name="pf_physical_id[]" value="<?php echo $ph->physicalId;?>" id="<?php echo $id; ?>"> <?php echo $ph->physicalTitle ;?>
                              </label>
                           <?php endforeach; ?>
                           <?php else: ?>
                             <span class="text-danger">No Physical found.</span>
                           <?php endif;?>
                        </div>
                        <div class="form-group" id="latDiv" style="display: none;">
                           <label class="control-label col-sm-2" for="numberOfLatrines">Number of Latrines</label>
                           <div class="col-sm-4">
                            <input type="text" name="numberOfLatrines" class="form-control" id="numberOfLatrines">
                           </div>
                        </div>
                        
                        <div class="form-group">
                           <div class="col-sm-2"><strong style="font-size: 15px; margin-top:5px;" class="pull-right">Academic:</strong></div>
                            <?php if(!empty($academics)): ?>
                           <?php foreach ($academics as $academic) : ?>
                              <label class="checkbox-inline col-sm-2">
                                <?php if($academic->academicId == 2):?>
                                <?php $id ='library'; ?>
                                <?php elseif($academic->academicId == 4): ?>
                                <?php $id ='computerlab'; ?>
                                <?php else:?>
                                <?php $id =''; ?>
                                <?php endif; ?>
                              <input type="checkbox" name="academic_id[]" value="<?php echo $academic->academicId;?>" id="<?php echo $id; ?>"> <?php echo $academic->academicTitle ;?>
                              </label>
                           <?php endforeach; ?>
                           <?php else: ?>
                             <span class="text-danger">No Academic found.</span>
                           <?php endif;?>
                        </div>
                        <div class="form-group" id="computerLabDiv" style="display: none;">
                           <label class="control-label col-sm-2"  for="numberOfComputer">Number of Computers</label>
                           <div class="col-sm-4">
                              <input type="text"  name="numberOfComputer" placeholder="Enter Total Number Of Computers" class="form-control" id="numberOfComputer" />
                           </div>
                        </div>

                        <div id="libDiv" style="display: none;">
                           <div class="form-group" >
                          <label class="control-label col-sm-2" for="book_type_id">BookS Type:</label>
                          <div class="col-sm-4">
                             <select class="form-control select2" id="book_type_id" form="Form2" name="book_type_id" style="width: 100%;">
                                <option>Select Book Type</option>
                                <?php foreach ($book_types as $book_type) : ?>
                                  <option value="<?php echo $book_type->bookTypeId; ?>"><?php echo $book_type->bookType; ?></option>
                                <?php endforeach; ?>
                             </select>
                          </div>
                           <label class="control-label col-sm-2" for="numberOfBooks">Number of Books</label>
                           <div class="col-sm-4">
                            <input type="text" name="numberOfBooks" class="form-control" form="Form2" id="numberOfBooks">
                           </div>
                            </div>
                           <div class="form-group">
                              <label class="col-sm-2 pull-right">
                              <button type="submit" class="btn btn-sm add-row btn-primary btn-flat" form="Form2">Add Record</button>
                              </label>
                           </div>
                           <table class="table table-responsive table-hover table-condensed table-striped table-bordered">
                            <thead>
                              <th></th>
                              <th class="text-center">Book Type</th>
                              <th class="text-center">Number of books</th>
                            </thead>
                             <tbody id="formdata2">
                             </tbody>
                           </table>
                           <div class="form-group">
                              <label class="col-sm-2 pull-right">
                              <button type="button" class="btn btn-danger btn-sm delete-row btn-flat">Delete Selected</button>
                              </label>
                           </div>
                           
                        </div>

                        <div class="form-group">
                           <div class="col-sm-2"><strong style="font-size: 15px; margin-top:5px;" class="pull-right">Co-Curricular:</strong></div>
                            <?php if(!empty($co_curriculars)): ?>
                           <?php foreach ($co_curriculars as $co_curricular) : ?>
                              <label class="checkbox-inline col-sm-2">
                              <input type="checkbox" name="co_curricular_id[]" value="<?php echo $co_curricular->coCurricularId;?>"> <?php echo $co_curricular->coCurricularTitle ;?>
                              </label>
                           <?php endforeach; ?>
                           <?php else: ?>
                             <span class="text-danger">No Co-Curricular found.</span>
                           <?php endif;?>
                        </div>
                        <div class="form-group">
                           <div class="col-sm-2"><strong style="font-size: 15px; margin-top:5px;" class="pull-right">Others:</strong></div>
                            <?php if(!empty($other)): ?>
                           <?php foreach ($other as $oth) : ?>
                              <label class="checkbox-inline col-sm-2">
                              <input type="checkbox" name="other_id[]" value="<?php echo $oth->otherId;?>"> <?php echo $oth->otherTitle ;?>
                              </label>
                           <?php endforeach; ?>
                           <?php else: ?>
                             <span class="text-danger">No Other found.</span>
                           <?php endif;?>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-sm-offset-2">
                                <button type="submit"  style="margin-left:15px;" id="checkBtn" class="btn btn-primary btn-flat">Submit</button>
                            </div>
                        </div>
                    </div>
                  </form>
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
  <script type="text/javascript">
    $(document).ready(function () {
        $('#checkBtn').click(function(e) {
          // e.preventDefault();
          pf_physical_id = $("input[name=pf_physical_id]:checked").length;
          academic_id = $("input[name=academic_id]:checked").length;
          co_curricular_id = $("input[name=co_curricular_id]:checked").length;
          other_id = $("input[name=other_id]:checked").length;
          if(!checked) {
            alert("You must check at least one checkbox.");
            return false;
          }

        });

        // latrines check-box is when checked
        $("#latrines").change(function() {
          if($("#latrines").prop('checked') == true){
              $("#latDiv").fadeIn('slow');
              $("#latDiv").find("input").prop('required',true);
          }else{
            $("#latDiv").fadeOut('slow');//hide();
            $("#latDiv").find("input").val('');
            $("#latDiv").find("input").prop('required',false);
          }
        });
      // library check-box is when checked
        $("#library").change(function() {
          if($("#library").prop('checked') == true){
              $("#libDiv").fadeIn('slow');
              $("#libDiv").find("input").prop('required',true);
          }else{
            $("#libDiv").fadeOut('slow');//hide();
            $("#formdata2").find("tr").remove();
            $("#libDiv").find("input").prop('required',false);
          }
        });

        $("#computerlab").change(function() {
            if($("#computerlab").prop('checked') == true){
                $("#computerLabDiv").fadeIn('slow');
                $("#computerLabDiv").find("input").prop('required',true);
            }else{
              $("#computerLabDiv").fadeOut('slow');//hide();
              $("#computerLabDiv").find("input").prop('required',false);
            }

        });
        
    });

  </script>

  <script type="text/javascript">
      function addRecord(e) { 
          e.preventDefault();
          var book_type_id = $('select[name="book_type_id"] option:selected').val();         
          var book_type_id_text =  $('select[name="book_type_id"] option:selected').text();
          var numberOfBooks = $("#numberOfBooks").val();
      
          var markup = "<tr class='text-center'><td ><input type='checkbox' name='record'></td><td><input type='hidden' name='book_type_ids[]' value='" + book_type_id + "' /> " + book_type_id_text + "</td><td><input type='hidden' name='numberOfBooks[]' value='"+ numberOfBooks + "' /> "+ numberOfBooks +" </td></tr>";
          $("#formdata2").append(markup);
          $('#Form2').trigger("reset");
          $("select[form*='Form2']").select2('data', {}); // clear out values selected
          $("select[form*='Form2']").select2({ allowClear: true }); // re-init to show default status
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