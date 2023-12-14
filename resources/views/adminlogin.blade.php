<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Adminlogin</title>

        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">

        <style>
            .custom-login{
                height: 500px;
                padding-top:100px;
                box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            }
            .admin-l{
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
                <h2 class="text-center admin-l">Admin Login</h2>
                <div class="col-sm-4 col-sm-offset-4">
                    <div>
                        <span class="text-danger err"></span>
                        <div class="form-group">
                            <label for="Email" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                            <span class="text-danger email_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="Password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                            <span class="text-danger password_err"></span>
                        </div>
                        <button class="btn btn-primary" id="login_btn">Login</button>

                        <div class="form-group">
                            <h4>Don't have an account ? -
                                 <a class="form-lable" href="/register">Register</a>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script>
            $(document).ready(function(){
                $('#login_btn').click(function(e){

                    $.ajaxSetup({
                        header: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                e.preventDefault();
                var email = $("#email").val();
                var password = $("#password").val();

                $.ajax({
                        type: 'post',
                        url: 'admin_login',
                        data:{
                            _token: '{{csrf_token()}}',
                            email:email,
                            password:password,
                        },
                        success:function(data){
                        if($.isEmptyObject(data.error)){
                            if(data.success){
                                console.log(data.success);
                                $('.email_err').html('');
                                $('.password_err').html('');
                                window.location  = "{{route('admindash')}}";
                                }else{
                                    clearerror();
                                    $('.email_err').html('');
                                    $('.password_err').html('');
                                    $('.err').html(data.notexists);
                                }
                            }
                            else{
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
                    $('.email_err').html('');
                    $('.password_err').html('');
                }
        });
        </script>
    </body>
</html>
