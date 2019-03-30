<?php
    //include the header and top bar
    $pagetitle = "Login";
    include ("pageComponents/topBar.php");
?>

<h1 class ="title">Attendee Questions for a Speaker</h1>
<!--- Input box --->
<div class="container">
    <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Sign in to access room</div>
                <!-- <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div> -->
            </div>
            <div style="padding-top:30px" class="panel-body" >
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                <form id="loginform" class="form-horizontal" method="POST" action="x.php">
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email" maxlength="255">
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password" maxlength="255">
                    </div>
                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls ">
                            <a id="btn-login" href="#" class="btn btn-success useButton" onclick="window.location.href = 'select-room.php';">Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--- End of input box --->

<?php
    include ("pageComponents/footer.php");
?>
