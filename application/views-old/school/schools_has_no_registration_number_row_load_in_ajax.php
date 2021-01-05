<?php if(count($schools) > 0):?>
<?php foreach($schools as $school): ?>
<tr class="bg-success">
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
  <?php if($school->registrationNumber == 0 ): ?>
   <a href="#" class="btn btn-primary btn-xs btn-flat" onclick="load_form_in_modal(<?php echo $school->schoolId; ?>, 'Generate Registration Number', 'School/generate_reg_number');">Generate</a>
   <?php else: ?>
    <?php echo $school->registrationNumber; ?>
   <?php endif; ?>
</td>
</tr>
<?php endforeach; ?>
<?php else: ?>
<tr class="bg-success text-center"><td colspan="10"><strong class="text-danger">No School Found Againt The Creiteria.</strong></td></tr>
<?php endif; ?>