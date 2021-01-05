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
table tbody tr:hover{
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  border-left: 2px solid gray;
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
          
        
            
          <div class="col-md-12">
             <fieldset style="background-color: #f9f6f6;"><legend>Sent Messages</legend>
             <div class=" col-sm-12  margin-b">
             <div id="by_school_id">
                      <form id="Form2" method="post" action="<?php echo base_url('messages/get_messages_by_school_id');?>">
                        <div class="form-group">
                          <label class="col-sm-4">
                          <input type="text" class="form-control" name="schools_id" required="required" form="Form2" id="schools_id" placeholder="Enter School Id Examples 1,2,3 etc.">
                          </label>
                          <label class="col-sm-2">
                            <input type="submit" id="search" class="form-control btn-xs btn-primary btn-flat" form="Form2" value="Search">
                          </label>
                        </div>
                      </form>
                    </div>
            <a href="<?php echo base_url('messages/create_message'); ?>" class=" pull-right btn btn-flat btn-primary"><i class="fa fa-edit"></i> Create Message</a>
          </div>
            <table class=" table table-responsive table-condensed table-striped">
               <thead>
                 <th>#</th>
                  <th>Subject</th>
                   <th>School</th>
                    <th>Sent on Dated</th>
                     <th></th>
               </thead>
              <tbody id="searched_messages">
                
                <?php $counter=1; ?>
               

                <?php foreach($messages_for_all_schools as $message): ?>
                <tr>
                  <td><?php echo $counter++;?></td>

                  <td class=" message"><a href="<?php echo base_url('messages/message_details/'); ?><?php echo $message->message_id; ?>">
                    <strong style="font-size: 14px;"> <i style="font-size: 16px;" class="fa fa-star"></i> <i style="color:red;font-size: 16px;" class="fa fa-envelope-o"></i> <?php echo $message->subject; ?></strong>
                  </a> </td>
                  <td>
                    <?php if(!empty($message->schoolName)){ 
                      echo $message->schoolName;
                      }
                      ?>
                  </td>
                  <td style="font-size: 14px;text-align: left;"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date("l , dS F Y",strtotime($message->created_date));?></td>
                 <td><a href="<?= base_url('messages/delete/' . $message->message_id) ?>" class="btn btn-default btn-xs" id="">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a></td>
                </tr>

                <?php endforeach; ?>
              </tbody>
            </table>
             <?= $this->pagination->create_links(); ?>
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
    $('#Form2').on('submit', function(e) {
       //alert();
        e.preventDefault();
        $("#search").prop('disabled', true);
        $("#search").val("Please Wait...");
        $('#create_school_user_process_response').html('');
        $('#create_school_user_process_response_alert').html('');
        $.ajax({
             type: 'POST',
             url: $('#Form2').attr('action'),
             data: $('#Form2').serialize(),   // I WANT TO ADD EXTRA DATA + SERIALIZE DATA
             success: function(data){
              try
              {
                 obj = $.parseJSON(data);
                    console.log(data);
                    $('tr.bg-success').remove();
                    $('#searched_messages').prepend(obj.rows);
                    $("#search").val("Search");
                    $("#search").prop('disabled', false);
              }
              catch (e)
              {
                location.reload();
              }
                
              
              
               
             },
              error:function (data) {
                alert("not add staff info :"+data);

              }
        });


        // return false;
    });
  });
  </script>