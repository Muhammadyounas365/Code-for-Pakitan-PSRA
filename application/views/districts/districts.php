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
              <a href="<?php echo base_url('district/create_form'); ?>" class="btn btn-flat btn-primary">Add new <?php echo @ucfirst($title); ?></a>
            </div>
  <!-- 
              <div class="row">
                <div class="col-md-12"> -->
                  <table class="table table-responsive table-hover table-bordered table-striped">
                    <tbody>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Title</th>
                      <th class="text-center">Actions</th>
                    </tr>
                    <?php $counter=1; ?>
                    <?php foreach($districts as $district): ?>
                    <tr>
                      <td><?php echo $counter++;?></td>
                      <td><?php echo $district->districtTitle; ?></td>
                      <td class="text-center">
                        <a href="<?php echo base_url('district/edit/'); ?><?php echo $district->districtId; ?>" title="Edit <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-edit"></i></a>
                        <a href="<?php echo base_url('district/delete/'); ?><?php echo $district->districtId; ?>" title="Delete <?php echo @ucfirst($title); ?>"> &nbsp;<i class="fa fa-trash-o text-danger"></i></a>
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