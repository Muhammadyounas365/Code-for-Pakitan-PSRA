  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h2 style="display:inline;"> Notfication Alerts
      </h1>
      <small></small>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li> 
        <li class="active"><?php //echo @$title; ?></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <form method="POST" action="<?php echo base_url();?>Firebase/SendNotification">
        <div class="col-md-8">
          <div class="form-group">
          <label for="exampleInputEmail1">title</label>
          <input type="text" class="form-control" name="title" aria-describedby="tilte">
          <small id="tilte" class="form-text text-muted"></small>
        </div>
        <div class="form-group">
          <label for="description">Description</label> 
          <textarea rows="4" name="description" class="form-control"></textarea>
        </div>
      
        <button type="submit"  class="btn btn-primary">Submit</button>
        </div>
      </form>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->