<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- <title>AdminLTE 2 | Invoice</title> -->
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/lib/bootstrap/dist/css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/lib/font-awesome/css/font-awesome.min.css'); ?>">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css"> -->
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css');?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

<style type="text/css">
  @media print {
    @page { margin: 0; }
    body { margin: 1.4cm;}
    .indent{
      text-indent: 50px;
    }
    hr {
      border-top: 1px solid black;
    }
  }

</style>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <!-- <div class="row page-header"> -->
        <div class="row">
          <div class="col-xs-2">
            <img src="<?php echo base_url('assets/images/site_images/certificate-logo-1-in-print.jpg'); ?>" style="height: 100px; width: 100px;">
          </div>
          <div class="col-xs-8">
            <h2 class="text-center">PRIVATE SCHOOLS REGULATORY AUTHORITY</h>
            <h5 class="text-center">GOVERNMENT OF KHYBER PAKHTUNKHWA</h5>
          </div>
          <div class="col-xs-2">
            <img src="<?php echo base_url('assets/images/site_images/certificate-logo-2-in-print.png'); ?>" style="height: 108px; width: 128px;">
          </div>
        </div>
        <hr>
    <!-- </div> -->
    <div class="row">
      <div class="col-xs-12">
        <p><strong class="pull-right"><u> Dated Peshawar the, <?php echo date('d.m.Y', time()); ?></u></strong></p><br>
        <u><strong>No. MD(KP-PSRA)/3-1/Registration/<?php echo @$schools_info->districtTitle;?>/<?php echo date('Y', time()); ?>-<?php echo date('y', strtotime('+1 years'));; ?>:</strong></u> In accordance with the Provision of KP-PSRA Act, 2017, under sub-section (1) and (2) of Section 21, and under sub-clause (5) of Clause 5 and sub clause (1) & (3) of Clause 6, of the KP-PSRA Regulations, 2018, the Competent Authority in KP-PSRA has been pleased to accord approval of Provisional Registration to the Private Institution (s) named below:
        
      </div>
    </div>
    <br>
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-condensed table-bordered">
          <thead>
          <tr>
            <th>School Name</th>
            <th>Registration No.</th>
            <th>BISE Registration No.</th>
            <th>Level of Institution</th>
            <th>Gender of Institution</th>
            <th>Session of Registration</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td><?php echo $schools_info->schoolName; ?></td>
            <td><?php echo @$schools_info->registrationNumber; ?></td>
            <td><?php echo @$schools_info->biseRegistrationNumber?></td>
            <td><?php echo @$schools_info->levelofInstituteTitle; ?></td>
            <td><?php echo @$schools_info->genderOfSchoolTitle; ?></td>
            <td><?php echo date('Y', time()); ?>-<?php echo date('y', strtotime('+1 years'));; ?></td>
          </tr>
          <tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-xs-12">
        <p><strong>Note: </strong>Registration to the Private Institution (s) granted shall automatically expire on 31st March every year. The Head of the Private Institution (s) shall be required to apply for Renewal for the next Academic Session one month prior to the expiry of registration granted to the institution (s).</p>
        <p class="indent">The school management/administration shall abide by all the norms & standards, categorization and fee regulations, issued from time to time, by this office. In case of failure or non-implementation, the authority shall have the right to cancel the registration for establishment/renewal/up-gradation of Private Institution (s).</p>
        <p class="indent">Further, in case of violation or concealing any information required under KP-PSRA Act, 2017 and Regulations, 2018, the administration/management of Private Institution (s) shall be held responsible for which this authority have all the powers to deal with the institute under relevant sections of laws and regulations.</p>
      </div>
    </div>
<br>
<div class="clearfix"></div>
    <div class="row">
      <div class="col-xs-7" style="padding-top:100px;">
          <u><b>Endst: of even No. and dated.</b></u>
          <br />Copy Forwarded for information to the;
          <ol>
            <li>Chairman BISE Mardan, Khyber Pakhtunkhwa.</li>
            <li>Director (Registration & Fee Regulations), KP-PSRA.</li>
            <li>Chairman District Scrutiny Committee concerned.</li>
            <li>Deputy Director (M&E/MIS), KP-PSRA.</li>
            <li>Principal of the school/college concerned.</li>
            <li>PS to Managing Director, KP-PSRA.</li>
            <li>Master File.</li>
          </ol>
      </div>
      <div class="col-xs-5 text-center">
        <b><span>--Sd--</span><br />
        <span>DIRECTOR</span><br />
        <span>(REGISTRATION & FEE REGULATIONS)</span></b>
      </div>
    </div>
    <br>
    <div class="pull-right"><i>This is a computer-generated certificate.<br /> No signature is required</i></div>
    <div class="clearfix"></div>
        error and omissions are excepted.
    <hr>

    <div class="text-center" style="font-size: 14px;">
          <span>House No. 6 D-IV, Park Avenue, University Town, Peshawar <br />
                Phone# 091-5700247-8.  Fax# 091-5700246. <br />
                Complaint Email Address: kppsra.complaint@gmail.com <br />
    </span>

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
