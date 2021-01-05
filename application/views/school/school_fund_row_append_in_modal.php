<?php $gender_boy_or_girl = array();

$gender_boy_or_girl[0] = array("id"=> 1, "b_or_g"=> "Boys");
$gender_boy_or_girl[1] = array("id"=> 2, "b_or_g"=> "Girls");
?>


<tr id="fund_row_<?php echo $fund_info->feeId; ?>">
	<td><?php echo $fund_count; ?></td>
	<td>		   	
	 	<?php if(!empty($class_list)): ?>
   	 		<?php foreach($class_list as $class_li): ?>
   	 			<?php if($class_li->classId == $fund_info->class_id): ?>
   	    			<?php echo $class_li->classTitle; ?>
   	    		<?php endif;?>
   			<?php endforeach;?>
		<?php else: ?>
			No Class Found.
		<?php endif;?>
	</td>
	<td><?php echo $fund_info->addmissionFee; ?></td>
	<td><?php echo $fund_info->tuitionFee; ?></td>
	<td><?php echo $fund_info->securityFund; ?></td>
	<td><?php echo $fund_info->otherFund; ?></td>
	<td class="no-print" style="width: 250px;">
	          <a href="javascript:void(0);" title="Delete Dues/Fund" onclick="delete_record_by_id(<?php echo $fund_info->feeId; ?>, 'feeId', 'fee', 'fund_row_');" > &nbsp;<i class="fa fa-trash-o text-danger"></i>
	          </a>
	</td>
</tr>



