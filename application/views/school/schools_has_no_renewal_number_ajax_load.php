<?php if(count($schools) > 0):?>
<?php $counter= 1; 

                  ?>
                  <?php foreach($schools as $school): ?>
                  <tr class="bg-success">
                    <td><?php echo $school->schoolId; ?></td>
                    <td class="text-center"><a class="btn btn-link" href="<?php echo base_url('school/explore_schools_by_school_id/'); ?><?php echo $school->schoolId; ?>"><?php echo $school->schoolName; ?></a><br>
                    <span class="label label-default"><?php echo @$school->registrationNumber; ?></span></td>
                    
                    
                    <td><?php if($school->districtTitle != NULL){
                      echo "<span style='font-size:12px;'><strong>District: </strong>".$school->districtTitle."<br /><strong>Tehsil: </strong>".$school->tehsilTitle." ".$school->address."</span>";
                      }else{
                      echo $school->address;
                      }
                      ?>
                    </td>
                    
                    
                    <td><?php echo @$school->biseregistrationNumber; ?></td>
                    <td><?php echo @$school->classTitle; ?> To <?php echo @$school->upper_class; ?></td>
                     <td><?php echo @$school->regTypeTitle; ?></td>
                      <td><?php echo @$school->yearOfEstiblishment; ?></td>
                       <td><?php echo @$school->genderOfSchoolTitle; ?></td>
                    
                    <td class="text-center">
                     <?php if($school->status==2): ?>
                      <?php echo @$school->sessionYearTitle; ?><br>
                      <a href="#" class="btn btn-success btn-flat btn-xs" onclick="load_form_in_modal(<?php echo $school->school_session_id; ?>, 'Generate Renewal Number', 'School/generate_renewal_number');">Generate Renewal Code</a>
                      <br>
                      <a href="<?php echo base_url('school/certificate_of_schools/'); ?><?php echo $school->schoolId; ?>" title="Print the <?php echo @ucfirst($title); ?> Certificate" target="_blank" > &nbsp;<i class="fa fa-file-text"></i></a>
                        <a class="school_details_by_id" id="<?php echo $school->school_session_id; ?>" href="#" title="Edit School Details"> &nbsp;<i class="  fa fa-edit"></i></a>
                      <br>
                       <?php if($school->isfined==1) { ?>
                       <a href="#" class="btn btn-danger btn-xs btn-flat" title="the school has been fined!"><i class="fa fa-fire"></i> Fined</a>
                       <?php } ?>
                     <?php elseif($school->status==1): ?>
                       <a href="<?php echo base_url('school/certificate_of_schools/'); ?><?php echo $school->schoolId; ?>" title="Print the <?php echo @ucfirst($title); ?> Certificate" target="_blank" > &nbsp;<i class="fa fa-file-text"></i></a> |<i class="fa fa-check text-success"></i><br>
                        <a class="school_details_by_id" id="<?php echo $school->school_session_id; ?>" href="#" title="Edit School Details"> &nbsp;<i class="  fa fa-edit"></i></a>
                        <?php else: ?>
                          <b class="text-danger">Not Applied</b>
                     <?php endif; ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
<?php else: ?>
<tr class="bg-success text-center"><td colspan="10"><strong class="text-danger">No School Found Againt The Creiteria.</strong></td></tr>
<?php endif; ?>


<script type="text/javascript">
      $(".school_details_by_id").on('click',function(){
        var id=$(this).attr('id');
        //$(this).closest("tr").html("");
         //alert(id);
          $.ajax({
              type: 'POST',
              url: "<?php echo base_url('School/edit_school_details_by_id')?>",
              data: {"id": id},

              success: function(data){
                console.log(data);
                      try
                       {
                        obj = $.parseJSON(data);
                        $('#modal_one').modal('show');
                        $("#modal_one_content_goes_here").html("");
                        $("#modal_one_content_goes_here").html(obj.view);
                        $("#modal_one_title").html("Edit School Details"); 
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