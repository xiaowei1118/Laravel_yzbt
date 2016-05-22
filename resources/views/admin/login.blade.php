<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <title>管理员登陆</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/maruti-login.css" />
    </head>
    <body>
        <div id="logo">
            <img src="img/login-logo.png" alt="" />
        </div>
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" method="POST">
				 <div class="control-group normal_text"><h3>管理员登陆</h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-user"></i></span><input name="username" type="text" placeholder="Username" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on"><i class="icon-lock"></i></span><input name="password" type="password" placeholder="Password" />
                        </div>
                    </div>
                </div>

                <div class="form-actions">
                    @foreach($errors->all as $item)
                        {{$item}}
                    @endforeach
                    <span></span>
                    <span class="pull-right">
                        <input name="submit" type="submit" class="btn btn-success" value="登录" />
                    </span>
                </div>
            </form>
        </div>
    </body>
</html>
