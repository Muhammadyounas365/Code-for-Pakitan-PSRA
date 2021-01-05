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
                <section class="content" style="background-image:url(img/fairview-hospital-hero.jpg); background-repeat:no-repeat; min-height:500px;"/>

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                         <legend style="font-weight: bolder;margin:20px 10px;font-size: 26px;">Registered Schools Info</legend>
                        
                        <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                      <?php echo $registered_schools; ?>
                                    </h3>
                                    <p>
                                        Total Registrations
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-university"></i>
                                </div>
                                <a href="list_user.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                       <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>
                                       <?php echo $renewed_schools; ?>  
                                    </h3>
                                    <p>
                                        Total Renewal 
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-university"></i>
                                </div>
                                <a href="list_user.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                      
                        </div><!-- ./col -->
                         <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                       <?php echo $primary; ?>  
                                    </h3>
                                    <p>
                                        Primary 
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-university"></i>
                                </div>
                                <a href="list_user.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                          
                        </div><!-- ./col -->
                         <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
                                    <h3>
                                       <?php echo $middle; ?>  
                                    </h3>
                                    <p>
                                        Middle
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-university"></i>
                                </div>
                                <a href="list_user.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                          
                        </div><!-- ./col -->
                         <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                       <?php echo $high; ?>  
                                    </h3>
                                    <p>
                                        High 
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-university"></i>
                                </div>
                                <a href="list_user.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                          
                        </div><!-- ./col -->
                         <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-black">
                                <div class="inner">
                                    <h3>
                                       <?php echo $high_sec; ?>  
                                    </h3>
                                    <p>
                                        High Sec/Inter Collages 
                                    </p>
                                </div>
                                <div class="icon">
                                    <i style="color:white;" class="fa fa-university"></i>
                                </div>
                                <a href="list_user.php" class="small-box-footer">
                                    More info <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                          
                        </div><!-- ./col -->
                        <div class="clearfix"></div>
                       

                    <!-- Main row -->
                    <!-- /.row (main row) -->

  </div>
  <!-- /.content-wrapper -->
  <div class="row" style="background-color: #fff;">
  <legend style="font-weight: bolder;margin: 10px;font-size: 26px;">District & Level Wise Registered Schools</legend>
                 <div class="table-responsive">
                    
                  
                  <table style="font-size: 18px;" class="table table-responsive table-hover table-bordered table-condensed table-striped">
                    <tr class="bg-danger">
                      
                      <th>District</th>
                      <th>Primary</th>
                      <th>Middle</th>
                      
                      <th>High</th>
                      
                      <th>Higher Sec/Inter Collage</th>
                      <th>Total Schools</th>
                      
                    </tr>
                    <tbody>
                    <?php $counter= 1; ?>
                    <?php $total_schools_in_district= 0; ?>
                    <?php foreach($levelwise_registered_schools as $district): ?>
                    <tr>
                      <td><?php echo $district->districtTitle;
                           
                       ?></td>
                      <td><?php echo $district->primaryschools; 

                       $total_schools_in_district+=$district->primaryschools; 
                      ?></td>
                      

                      
                      <td><?php echo @$district->middleschools; 
                      $total_schools_in_district+=$district->middleschools; ?></td>
                      
                      <td><?php echo @$district->Highschools;
                       $total_schools_in_district+=$district->Highschools;
                       ?></td>
                      <td><?php echo $district->inter_collages;
                      $total_schools_in_district+=$district->inter_collages;
                       ?></td>
                       <td style="color:red;font-weight:bolder"><?php echo  $total_schools_in_district;
                       $total_schools_in_district=0;
                       ?></td>
                     
                    </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                  </div>
  </div>
  </section>
  </div>
  </div>