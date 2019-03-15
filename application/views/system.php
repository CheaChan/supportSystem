<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FlexiSolution</title>
    <link rel="stylesheet" href="<?php echo base_url("assets/vendor/bootstrap/css/bootstrap.min.css"); ?>" /> 
    <link href="<?php echo base_url() ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url("assets/vendor/datatable/css/dataTables.bootstrap4.min.css");?>" />
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/vendor/datatable/js/jquery.dataTables.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/vendor/datatable/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="https://unpkg.com/gijgo@1.9.11/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.11/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>
<body>
<nav class="navbar navbar-expand-xl navbar-light bg-secondary">
  <a class="navbar-brand" href="#">FlexiSolution</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('user/customerList'); ?>">Customer List<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('user/userList'); ?>">User List</a>
      </li>
      <li class="float-right nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Setting
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="<?php echo base_url('index.php/system'); ?>">System Type</a>
          <a class="dropdown-item" href="<?php echo base_url('index.php/service'); ?>">Service Type</a>
        </div>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
    <li class="float-right nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo $this->session->userdata['logged_in']['u_name'] ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Change Password</a>
          <a class="dropdown-item" href="<?php echo base_url('user/logout'); ?>">Sign Out</a>
        </div>
      </li>
  </ul>
  </div>
</nav>
<br>
<div class="container">
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <button id="btnAddSystem" class="btn btn-success">Add New</button><br><br>
    <!-- <div class="alert alert-success" style="display: none;"></div> -->
    <table id="systemList" class="table table-striped table-bordered text-center" style="width:100%">
        <thead>
            <tr>
                <td>Code</td>
                <td>Name</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody id="systemListData">
        
        </tbody>
    </table>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modal Title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="myForm" action="" method="post" class="">
                    <input type="hidden" name="txtId" value="0">
                    <div class="form-group row">
                        <label for="systemName" class="col-sm-4 col-form-label">System Name <span class="text-danger">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="systemName" id="systemName" placeholder="System Name" required=""/>
                            <span class="text-danger"><small id="msgSystemName"></small></span>
                        </div>
                    </div>	     
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary btn-ok" id="btnSave">Save</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirm Delete System</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Do you want to delete this System?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger" id="btnDelete">Delete</a>
            </div>
        </div>
    </div>
</div>

<script>
    function systemList(){
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: '<?php echo base_url() ?>index.php/system/getSystemList',
            async: false,
            dataType: 'json',
            success: function(data)
            {
                var html = '';
                var i;
                var status = '';
                for(i=0; i<data.length; i++)
                {
                    if(data[i].u_status == 1){
                        status = 'Active';
                    }else{
                        status = 'None-active';
                    }
                    html +='<tr>'+
                                '<td>'+'S'+data[i].sys_id.padStart(5, '0')+'</td>'+
                                '<td>'+data[i].sys_type+'</td>'+
                                '<td>'+
                                    '<a title="Edit System" href="javascript:;" class="item-edit" data="'+data[i].sys_id+'"><i class="fa fa-pencil-square fa-fw text-warning"></i></a>&nbsp;'+
                                    '<a title="Delete System" href="javascript:;" class="item-delete" data="'+data[i].sys_id+'"><i class="fa fa-trash fa-fw text-danger"></i></a>&nbsp;'+
                                '</td>'+
                            '</tr>';
                }
                $('#systemListData').html(html);
                $('#systemList').DataTable();
            },
            error: function(){
                alert('Could not get Data from Database');
            }
        });
    }
    $(function(){
        systemList();
        //delete user 
        $('#systemListData').on('click', '.item-delete', function()
        {
            var id = $(this).attr('data');
            $('#deleteModal').modal('show');
            //prevent previous handler - unbind()
            $('#btnDelete').unbind().click(function()
            {
                $.ajax({
                    type: 'ajax',
                    method: 'get',
                    async: false,
                    url: '<?php echo base_url() ?>index.php/system/deleteSystem',
                    data:{id:id},
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                            $('#deleteModal').modal('hide');
                            $('.alert-success').html('User Deleted successfully').fadeIn().delay(4000).fadeOut('slow');
                            systemList();
                        }else{
                            alert('Error');
                        }
                    },
                    error: function(){
                        alert('Error deleting');
                    }
                });
            });
        });
        // Add New system
        $('#btnAddSystem').click(function()
        {
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Add New System');
            $('#myForm').attr('action', '<?php echo base_url() ?>index.php/system/addSystem');
        });
        // edit user
        $('#systemListData').on('click', '.item-edit', function()
        {
            var id = $(this).attr('data');
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Edit System');
            $('#myForm').attr('action', '<?php echo base_url() ?>index.php/system/updateSystem');
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: '<?php echo base_url() ?>index.php/system/editSystem',
                data: {id: id},
                async: false,
                dataType: 'json',
                success: function(data){
                    $('input[name=systemName]').val(data.sys_type);
                    $('input[name=txtId]').val(data.sys_id);
                },
                error: function()
                {
                    alert('Could not Edit Data');
                }
            });
        });
        // validation bntSave for add 
        $('#btnSave').click(function()
        {
            var url = $('#myForm').attr('action');
            var data = $('#myForm').serialize();
            //validate form
            var systemName = $('input[name=systemName]');
            var result = '';
            if(systemName.val()==''){
                $("#msgSystemName").text("System Name cannot be null");
            }else{
                $("#msgSystemName").text("");
                result +='a';
            }
            if(result=='a'){
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: url,
                    data: data,
                    async: false,
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                            $('#myModal').modal('hide');
                            $('#myForm')[0].reset();
                            if(response.type=='add'){
                                var type = 'added'
                            }else if(response.type=='update'){
                                var type ="updated"
                            }
                            $('.alert-success').html('System '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');
                            systemList();
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
        
    });

</script>
</body>
</html>