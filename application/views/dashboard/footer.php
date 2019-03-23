<script>
        // function to get all the service hosting into the renew selection
        function getRenewHost(hostId){
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
                    $('#serviceHostRenew').html(htmlServiceHost);
                },
                error: function()
                {
                    alert('Could not get system type from database');
                }
            });
        }
        // function to get all all the service maintenance into renew selection
        function getRenewMain(mainId){
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
                    $('#serviceMainRenew').html(htmlServiceMain);
                },
                error: function()
                {
                    alert('Could not get system type from database');
                }
            });
        }
        // function to calculate the the expire date when we renew the expire customer 
        function calRenewExpire(type){
            var serviceStartDate = '';
            var serv_id = '';
            if(type == 1){
                serviceStartDate = document.getElementById("hostRenewDate").value;
                serv_id = document.getElementById("serviceHostRenew").value;
            }
            if(type == 2){
                serviceStartDate = document.getElementById("mainRenewDate").value;
                serv_id = document.getElementById("serviceMainRenew").value;
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
                        $('input[name=hostRenewExpDate]').val(someFormattedDate);
                    }
                    if(type == 2){
                        $('input[name=mainRenewExpDate]').val(someFormattedDate);
                    }
                },
                error: function()
                {
                    alert('Could not get system type from database');
                }
            });
        }   
        // function to get the customer expire and alter into bell
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
            getExpireDate(); // auto call the function getExpireDate()
            $('#changePass').click(function(){
                $('#myChangePasswordModal').modal('show');
                $('#myChangePassForm').attr('action', '<?php echo base_url() ?>user/changePassword');
            });
             // validation current user login change password
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
            // function to load the modal pop-up list all the customer expire
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
                            var currentDate = new Date().toISOString().slice(0,10); 
                            var totalHostPrice = 0;
                            var totalMainPrice = 0;
                            for(i=0; i<data.length; i++)
                            {
                                var AmountDiffHostDay = Math.floor((Date.parse(data[i].exp_date_host) - Date.parse(currentDate) ) / 86400000);
                                var AmountDiffMainDay = Math.floor((Date.parse(data[i].exp_date_main) - Date.parse(currentDate) ) / 86400000);
                                var host_price;
                                var main_price;
                                if(data[i].exp_date_host != "0000-00-00" && data[i].exp_date_host != ""){
                                    if(AmountDiffHostDay > 7){
                                        host_price = 0; 
                                    }else{
                                        host_price = parseInt(data[i].host_price);
                                    }
                                }else{
                                    host_price = 0;
                                }
                                if(data[i].exp_date_main != '0000-00-00' && data[i].exp_date_main != ''){                       
                                    if(AmountDiffMainDay > 7){
                                        main_price = 0; 
                                    }else{
                                        main_price = parseInt(data[i].main_price);
                                    }
                                }else{
                                    main_price = 0;
                                }
                                
                                htmlTable1 +='<tr class="">'+
                                        '<td>'+'<a title="Renew" href="javascript:;" class="item-renew" data="'+data[i].c_id+'"><button class="btn btn-primary btn-sm"><i class="fa fa-repeat" aria-hidden="true"></i></button></a>'+'</td>'+
                                        '<td>'+"C"+data[i].c_id.padStart(5, '0')+'</td>'+
                                        '<td>'+data[i].c_name+'</td>'+
                                        '<td>'+data[i].c_phone+'</td>'+
                                        '<td>'+data[i].c_org+'</td>'+
                                        '<td>'+data[i].sys_type+'</td>'+
                                        '<td>$'+data[i].num_branch * host_price+'</td>'+
                                        '<td>$'+data[i].num_branch * main_price+'</td>'+
                                        '</tr>';
                                        totalHostPrice += data[i].num_branch * host_price;
                                        totalMainPrice += data[i].num_branch * main_price;
                            }
                            htmlTable1 +='<tr><th colspan="6" class="text-right">Total Price:&nbsp;</th>'+
                            '<th>$'+totalHostPrice+'</th>'+
                            '<th>$'+totalMainPrice+'</th>'+
                            '</tr>';
                        $('#customerListExpDetail').html(htmlTable1);
                        },
                        error: function()
                        {
                            alert('Could not Edit Data');
                        }
                });
            });
            // get all the information when renew customer 
            $('#customerListExpDetail').on('click', '.item-renew', function()
            {
                var id = $(this).attr('data');
                $('#renewModal').modal('show');
                $('#hostRenewDate').datepicker({
                    uiLibrary: 'bootstrap4',
                    format: 'yyyy-mm-dd'
                });
                $('#mainRenewDate').datepicker({
                    uiLibrary: 'bootstrap4',
                    format: 'yyyy-mm-dd'
                });
                $('#renewForm').attr('action', '<?php echo base_url() ?>customer/renewService');
                $.ajax({
                    type: 'ajax',
                    method: 'get',
                    url: '<?php echo base_url() ?>customer/editCustomer',
                    data: {id: id},
                    async: false,
                    dataType: 'json',
                    success: function(data){
                        $('input[name=hostRenewDate]').val(data.start_date_host);
                        $('input[name=hostRenewExpDate]').val(data.exp_date_host);
                        $('input[name=mainRenewDate]').val(data.start_date_main);
                        $('input[name=mainRenewExpDate]').val(data.exp_date_main);
                        $('input[name=cusId]').val(data.c_id);
                        getRenewHost(data.serv_host_id);
                        getRenewMain(data.serv_main_id);
                    },
                    error: function()
                    {
                        alert('Could not get an customer expire Data');
                    }
                });
            });
            // renew the service expire 
            $('#btnRenew').click(function()
            {
                var url = $('#renewForm').attr('action');
                var data = $('#renewForm').serialize();
                $.ajax({
                    type: 'ajax',
                    method: 'post',
                    url: url,
                    data: data,
                    async: false,
                    dataType: 'json',
                    success: function(response){
                        if(response.success){
                            $('#renewModal').modal('hide');
                            $('#alertExpModal').modal('hide');
                            $('#renewForm')[0].reset();
                            getExpireDate();
                            customerList();
                        }else{
                            alert('Error');
                        }
                    },
                    error: function(){
                        alert('Could not add data');
                    }
                });
            });
        });
    </script>
</body>
</html>