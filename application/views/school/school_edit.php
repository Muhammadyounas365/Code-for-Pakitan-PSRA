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
        <li><a href="<?php echo base_url('module');?>"><?php echo @$title; ?></a></li>
        <li><a href="#">Create <?php echo @$title; ?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Create New <?php echo @ucfirst($title); ?></h3>
        </div>
        <div class="box-body">
          <div class="row">
                <div class="col-md-offset-1 col-md-9">
                  <form class="form-horizontal" method="post" enctype="multipart/form-data" id="role_form" action="<?php echo base_url('school/create_process').'/'.$school->schoolId;?>">
                    <?php  date_default_timezone_set("Asia/Karachi"); $dated = date("d-m-Y h:i:sa"); ?>
                    <input type="hidden" name="updatedBy" value="<?php echo $this->session->userdata('userId'); ?>" />
                    <input type="hidden" name="updatedDate" value="<?php echo $dated; ?>">
                    <div class="box-body">
                      <div class="form-group">
                        <label for="title" class="col-sm-2 control-label"><span class="text-danger">*</span><?php echo @ucfirst($title); ?> Name</label>
                        <div class="col-sm-10">
                          <?php echo form_error('schoolName'); ?>
                          <input type="text" class="form-control" name="schoolName" required value="<?php echo set_value('schoolName', $school->schoolName);?>" id="title" placeholder="<?php echo @ucfirst($title); ?> Name">

                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label"><span class="text-danger">*</span>District</label>
                        <div class="col-sm-10">
                        <select class="form-control select2" required name="district_id">
                            <?php foreach ($districts as $district) : ?>
                              <option value="<?= $district->districtId;?> <?php set_value('district_id', $school->district_id); ?>"  ><?= $district->districtTitle; ?></option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                      </div>

                      <div class="form-group">
                        <label for="address" class="col-sm-2 control-label"><?php echo @ucfirst($title); ?> Address</label>
                        <div class="col-sm-10">
                          <?php echo form_error('address'); ?>
                          <input type="text" class="form-control" name="address" value="<?php echo set_value('address', $school->address);?>" id="address" placeholder="<?php echo @ucfirst($title); ?> Address">

                        </div>
                      </div>

                      <div class="form-group">
                        <label for="schoolLandlineNumber" class="col-sm-2 control-label"><?php echo @ucfirst($title); ?> Phone#</label>
                        <div class="col-sm-10">
                          <?php echo form_error('schoolLandlineNumber'); ?>
                          <input type="text" class="form-control" name="schoolLandlineNumber" value="<?php echo set_value('schoolLandlineNumber', $school->schoolLandlineNumber);?>" id="schoolLandlineNumber" placeholder="<?php echo @ucfirst($title); ?> Land line Number">

                        </div>
                      </div>

                      <div class="form-group">
                        <label for="schoolMobileNumber" required class="col-sm-2 control-label"><span class="text-danger">*</span> <?php echo @ucfirst($title); ?> Cell#</label>
                        <div class="col-sm-10">
                          <?php echo form_error('schoolMobileNumber'); ?>
                          <input type="text" class="form-control" name="schoolMobileNumber" value="<?php echo set_value('schoolMobileNumber', $school->schoolMobileNumber);?>" id="schoolMobileNumber" placeholder="<?php echo @ucfirst($title); ?> Mobile Number">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label"><span class="text-danger">*</span> Type Of School</label>
                        <div class="col-sm-10">
                        <select class="form-control select2" required name="type_of_institute_id">
                            <?php foreach ($type_of_institute as $typeOfInsti) : ?>
                              <option value="<?= $typeOfInsti->typeOfInstituteId;?>" <?php echo set_select('type_of_institute_id',  $typeOfInsti->typeOfInstituteId); ?> <?php if($school->type_of_institute_id == $typeOfInsti->typeOfInstituteId){ echo "selected";} ?> ><?= $typeOfInsti->toiTitle; ?></option>
                            <?php endforeach; ?>
                        </select>
                      </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label"><span class="text-danger">*</span> Education System</label>
                        <div class="col-sm-10">
                        <select class="form-control select2" required name="gender_of_school">
                          <?php foreach ($gender_of_school as $gender) : ?>
                            <option value="<?= $gender->genderOfSchoolId;?>" <?php echo set_select('gender_of_school',  $gender->genderOfSchoolId); ?> <?php if($school->gender_of_school == $gender->genderOfSchoolId){ echo "selected";} ?> ><?= $gender->genderOfSchoolTitle; ?> </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label"><span class="text-danger">*</span> School Level</label>
                        <div class="col-sm-10">
                        <select class="form-control select2" required name="level_of_school">
                          <?php foreach ($level_of_institute as $item) : ?>
                            <option value="<?= $item->levelofInstituteId;?>" <?php echo set_select('level_of_school',  $item->levelofInstituteId); ?><?php if($school->level_of_school == $item->levelofInstituteId){ echo "selected";} ?> ><?= $item->levelofInstituteTitle; ?></option>
                          <?php endforeach; ?>
                          
                          <?php // echo $level_of_institute; ?>
                        </select>
                      </div>
                      </div>


                      <div class="form-group">
                          <div class="col-md-offset-2 col-sm-offset-2">
                              <button type="submit"  style="margin-left:15px;" class="btn btn-primary btn-flat">Add <?php echo @ucfirst($title); ?></button>
                          </div>
                      </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <!-- Footer -->
        </div>
        <!-- /.box-footer-->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
