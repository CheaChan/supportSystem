
                        
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
                                        <li><a href="#"><b>&nbsp;Customer</b></a></li>
                                        
                                    </ol>
                                </div>
                            </div>
                            <button id="btnAdd" class="btn btn-success float-right">Add New</button><br><br>
                        </div>
                    </div>
                    
                    <!-- <div class="alert alert-success" style="display: none;"></div> -->
                    <table id="customerList" class="table table-striped table-bordered text-center" style="width:100%">
                        <thead>
                            <tr>
                                <td>Code</td>
                                <td>Customer Name</td>
                                <td>Phone Number</td>
                                <td>Organization</td>
                                <td>Hosting</td>
                                <td>Maintenance</td>
                                <td>System Type</td>
                                <td>&nbsp;Action&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody id="customerListData">
                        
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
                                    <input type="hidden" name="hostExpDate" value="">
                                    <input type="hidden" name="mainExpDate" value="">
                                    <div class="form-group row">
                                        <label for="customerName" class="col-sm-4 col-form-label">Cusomter Name <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="customerName" id="customerName" placeholder="Customer Name" required=""/>
                                            <span class="text-danger"><small id="msgCusName"></small></span>
                                        </div>
                                    </div>	 
                                    <div class="form-group row">
                                        <label for="customerPhone" class="col-sm-4 col-form-label">Phone <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="customerPhone" id="customerPhone" placeholder="Customer Phone" required=""/>
                                            <span class="text-danger"><small id="msgCusPhone"></small></span>
                                        </div>
                                    </div>     
                                    <div class="form-group row">
                                        <label for="customerOrg" class="col-sm-4 col-form-label">Organization <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="customerOrg" id="customerOrg" placeholder="Customer Organization" required=""/>
                                            <span class="text-danger"><small id="msgCusOrg"></small></span>
                                        </div>
                                    </div>  
                                    <div class="form-group row">
                                        <label for="publicIP" class="col-sm-4 col-form-label">Public IP <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="publicIP" id="publicIP" placeholder="Public IP" required=""/>
                                            <span class="text-danger"><small id="msgPublicIp"></small></span>
                                        </div>
                                    </div> 
                                    
                                    <div class="form-group row">
                                        <label for="systemTypeSelect" class="col-sm-4 col-form-label">System Type <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <select class="custom-select" name="systemTypeSelect" id="systemTypeSelect" required="">
                                            </select>
                                            <span class="text-danger"><small id="msgSysType"></small></span>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="serviceHostSelect" class="col-sm-4 col-form-label">Service Host</label>
                                        <div class="col-sm-8">
                                        <select class="custom-select" name="serviceHostSelect" id="serviceHostSelect" onchange="calExpDate(1)">
                                        </select>
                                        </div>
                                    </div> 	
                                    <div class="form-group row">
                                        <label for="hostStartDate" class="col-sm-4 col-form-label">Host Start Date</label>
                                        <div class="col-sm-8">
                                            <input  type="input" class="form-control" onchange="calExpDate(1)" name="hostStartDate" id="hostStartDate" placeholder="yyyy-mm-dd">
                                        </div>
                                    </div> 	
                                    <div class="form-group row">
                                        <label for="serviceMainSelect" class="col-sm-4 col-form-label">Service Main</label>
                                        <div class="col-sm-8">
                                        <select class="custom-select" name="serviceMainSelect" id="serviceMainSelect" onchange="calExpDate(2)">
                                        </select>
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="mainStartDate" class="col-sm-4 col-form-label">Main Start Date</label>
                                        <div class="col-sm-8">
                                            <input  type="input" class="form-control" onchange="calExpDate(2)" name="mainStartDate" id="mainStartDate" placeholder="dd-mm-yyyy">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="orgBranch" class="col-sm-4 col-form-label">Number Branch <span class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" name="orgBranch" id="orgBranch" placeholder="Number of Branch" required=""/>
                                            <span class="text-danger"><small id="msgCusBranch"></small></span>
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
                                <h4 class="modal-title">Confirm Delete Customer</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Do you want to delete this customer?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" id="btnDelete">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Customer View Detail</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- <div class="" id="viewCustomerDetailContaint"></div> -->
                                <table class="" style="width:100%">
                                    <thead id="viewCustomerDetailContaint" style="width:100%">
                                    
                                    </thead>
                                </table>
                                <br/>
                                <table id="customerListDetail" class="table table-bordered" style="width:100%">
                                    <thead id="customerListDetailTable1" style="width:100%">
                                    
                                    </thead>
                                </table>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .row -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->
    <!-- Right Panel --> 
<script>
    // function to get list of customer
    function customerList(){
        $.ajax({
            type: 'ajax',
            method: 'get',
            url: '<?php echo base_url() ?>customer/getCustomerList',
            async: false,
            dataType: 'json',
            success: function(data)
            {
                var html = '';
                var i;
                for(i=0; i<data.length; i++)
                {
                    var serv_host_checked;
                    var serv_main_checked;
                    if(data[i].serv_host_id == null || data[i].serv_host_id== 0){
                        serv_host_checked = " ";
                    }else{
                        serv_host_checked = "<i class='fa fa-check fa-fw'>";
                    }
                    if(data[i].serv_main_id == null || data[i].serv_main_id ==0){
                        serv_main_checked = " ";
                        
                    }else{
                        serv_main_checked = "<i class='fa fa-check fa-fw'>";
                    }
                    html +='<tr>'+
                                '<td>'+'C'+data[i].c_id.padStart(5, '0')+'</td>'+
                                '<td>'+data[i].c_name+'</td>'+
                                '<td>'+data[i].c_phone+'</td>'+
                                '<td>'+data[i].c_org+'</td>'+
                                '<td>'+serv_host_checked+'</td>'+
                                '<td>'+serv_main_checked+'</td>'+
                                '<td>'+data[i].sys_type+'</td>'+
                                '<td>'+
                                    '<a title="View Customer" href="javascript:;" class="item-view" data="'+data[i].c_id+'"><i class="fa fa-eye fa-fw text-primary"></i></a>&nbsp;'+
                                    '<a title="Edit Customer" href="javascript:;" class="item-edit" data="'+data[i].c_id+'"><i class="fa fa-pencil-square fa-fw text-warning"></i></a>&nbsp;'+
                                    '<a title="Delete Customer" href="javascript:;" class="item-delete" data="'+data[i].c_id+'"><i class="fa fa-trash fa-fw text-danger"></i></a>&nbsp;'+
                                '</td>'+
                            '</tr>';
                }
                $('#customerListData').html(html);
                $('#customerList').DataTable();
            },
            error: function(){
                alert('Could not get Data from Database');
            }
        });
    }
    // functin get all the system type into selection
    function getSystemType(sysId){
        $.ajax({
            type: 'ajax',
            url: '<?php echo base_url() ?>customer/getSystemType',
            async: false,
            dataType: 'json',
            success: function(data)
            {
                var htmlSysType ='';
                if(sysId == null || sysId == 0){
                    htmlSysType += "<option value='' selected>Choose...</option>";
                }
                for(i=0; i<data.length; i++){
                    if(sysId == data[i].sys_id){
                        htmlSysType +="<option value='"+data[i].sys_id+"'selected>"+data[i].sys_type+"</option>";
                    }else{
                        htmlSysType +="<option value='"+data[i].sys_id+"'>"+data[i].sys_type+"</option>";
                    }
                    
                }
                $('#systemTypeSelect').html(htmlSysType);
            },
            error: function()
            {
                alert('Could not get system type from database');
            }
        });
    }
    // function to get all the service hosting into the selection
    function getServiceHost(hostId){
        $.ajax({
            type: 'ajax',
            url: '<?php echo base_url() ?>customer/getServiceHost',
            async: false,
            dataType: 'json',
            success: function(data)
            {
                var htmlServiceHost = '';
                if(hostId == null || hostId == 0){
                    htmlServiceHost += "<option value='' selected>Choose...</option>";
                }
                for(i=0; i<data.length; i++){
                    if(hostId == data[i].serv_id){
                        htmlServiceHost +="<option value='"+data[i].serv_id+"'selected>"+data[i].serv_type+"( "+data[i].serv_duration+" Months & $"+data[i].serv_price+" )"+"</option>";
                    }else{
                        htmlServiceHost +="<option value='"+data[i].serv_id+"'>"+data[i].serv_type+"( "+data[i].serv_duration+" Months & $"+data[i].serv_price+" )"+"</option>";
                    }
                    
                }
                $('#serviceHostSelect').html(htmlServiceHost);
            },
            error: function()
            {
                alert('Could not get system type from database');
            }
        });
    }
    // function to get all all the service maintenance into selection
    function getServiceMain(mainId){
        $.ajax({
            type: 'ajax',
            url: '<?php echo base_url() ?>customer/getServiceMain',
            async: false,
            dataType: 'json',
            success: function(data)
            {
                var htmlServiceMain ='';
                if(mainId == null || mainId == 0){
                    htmlServiceMain += "<option value=''selected>Choose...</option>";
                }
                for(i=0; i<data.length; i++){
                    if(mainId == data[i].serv_id){
                        htmlServiceMain +="<option value='"+data[i].serv_id+"'selected>"+data[i].serv_type+"( "+data[i].serv_duration+" Months & $"+data[i].serv_price+" )"+"</option>";
                    }else{
                        htmlServiceMain +="<option value='"+data[i].serv_id+"'>"+data[i].serv_type+"( "+data[i].serv_duration+" Months & $"+data[i].serv_price+" )"+"</option>";
                    }
                }
                $('#serviceMainSelect').html(htmlServiceMain);
            },
            error: function()
            {
                alert('Could not get system type from database');
            }
        });
    }
    // function to calculate the the expire date by add more of start date with the duration 
    function calExpDate(type){
        var serviceStartDate = '';
        var serv_id = '';
        if(type == 1){
            serviceStartDate = document.getElementById("hostStartDate").value;
            serv_id = document.getElementById("serviceHostSelect").value;
        }
        if(type == 2){
            serviceStartDate = document.getElementById("mainStartDate").value;
            serv_id = document.getElementById("serviceMainSelect").value;
        }
        $.ajax({
            type: 'ajax',
                method: 'get',
                url: '<?php echo base_url() ?>customer/calExpDate',
                data: {serv_id: serv_id},
                async: false,
                dataType: 'json',
            success: function(data)
            {
                var date = new Date(serviceStartDate);
                var newdate = new Date(date);
                newdate.setMonth(newdate.getMonth() + parseInt(data.serv_duration));
                var dd = newdate.getDate();
                var mm = newdate.getMonth() + 1;
                var y = newdate.getFullYear();
                var someFormattedDate = y + '-' + mm + '-' + dd;
                
                if(type == 1){
                    $('input[name=hostExpDate]').val(someFormattedDate);
                }
                if(type == 2){
                    $('input[name=mainExpDate]').val(someFormattedDate);
                }
            },
            error: function()
            {
                alert('Could not get system type from database');
            }
        });
    }   
    $(function(){
        customerList();
        //delete customer 
        $('#customerListData').on('click', '.item-delete', function()
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
                    url: '<?php echo base_url() ?>customer/deleteCustomer',
                    data:{id:id},
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                            $('#deleteModal').modal('hide');
                            $('.alert-success').html('Customer Deleted successfully').fadeIn().delay(4000).fadeOut('slow');
                            customerList();
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
        // Add New Customer
        $('#btnAdd').click(function()
        {
            $('#myModal').modal('show');
                $('#hostStartDate').datepicker({
                    uiLibrary: 'bootstrap4',
                    format: 'yyyy-mm-dd'
                });
                $('#mainStartDate').datepicker({
                    uiLibrary: 'bootstrap4',
                    format: 'yyyy-mm-dd'
                });
            $('#myModal').find('.modal-title').text('Add New Customer');
            $('#myForm').attr('action', '<?php echo base_url() ?>customer/addCusomter');
            getSystemType(null);
            getServiceHost(null);
            getServiceMain(null);
        });
        // edite customer
        $('#customerListData').on('click', '.item-edit', function()
        {
            var id = $(this).attr('data');
            $('#myModal').modal('show');
            $('#hostStartDate').datepicker({
                    uiLibrary: 'bootstrap4',
                    format: 'yyyy-mm-dd'
                });
                $('#mainStartDate').datepicker({
                    uiLibrary: 'bootstrap4',
                    format: 'yyyy-mm-dd'
                });
            $('#myModal').find('.modal-title').text('Edit Customer');
            $('#myForm').attr('action', '<?php echo base_url() ?>customer/updateCustomer');
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: '<?php echo base_url() ?>customer/editCustomer',
                data: {id: id},
                async: false,
                dataType: 'json',
                success: function(data){
                    $('input[name=customerName]').val(data.c_name);
                    $('input[name=customerPhone]').val(data.c_phone);
                    $('input[name=customerOrg]').val(data.c_org);
                    $('input[name=publicIP]').val(data.public_ip);
                    $('input[name=hostStartDate]').val(data.start_date_host);
                    $('input[name=hostExpDate]').val(data.exp_date_host);
                    $('input[name=mainStartDate]').val(data.start_date_main);
                    $('input[name=mainExpDate]').val(data.exp_date_main);
                    $('input[name=orgBranch]').val(data.num_branch);
                    $('input[name=txtId]').val(data.c_id);
                    getSystemType(data.sys_type_id);
                    getServiceHost(data.serv_host_id);
                    getServiceMain(data.serv_main_id);
                },
                error: function()
                {
                    alert('Could not Edit Data');
                }
            });
        });
        // validation bntSave for add & update
        $('#btnSave').click(function()
        {
            var url = $('#myForm').attr('action');
            var data = $('#myForm').serialize();
            // //validate form
            var customerName = $('input[name=customerName]');
            var customerPhone = $('input[name=customerPhone]');
            var customerOrg = $('input[name=customerOrg]');
            var publicIP = $('input[name=publicIP]');
            var systemTypeSelect = $('select[name=systemTypeSelect]');
            var serviceHostSelect = $('select[name=serviceHostSelect]');
            var hostStartDate = $('input[name=hostStartDate]');
            var serviceMainSelect = $('select[name=serviceMainSelect]');
            var mainStartDate = $('input[name=mainStartDate]');
            var orgBranch = $('input[name=orgBranch]');
            var result = '';
            if(customerName.val()==''){
                $("#msgCusName").text("Customer Name cannot be null");
            }else{
                $("#msgCusName").text("");
                result +='a';
            }
            if(customerPhone.val()==''){
                $("#msgCusPhone").text("Phone cannot be null");
            }else{
                $("#msgCusPhone").text("");
                result +='b';
            }
            if(customerOrg.val()==''){
                $("#msgCusOrg").text("Organization cannot be null");
            }else{
                $("#msgCusOrg").text("");
                result +='c';
            }
            if(publicIP.val()==''){
                $("#msgPublicIp").text("Public IP cannot be null");
            }else{
                $("#msgPublicIp").text("");
                result +='d';
            }
            if(systemTypeSelect.val()==''){
                $("#msgSysType").text("System Type cannot be null");
            }else{
                $("#msgSysType").text("");
                result +='e';
            }
            if(orgBranch.val()==''){
                $("#msgCusBranch").text("Number of Branch cannot be null");
            }else{
                $("#msgCusBranch").text("");
                result +='f';
            }
            if(result=='abcdef'){
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
                            $('.alert-success').html('Customer '+type+' successfully').fadeIn().delay(4000).fadeOut('slow');
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
        // view  customer detail
        $('#customerListData').on('click', '.item-view', function()
        {
            var id = $(this).attr('data');
            $('#viewModal').modal('show');
            $.ajax({
                type: 'ajax',
                method: 'get',
                url: '<?php echo base_url() ?>customer/viewCustomer',
                data: {id: id},
                async: false,
                dataType: 'json',
                success: function(data){
                    var textContaint = " ";
                    var htmlTable1 = '';
                    textContaint += '<tr class="">'+
                                    '<td><b>Customer Code: <b></td>'+
                                    '<td>'+"C"+data.c_id.padStart(5, '0')+'</td>'+
                                    '<td><b>Customer Name: <b></td>'+
                                    '<td>'+data.c_name+'</td>'+'</tr>'+
                                '<tr class="">'+
                                    '<td><b>Phone Number: <b></td>'+
                                    '<td>'+data.c_phone+'</td>'+
                                    '<td><b>Organization:<b></td>'+
                                    '<td>'+data.c_org+'</td>'+'</tr>'+
                                '<tr class="">'+
                                    '<td><b>Public IP: <b></td>'+
                                    '<td>'+data.public_ip+'</td>'+
                                    '<td><b>System Type:<b> </td>'+
                                    '<td>'+data.sys_type+'</td>'+'</tr>'+
                                '<tr class="">'+
                                    '<td></td>'+
                                    '<td></td>'+
                                    '<td><b>Branch Amount: <b></td>'+
                                    '<td>'+data.num_branch+'</td>'+'</tr>';
                    htmlTable1 +='<tr class="">'+
                                '<th>No</th>'+
                                '<th>Service Name</th>'+
                                '<th>Duration</th>'+
                                '<th>Start Date</th>'+
                                '<th>Expire Date</th>'+
                                '<th>Price</th>'+'</tr>';
                            if(data.serv_host_id != 0 && data.serv_main_id != 0){
                                htmlTable1 +='<tr class="">'+
                                    '<td>1</td>'+
                                    '<td>'+data.host_name+'</td>'+
                                    '<td>'+data.host_duration+'</td>'+
                                    '<td>'+data.start_date_host+'</td>'+
                                    '<td>'+data.exp_date_host+'</td>'+
                                    '<td>$'+data.host_price+'</td>'+'</tr>'+
                                '<tr class="">'+
                                    '<td>2</td>'+
                                    '<td>'+data.main_name+'</td>'+
                                    '<td>'+data.main_duration+'</td>'+
                                    '<td>'+data.start_date_main+'</td>'+
                                    '<td>'+data.exp_date_main+'</td>'+
                                    '<td>$'+data.main_price+'</td>'+'</tr>'+
                                '<tr><th colspan="6" class="text-right">Total Price:&nbsp;$'+data.num_branch * (parseInt(data.host_price)+parseInt(data.main_price))+'</th></tr>';
                            }else{
                                if(data.serv_host_id != 0){
                                    htmlTable1 +='<tr class="">'+
                                    '<td>1</td>'+
                                    '<td>'+data.host_name+'</td>'+
                                    '<td>'+data.host_duration+'</td>'+
                                    '<td>'+data.start_date_host+'</td>'+
                                    '<td>'+data.exp_date_host+'</td>'+
                                    '<td>$'+data.host_price+'</td>'+'</tr>'+
                                    '<tr><th colspan="6" class="text-right">Total Price:&nbsp;$'+data.num_branch * (parseInt(data.host_price))+'</th></tr>';
                                }
                                if(data.serv_main_id != 0){
                                    htmlTable1 +='<tr class="">'+
                                    '<td>1</td>'+
                                    '<td>'+data.main_name+'</td>'+
                                    '<td>'+data.main_duration+'</td>'+
                                    '<td>'+data.start_date_main+'</td>'+
                                    '<td>'+data.exp_date_main+'</td>'+
                                    '<td>$'+data.main_price+'</td>'+'</tr>'+
                                    '<tr><th colspan="6" class="text-right">Total Price:&nbsp;$'+data.num_branch * (parseInt(data.main_price))+'</th></tr>';
                                }

                            }
                    $('#viewCustomerDetailContaint').html(textContaint);
                    $('#customerListDetailTable1').html(htmlTable1);
                    
                },
                error: function()
                {
                    alert('Could not Edit Data');
                }
            });
        });
    });

</script>
