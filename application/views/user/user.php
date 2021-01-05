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
        <li class="active"><?php echo @$title; ?></li>
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
                      <div class="pull-right">
                        <a href="<?php echo base_url('user/create_form'); ?>" class="btn btn-flat btn-primary">Add new <?php echo $title; ?></a>
                      </div>
<!-- 
                        <div class="row">
                          <div class="col-md-12"> -->
                            <table class="table table-responsive table-hover table-bordered table-striped">
                              <tbody>
                              <tr>
                                <th style="width: 10px">#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>CNIC</th>
                                <th>Contact Number</th>
                                <th>Gender</th>
                                <th>District</th>
                                <th>Address</th>
                                <th style="width: 40px">Status</th>
                                <th class="text-center">Action</th>
                              </tr>
                              <?php $offset = $this->uri->segment(3,0); if(!empty($offset)):$counter=$offset+1; else:$counter=1; endif; ?>
                              <?php foreach($users as $user): ?>
                              <tr>
                                <td><?php echo $counter++;?></td>
                                <td><?php echo $user->userTitle; ?></td>
                                <td><?php echo $user->userEmail;?></td>
                                <td><?php echo $user->cnic;?></td>
                                <td><?php echo $user->contactNumber;?></td>
                                <td>
                                  <?php switch ($user->gender):
                                    case '1':
                                      ?>
                                      <span><i class="fa fa-male text-info" aria-hidden="true"></i> Male</span>
                                    <?php break;
                                    case '2':
                                      ?>
                                      <span><i class="fa fa-female text-info" aria-hidden="true"></i> Female</span>
                                      <?php
                                      break;
                                    
                                    default:
                                    ?>
                                      <span><i class="fa fa-female text-info" aria-hidden="true"></i> Other</span>
                                      <?php
                                      break;
                                    endswitch; ?>
                                  </td>
                                <td><?php echo $user->districtTitle;?></td>
                                <td><?php echo $user->address;?></td>
                                <td>
                                  <?php switch ($user->userStatus):
                                    case '0':
                                      ?>
                                      <span class="badge bg-red">Pending</span>
                                    <?php break;
                                    case '1':
                                      ?>
                                      <span class="badge bg-green">Active</span>
                                      <?php
                                      break;
                                    
                                    default:
                                      # code...
                                      break;
                                    endswitch; ?>
                                  </td>
                                  <td class="text-center">
                                    <a href="<?php echo base_url('user/edit/'); ?><?php echo $user->userId;?>" title="Edit <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-edit"></i></a>
                                    <a href="<?php echo base_url('user/delete/'); ?><?php echo $user->userId;?>" title="Delete <?php echo @ucfirst($title); ?>" onclick="return confirm('Are you sure, you want to delete the user.');"> &nbsp;<i class="fa fa-trash-o text-danger"></i></a>
                                  </td>
                              </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
                            <br>
                            <p>Showing &nbsp; <?php echo $offset; ?> &nbsp; to &nbsp;<?php echo $offset+10; ?> &nbsp; of &nbsp;<?php echo $number_of_rows;?></p>
                            <?= $this->pagination->create_links(); ?>
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