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
                                        <li><a href="#"><strong>Dashboard / </strong></a></li>
                                        <li><a href="#"><b>&nbsp;System Type</b></a></li>
                                        
                                    </ol>
                                </div>
                            </div>
                            <button id="btnAddSystem" class="btn btn-success pull-right">Add New</button><br><br>
                        </div>
                    </div>
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
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="btnSave">Save</button>
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
    function systemList(){
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: '<?php echo base_url() ?>systemtype/getSystemList',
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
                                '<td>'+data[i].sys_type+'</td>'+
                                '<td>'+
                                    '<a title="Edit System" href="javascript:;" class="item-edit" data="'+data[i].sys_id+'"><i class="fa fa-pencil-square fa-fw text-warning"></i></a>&nbsp;'+
                                    '<a title="Delete System" href="javascript:;" class="item-delete" data="'+data[i].sys_id+'"><i class="fa fa-trash fa-fw text-danger"></i></a>&nbsp;'+
                                '</td>'+
                            '</tr>';
                    id++;
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
        //delete system 
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
                    url: '<?php echo base_url() ?>systemtype/deleteSystem',
                    data:{id:id},
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                            $('#deleteModal').modal('hide');
                            $('.alert-success').html('System Deleted successfully').fadeIn().delay(4000).fadeOut('slow');
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
            $('#myForm').attr('action', '<?php echo base_url() ?>systemtype/addSystem');
        });
        // edit system
        $('#systemListData').on('click', '.item-edit', function()
        {
            var id = $(this).attr('data');
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Edit System');
            $('#myForm').attr('action', '<?php echo base_url() ?>systemtype/updateSystem');
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: '<?php echo base_url() ?>systemtype/editSystem',
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
