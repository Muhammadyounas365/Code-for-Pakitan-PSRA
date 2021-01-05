
          <div class="row">
            <!-- col-md-offset-1 -->
                <div class="col-md-12">
                  <form class="form-horizontal" method="post" onsubmit="return confirm('Have you revised the form if yes, click Ok otherwise click cancel button.');" enctype="multipart/form-data" id="Form1" action="<?php echo base_url('school/physical_facilities_view_edit_process');?>">
                    <input type="hidden" name="school_id" value="<?php echo $school_id; ?>">
                    <input type="hidden" name="physicalFacilityId" value="<?php echo $school_physical_facilities->physicalFacilityId; ?>">
                    <?php  date_default_timezone_set("Asia/Karachi"); $dated = date("d-m-Y h:i:sa"); ?>
                    <!-- <input type="hidden" name="createdBy" value="<?php echo $this->session->userdata('userId'); ?>" />
                    <input type="hidden" name="createdDate" value="<?php echo $dated; ?>"> -->
                    <div class="box-body">
                        <h2 class="text-center">Section-B: Physical Facilities</h2>

                        <div class="alert alert-success" id="msg_one" style="display: none;"></div>
                        <div id="validation_one" class="text-center"></div>
                        <?php // echo validation_error(); ?>
                        <div class="form-group">
                           <label class="control-label col-sm-2" for="building_id">Building:</label>
                           <div class="col-sm-4">
                              <select class="form-control select2" id="building_id" name="building_id" required  style="width: 100%;">
                                <?php $selected = '';?>
                                 <option>Select Building</option>
                                  <?php if(!empty($buildings)): ?>
                                 <?php foreach ($buildings as $building) : ?>
                                  <?php if($building->physicalBuildingId == $school_physical_facilities->building_id){ $selected = 'selected';}?>
                                   <option value="<?= $building->physicalBuildingId;?>" <?php echo $selected; ?> > <?= $building->physicalBuildingTitle; ?></option>
                                   <?php $selected = '';?>
                                 <?php endforeach; ?>
                                 <?php else: ?>
                                   <option class="text-danger">No Building found.</option>
                                 <?php endif;?>

                              </select>
                           </div>
                           <label class="control-label col-sm-2" for="numberOfClassRoom">No. of Classroom(s):</label>
                           <div class="col-sm-4">
                              <input type="text" required name="numberOfClassRoom" placeholder="No. of Classroom(s)" class="form-control" id="numberOfClassRoom" value="<?php echo $school_physical_facilities->numberOfClassRoom;?>"/>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-sm-2" for="numberOfOtherRoom">No. of Other Room(s):</label>
                           <div class="col-sm-4">
                              <input type="text" required name="numberOfOtherRoom" placeholder="Office/Staff room/ Store etc." class="form-control" id="numberOfOtherRoom" value="<?php echo $school_physical_facilities->numberOfOtherRoom;?>"/>
                           </div>
                           <label class="control-label col-sm-2" for="totalArea">Total Area (in marlas):</label>
                           <div class="col-sm-4">
                              <input type="text" required name="totalArea" placeholder="Enter total Area" class="form-control" id="totalArea" value="<?php echo $school_physical_facilities->totalArea;?>"/>
                           </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-sm-2" for="coveredArea">Covered Area <br>(in Marlas):</label>
                           <div class="col-sm-4">
                              <input type="text" required name="coveredArea" placeholder="Enter Covered Area" class="form-control" id="coveredArea" value="<?php echo $school_physical_facilities->coveredArea;?>"/>
                           </div>
                        </div>
                        <h5><strong class="">Whether the following facilities are available in the School?</strong></h5>
                        <div class="form-group">
                           <div class="col-sm-2"><strong style="font-size: 15px; margin-top:5px;" class="pull-right">Physical:</strong></div>
                            <?php if(!empty($physical)): ?>
                           <?php foreach ($physical as $ph) : ?>
                              <label class="checkbox-inline col-sm-2">
                                <?php if(in_array($ph->physicalId, $facilities_physical_ids)):  ?>
                                <?php $check ='checked'; ?>
                                <?php else: ?>
                                  <?php $check =''; ?>
                                <?php endif; ?>
                              <input type="checkbox" name="pf_physical_id[]" value="<?php echo $ph->physicalId;?>" <?php echo $check; ?>> <?php echo $ph->physicalTitle ;?>
                              </label>
                           <?php endforeach; ?>
                           <?php else: ?>
                             <span class="text-danger">No Physical found.</span>
                           <?php endif;?>
                        </div>
                        <?php if(!empty($school_physical_facilities->numberOfLatrines)):?>
                        <div class="form-group" id="latDiv" style="">
                           <label class="control-label col-sm-2" for="numberOfLatrines">Number of Latrines</label>
                           <div class="col-sm-4">
                            <input type="text" name="numberOfLatrines" class="form-control" id="numberOfLatrines" value="<?php echo $school_physical_facilities->numberOfLatrines; ?>">
                           </div>
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                           <div class="col-sm-2"><strong style="font-size: 15px; margin-top:5px;" class="pull-right">Academic:</strong></div>
                            <?php if(!empty($academics)): ?>
                           <?php foreach ($academics as $academic) : ?>
                              <label class="checkbox-inline col-sm-2">
                                <?php if(in_array($academic->academicId, $academic_ids)):  ?>
                                <?php $check ='checked'; ?>
                                <?php else: ?>
                                  <?php $check =''; ?>
                                <?php endif; ?>
                              <input type="checkbox" name="academic_id[]" value="<?php echo $academic->academicId;?>" <?php echo $check;?> > <?php echo $academic->academicTitle ;?>
                              </label>
                           <?php endforeach; ?>
                           <?php else: ?>
                             <span class="text-danger">No Academic found.</span>
                           <?php endif;?>
                        </div>
                        <?php if(!empty($school_physical_facilities->numberOfComputer)):?>
                        <div class="form-group" id="computerLabDiv" >
                           <label class="control-label col-sm-2"  for="numberOfComputer">Number of Computers</label>
                           <div class="col-sm-4">
                              <input type="text"  name="numberOfComputer" placeholder="Enter Total Number Of Computers" class="form-control" id="numberOfComputer" value="<?php echo $school_physical_facilities->numberOfComputer; ?>" />
                           </div>
                        </div>
                        <?php endif;?>

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
                            <?php if(in_array($co_curricular->coCurricularId, $curricular_ids)):  ?>
                            <?php $check ='checked'; ?>
                            <?php else: ?>
                              <?php $check =''; ?>
                            <?php endif; ?>
                              <label class="checkbox-inline col-sm-2">
                              <input type="checkbox" name="co_curricular_id[]" value="<?php echo $co_curricular->coCurricularId;?>" <?php echo $check; ?> > <?php echo $co_curricular->coCurricularTitle ;?>
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
                            <?php if(in_array($oth->otherId, $other_ids)):  ?>
                            <?php $check ='checked'; ?>
                            <?php else: ?>
                              <?php $check =''; ?>
                            <?php endif; ?>
                              <label class="checkbox-inline col-sm-2">
                              <input type="checkbox" name="other_id[]" value="<?php echo $oth->otherId;?>" <?php echo $check;?>> <?php echo $oth->otherTitle ;?>
                              </label>
                           <?php endforeach; ?>
                           <?php else: ?>
                             <span class="text-danger">No Other found.</span>
                           <?php endif;?>
                        </div>
                        <div class="form-group">
                            <div class="col-md-offset-2 col-sm-offset-2">
                                <input  type="submit"  style="margin-left:15px;" id="update" class="btn btn-primary btn-flat" value="Update">
                            </div>
                        </div>
                    </div>
                  </form>
                </div>
            </div>



            <script type="text/javascript">
              $('form[id="Form1"] input:submit').on('click', function(e) {
                  e.preventDefault();
                  $("#update").prop('disabled', true);
                  $("#update").val("Please Wait...");
                  $('#validation_one').html('');
                  $('#msg_one').html('');
                  // $('#create_school_user_process_response').html('');
                  // $('#create_school_user_process_response_alert').html('');
                  $.ajax({
                       type: 'POST',
                       url: $('#Form1').attr('action'),
                       data: $('#Form1').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
                       success: function(data){
                          obj = $.parseJSON(data);
                          // console.log(data);
                          // fails
                          if(obj.status == false){
                              $('#validation_one').html(obj.msg);
                              $("#update").val("Update");
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
                              $("#Form1").trigger('reset');
                          }

                       },
                        error:function (data) {
                          alert("not update staff info :"+data);

                        }
                  });


                  // return false;
              });
            </script>