<!DOCTYPE html>
<html lang="en">
<head>
    <title>Support</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url("assets/vendor/bootstrap/css/bootstrap.min.css"); ?>" /> 
    <link href="<?php echo base_url() ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
    
</head>
<body  style="padding-top: 10%;">
<div class="container">
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
            <?php
                echo "<div class='error_msg text-danger text-center' style='font-size:20px;'>";
                if (isset($error_message)) {
                    echo $error_message;
                }
                    echo validation_errors();
                echo "</div>";
            ?>
				<div class="card card-primary" style="box-shadow: 1px 1px 1px 2px;">
					<div class="card-header text-center">
						<h3>FlexiSolution</h3>
					</div>
					<div class="text-center">
					</div> 
					<div class="card-body">
                    
						<form id="formLogin" action="<?php echo base_url('user/login'); ?>" method="post">
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-user fa-fw"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter Username" aria-label="Username" aria-describedby="basic-addon1" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="username">Password:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-key fa-fw"></i></span>
                                    </div>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" aria-label="Password" aria-describedby="basic-addon1" required="">
                                </div>
                            </div>
                            <button type="submit" id="btnLogin" class="btn btn-primary pull-right">Login</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col-md-4"></div>
		</div>
	</div>
</body>
</html>