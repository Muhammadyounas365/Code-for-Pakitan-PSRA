
<tr id="staff_row_<?php echo $staff_info->schoolStaffId; ?>">
	<td>&nbsp;</td>
	<td><?php echo $staff_info->schoolStaffName; ?></td>
	<td><?php echo $staff_info->schoolStaffFatherOrHusband; ?></td>
	<td><?php echo $staff_info->schoolStaffCnic; ?></td>
	<td>
	 	<?php if(!empty($gender)): ?>
	 		<?php foreach($gender as $gen): ?>
	 			<?php if($gen->genderId == $staff_info->schoolStaffGender): ?>
	    			<?php echo $gen->genderTitle; ?>
	    		<?php endif;?>
			<?php endforeach;?>
		<?php else: ?>
			No gender found.
		<?php endif;?>
	</td>
	<td>		   	
	 	<?php if(!empty($staff_type)): ?>
   	 		<?php foreach($staff_type as $s_type): ?>
   	 			<?php if($s_type->staffTypeId == $staff_info->schoolStaffType): ?>
   	    			<?php echo $s_type->staffTtitle; ?>
   	    		<?php endif;?>
   			<?php endforeach;?>
		<?php else: ?>
			No Staff Type Found.
		<?php endif;?>
	</td>
	<td><?php echo $staff_info->schoolStaffQaulificationAcademic; ?></td>
	<td><?php echo $staff_info->schoolStaffQaulificationProfessional; ?></td>
	<td><?php echo $staff_info->TeacherTraining; ?></td>
	<td><?php echo $staff_info->TeacherExperience; ?></td>
	<td><?php echo $staff_info->schoolStaffDesignition; ?></td>
	<td><?php echo $staff_info->schoolStaffAppointmentDate; ?></td>
	<td><?php echo  @$staff_info->schoolStaffNetPay; ?></td>
	<td><?php echo @$staff_info->schoolStaffAnnualIncreament; ?></td>
	<td class="no-print" style="width: 250px;"><a href="javascript:void(0);" onclick="load_form_in_modal(<?php echo $staff_info->schoolStaffId; ?>, 'Staff Update', 'School/school_staff_edit_by_id')"> &nbsp;<i class="fa fa-edit"></i></a>
	          <a href="javascript:void(0);" title="Delete Staff" onclick="delete_record_by_id(<?php echo $staff_info->schoolStaffId; ?>, 'schoolStaffId', 'school_staff', 'staff_row_');" > &nbsp;<i class="fa fa-trash-o text-danger"></i>
	          </a></td>
</tr>