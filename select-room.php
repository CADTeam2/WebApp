<?php
    //include the header and top bar
    $pagetitle = "Select Room";
    include ("pageComponents/topBar.php");
?>

<script>
//check room code against db, if it exists: display details and activate the room select button
//If it doesn't exist: display "Room not found" and deactivate the button


$(document).ready(function() {
	toggleEventInfo = function(){
	     if($("#event").css("visibility") == "hidden"){
			 $("#event").css({"visibility": "visible"});
			 $("#showButton").html("Hide Event Details");
		 } else
	     if($("#event").css("visibility") == "visible"){
			 $("#event").css({"visibility": "hidden"});
			 $("#showButton").html("Show Event Details");
		 }		 
	}
	
    checkRoomCode = function(){
    var sessionCode = $("#roomCodeInput").val();
    if(sessionCode!=""){
		//get data for the session
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
				//format the minutes and hours so that they don't lose their 0s
                var startHour = sd.getHours();
				var startMinute = sd.getMinutes();
				var endHour = sd.getHours();
				var endMinute = sd.getMinutes();
				if(parseInt(startHour) < 9){
					startHour = "0" + startHour;
				}
				if(parseInt(startMinute) < 9){
					startMinute = "0" + startMinute;
				}
				if(parseInt(endHour) < 9){
					endHour = "0" + endHour;
				}
				if(parseInt(endMinute) < 9){
					endMinute = "0" + endMinute;
				}
				//set the date and start and end times as a string to spit onto the box
                time = sd.getDate()+"/"+sd.getMonth()+"/"+sd.getFullYear()+" "+ startHour+":"+startMinute+" - "+endHour+":"+endMinute;
            } else {
                time = "Date and time TBC"
            }
            $("#sessionDetails").html(
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
			$("#showButton").attr("onclick", "toggleEventInfo()");
			$("#showButton").css({"background-color": "#79c6ce", "border-color": "#528b91", "color": "black"});
            var eventCode = request.eventID;
			
			//get event data
			$.ajax({
				url: "https://cadgroup2.jdrcomputers.co.uk/api/events/" + eventCode,
				dataType: "json"
			}).done(function (eventData){
				if(eventData.eventName!=null){
					var eventName = eventData.eventName;
				} else{ var eventName = "";}
				if(eventData.street!=null){
					var eventStreet = eventData.street;
				} else{ var eventStreet = "";}
				if(eventData.city!=null){
					var eventCity = eventData.city;
				} else{ var eventCity = "";}
				if(eventData.postcode!=null){
					var eventPost = eventData.postcode;
				} else{ var eventPost = "";}
			    if(eventData.contactNo!=null){
					var eventPhone = eventData.contactNo;
				} else{ var eventPhone = "";}
				if(eventData.email!=null){
					var eventEmail = eventData.email;
				} else{ var eventEmail = "";}
				
			       $("#eventDetails").html(
                "<div id='EDName'>"
                +eventName
                +"</div></br><div id='EDstreet'>"
                +eventStreet
                +"</div><div id='EDcity'>"
                +eventCity
                +"</div><div id='EDpostcode'> Post/zip Code: "
                +eventPost
                +"</div> <br> Contact information: <div id='EDemail'>"
				+eventEmail
				+"</div> <div is='EDphone'>"
				+eventPhone
				+"</div>"
				
				
				
				);
				})
			
			
			
			
			
        }).fail(function (e){
                $("#sessionDetails").html("Room not found");
				$("#eventDetails").html("Event not found");
				$("#btn-login").attr("href", "");
				$("#btn-login").css({"background-color": "#a7a8aa", "border-color": "#9b9999", "color": "#eae5e5"});
				$("#showButton").css({"background-color": "#a7a8aa", "border-color": "#9b9999", "color": "#eae5e5"});
				$("#showButton").attr("onclick", "");
				
            });
        } else {
            $("#sessionDetails").html(" ");
			$("#eventDetails").html(" ");
            //(disable the Join room button)
			$("#btn-login").attr("href", "");
			$("#btn-login").css({"background-color": "#a7a8aa", "border-color": "#9b9999", "color": "#eae5e5"});
			$("#showButton").css({"background-color": "#a7a8aa", "border-color": "#9b9999", "color": "#eae5e5"});
			$("#showButton").attr("onclick", "");
        }
		//get data for the event
		
    }
});
</script>

<h1 class ="title">Attendee Questions for a Speaker</h1>

<!--- Input box --->
<div class="container" style="z-index: 2;">
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
                <div style="margin-bottom: 25px" class="roomDetails" id="sessionDetails"></div>
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

<div style="text-align: center;">
	<div  id="showButton"  class="btn btn-success useButton" onclick="" style="padding: 7px; text-align: center; background-color:#a7a8aa; border-color:#9b9999; color:#eae5e5;">Show Event details</div>
</div>
<div id = "event" class="" style="visibility: hidden; position: fixed; top: 12vw; width: 20vw; left: 10vw;">
	<div id="loginbox" class="mainbox ">
        
		<div class="panel panel-info" >
			<div class="panel-heading">
				<div class="panel-title">Event details</div> 
			</div>
			<div style="padding-top:30px; text-align:center;" class="panel-body" >
				<div style="margin-bottom: 25px" class="roomDetails" id="eventDetails"></div>
			</div>
		</div>
	</div>


</div>





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

