<?php if(count($schools) > 0):?>
  <?php $role_id = $this->session->userdata('role_id');?>
<?php foreach($schools as $school): ?>
                    <tr class="bg-success">
                      <td><?php echo $school->schoolId; ?></td>
                     <td><b><?php echo $school->schoolName; ?></b></td>
                      <td><?php if($school->registrationNumber == 0 || $school->registrationNumber == ''): ?>
                        <span class="text-danger">Not Registered</span>
                      <?php else: echo $school->registrationNumber; endif;?></td>
                      <td><?php if($school->districtTitle != NULL){
                                    echo $school->districtTitle.", ".$school->address;
                                  }else{
                                    echo $school->address;
                                  }
                          ?>   
                      </td>

                      
                      <td><?php echo @$school->typeTitle; ?></td>
                      
                      <td><?php echo @$school->levelofInstituteTitle; ?></td>
                      <td><?php echo $school->genderOfSchoolTitle; ?></td>
                      <td><?php echo $school->telePhoneNumber; ?></td>
                      <td id="<?php echo $school->schoolId; ?>"><?php if($school->isfined==1) echo"<span class='label label-danger'>Yes</span>";
                      else echo "<span class='label label-success'>No</span>"; ?></td>
                      <td class="text-center">
                         <button title="Fine Settig" id="<?php echo $school->schoolId; ?>" class="btn btn-primary
                         btn-xs fine_details_by_search" ><i class="  fa fa-gear "></i></button>
                          <br>
                        <button title="Send Message" school="<?php echo @$school->schoolName; ?>" id="<?php echo @$school->schoolId; ?>" class="send_message fa fa-envelope-o btn btn-warning btn-xs"></button>
                       
                      </td>
                    </tr>
                      <?php endforeach; ?>
<?php else: ?>
<tr class="bg-success text-center"><td colspan="10"><strong class="text-danger">No School Found Againt The Creiteria.</strong></td></tr>
<?php endif; ?>



  <script type="text/javascript">
     $(".fine_details_by_search").on('click',function(){
         var id=$(this).attr('id');
         //alert(id);
          $.ajax({
              type: 'POST',
              url: "<?php echo base_url('fine_management/get_school_fine_details')?>",
              data: {"id": id},

              success: function(data){

                try
                       {
                        obj = $.parseJSON(data);
                        $('#fine_details_modal').modal('show');
                        $("#modal_one_content_goes_here").html("");
                        $("#modal_one_content_goes_here").html(obj.school_info);
                        $("#modal_one_title").html("School Fine Details"); 
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