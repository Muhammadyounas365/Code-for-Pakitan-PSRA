<?php if(count($academies) > 0):?>
  <?php $role_id = $this->session->userdata('role_id');?>
<?php foreach($academies as $academy): ?>
<tr class="bg-success">
   <td><?php echo $academy->academy_id; ?></td>
                      <td><a class="btn btn-link" href="<?php echo base_url('school/explore_schools_by_school_id/'); ?><?php echo $academy->academy_id; ?>"><?php echo $academy->academy_name; ?></a></td>
                      <td><?php if($academy->registration_number == 0 || $academy->registration_number == ''): ?>
                        <span>Not registered</span>
                      <?php else: echo $academy->registrationNumber; endif;?></td>
                      <td><?php if($academy->districtTitle != NULL){
                                    echo $academy->districtTitle.", ".$academy->postal_address;
                                  }else{
                                    echo $academy->postal_address;
                                  }
                          ?>   
                      </td>

                      <td><?php echo $academy->telePhoneNumber; ?><br></td>
                      
                      <td><?php echo $academy->genderOfSchoolTitle; ?></td>
                       <td><?php echo $academy->location; ?></td>
    <td class="text-center">
     <a style="cursor: pointer;" title="Send Message"  school="<?php echo @$academy->schoolName; ?>" id="<?php echo @$academy->academy_id; ?>" class="send_message fa fa-envelope-o "></a>
      <a href="<?php echo base_url('school/certificate_of_schools/'); ?><?php echo $academy->academy_id; ?>" title="Print the <?php echo @ucfirst($title); ?> Certificate" target="_blank" > &nbsp;<i class="fa fa-file-text"></i></a>
      <a style="cursor: pointer;" id="<?php echo $academy->academy_id; ?>" class="username_password_detail" title="Show UserName & Password"> &nbsp;<i class="fa fa-user"></i></a>
      <a href="javascript:void(0);" onclick='load_form_in_modal("<?php echo $academy->academy_id; ?>", "you can renewal, new any registaration type", "school/renewal_of_registration");' title="Registration of <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-book"></i></a>
      <a href="<?php echo base_url('school/explore_schools_by_school_id/'); ?><?php echo $academy->academy_id; ?>" title="Explore the <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-eye"></i></a>
      <a href="<?php echo base_url('school/edit/'); ?><?php echo $academy->academy_id; ?>" title="Edit <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-edit"></i></a>
      <a href="<?php echo base_url('school/delete/'); ?><?php echo $academy->academy_id; ?>" title="Delete <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-trash-o text-danger"></i></a>
    </td>
  </tr>
    <?php endforeach; ?>
<?php else: ?>
<tr class="bg-success text-center"><td colspan="10"><strong class="text-danger">No Academy Found Againt The Creiteria.</strong></td></tr>
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