  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2 style="display:inline;">
        <?php echo @ucfirst($title); ?>
      </h1>
      <small><?php echo @$description; ?></small>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <!-- <li><a href="#">Examples</a></li> -->
        <li class="active"><?php echo @$title; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><?php echo @ucfirst($title); ?>s list</a></li>
              <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Add new <?php echo $title; ?></a></li>
            </ul>
            <div class="tab-content"  style="padding-top:40px;">
              <div class="tab-pane active" id="tab_1">
                <div class="row">
                  <div class="col-md-offset-1 col-md-10">
                    <table class="table table-responsive table-hover table-bordered">
                      <tbody>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Task</th>
                        <th>Description</th>
                        <th style="width: 40px">Status</th>
                        <th> Action</th>
                      </tr>
                      <?php $counter=1; ?>
                      <?php foreach($tasks as $task): ?>
                      <tr>
                        <td><?php echo $counter++;?></td>
                        <td><?php echo $task->task_title; ?></td>
                        <td><?php echo $task->task_description;?></td>
                        <td>
                          <?php switch ($task->status):
                            case '0':
                              ?>
                              <span class="badge bg-red">Pending</span>
                            <?php break;
                            case '1':
                              ?>
                              <span class="badge bg-blue">Active</span>
                              <?php
                              break;
                              case '2':
                              ?>
                              <span class="badge bg-green">Completed</span>
                              <?php
                              break;
                            
                            default:
                              # code...
                              break;
                            endswitch; ?>
                          </td>
                          <td> <a href="<?php echo base_url('task/edit/');echo $task->task_id;?>" class="btn btn-info btn-flat">Edit</a> &nbsp; <a href="<?php echo base_url('task/delete/');echo $task->task_id;?>" class="btn btn-danger btn-flat">Delete</a></td>
                      </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="tab_2">
                <div class="row">
                  <?php echo validation_errors(); ?>
                      <div class="col-md-offset-1 col-md-9">
                        <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url('task/create');?>">
                          <div class="box-body">
                            <div class="form-group">
                              <label for="name" class="col-sm-2 control-label">Task</label>

                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="task" value="<?php echo set_value('task');?>" id="task" placeholder="task">
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="description" class="col-sm-2 control-label">Description</label>

                              <div class="col-sm-10">
                                <input type="text" class="form-control" name="description" value="<?php echo set_value('description');?>" id="description" placeholder="description">
                              </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-2 col-sm-offset-2">
                                    <button type="submit"  style="margin-left:15px;"  class="btn btn-primary btn-flat">Add new <?php echo $title; ?></button>
                                </div>
                            </div>
                          </div>
                        </form>
                      </div>
                  </div>
              </div>
            </div>
            <!-- /.tab-content -->
          </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->