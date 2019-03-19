                <div class="container">
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="float-left">
                                <div class="page-title">
                                    <ol class="breadcrumb text-right">
                                        <li><a href="#"><strong>Dashboard</strong> / </a></li> 
                                        <li><a href="#"><b>&nbsp;User</b></a></li>
                                        
                                    </ol>
                                </div>
                            </div>
                            <button id="btnAddUser" class="btn btn-success pull-right">Add New</button><br><br>
                        </div>
                    </div>      
                    <!-- <div class="alert alert-success" style="display: none;"></div> -->
                    <table id="userList" class="table table-striped table-bordered text-center" style="width:100%">
                        <thead>
                            <tr>
                                <td>Code</td>
                                <td>Name</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody id="userListData">
                        
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
                                        <label for="userName" class="col-sm-4 col-form-label">User Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="userName" id="userName" placeholder="User Name" required=""/>
                                            <span class="text-danger"><small id="msgUserName"></small></span>
                                        </div>
                                    </div>	 
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-4 col-form-label">Password <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required=""/>
                                            <span class="text-danger"><small id="msgPass"></small></span>
                                        </div>
                                    </div>     
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="btnSave" data-dismiss="modal">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="myEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Edit User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="myEditForm" action="" method="post" class="">
                                    <input type="hidden" name="txtEditId" value="">
                                    <div class="form-group row">
                                        <label for="userEditName" class="col-sm-4 col-form-label">User Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="userEditName" id="userEditName" placeholder="User Name" required=""/>
                                            <span class="text-danger"><small id="msgUserEditName"></small></span>
                                        </div>
                                    </div>	   
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="btnUpdate" data-dismiss="modal">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Confirm Delete User</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Do you want to delete this user?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" id="btnDelete">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .row -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->
    <!-- Right Panel --> 
<script>
    function userList(){
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: '<?php echo base_url() ?>user/getUserList',
            async: false,
            dataType: 'json',
            success: function(data)
            {
                var html = '';
                var id = 1;
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
                                '<td>'+id+'</td>'+
                                '<td>'+data[i].u_name+'</td>'+
                                '<td>'+status+'</td>'+
                                '<td>'+
                                    '<a title="Edit user" href="javascript:;" class="item-edit" data="'+data[i].u_id+'"><i class="fa fa-pencil-square fa-fw text-warning"></i></a>&nbsp;'+
                                    '<a title="Delete user" href="javascript:;" class="item-delete" data="'+data[i].u_id+'"><i class="fa fa-trash fa-fw text-danger"></i></a>&nbsp;'+
                                '</td>'+
                            '</tr>';
                    id++;
                }
                $('#userListData').html(html);
                $('#userList').DataTable();
            },
            error: function(){
                alert('Could not get Data from Database');
            }
        });
    }
    $(function(){
        userList();
        //delete user 
        $('#userListData').on('click', '.item-delete', function()
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
                    url: '<?php echo base_url() ?>user/deleteUser',
                    data:{id:id},
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                            $('#deleteModal').modal('hide');
                            $('.alert-success').html('User Deleted successfully').fadeIn().delay(4000).fadeOut('slow');
                            userList();
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
        // Add New user
        $('#btnAddUser').click(function()
        {
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Add New User');
            $('#myForm').attr('action', '<?php echo base_url() ?>user/addUser');
        });
        // edit user
        $('#userListData').on('click', '.item-edit', function()
        {
            var id = $(this).attr('data');
            $('#myEditModal').modal('show');
            $('#myEditForm').attr('action', '<?php echo base_url() ?>user/updateUser');
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: '<?php echo base_url() ?>user/editUser',
                data: {id: id},
                async: false,
                dataType: 'json',
                success: function(data){
                    $('input[name=userEditName]').val(data.u_name);
                    $('input[name=txtEditId]').val(data.u_id);
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
            var userName = $('input[name=userName]');
            var password = $('input[name=password]');
            var result = '';
            if(userName.val()==''){
                $("#msgUserName").text("User Name cannot be null");
            }else{
                $("#msgUserName").text("");
                result +='a';
            }
            if(password.val()==''){
                $("#msgPass").text("Password cannot be null");
            }else{
                $("#msgPass").text("");
                result +='b';
            }
            if(result=='ab'){
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
                            $('.alert-success').html('User added successfully').fadeIn().delay(4000).fadeOut('slow');
                            userList();
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
        // validation btnUpdate 
        $('#btnUpdate').click(function()
        {
            var url = $('#myEditForm').attr('action');
            var data = $('#myEditForm').serialize();
            //validate form
            var userName = $('input[name=userEditName]');
            var result = '';
            if(userName.val()==''){
                $("#msgUserEditName").text("User Name cannot be null");
            }else{
                $("#msgUserEditName").text("");
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
                            $('#myEditModal').modal('hide');
                            $('#myEditForm')[0].reset();
                            $('.alert-success').html('User updated successfully').fadeIn().delay(4000).fadeOut('slow');
                            userList();
                        }else{
                            alert('Error');
                        }
                    },
                    error: function(){
                        alert('Could not update data');
                    }
                });
            }else{
                
            }
        });
    });

</script>
</body>
</html>