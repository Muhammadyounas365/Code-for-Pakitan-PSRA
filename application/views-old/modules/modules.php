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
                      <div class="pull-right margin-b">
                        <a href="<?php echo base_url('modules/create_form'); ?>" class="btn btn-flat btn-primary">Add new <?php echo $title; ?></a>
                      </div>
<!-- 
                        <div class="row">
                          <div class="col-md-12"> -->
                            <table class="table table-responsive table-hover table-bordered">
                              <tbody>
                              <tr>
                                <th style="width: 10px">#</th>
                                <th>Title</th>
                                <th>URI</th>
                                <th>Menu status</th>
                                <th class="text-center">Icon</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Actions</th>
                              </tr>
                              <?php $counter=1; ?>
                              <?php foreach($modules as $module): ?>
                              <tr>
                                <td><?php echo $counter++;?></td>
                                <td>
                                  <a href="<?php echo base_url('modules/actions/')?><?php echo $module->module_id; ?>""><?php echo $module->module_title; ?></a>
                                </td>
                                <td><?php echo $module->module_uri;?></td>
                                <td>
                                  <?php if($module->module_menu_status == 0 ): ?>
                                    <small class="label label-danger"> Disabled</small>
                                    <?php else: ?>
                                    <small class="label label-success"> Enabled</small>
                                  <?php endif;?>
                                </td>
                                <td class="text-center">
                                  <i class="fa <?php echo $module->module_icon; ?> text-info"></i>
                                </td>
                                <td class="text-center">
                                  <?php if($module->module_status == 0 ): ?>
                                    <small class="label label-danger"> Trash</small>
                                    <?php else: ?>
                                    <small class="label label-success"> Active</small>
                                  <?php endif;?>
                                </td>
                                <td class="text-center">
                                  <a href="<?php echo base_url('modules/create_form/'); ?><?php echo $module->module_id; ?>" title="Add Actions"> &nbsp;<i class="fa fa-plus"></i></a>
                                  <a href="<?php echo base_url('modules/edit/'); ?><?php echo $module->module_id; ?>" title="Edit <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-edit"></i></a>
                                  <a href="#" title="Delete <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-trash-o text-danger"></i></a>
                                </td>
                              </tr>
                                <?php endforeach; ?>
                              </tbody>
                            </table>
<!--                           </div>
                        </div> -->
                    </div>
                    <!-- /.box-body -->
                  </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->