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
        <!-- <li><a href="#">Examples</a></li> -->
        <li class="active"><?php echo @ucfirst($title); ?>s</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo @ucfirst($title); ?>s list</h3>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="pull-right margin-b">
              <!-- <a href="<?php echo base_url('school/create_form'); ?>" class="btn btn-flat btn-primary">Add new <?php echo @ucfirst($title); ?></a> -->
            </div>
              <?php $role_id = $this->session->userdata('role_id');?>
              <div class="row">
                <div class="col-md-12">
                  <div class="">
                    <!-- searching of schools by name and area wise -->
                        <div class="clearfix"></div>
                        <div id="area_and_like_box">
                          <div class="form-group">
                            <?php if(empty($district_id)): ?>
                            <div class="col-sm-4">
                               <select class="form-control select2" id="district_id" name="district_id" onchange="getTehsilsByDistrictId(this);" required  style="width: 100%;">
                                  <?php echo $districts;?>
                               </select>
                            </div>
                            <div class="col-sm-4">
                              <select class="form-control select2" name="tehsil_id" id="tehsil_id" style="width: 100%;" onchange="requiredOperationAfterTehsilChange(this);">
                              </select>
                            </div>
                            <?php else: ?>
                            <input type="hidden" name="district_id" value="<?php echo $district_id; ?>" id="district_id">
                            <div class="col-sm-4">
                              <select class="form-control select2" name="tehsil_id" id="tehsil_id" style="width: 100%;" onchange="requiredOperationAfterTehsilChange(this);">
                                  <option>Select Tehsil</option>
                                  <?php foreach($tehsils as $tehsil): ?>
                                    <option value="<?php echo $tehsil->tehsilId; ?>"><?php echo $tehsil->tehsilTitle; ?></option>
                                  <?php endforeach; ?>
                              </select>
                            </div>
                            <?php endif; ?>


                            <label class="col-sm-4">
                            <input type="text" class="form-control" name="like_text" onkeyup="getSchoolsByCreteria(this);" required="required" form="Form1" id="like_text" placeholder="Enter School Name" value="Select District And Tehsil First." disabled>
                            </label>
                          </div>
                        </div>
                        <!-- end school area search... -->
                    <!-- end searching code here -->
                  <table class="table table-responsive table-hover table-bordered table-condensed">
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th>School Name</th>
                      <th>Registration Number</th>
                      <th>Address</th>
                      <th>Phone#</th>
                      <th>Cell#</th>
                      <th>Type</th>
                      <th>School Owner</th> 
                      <th>School Level</th>
                      <th>School For</th>
                      <th class="text-center">Actions</th>
                    </tr>
                    <tbody id="searched_data_div">
                    <?php $counter= 1; ?>
                    <?php foreach($schools as $school): ?>
                    <tr>
                      <td><?php echo $school->schoolId; ?></td>
                      <td><a class="btn btn-link" href="<?php echo base_url('school/explore_schools_by_school_id/'); ?><?php echo $school->schoolId; ?>"><?php echo $school->schoolName; ?></a></td>
                      <td><?php if($school->registrationNumber == 0 && $role_id != 16): ?>
                        <a href="<?php echo base_url('school/registration_code_allotment/'); ?>">Allot Registration Number</a>
                      <?php else: echo $school->registrationNumber; endif;?></td>
                      <td><?php if($school->districtTitle != NULL){
                                    echo $school->districtTitle.", ".$school->address;
                                  }else{
                                    echo $school->address;
                                  }
                          ?>   
                      </td>
                      <td><?php echo $school->telePhoneNumber; ?></td>
                      <td><?php echo $school->schoolMobileNumber; ?></td>
                      <td><?php echo @$school->typeTitle; ?></td>
                      <td><?php echo @$school->userTitle; ?></td>
                      <td><?php echo @$school->levelofInstituteTitle; ?></td>
                      <td><?php echo $school->genderOfSchoolTitle; ?></td>
                      <td class="text-center">
                        <a href="<?php echo base_url('school/certificate_of_schools/'); ?><?php echo $school->schoolId; ?>" title="Print the <?php echo @ucfirst($title); ?> Certificate" target="_blank" > &nbsp;<i class="fa fa-file-text"></i></a>
                        <a href="<?php echo base_url('school/explore_schools_by_school_id/'); ?><?php echo $school->schoolId; ?>" title="Explore the <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-eye"></i></a>
                        <a href="<?php echo base_url('school/edit/'); ?><?php echo $school->schoolId; ?>" title="Edit <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-edit"></i></a>
                        <a href="<?php echo base_url('school/delete/'); ?><?php echo $school->schoolId; ?>" title="Delete <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-trash-o text-danger"></i></a>
                      </td>
                    </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  </div>
                  <?= $this->pagination->create_links(); ?>
                </div>
              </div>
          </div>
          <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Modal -->
  <div class="modal fade" id="modal_one" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="modal_one_title">title will be goes dynamically</h4>
        </div>
        <div id="modal_one_content_goes_here">
          
        </div>
      </div>
      
    </div>
  </div>



  <script type="text/javascript">
      function load_form_in_modal(id, title, url) {

          $.ajax({
              type: 'POST',
              url: "<?php echo base_url('')?>"+url,
              data: {"id": id},

              success: function(data){
                  $('#modal_one').modal('show');
                  $("#modal_one_content_goes_here").html(data);
                  $("#modal_one_title").html(title);

              },
               error:function (data) {
                 // alert("getUcsByTehsilsId :s"+data);

               }

          });
        // $('#myModal').modal('show');

        
      }



      function getTehsilsByDistrictId(selected) {
          $("select.select2").select2('data', {}); // clear out values selected
          $("select.select2").select2({ allowClear: true }); // re-init to show default status
          $.ajax({
              type: 'GET',
              url: "<?php echo base_url('School/get_tehsils_list_by_district_id')?>/"+selected.value,
              //data: {"id": id},
              success: function(data){

                  $("#tehsil_id").html(data);

              },
               error:function (error) {
                  alert("getTehsilsByDistrictId"+ error);
               }

          });
      }

      function requiredOperationAfterTehsilChange(selected) {
        $("#like_text").val('');
        $("#like_text").prop('disabled', false);
      }

      function getSchoolsByCreteria(likeObj) {
          var likObjValue = ''; var district_id = 0; var tehsil_id = 0;
          likObjValue = likeObj.value;
          district_id = $("#district_id").val();
          tehsil_id = $("#tehsil_id").val();
          // console.log(likObjValue);
          if(likObjValue.length > 0 ){
              $.ajax({
                   type: 'POST',
                   url: "<?php echo base_url('school/search_schools_by_creiteria');?>",
                   data: {"matchString": likObjValue, "district_id":district_id, "tehsil_id": tehsil_id},
                   success: function(data){
                      // console.log(data);
                      $('tr.bg-success').remove();
                      $('#searched_data_div').prepend(data);                 
                   },
                    error:function (error) {
                      alert("Error occur:"+error);

                    }
              });
          }else{
              $('tr.bg-success').remove();
          }
      }

  </script>