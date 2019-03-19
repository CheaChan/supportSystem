<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FlexiSolution</title>
    <meta name="description" content="FlexiSolution">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
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
    <script>
        function getExpireDate(){
            var todayDate = new Date().toISOString().slice(0,10);
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: '<?php echo base_url() ?>customer/getExpireDate',
                async: false,
                dataType: 'json',
                success: function(data)
                {
                    $("#amountExPay").html(data);
                },
                error: function()
                {
                    alert('Could not get expire date from database');
                }
            });
        }
        $(function(){
            getExpireDate();
            $('#changePass').click(function(){
                $('#myChangePasswordModal').modal('show');
                $('#myChangePassForm').attr('action', '<?php echo base_url() ?>user/changePassword');

            });
             // validation bntSave for add & update
            $('#btnSaveChange').click(function()
            {
                var url = $('#myChangePassForm').attr('action');
                var data = $('#myChangePassForm').serialize();
                // //validate form
                var currentPassword = $('input[name=currentPassword]');
                var newPassword = $('input[name=newPassword]');
                var confirmNewPassword = $('input[name=confirmNewPassword]');
                var result = '';
                if(currentPassword.val()==''){
                    $("#msgCurrentPassword").text("Current Password cannot be null");
                }else{
                    $.ajax({
                        type: 'ajax',
                        method: 'get',
                        url: '<?php echo base_url() ?>user/getCurrentPassword',
                        async: false,
                        dataType: 'json',
                        success: function(data){
                            console.log(data);
                            if(data.u_pass != currentPassword.val()){
                                $("#msgCurrentPassword").text("Wrong Current Password");
                            }else{
                                //$('input[name=txtId]').val(data.u_id);
                                $("#msgCurrentPassword").text("");
                                result +='a';
                            }
                        },
                        error: function(){
                            alert('Could not add data');
                        }
                    });
                    
                }
                if(newPassword.val()==''){
                    $("#msgNewPassword").text("New Password cannot be null");
                }else{
                    $("#msgNewPassword").text("");
                    result +='b';
                }
                if(confirmNewPassword.val()==''){
                    $("#msgConfirmNewPassword").text("Confirm Password cannot be null");
                }else{
                    if(newPassword.val() != confirmNewPassword.val()){
                        $("#msgConfirmNewPassword").text("Confirm Password not match!");
                    }else{ 
                        $("#msgConfirmNewPassword").text("");
                        result +='c';
                    }
                }

                if(result=='abc'){
                    $.ajax({
                        type: 'ajax',
                        method: 'post',
                        url: url,
                        data: data,
                        async: false,
                        dataType: 'json',
                        success: function(response){
                            if(response.success){
                                $('#myChangePasswordModal').modal('hide');
                                $('#myChangePassForm')[0].reset();
                                $('.alert-success').html('Change Password successfully').fadeIn().delay(4000).fadeOut('slow');
                                customerList();
                            }else{
                                alert('Error');
                            }
                        },
                        error: function(){
                            alert('Could not add data');
                        }
                    });
                }else{
                    
                }
            });
            // validation bntSave for add & update
            $('#alertExp').click(function()
            {
                $('#alertExpModal').modal('show');
                    $.ajax({
                        type: 'ajax',
                        method: 'get',
                        url: '<?php echo base_url() ?>customer/viewCustomerExpire',
                        data: {},
                        async: false,
                        dataType: 'json',
                        success: function(data){
                            var i;
                          
                            var htmlTable1 = '';
                            for(i=0; i<data.length; i++)
                            {
                                
                                htmlTable1 +="<div><div class='row'>"+
                                "<div class='col-md-4'>"+
                                    "<p>"+"Customer Code : "+"<b>C"+data[i].c_id.padStart(5, '0')+"</b>"+"</p>"+
                                "</div>"+
                                "<div class='col-md-4'>"+
                                    "<p>"+"Customer Name : "+"<b>"+data[i].c_name+"</b>"+"</p>"+
                                "</div>"+
                                "<div class='col-md-4'>"+
                                    "<p>"+"Phone Number : "+"<b>"+data[i].c_phone+"</b>"+"</p>"+
                                "</div>"+
                                '</div>'+
                                "<div class='row'>"+
                                "<div class='col-md-3'>"+
                                    "<p>"+"Org : "+"<b>"+data[i].c_org+"</b>"+"</p>"+
                                "</div>"+
                                "<div class='col-md-3'>"+
                                    "<p>"+"IP : "+"<b>"+data[i].public_ip+"</b>"+"</p>"+
                                "</div>"+
                                "<div class='col-md-3'>"+
                                    "<p>"+"System Type: "+"<b>"+data[i].sys_type+"</b>"+"</p>"+
                                "</div>"+
                                "<div class='col-md-3'>"+
                                    "<p>"+"Branch Amount: "+"<b>"+data[i].num_branch+"</b>"+"</p>"+
                                "</div>"+
                                "</div></div>"
                                htmlTable1 +='<table class="table table-bordered" style="width:100%"><thead><tr class="">'+
                                        '<th>No</th>'+
                                        '<th>Service Name</th>'+
                                        '<th>Duration</th>'+
                                        '<th>Start Date</th>'+
                                        '<th>Expire Date</th>'+
                                        '<th>Price</th>'+'</tr>';
                                if(data[i].serv_host_id != 0 && data[i].serv_main_id != 0){
                                    htmlTable1 +='<tr class="">'+
                                        '<td>1</td>'+
                                        '<td>'+data[i].host_name+'</td>'+
                                        '<td>'+data[i].host_duration+'</td>'+
                                        '<td>'+data[i].start_date_host+'</td>'+
                                        '<td>'+data[i].exp_date_host+'</td>'+
                                        '<td>$'+data[i].host_price+'</td>'+'</tr>'+
                                    '<tr class="">'+
                                        '<td>2</td>'+
                                        '<td>'+data[i].main_name+'</td>'+
                                        '<td>'+data[i].main_duration+'</td>'+
                                        '<td>'+data[i].start_date_main+'</td>'+
                                        '<td>'+data[i].exp_date_main+'</td>'+
                                        '<td>$'+data[i].main_price+'</td>'+'</tr>'+
                                    '<tr><th colspan="6" class="text-right">Total Price:&nbsp;$'+data[i].num_branch * (parseInt(data[i].host_price)+parseInt(data[i].main_price))+'</th></tr></thead></table><br/>';
                                }else{
                                    if(data[i].serv_host_id != 0){
                                        htmlTable1 +='<tr class="">'+
                                        '<td>1</td>'+
                                        '<td>'+data[i].host_name+'</td>'+
                                        '<td>'+data[i].host_duration+'</td>'+
                                        '<td>'+data[i].start_date_host+'</td>'+
                                        '<td>'+data[i].exp_date_host+'</td>'+
                                        '<td>$'+data[i].host_price+'</td>'+'</tr>'+
                                        '<tr><th colspan="6" class="text-right">Total Price:&nbsp;$'+data[i].num_branch * (parseInt(data[i].host_price))+'</th></tr></thead></table></br>';
                                    }
                                    if(data[i].serv_main_id != 0){
                                        htmlTable1 +='<tr class="">'+
                                        '<td>1</td>'+
                                        '<td>'+data[i].main_name+'</td>'+
                                        '<td>'+data[i].main_duration+'</td>'+
                                        '<td>'+data[i].start_date_main+'</td>'+
                                        '<td>'+data[i].exp_date_main+'</td>'+
                                        '<td>$'+data[i].main_price+'</td>'+'</tr>'+
                                        '<tr><th colspan="6" class="text-right">Total Price:&nbsp;$'+data[i].num_branch * (parseInt(data[i].main_price))+'</th></tr></thead></table><br/>';
                                    }
                                }
                            }
                        $('#customerListExpDetail').html(htmlTable1);
                        },
                        error: function()
                        {
                            alert('Could not Edit Data');
                        }
                });
            });
        });
    </script>
</head>

<body>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#"><h3>Flexible Solution</h3></a>
                <a class="navbar-brand hidden" href="#">F</a>
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
                                <a class="btn btn-primary btn-ok" id="btnSaveChange">Save Change</a>
                            </div>
                        </div>
                    </div>
                </div>   
                <div class="modal fade" id="alertExpModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">List Customer Expire Detail</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="customerListExpDetail">
                            
                                
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>