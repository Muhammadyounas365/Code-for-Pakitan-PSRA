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
        <li class="active"><?php echo @ucfirst($title); ?>s</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo @ucfirst($title); ?>s list</h3>
            <!-- /.box-tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="pull-right margin-b">
              <!-- <a href="<?php echo base_url('school/create_form'); ?>" class="btn btn-flat btn-primary">Add new <?php echo @ucfirst($title); ?></a> -->
            </div>
              <?php $role_id = $this->session->userdata('role_id');?>
              <div class="row">
                <div class="col-md-12">
                  <div class="">
<?php $schools_id = $this->uri->segment(3); ?>
                        <!-- end school area search... -->
                    <!-- end searching code here -->
                  <table class="table table-responsive table-hover table-bordered table-condensed table-striped">
                    <tr>
                      <th style="width: 10px">ID</th>
                      <th>Session Year</th>
                      <th>School Name</th>
                      <th>Address</th>
                      <th>Contact#</th>
                      <th>Type</th>
                      <th>School Level</th>
                      <th>School For</th>
                      <th class="text-center">Actions</th>
                    </tr>
                    <tbody id="searched_data_div">
                    <?php $counter= 1; ?>
                    <?php foreach($schools as $school): ?>
                    <tr>
                      <td><?php echo $school->schoolId; ?></td>
                      <td><?php echo @$school->sessionYearTitle; ?></td>
                      <td><a class="btn btn-link" href="<?php echo base_url('school/explore_school_by_id/'); ?><?php echo $school->schoolId; ?>"><?php echo $school->schoolName; ?></a></td>
                      <td><?php echo $school->districtTitle; ?>   
                      </td>
                      <td><?php echo $school->telePhoneNumber; ?> <br> <?php echo $school->schoolMobileNumber; ?> </td>
                      <td><?php echo @$school->typeTitle; ?></td>
                      <td><?php echo @$school->levelofInstituteTitle; ?></td>
                      <td><?php echo $school->genderOfSchoolTitle; ?></td>
                      <td class="text-center">
                        <a href="<?php echo base_url('school/explore_school_by_id/'); ?><?php echo $school->schoolId; ?>" title="Explore the <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-eye"></i></a>
                        <a href="<?php echo base_url('school/edit/'); ?><?php echo $school->schoolId; ?>" title="Edit <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-edit"></i></a>
                        <a href="<?php echo base_url('school/delete_school_by_id_with_all_related_data/'); ?><?php echo $school->schoolId.'/'.$schools_id; ?>"  onclick="return confirm('Are you sure you want to delete school and all related data to it.?');" title="Delete <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-trash-o text-danger"></i></a>
                      </td>
                    </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  </div>
                </div>
              </div>
          </div>
          <!-- /.box-body -->
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
