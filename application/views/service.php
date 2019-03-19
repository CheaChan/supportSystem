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
                                        <li><a href="<?php echo base_url('customer'); ?>"><strong>Dashboard / </strong></a></li>
                                        <li><a href="#"><b>&nbsp;Service Type</b></a></li>
                                        
                                    </ol>
                                </div>
                            </div>
                            <button id="btnAddService" class="btn btn-success pull-right">Add New</button><br><br>
                        </div>
                    </div>
                    <!-- <div class="alert alert-success" style="display: none;"></div> -->
                    <table id="serviceList" class="table table-striped table-bordered text-center" style="width:100%">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Service Name</td>
                                <td>Service Price</td>
                                <td>Service Duration</td>
                                <td>Service Type</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody id="serviceListData">
                        
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
                                        <label for="serviceName" class="col-sm-4 col-form-label">Service Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="serviceName" id="serviceName" placeholder="Service Name" required=""/>
                                            <span class="text-danger"><small id="msgServiceName"></small></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="servicPrice" class="col-sm-4 col-form-label">Service Price <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" name="servicPrice" id="servicPrice" placeholder="Serive Price" required=""/>
                                            <span class="text-danger"><small id="msgServicPrice"></small></span>
                                        </div>
                                    </div>	
                                    <div class="form-group row">
                                        <label for="serviceDuration" class="col-sm-4 col-form-label">Service Duration <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" name="serviceDuration" id="serviceDuration" placeholder="Serive Price" required=""/>
                                            <span class="text-danger"><small id="msgServiceDuration"></small></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="serviceType" class="col-sm-4 col-form-label">System Type <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <select class="custom-select" name="serviceType" id="serviceType" required="">
                                            </select>
                                            <span class="text-danger"><small id="msgServiceType"></small></span>
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
                                <h4 class="modal-title">Confirm Delete Service</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Do you want to delete this Service?
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
    function serviceList(){
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: '<?php echo base_url() ?>service/getserviceList',
            async: false,
            dataType: 'json',
            success: function(data)
            {
                var html = '';
                var id = 1;
                var i;
                var type = '';
                for(i=0; i<data.length; i++)
                {
                    if(data[i].serv_key == 1){
                        type = 'Hosting';
                    }else{
                        type = 'Maintenance';
                    }
                    html +='<tr>'+
                                '<td>'+id+'</td>'+
                                '<td>'+data[i].serv_type+'</td>'+
                                '<td>'+data[i].serv_price+'</td>'+
                                '<td>'+data[i].serv_duration+'</td>'+
                                '<td>'+type+'</td>'+
                                '<td>'+
                                    '<a title="Edit Service" href="javascript:;" class="item-edit" data="'+data[i].serv_id+'"><i class="fa fa-pencil-square fa-fw text-warning"></i></a>&nbsp;'+
                                    '<a title="Delete Service" href="javascript:;" class="item-delete" data="'+data[i].serv_id+'"><i class="fa fa-trash fa-fw text-danger"></i></a>&nbsp;'+
                                '</td>'+
                            '</tr>';
                    id++;
                }
                $('#serviceListData').html(html);
                $('#serviceList').DataTable();
            },
            error: function(){
                alert('Could not get Data from Database');
            }
        });
    }
    $(function(){
        serviceList();
        //delete service 
        $('#serviceListData').on('click', '.item-delete', function()
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
                    url: '<?php echo base_url() ?>service/deleteService',
                    data:{id:id},
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                            $('#deleteModal').modal('hide');
                            $('.alert-success').html('Service Deleted successfully').fadeIn().delay(4000).fadeOut('slow');
                            serviceList();
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
        // Add New service
        $('#btnAddService').click(function()
        {
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Add New Service');
            $('#myForm').attr('action', '<?php echo base_url() ?>service/addService');
            var htmlSysType ='';
                htmlSysType += "<option value='' selected>Chose...</option>";
                htmlSysType +="<option value='1'>Hosting</option>";
                htmlSysType +="<option value='2'>Maintenance</option>";  
                $('#serviceType').html(htmlSysType);
        });
        // edit service
        $('#serviceListData').on('click', '.item-edit', function()
        {
            var id = $(this).attr('data');
            $('#myModal').modal('show');
            $('#myModal').find('.modal-title').text('Edit Service');
            $('#myForm').attr('action', '<?php echo base_url() ?>service/updateService');
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: '<?php echo base_url() ?>service/editService',
                data: {id: id},
                async: false,
                dataType: 'json',
                success: function(data){
                    $('input[name=serviceName]').val(data.serv_type);
                    $('input[name=servicPrice]').val(data.serv_price);
                    $('input[name=serviceDuration]').val(data.serv_duration);
                    $('input[name=txtId]').val(data.serv_id);
                    var htmlSysType ='';
                    if(data.serv_key == 1){
                        htmlSysType +="<option value='"+data.serv_key+"' selected>Hosting</option>";
                        htmlSysType +="<option value='2' >Maintenance</option>";
                    }else{
                        htmlSysType +="<option value='"+data.serv_key+"'>Maintenance</option>"; 
                        htmlSysType +="<option value='1'>Hosting</option>";
                    }   
                        $('#serviceType').html(htmlSysType);
                },
                error: function()
                {
                    alert('Could not get Edit Data');
                }
            });
        });
        // validation bntSave for add and edit
        $('#btnSave').click(function()
        {
            var url = $('#myForm').attr('action');
            var data = $('#myForm').serialize();
            //validate form
            var serviceName = $('input[name=serviceName]');
            var servicPrice = $('input[name=servicPrice]');
            var serviceDuration = $('input[name=serviceDuration]');
            var serviceType = $('select[name=serviceType]');
            var result = '';
            if(serviceName.val()==''){
                $("#msgServiceName").text("Service Name cannot be null");
            }else{
                $("#msgServiceName").text("");
                result +='a';
            }
            if(servicPrice.val()==''){
                $("#msgServicPrice").text("Service Price cannot be null");
            }else{
                $("#msgServicPrice").text("");
                result +='b';
            }
            if(serviceDuration.val()==''){
                $("#msgServiceDuration").text("Service Duration cannot be null");
            }else{
                $("#msgServiceDuration").text("");
                result +='c';
            }
            if(serviceType.val()==''){
                $("#msgServiceType").text("Service Type cannot be null");
            }else{
                $("#msgServiceType").text("");
                result +='d';
            }
            if(result=='abcd'){
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
                            $('.alert-success').html('Service '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');
                            serviceList();
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
