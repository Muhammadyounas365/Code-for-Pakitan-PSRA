<style type="text/css">
 fieldset {
    display: block;
    margin-inline-start: 2px;
    margin-inline-end: 2px;
    padding-block-start: 0.35em;
    padding-inline-start: 0.75em;
    padding-inline-end: 0.75em;
    padding-block-end: 0.625em;
    min-inline-size: min-content;
    border-width: 1px;
    border-style: groove;
    border:1px solid #bbb;
    border-image: initial;
    font-size: 16px;

}
legend {
    width: auto;
    display: block;
    padding-inline-start: 2px;
    padding-inline-end: 2px;
    border-width: initial;
    border-style: none;
    border-color: initial;
    border-image: initial;
    font-size: 16px;
    
}
.message{
  overflow:hidden;
  text-overflow: ellipsis;
  font-size: .875rem;
    letter-spacing: .2px;
    color: #202124;
    line-height: 20px;
}
table tr { height:1em;  }
td { overflow:hidden;white-space:nowrap;text-overflow: ellipsis;overflow-x: hidden;overflow-y: hidden;  } 
table tr:hover{
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>
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
      <li class="active"><?php echo @ucfirst($title); ?></li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="box box-primary box-solid">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo @ucfirst($title); ?></h3>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        
        
       
        <div class="row">
          
        
        
          <div class="col-md-12 table-responsive">
             <fieldset style="background-color: #f9f6f6;"><legend>Inbox Messages</legend>
           
            <table class=" table  table-condensed table-striped">
              <tbody>
                
                <?php $counter=1; ?>
               

                <?php foreach($school_messages as $message): ?>
                <tr>
                  <td><?php echo $counter++;?></td>

                  <td class=" message"><a href="<?php echo base_url('messages/school_message_details/'); ?><?php echo $message->message_id; ?>">
                    <strong style="font-size: 14px;"> <i style="color:red;font-size: 16px;" class="fa fa-envelope-o"></i> <?php echo $message->subject; ?></strong>
                  </a> </td>
                  <td style="font-size: 14px;text-align: right;"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date("l , dS F Y",strtotime($message->created_date));?></td>
                 <td><a href="<?= base_url('messages/delete/' . $message->message_id) ?>" class="btn btn-default btn-xs" id="">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a></td>
                </tr>

                <?php endforeach; ?>
              </tbody>
            </table>
            </fieldset>
          <!--                           </div>
        </div> -->
      </div>
      
      <!-- /.box-body -->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<script type="text/javascript">
  
  $(document).ready(function(){

  $('#start_session').on('click',function(e){
    e.preventDefault();

    var r=confirm("Are You Sure to Start New Session");
    
    if(r == true)
    {

    $('#start_session').prop('disabled', true);
    var id=1;
    $.ajax({
    type: 'POST',
    url: "<?php echo base_url('school/renewal_as_a_whole_school')?>",
    data: {"id": id},
    success: function(data){
    alert("New Session Created For "+data+" Schools");
    $('#start_session').prop('disabled', false);
    },
    error:function (data) {
     alert("Failed");
     $('#start_session').prop('disabled', false);
    }
});
    }


  });
   

   $('#current').on('click',function(){
      $("#current_sessin_model").modal('show');

   });
    $('#next').on('click',function(){
      $("#next_sessin_model").modal('show');

   });
  });
</script>