<?php
    //include the header and top bar
    $pagetitle = "Select Room";
    include ("pageComponents/topBar.php");
?>

<script>
//check room code against db, if it exists: display details and activate the room select button
//If it doesn't exist: display "Room not found" and deactivate the button
$(document).ready(function() {
    checkRoomCode = function(){
    var sessionCode = $("#roomCodeInput").val();
    if(sessionCode!=""){
        $.ajax({
            url: "https://cadgroup2.jdrcomputers.co.uk/api/sessions/" + sessionCode,
            dataType: "json"
        }).done(function (request){
            var title ="";
                var speaker ="";
                var room ="";
                var time="";
				//if the date and time have both been set, convert the start and end date/times into a more aesthetic string
                if(request.startTime != null && request.endTime != null){
                    var st = request.startTime.split(/[- :]/);
                    var sd = new Date(Date.UTC(st[0], st[1]-1, st[2], st[3], st[4], st[5]));
                    var et = request.endTime.split(/[- :]/);
                    var ed = new Date(Date.UTC(et[0], et[1]-1, et[2], et[3], et[4], et[5]));
                    time = sd.getDate()+"/"+sd.getMonth()+"/"+sd.getFullYear()+" "+ sd.getHours()+":"+sd.getMinutes()+" - "+ed.getHours()+":"+ed.getMinutes();
                } else {
                    time = "Date and time TBC"
                }
                $("#details").html(
                    "<div id='RDTitle'>"
                    +request.sessionName
                    +"</div></br><div id='RDName'>"
                    +request.speaker
                    +"</div><div id='RDLocation'>"
                    +request.roomName
                    +"</div><div id='RDTime'>"
                    +time
                    +"</div>");
				$("#btn-login").attr("href", "moderator.php?sessionID="+sessionCode); //set the Join Room button to link to the correct session
				$("#btn-login").css({"background-color": "#5cb85c", "border-color": "#4cae4c", "color": "white"});
            
            }).fail(function (e){
                $("#details").html("Room not found");
				$("#btn-login").attr("href", "");
				$("#btn-login").css({"background-color": "#a7a8aa", "border-color": "#9b9999", "color": "#eae5e5"});
            });
        } else {
            $("#details").html(" ");
            //(disable the Join room button)
			$("#btn-login").attr("href", "");
			$("#btn-login").css({"background-color": "#a7a8aa", "border-color": "#9b9999", "color": "#eae5e5"});
        }
    }
});
</script>

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
                    <input id="roomCodeInput" type="text" class="form-control" name="username" value="" placeholder="Room code"style="text-align: center; width: 300px;" onkeyup="checkRoomCode()" onchange="checkRoomCode()" maxlength="255">
                </div>
                <!-- Talk details -->
                <div style="margin-bottom: 25px" class="roomDetails" id="details"></div>
                <div style="margin-top:10px" class="form-group">
                    <!-- Join Room Button -->
                    <div class="col-sm-12 controls ">
                        <a id="btn-login" href="select-room.php" class="btn btn-success useButton" style="background-color:#a7a8aa; border-color:#9b9999; color:#eae5e5;">Join room  </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End of input box -->

<?php
    include ("pageComponents/footer.php");
?>
<!-- inactive button style 
#a7a8aa background 
#9b9999 border
#eae5e5 text -->

<!-- active button style
background #5cb85c
border #4cae4c-->