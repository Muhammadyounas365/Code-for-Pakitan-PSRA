<!DOCTYPE html>
<html>
<head> 
	<title>Bank Receipt</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700;900&display=swap"
	rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<style type="text/css">
	body {
		font-size: 14px !important;
		font-family: 'Source Sans Pro', 'Regular' !important;
		background-color: #fff !important;
		color: #3D3D3D!important;
		width: 100%;
		height: 100%;
		margin: 0px;
		padding: 0px;
		overflow-x: hidden; 
	}
	.img{
		width:120px;
	}
	.form-group{
		display: flex !important
	}
	.form-control{
		height:34px !important;
	}
	h5.font{
		font-size:1.20rem !important;
	}
</style>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 offset-sm" style="border: 1px solid #ddd; margin-left: 5%; padding-top: 10px;">
                <div class="row" style="margin-bottom: -65px;">
                    <div class="col-sm-2">
                        <img src="<?php echo base_url();?>assets/logo.png" class="img-responsive img" />
                    </div>
                    <div class="col-sm-8 text-center mt-5">
                        <h5 class="font">The Bank of Khyber, Civil Secretariat Branch Peshawar (0015) A/C No. <b> PLS. 7331-2</b> On Account of: <b>Managing Director Private Schools Regulatory Authority</b></h5>
                    </div>
                    <div class="col-sm-2 float-right" style="padding: 45px 0px;">
                        <!-- <div class="text-center mb-2">
                            <div class="badge badge-success" style="font-size: 100%; padding: 0.5em 0.4em;">Bank Copy</div>
                        </div> -->
                        <br />

                        <b>Reference no:_________</b><br />
                        <p>(for Bank use only)</p>
                    </div>
                </div><br>
                <span style="margin-bottom: -85px;"> <label class="col-sm-1 font-weight-bold">Date:</label>_____________ </span>
                <div class="row" style="margin-top: -35px;">
                    <div class="col-sm-12">
                        <form class="mt-5">
                            <div class="form-group">
                                <label class="col-sm-2 mt-2 font-weight-bold">Institution ID:</label>
                                <div class="col-sm-1">
                                    <input readonly="" value="2344<?php echo $data[0]['schoolId']?>" type="text" style="border-top: 0px; border-right: 0px; border-left: 0px; width:120px ; background: none; margin-left: -50px;" class="form-control" />
                                </div>
                                <label class="col-sm-2 mt-2 font-weight-bold">Institution Name:</label>
                                <div class="col-sm-4">
                                    <input readonly="" value="<?php echo $data[0]['schoolName']?>" type="text" style="border-top: 0px; border-right: 0px; border-left: 0px; background: none;" class="form-control" />
                                </div>
                                <label class="col-sm-1 mt-2 font-weight-bold">District:</label>
                                <div class="col-sm-2">
                                    <input readonly="" value="<?php echo $data[0]['districtTitle']?> " type="text" style="border-top: 0px; border-right: 0px; border-left: 0px; background: none;" class="form-control" />
                                </div>
                            </div>
                            <label class="col-sm-2 font-weight-bold">Level of Institution:</label>
                            <div class="form-check-inline">
                                <label class="form-check-label font-weight-bold"> <input type="checkbox" style="border-top: 0px; border-right: 0px; border-left: 0px;" class="form-check-input" value="" />Primary </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label font-weight-bold"> <input type="checkbox" class="form-check-input" value="" />Middle </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label font-weight-bold"> <input type="checkbox" class="form-check-input" value="" />High </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label font-weight-bold"> <input type="checkbox" class="form-check-input" value="" />H.Secy / Inter College: </label>
                            </div>
                            <br />
                           <!--  <label class="col-sm-2 mt-2 font-weight-bold">Institution Status:</label>
                            <div class="form-check-inline">
                                <label class="form-check-label font-weight-bold"> <input type="checkbox" class="form-check-input" value="" />New Registration: </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label font-weight-bold"> <input type="checkbox" class="form-check-input" value="" />Renewal </label>
                            </div>
                            <div class="form-check-inline">
                                <label class="form-check-label font-weight-bold"> <input type="checkbox" class="form-check-input" value="" />Up-gradation: </label>
                            </div> -->
                        </form>
                        <div class="col-sm-8 mt-3">
                            <table class="table table-bordered table-sm">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Fee Category</th>
                                        <th>Amount (Rs.)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Application Processing Fee</td>
                                        <td><input value="" type="number" style="border: 0px; background: none;" class="" /></td>
                                    </tr>
                                    <tr>
                                        <td>Inspection Fee</td>
                                        <td><input value="" type="number" style="border: 0px; background: none;" class="" /></td>
                                    </tr>
                                    <tr>
                                        <td>Renewal Fee</td>
                                        <td><input value="" type="number" style="border: 0px; background: none;" class="" /></td>
                                    </tr>

                                    <tr>
                                        <td>Up-Gradation Fee</td>
                                        <td><input value="" type="number" style="border: 0px; background: none;" class="" /></td>
                                    </tr>
                                    
                                    
                                    <tr>
                                        <td>Late Fee</td>
                                        <td><input value="" type="number" style="border: 0px; background: none;" class="" /></td>
                                    </tr>
                                    <tr>
                                        <td>Fine</td>
                                        <td><input value="" type="number" style="border: 0px; background: none;" class="" /></td>
                                    </tr>
                                    <tr>
                                        <td>Security Deposit</td>
                                        <td><input value="" type="number" style="border: 0px; background: none;" class="" /></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
						<div class="col-sm-4">
							<hr style="border:2px solid #333;width:250px">
							<p class="text-center">Applicant Signature</p>
						</div>

						<div class="col-sm-4">
							<hr style="border:2px solid #333;width:250px">
							<p class="text-center">Cashier</p>
						</div>

						<div class="col-sm-4">
							<hr style="border:2px solid #333;width:250px">
							<p class="text-center">Bank Officer</p>
						</div>
					</div>
                <!-- <div class="row mt-5">
					<div class="col-sm-4">
						<hr style="border:2px solid #333;width:250px">
						<p class="text-center">Applicant Signature</p>
					</div>

					<div class="col-sm-4">
						<hr style="border:2px solid #333;width:250px">
						<p class="text-center">Cashier</p>
					</div>

					<div class="col-sm-4">
						<hr style="border:2px solid #333;width:250px">
						<p class="text-center">Bank Officer</p>
					</div>
				</div> -->

                <!-- <hr style="border:1px solid #ddd"> -->
            </div>
        </div>
    </div>
</body>

</html>