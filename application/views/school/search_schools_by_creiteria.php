<?php if(count($schools) > 0):?>
  <?php $role_id = $this->session->userdata('role_id');?>
<?php foreach($schools as $school): ?>
<tr class="bg-success">
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
    <td><?php echo $school->telePhoneNumber; ?><br><?php echo $school->schoolMobileNumber; ?></td>
    <td><?php echo @$school->typeTitle; ?></td>
    <td><?php echo @$school->userTitle; ?></td>
    <td><?php echo @$school->levelofInstituteTitle; ?></td>
    <td><?php echo $school->genderOfSchoolTitle; ?></td>
    <td class="text-center">
     <a style="cursor: pointer;" title="Send Message"  school="<?php echo @$school->schoolName; ?>" id="<?php echo @$school->schoolId; ?>" class="send_message fa fa-envelope-o "></a>
      <a href="<?php echo base_url('school/certificate_of_schools/'); ?><?php echo $school->schoolId; ?>" title="Print the <?php echo @ucfirst($title); ?> Certificate" target="_blank" > &nbsp;<i class="fa fa-file-text"></i></a>
      <a style="cursor: pointer;" id="<?php echo $school->schoolId; ?>" class="username_password_detail" title="Show UserName & Password"> &nbsp;<i class="fa fa-user"></i></a>
      <a href="javascript:void(0);" onclick='load_form_in_modal("<?php echo $school->schoolId; ?>", "you can renewal, new any registaration type", "school/renewal_of_registration");' title="Registration of <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-book"></i></a>
      <a href="<?php echo base_url('school/explore_schools_by_school_id/'); ?><?php echo $school->schoolId; ?>" title="Explore the <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-eye"></i></a>
      <a href="<?php echo base_url('school/edit/'); ?><?php echo $school->schoolId; ?>" title="Edit <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-edit"></i></a>
      <a href="<?php echo base_url('school/delete/'); ?><?php echo $school->schoolId; ?>" title="Delete <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-trash-o text-danger"></i></a>
    </td>
  </tr>
    <?php endforeach; ?>
<?php else: ?>
<tr class="bg-success text-center"><td colspan="10"><strong class="text-danger">No School Found Againt The Creiteria.</strong></td></tr>
<?php endif; ?>

 <script type="text/javascript">
      $(".send_message").on('click',function(){
        var id=$(this).attr('id');
        $('#school_id_for_message').val(id);
        var school=$(this).attr('school');
       
        $('#selected_schools').html(school);
       $('#send_message_modal').modal('show');
         //alert(id);
          

        
      });
      </script>
<script type="text/javascript">
      $(".username_password_detail").on('click',function(){
        var id=$(this).attr('id');
        //$(this).closest("tr").html("");
        
          $.ajax({
              type: 'POST',
              url: "<?php echo base_url('school/get_school_username_password')?>",
              data: {"id": id},

              success: function(data){

                try
                       {
                        obj = $.parseJSON(data);
                        $('#username_password').modal('show');
                        $("#username_password_modal_one_content_goes_here").html("");
                        $("#username_password_modal_one_content_goes_here").html(obj.school_info);
                        $("#username_password_modal_one_title").html("School Fine Details"); 
                       }
                       catch (e)
                       {
                        location.reload();
                       }
                  

              },
               error:function (data) {
                 // alert("getUcsByTehsilsId :s"+data);

               }

          });
        // $('#myModal').modal('show');

        
      });
      </script>