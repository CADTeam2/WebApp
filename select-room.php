<?php
//check code against db, 
//include the header and top bar
$pagetitle = "Select Room";
include ("includes/topBar.php");
?>
<h1 class ="title">Attendee Questions for a Speaker</h1>

<!--- Input box --->
    <div class="container">    
        <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Input room code</div>
                        <!-- <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div> -->
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >
     
                            <div style="margin-bottom: 25px" class="input-group">

                                        <input id="login-username" type="text" class="form-control" name="username" value="" placeholder="Room code"style="text-align: center; width: 300px;">                                        
                                    </div>
                            

                            <!---  Talk details  --->							
                            <div style="margin-bottom: 25px" class="roomDetails">
                                
								</div>

                            <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                                    <div class="col-sm-12 controls ">
                                      <a id="btn-login" href="#" class="btn btn-success useButton" onclick="//dostuff">Join room  </a>
                                    </div>
                            </div> 
								
                            
                    </div>                     
            </div>  
        </div>
    </div>
<!--- End of input box --->

<?php
include ("includes/footer.php");
?>