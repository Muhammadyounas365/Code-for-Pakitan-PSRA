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
                  <!-- radio button for search... -->
                  <div style="background-color: #dff0d8; padding: 15px; margin-bottom: 15px;">
                  <div class="form-group">
                       <div class="col-sm-6 text-center"><strong class="">School Search By:</strong></div>
                       <label class="radio-inline col-sm-2">
                       <input type="radio" name="search_method" value="by_school_id"> <b>Id</b> 
                       </label>
                       <label class="radio-inline col-sm-2">
                       <input type="radio" name="search_method" value="area_and_name" id="UnsafeRadioButton"> <b>Area And Name</b>
                       </label>
                  </div>
                  </div>

                    <!-- school Id search form-->
                    <div id="by_school_id" style="display: none;">
                      <form id="Form2" method="post" enctype="multipart/form-data" action="<?php echo base_url('school/get_single_school_from_schools_by_id');?>">
                        <div class="form-group">
                          <label class="col-sm-4">
                          <input type="text" class="form-control" name="schools_id" required="required" form="Form2" id="schools_id" placeholder="Enter School Id Examples 1,2,3 etc.">
                          </label>
                          <label class="col-sm-2">
                            <input type="submit" id="search" class="form-control btn-xs btn-primary btn-flat" form="Form2" value="Search">
                          </label>
                        </div>
                      </form>
                    </div>
                    <!-- end school id form here... -->
                    <!-- <=======        ========> -->
                    <!-- school area and name search -->
                    <div class="clearfix"></div>
                    <div id="area_and_like_box" style="display: none;">
                      <div class="form-group">
                        <div class="col-sm-4">
                           <select class="form-control select2" id="district_id" name="district_id" onchange="getTehsilsByDistrictId(this);" required  style="width: 100%;">
                              <?php echo $districts;?>
                           </select>
                        </div>

                        <div class="col-sm-4">
                          <select class="form-control select2" name="tehsil_id" id="tehsil_id" style="width: 100%;" onchange="requiredOperationAfterTehsilChange(this);">
                          </select>
                        </div>

                        <label class="col-sm-4">
                        <input type="text" class="form-control" name="like_text" onkeyup="getSchoolsDontHaveRegistrationNumberAllotedLikeCondition(this);" required="required" form="Form1" id="like_text" placeholder="Enter School Name" value="Select District And Tehsil First." disabled>
                        </label>
                      </div>
                    </div>
                    <!-- end school area search... -->

                  <div class="">
                  <table class="table table-responsive table-hover table-bordered table-condensed">
                    
                    <tr style="font-size: 12px;">
                      <th style="width: 10px">ID</th>
                      <th>School Name</th>
                      <th>Address</th>
                      <th>Phone#</th>
                      <th>Cell#</th>
                      <th>Type</th>
                      <th>School Owner</th> 
                      <th>School Level</th>
                      <th>School For</th>
                      <th class="text-center">Registration#</th>
                    </tr>
                    <tbody id="searched_data_div">
                    <!-- <tr ></tr> -->
                    <?php $counter= 1; ?>
                    <?php foreach($schools as $school): ?>
                    <tr>
                      <td><?php echo $school->schoolId; ?></td>
                      <td><a class="btn btn-link" href="<?php echo base_url('school/explore_schools_by_school_id/'); ?><?php echo $school->schoolId; ?>"><?php echo $school->schoolName; ?></a></td>
                      <td><?php if($school->districtTitle != NULL){
                                    echo "<span style='font-size:12px;'><strong>District: </strong>".$school->districtTitle."<br /><strong>Tehsil: </strong>".$school->tehsilTitle." ".$school->address."</span>";
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
                       <a href="#" class="btn btn-primary btn-flat btn-xs" onclick="load_form_in_modal(<?php echo $school->schoolId; ?>, 'Generate Registration Number', 'School/generate_reg_number');">Generate</a>
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

          $('input[type=radio][name=search_method]').change(function() {
              if (this.value == 'by_school_id') {
                  $("#like_text").val('');
                  $("select.select2").select2('data', {}); // clear out values selected
                  $("select.select2").select2({ allowClear: true }); // re-init to show default status

                  $("#by_school_id").fadeIn('slow');
                  $("#area_and_like_box").fadeOut('slow');
              }
              else{
                $("#school_id").val('');
                $("#by_school_id").fadeOut('slow');
                $("#area_and_like_box").fadeIn('slow');
              }
          });

      function requiredOperationAfterTehsilChange(selected) {
        $("#like_text").val('');
        $("#like_text").prop('disabled', false);
      }

      function getSchoolsDontHaveRegistrationNumberAllotedLikeCondition(likeObj) {
          var likObjValue = ''; var district_id = 0; var tehsil_id = 0;
          likObjValue = likeObj.value;
          district_id = $("#district_id").val();
          tehsil_id = $("#tehsil_id").val();
          // console.log();
          if(likObjValue.length > 0 ){
              $.ajax({
                   type: 'POST',
                   url: "<?php echo base_url('school/get_single_school_from_schools_by_id');?>",
                   data: {"matchString": likObjValue, "district_id":district_id, "tehsil_id": tehsil_id},
                   success: function(data){
                      // console.log(data);
                      $('tr.bg-success').remove();
                      $('#searched_data_div').prepend(data);                 
                   },
                    error:function (data) {
                      alert("not add staff info :"+data);

                    }
              });
          }else{
              $('tr.bg-success').remove();
          }
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
  </script>


  <script type="text/javascript">
    $('form[id="Form2"] input:submit').on('click', function(e) {
        e.preventDefault();
        $("#search").prop('disabled', true);
        $("#search").val("Please Wait...");
        $('#create_school_user_process_response').html('');
        $('#create_school_user_process_response_alert').html('');
        $.ajax({
             type: 'POST',
             url: $('#Form2').attr('action'),
             data: $('#Form2').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
             success: function(data){
                // obj = $.parseJSON(data);
                // console.log(data);
                    $('tr.bg-success').remove();
                    $('#searched_data_div').prepend(data);
                    $("#search").val("Search");
                    $("#search").prop('disabled', false);
               
             },
              error:function (data) {
                alert("not add staff info :"+data);

              }
        });


        // return false;
    });
  </script>