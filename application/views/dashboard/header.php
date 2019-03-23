<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Flexible Solution</title>
    <meta name="description" content="FlexiSolution">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo-144.gif">
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="<?php echo base_url("assets/vendor/bootstrap/css/bootstrap.min.css"); ?>" /> 
    <link href="<?php echo base_url() ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url("assets/vendor/datatable/css/dataTables.bootstrap4.min.css");?>" />
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/popper.js/dist/umd/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/datatable/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/datatable/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
    <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.css')?>">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#"><img class="mx-auto d-block" src="<?php echo base_url(); ?>assets/images/logo-50.png" alt="Logo" style="height:37px;"></a>
                <a class="navbar-brand hidden" href="#">FS</a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?php echo base_url('customer'); ?>"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <li class="">
                        <a href="<?php echo base_url('customer'); ?>"> <i class="menu-icon fa fa-users"></i>Customer List</a>
                    </li>
                     <li class="">
                        <a href="<?php echo base_url('user'); ?>"> <i class="menu-icon fa fa-user"></i>User List</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                    <a href="#"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cog"></i>Setting</a>
                        <ul class="sub-menu  dropdown-menu">
                            <li><i class="menu-icon fa fa-archive"></i><a href="<?php echo base_url('systemtype'); ?>">System Type</a></li>
                            <li><i class="menu-icon fa fa-server"></i><a href="<?php echo base_url('service'); ?>">Service Type</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->
    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>        
                </div>
                <div class="col-sm-5">
                    <div class="user-area dropdown">
                    <div class="header-left pull-left">
                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="alertExp">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger" id="amountExPay">0</span>
                            </button>
                        </div>
                    </div>&nbsp;
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span><?php echo $this->session->userdata['logged_in']['u_name']; ?>&nbsp;<i class="fa fa-chevron-down"></i></span>
                        </a>
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#" id="changePass"><i class="fa fa-cog"></i> Change Password</a>
                            <a class="nav-link" href="<?php echo base_url('user/logout'); ?>"><i class="fa fa-sign-out"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- /header -->
        <!-- Header-->
        <div class="content mt-3">
            <div class="row">
                <!-- modal pop-up change password for the current user login -->
                <div class="modal fade" id="myChangePasswordModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Change Password</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="myChangePassForm" action="" method="post" class="">
                                    <input type="hidden" name="txtId" value="0">
                                    <div class="form-group row">
                                        <label for="currentPassword" class="col-sm-4 col-form-label">Current Password <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" name="currentPassword" id="currentPassword" placeholder="Customer Name" required=""/>
                                            <span class="text-danger"><small id="msgCurrentPassword"></small></span>
                                        </div>
                                    </div>	 
                                    <div class="form-group row">
                                        <label for="newPassword" class="col-sm-4 col-form-label">New Password <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" name="newPassword" id="newPassword" placeholder="Customer Phone" required=""/>
                                            <span class="text-danger"><small id="msgNewPassword"></small></span>
                                        </div>
                                    </div>     
                                    <div class="form-group row">
                                        <label for="confirmNewPassword" class="col-sm-4 col-form-label">Confirm Password<span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" name="confirmNewPassword" id="confirmNewPassword" placeholder="Customer Organization" required=""/>
                                            <span class="text-danger"><small id="msgConfirmNewPassword"></small></span>
                                        </div>
                                    </div>      
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="btnSaveChange">Save Change</button>
                            </div>
                        </div>
                    </div>
                </div>   
                <!-- modal pup-up to load list of customer expire -->
                <div class="modal fade" id="alertExpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">List Customer Expire Detail</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table id="customerListExpDetailTable" class="table table-bordered" style="width:100%">
                                        <thead style="width:100%">
                                            <th>#</th>
                                            <th>Code</th>
                                            <th>Name</th>
                                            <th>Phone Number</th>
                                            <th>Organization</th>
                                            <th>System</th>
                                            <th>Host</th>
                                            <th>Main</th>
                                        </thead>
                                        <tbody id="customerListExpDetail">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal pup-up for renew each customer that expire -->
                <div class="modal fade" id="renewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Renew Customer Expire</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="renewForm" action="" method="post" class="">
                                    <input type="hidden" name="cusId" value="0">
                                    <input type="hidden" name="hostRenewExpDate" value="">
                                    <input type="hidden" name="mainRenewExpDate" value="">
                                    <div class="form-group row">
                                        <label for="serviceHostRenew" class="col-sm-4 col-form-label">Service Host</label>
                                        <div class="col-sm-8">
                                        <select class="custom-select" name="serviceHostRenew" id="serviceHostRenew" onchange="calRenewExpire(1)">
                                        </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="hostRenewDate" class="col-sm-4 col-form-label date-picker">Host Start Date</label>
                                        <div class="col-sm-8">
                                            <input  type="input" class="form-control" onchange="calRenewExpire(1)" name="hostRenewDate" id="hostRenewDate" placeholder="yyyy-mm-dd">
                                        </div>
                                    </div> 	
                                    <div class="form-group row">
                                        <label for="serviceMainRenew" class="col-sm-4 col-form-label">Service Main</label>
                                        <div class="col-sm-8">
                                        <select class="custom-select" name="serviceMainRenew" id="serviceMainRenew" onchange="calRenewExpire(2)">
                                        </select>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="mainRenewDate" class="col-sm-4 col-form-label">Main Start Date</label>
                                        <div class="col-sm-8">
                                            <input  type="input" data-date-format="dd-mm-yyyy" class="form-control" onchange="calRenewExpire(2)" name="mainRenewDate" id="mainRenewDate" placeholder="yyyy-mm-dd">
                                        </div>
                                    </div>	     
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="btnRenew">Renew</button>
                            </div>
                        </div>
                    </div>
                </div>