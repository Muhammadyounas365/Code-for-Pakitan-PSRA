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
<?php else: ?>
<tr class="bg-success text-center"><td colspan="10"><strong class="text-danger">No School Found Againt The Creiteria.</strong></td></tr>
<?php endif; ?>


