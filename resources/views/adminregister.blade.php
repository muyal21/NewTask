<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Admin</title>

        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
        
        <style>
            .custom-login{
                height: 500px;
                padding-top:100px;
                
            }
            .admin-r{
                margin-bottom: 40px;
                font-weight:600;
                color: #3a969b;
            }
            .form-group{
                color: #5f7091;
        
            }
        </style>
    </head>
    <body>
        <div class="container custom-login">
            <div class="row">
                <h2 class="text-center admin-r" >Admin Register</h2>
                <div class="col-sm-4 col-sm-offset-4">
                    <div>
                        <span class="text-danger err"></span>
                        <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label" >Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name" >
                        <span class="text-danger name_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1" class="form-label" >Email address</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" >
                        <span class="text-danger email_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="form-label" >Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" >
                        <span class="text-danger password_err"></span>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1" class="form-label" >Confirm Password</label>
                        <input type="password" name="confirmpassword" class="form-control" id="confirmpassword" placeholder="Confirm your password" >
                        <span class="text-danger confirmpassword_err"></span>
                    </div>

                    <!-- New address fields -->
                    <div id="address-container">
                        <div class="form-group">
                            <label for="address1" class="form-label">Address 1</label>
                            <input type="text" name="address[]" class="form-control" placeholder="Enter your address">
                        </div>
                    </div>
                    <button type="button" class="btn btn-success" id="add-address-btn">Add Other Address</button>

                    <br>
                    <button class="btn btn-primary" id="register_btn">Register</button>
                    </div>
                </div>
            </div>    
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#register_btn').click(function(e){
                var name = $('#name').val();
                var email = $("#email").val();
                var password = $("#password").val();
                var confirmpassword = $("#confirmpassword").val();

                var addresses = $("input[name='address[]']")
                .map(function () {
                    return $(this).val();
                })
                .get();

                var dataString = $('form').serialize();

                dataString = dataString.replace(/&?addresses=%5B%5D/, '');

                $.ajaxSetup({
                        header: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                
                    $.ajax({
                            type: 'post',
                            url: 'admin_register',
                            dataType: 'JSON',
                            
                            data:{ 
                                _token: '{{csrf_token()}}',
                                name:name,
                                email:email,
                                password:password,
                                confirmpassword:confirmpassword,
                                addresses: JSON.stringify(addresses),
                                dataString
                                },
                            
                            success:function(data){
                            if($.isEmptyObject(data.error)){  
                                if(data.success){
                                    alert(data.success);
                                    $('.name_err').html('');
                                    $('.email_err').html('');
                                    $('.password_err').html('');
                                    $('.confirmpassword_err').html('');
                                    window.location  = "{{route('login')}}";
                                    
                                }
                                if(data.exists){
                                    clearerror();
                                    $('.err').html(data.exists);                              
                                }
                            }else{
                                clearerror();
                                printErrorMsg(data.error);
                            }
                            }
                    });
            });
            function printErrorMsg(msg)
            {
                $.each(msg,function(key,value){
                    $('.'+key+'_err').html(value);
                });
            }
            function clearerror()
                {
                    $('.name_err').html('');
                    $('.email_err').html('');
                    $('.password_err').html('');
                    $('.confirmpassword_err').html('');
                }
        });
        </script>
        <script>
            $(document).ready(function () {
                $("#add-address-btn").click(function () {
                    var newAddressInput = '<div class="form-group">' +
                        '<label for="address" class="form-label">Address ' + ($("#address-container").children().length + 1) + '</label>' +
                        '<input type="text" name="address[]" class="form-control" placeholder="Enter your address">' +
                        '</div>';
                    $("#address-container").append(newAddressInput);
                });
            });
        </script>
    </body>
</html>