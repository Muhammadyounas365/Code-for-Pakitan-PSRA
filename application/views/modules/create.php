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
        <li><a href="<?php echo base_url('modules');?>"><?php echo ucfirst(@$title); ?>s</a></li>
        <li><a href="#">Create <?php echo @$title; ?></a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box box-primary box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">create new <?php echo @$title; ?>s form</h3>
        </div>
        <div class="box-body">
          <div class="row">
            <?php echo validation_errors(); ?>
                <div class="col-md-offset-1 col-md-9">
                  <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo base_url('modules/create_process');?>">
                    <input type="hidden" name="parent_id" value="<?php echo $parent_id; ?>">
                    <div class="box-body">
                      <div class="form-group">
                        <label for="title" class="col-sm-2 control-label"><?php echo @ucfirst($title); ?> Title</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="module_title" value="<?php echo set_value('module_title');?>" id="title" placeholder="<?php echo @ucfirst($title); ?> Title">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="desc" class="col-sm-2 control-label">Description</label>

                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="desc" value="<?php echo set_value('desc');?>" id="desc" placeholder="<?php echo @ucfirst($title); ?> Description">
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="uri" class="col-sm-2 control-label">URL</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" name="uri" value="<?php echo set_value('uri');?>" id="uri" placeholder="<?php echo @ucfirst($title); ?> URL">
                        </div>
                      </div>
                      <!-- radio for menu status -->
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Menu Status</label>
                        <div class="col-sm-10">
                        <label>
                          <input type="radio" name="menu_status" value="1" class="flat-red" checked> Show in menu
                        </label>
                        <br>
                        <label>
                          <input type="radio" name="menu_status" value="0" class="flat-red"> Don't show in menu
                        </label>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-sm-2 control-label">Icon</label>
                        <div class="col-sm-10">
                        <select class="form-control select2" name="icon">
                          <?php foreach ($icons as $icon) : ?>
                            <option value="<?php echo $icon->icon_title; ?>"><?php echo $icon->icon_title; ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      </div>

                      <!-- radio for status -->
                      <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10">
                        <label>
                          <input type="radio" name="status" value="1" class="flat-red" checked> Active
                        </label>
                        <br>
                        <label>
                          <input type="radio" name="status" value="0" class="flat-red"> In-Active
                        </label>
                        </div>
                      </div>

                      <div class="form-group">
                          <div class="col-md-offset-2 col-sm-offset-2">
                              <button type="submit"  style="margin-left:15px;"  class="btn btn-primary btn-flat">Add <?php echo @ucfirst($title); ?></button>
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