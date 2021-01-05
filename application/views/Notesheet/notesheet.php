<div class="content-wrapper" style="min-height: 845.764px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h2 style="display: inline;">
            School Registration
        </h2>
        <small>info about school</small>
        <ol class="breadcrumb">
            <li>
                <a href="#"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <!-- <li><a href="#">Examples</a></li> -->
            <li class="active">School Registrations</li>
        </ol>
    </section>
<?php //echo "<pre>"; print_r($res);exit;?>
    <!-- Main content -->
    <section class="content">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Schools list</h3>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="pull-right margin-b">
                    <!-- <a href="http://localhost/PSRA/school/create_form" class="btn btn-flat btn-primary">Add new School Registration</a> -->
                </div>
                <div class="row">
                    <div class="col-md-12"> 

                        <div id="area_and_like_box">
                            <div class="form-group">
                                 
                            </div>
                        </div> 
                        <!-- end school id form here... -->
                        <div class="clearfix"></div>
                        <div class="table-responsive">
                            <table width="100%" class="table table-hover table-bordered table-condensed table-striped">
                                <tbody>
                                    <tr style="font-size: 12px;">
                                        <th style="width: 10px;">Seq</th>
                                        <th style="width: 10px;">School ID</th>
                                        <th width="">School Name</th>
                                        <th>Address</th> 
                                        <th width="">School Level</th>
                                        <th width="">Location</th>
                                        <th width="">Location</th>
                                        <th>Reg Type</th>
                                        <th>Year of Establishment</th>
                                        <th>Upper Class</th> 
                                        <th>Forward/Backward To</th> 
                                        <th>Comments</th> 
                                        <th>Para</th> 
                                    </tr>
                                </tbody>
                                <tbody id="searched_data_div">
                                    <?php $designations = 
                                    array(
                                           "1"=>"Computer Operator",
                                           "2"=>"DD-MIS",
                                           "3"=>"Additional Admin",
                                           "4"=>"DD-Registration",
                                           "5"=>"AD-Registration-01",
                                           "6"=>"AD-Registration-02",
                                           "7"=>"Director");
                                    $count=1; foreach($res as $row){?>
                                    <tr>
                                        <td><?php echo $count++;?></td>
                                        <td><?php echo $row['schoolId'];?></td>
                                        <td><a class="btn btn-link" href="https://psra.gkp.pk/schoolReg/school/explore_school_by_id/<?php echo $row['schoolId']?>"><?php echo $row['schoolName'];?></a></td>
                                        <td>
                                            <span style="font-size: 12px;">
                                                <strong>District: </strong><?php echo $row['districtTitle'];?><br />
                                                <strong>Tehsil: </strong><?php echo $row['tehsilTitle'];?>
                                            </span>
                                        </td>
                                        <td><?php echo $row['levelofInstituteTitle'];?></td>
                                        <td><?php echo $row['location']?></td>
                                        <td><?php echo $row['yearOfEstiblishment'];?></td>
                                        <td>New Registration</td>
                                        <td><?php echo $row['yearOfEstiblishment'];?></td>
                                        <td><?php echo $row['upper_class'];?></td> 
                                        <td>
                                            <select class="form-control" onchange="updateStatus(this,this.value,'<?php echo $row['schoolId'];?>')">
                                                <option>--Select--</option>
                                                <?php foreach($designations as $key=>$val){ 
                                                    if($key != $row['status_type'])  {?>
                                                     <option value="<?php echo $key;?>"><?php echo $val;?></option>
                                                    <?php } ?> 
                                                <?php } ?>                                              
                                            </select>
                                        </td> 
                                        <td class="text text-center">
                                            <a href="#" style="font-size: 17px;" data-toggle="modal" onclick="comments('SET',<?php echo $row['schoolId'];?>)"  data-target="#commentsModal" class="fa fa-plus"></a> |
                                            <a href="#" style="font-size: 17px;" data-toggle="modal" onclick="viewComment(<?php echo $row['schoolId'];?>)"  data-target="#commentsview" class="fa fa-eye"></a>
                                            
                                            <!-- <textarea onfocusout="updateComment(this.value,'<?php //echo $row['schoolId'];?>')" class="form-control" cols="40" rows="4"><?php //echo $row['comments']?></textarea> -->
                                        </td>
                                        <td class="text text-center">
                                           <a href="#" style="font-size: 17px;" data-toggle="modal" onclick="para('SET',<?php echo $row['schoolId'];?>)"  data-target="#paraModal" class="fa fa-plus"></a> |
                                           <a href="#" style="font-size: 17px;" data-toggle="modal" onclick="viewPara(<?php echo $row['schoolId'];?>)"  data-target="#paraViewModal" class="fa fa-eye"></a> 
                                        </td> 
                                        </td>
                                    </tr>
                                    <?php }?>
                                  
                                </tbody>
                            </table>
                        </div>
                        <!-- <ul class="pagination pagination-sm">
                            <li class="active"><a>1</a></li>
                            <li><a href="http://localhost/PSRA/school/registration_code_allotment/10" data-ci-pagination-page="2">2</a></li>
                            <li><a href="http://localhost/PSRA/school/registration_code_allotment/20" data-ci-pagination-page="3">3</a></li>
                            <li><a href="http://localhost/PSRA/school/registration_code_allotment/10" data-ci-pagination-page="2" rel="next">&gt;</a></li>
                            <li><a href="http://localhost/PSRA/school/registration_code_allotment/7330" data-ci-pagination-page="734">Last ›</a></li>
                        </ul> -->
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
</div>
<div id="commentsModal" tabindex="-1" role="dialog" class="modal in">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated bounceIn">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">×</span> <span class="sr-only">Close</span> </button>
        <h4 class="modal-title">Add Comments</h4>
      </div>
      <div class="modal-body">
        <!-- <form> -->
          <input type="hidden" id="comment_id" name="comment_id" value=""> 
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="comment_text" class="control-label">Comments</label>
                        <input maxlength="250" id="comment_text" class="form-control" type="text" name="comment_text" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span>
                       </div>
                    </div> 
                    <div class="pull-right col-md-2 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="Select-2" class="control-label">&nbsp;</label>
                        <button   class="btn btn-info btn-block" name="edit_admin" onclick="comments()" type="submit">&nbsp;Add&nbsp;</button>
                      </div>
                    </div>
                    <div class="pull-right col-md-2 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="Select-2" class="control-label">&nbsp;</label>
                        <button class="btn btn-warning btn-block" data-dismiss="modal" type="button">Cancel</button>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    
                    
                    
                 </div>
                </div>
              </div>
            </div>
          </div>
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>
<div id="paraModal" tabindex="-1" role="dialog" class="modal in">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated bounceIn">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">×</span> <span class="sr-only">Close</span> </button>
        <h4 class="modal-title">Add Para</h4>
      </div>
      <div class="modal-body">
        <!-- <form> -->
          <input type="hidden" id="para_id" name="para_id" value=""> 
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="para_text" class="control-label">Comments</label>
                        <input maxlength="250" id="para_text" class="form-control" type="text" name="para_text" required="" aria-required="true">
                        <span class="form-control-feedback" aria-hidden="true"><span class="icon"></span></span>
                       </div>
                    </div> 
                    <div class="pull-right col-md-2 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="Select-2" class="control-label">&nbsp;</label>
                        <button   class="btn btn-info btn-block" name="" onclick="para()">&nbsp;Add&nbsp;</button>
                      </div>
                    </div>
                    <div class="pull-right col-md-2 col-sm-6 col-xs-12">
                      <div class="form-group has-feedback">
                        <label for="Select-2" class="control-label">&nbsp;</label>
                        <button class="btn btn-warning btn-block" data-dismiss="modal" type="button">Cancel</button>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    
                    
                    
                 </div>
                </div>
              </div>
            </div>
          </div>
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>
<div id="paraViewModal" tabindex="-1" role="dialog" class="modal in">
  <div class="modal-dialog modal-lg">
    <div class="modal-content animated bounceIn">
      <div class="modal-header bg-info">
        <button type="button" class="close" data-dismiss="modal"> <span aria-hidden="true">×</span> <span class="sr-only">Close</span> </button>
        <h4 class="modal-title">View Para's</h4>
      </div>
      <div class="modal-body">
        <!-- <form> -->
          <input type="hidden" id="para_id" name="para_id" value=""> 
          <div class="row gutter-xs">
            <div class="col-xs-12">
              <div class="card">
                <div class="card-body">

                  <div class="row">
                    <div class="col-md-8 col-sm-8 col-xs-12">
                      <div class="form-group has-feedback">
                         <ul> 
                          <li>Para 1</li>
                          <li>Para 2</li>
                          <li>Para 3</li>
                          <li>Para 4</li>
                          <li>Para 5</li>
                         </ul>
                       </div>
                    </div>  
                  </div>

              </div>
            </div>
          </div>
        <!-- </form> -->
      </div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript"> 
    function comments(value,id){
        if (value =='SET') {
            document.getElementById('comment_id').value=id;
        }else{

            var id = document.getElementById('comment_id').value;
            var comment_text = document.getElementById('comment_text').value; 
            $.ajax({
              type :'GET',
              data:{comments:comment_text,schoolId:id},
              url  :"<?php echo base_url();?>NoteSheet/ChangeStatus/",
              contentType: "application/json",
              dataType: "json",
              success: function(data){  
                $(function(){ toastr.success('Comments Added Successfully', 'success'); });        
              }
          });
        }
      
    }
    function viewComment(value,id){}
    function updateStatus(el,value,id){
        var val = confirm('Are want to Transfer this File'); 
        if(val == false){ 
          return false;
        }else{
          $.ajax({
          type :'GET',
          data:{status_type:value,schoolId:id},
          url  :"<?php echo base_url();?>NoteSheet/ChangeStatus/",
          contentType: "application/json",
          dataType: "json",
            success: function(data){ 
                el.parentElement.parentElement.remove();
                $(function(){ toastr.success('File Transfer Successfully', 'success'); });        
            }
         });
        }
    }
    function viewPara(id){   
      $.ajax({
        type :'GET',
        data:{ViewPara:'ViewPara',schoolId:id},
        url  :"<?php echo base_url();?>NoteSheet/ChangeStatus/",
        contentType: "application/json",
        dataType: "json",
        success: function(data){           
        }
    });
    }    
    function para(value,id){
        if (value =='SET') {
            document.getElementById('para_id').value=id;
        }else{

            var id = document.getElementById('para_id').value;
            var para_text = document.getElementById('para_text').value; 
            $.ajax({
              type :'GET',
              data:{para_text:para_text,schoolId:id},
              url  :"<?php echo base_url();?>NoteSheet/ChangeStatus/",
              contentType: "application/json",
              dataType: "json",
              success: function(data){  
                $(function(){ toastr.success('Comments Added Successfully', 'success'); });        
              }
          });
        }
    }
 </script>