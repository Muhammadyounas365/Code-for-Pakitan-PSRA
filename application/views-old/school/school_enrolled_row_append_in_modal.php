<?php $gender_boy_or_girl = array();

$gender_boy_or_girl[0] = array("id"=> 1, "b_or_g"=> "Boys");
$gender_boy_or_girl[1] = array("id"=> 2, "b_or_g"=> "Girls");
?>

<?php if($enrolled_flag == TRUE ):?>
<tr id="enrolled_row_<?php echo $enrollement_info->ageAndClassId; ?>">
	<td><?php echo $enrolled_count; ?></td>

	<td>		   	
	 	<?php if(!empty($class_list)): ?>
   	 		<?php foreach($class_list as $class_li): ?>
   	 			<?php if($class_li->classId == $enrollement_info->class_id): ?>
   	    			<?php echo $class_li->classTitle; ?>
   	    		<?php endif;?>
   			<?php endforeach;?>
		<?php else: ?>
			No Class Found.
		<?php endif;?>
	</td>

	<td>
	 	<?php if(!empty($age_list)): ?>
	 		<?php foreach($age_list as $age_li): ?>
	 			<?php if($age_li->ageId == $enrollement_info->age_id): ?>
	    			<?php echo $age_li->ageTitle; ?>
	    		<?php endif;?>
			<?php endforeach;?>
		<?php else: ?>
			No Age Found.
		<?php endif;?>
	</td>

	<td>
 		<?php foreach($gender_boy_or_girl as $bg_li): ?>
 			<?php if($bg_li['id'] == $enrollement_info->gender_id): ?>
    			<?php echo $bg_li['b_or_g']; ?>
    		<?php endif;?>
		<?php endforeach;?>
	</td>
	<td><?php echo $enrollement_info->enrolled; ?></td>
	<td class="no-print" style="width: 250px;">
	          <a href="javascript:void(0);" title="Delete Enrollement" onclick="delete_record_by_id(<?php echo $enrollement_info->ageAndClassId; ?>, 'ageAndClassId', 'age_and_class', 'enrolled_row_');" > &nbsp;<i class="fa fa-trash-o text-danger"></i>
	          </a>
	</td>
</tr>
<?php endif; ?>
<tr class="append_total_enrolled">
  <td colspan="4" class="text-center"><strong>Total Enrolled</strong></td>
  <td><strong><?php echo $enrolled_sum; ?></strong></td>
  <td class="no-print">&nbsp;</td>
</tr>

<script type="text/javascript">
	setTimeout(function(){
	  remove_enrolled_total_list_by_class();
	}, 500);
</script>


