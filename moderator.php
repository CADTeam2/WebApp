<?php
    //include the header and top bar
    $pagetitle = "Questions";
    include ("pageComponents/topBar.php");
	$head = $_GET['sessionID'];
	
	$sessionID = $_GET['sessionID'];
	$url = "https://cadgroup2.jdrcomputers.co.uk/api/questions/session/{$sessionID}";
    $jsondata = file_get_contents($url);
	$json = json_decode($jsondata, true);
	
	$nameURL = "https://cadgroup2.jdrcomputers.co.uk/api/sessions/{$sessionID}";	
	$nameJsonData = file_get_contents($nameURL);
	$nameJson = json_decode($nameJsonData, true);
	//$roomTitle = json_decode(file_get_contents("https://cadgroup2.jdrcomputers.co.uk/api/sessions/{$sessionID}"), true)
	echo '<h1 id="sessionName">'.$nameJson['sessionName'].'</h1>';
	$allowQuest = $nameJson['acceptingQuestions'];
	$date = date('Y-m-d H:i:s');
	$x = explode(' ', $date);

	echo "
	<script>
	    	$(document).ready(function() {
		var sessionCode = $head;
		toggleEnable = function(){
			$.ajax({
				url: 'https://cadgroup2.jdrcomputers.co.uk/api/sessions/' + $head,
				dataType: 'json'
			}).done(function (request){
				if(request.acceptingQuestions == 1){
					$('#acceptButton').attr('value', 'Disable questions');
					$('#acceptButton').css({'background-color': '#e83e3e', 'border-color': '#a52b2b'});

				} else if (request.acceptingQuestions == 0){
					$('#acceptButton').attr('value', 'Enable questions');
					$('#acceptButton').css({'background-color': '#1dba68', 'border-color': '#258265'});
				}
			});
			} 
		 toggleEnable();
		}); 
	</script>
		 "
?>
<!--Refresh Button and speaker button-->
	
<div id="optionsButtons">
	<div  id="refreshButton"  class="btn btn-success useButton" onclick="return Refresh();" style="padding: 7px;">Refresh</div>
	<div  id="speakerButton"  class="btn btn-success useButton" onclick="window.location.href = 'speaker.php?sessionID=<?php echo "$sessionID"; ?>'" style="padding: 7px;">Go to Speaker</div>
	<div><p>Time since last refresh: <time datetime='<?php echo "$x[0]"; ?>T<?php echo "$x[1]"; ?>' ></time></p></div>
</div>
<div class="list">

    <?php
		$output = '<ul id="selections" class="list-group">';
		foreach($json as $question) {
			$id = $question['userID'];
			$users = "https://cadgroup2.jdrcomputers.co.uk/api/users/{$id}";
			$userdata = file_get_contents($users);
			$userjson = json_decode($userdata, true);
			$output .= "<li class='list-group-item'>".$userjson['username'].": ".$question['question']."<div style='display: none;'>".'-'.$question['questionID']."</div></li>";
		}
		$output .= "</ul>";
		echo $output;
	?>
</div>


<div class="submissionBlock">


	<!--<input type="checkbox" id="questionAllow" name="questionsOnOff" value="Submit"/>-->
	<form action="put.php" method="get">
		<div id= "accepting">
			<input type="submit" id="acceptButton"class="btn btn-success acceptButton" name="enable" value="Enable questions"onclick="" style="padding: 7px;">
		</div>
		<textarea readonly type="text" class="form-control" rows="1" cols="1" name="userName" id="uName" >Username</textarea>
        <textarea type="text" name="updatedq" id="updateq" class="form-control" rows="5" cols="65" maxlength="250">On click questions will appear here... In this box...</textarea>
		<!-- submit, delete and modify priority stuff -->
		<h4>Set Question Priority - 1 is highest</h4>
		<div id="modifyOptions" style="">
			<input type="submit" class="btn btn-success" name="submission" id="submitBtn" value="Submit" onclick="if(confirm('Are you sure you want to submit this question?')) return true; return false;">
			<input type="submit" class="btn btn-success" name="delete" id="deleteBtn" value="Delete Question" onclick="if(confirm('Are you sure you want to delete this question?')) return true; return false;">
			<div class="col-xs-3 col-ys-1">
				<select name="priority" type="text" class="form-control" >
					<option value="4">4</option>
					<option value="3">3</option>
					<option value="2">2</option>
					<option value="1">1</option>
				</select>
			</div>
		</div>
		<!-- end of modifyOptions -->
		<br>
		<textarea type="text" name="enableQuest" id="enableQues" style="display: none;"><?php echo "$allowQuest"; ?></textarea>
		<textarea type="text" name="sessionID" id="questionID" style="display: none;"><?php echo "$sessionID"; ?></textarea>
		<textarea type="text" name="user" id="question" rows="1" cols="5" style="display: none">question id will appear here</textarea>
		
	</form>

</div>
	<script src="jquery.timeago.js" type="text/javascript"></script>
	<script type="text/javascript">
	  $('#selections li').click(function() {
		var question = $(this).text();
		var username = question.split(':')[0];
		var nQuestion = question.split(':')[1];
		var compQuestion = nQuestion.split('-')[0];
		var questionIdentification = nQuestion.split('-')[1]
		$('#uName').html(username.trim());
	    $('#updateq').html(compQuestion.trim());
		$('#question').html(questionIdentification);
	  });
	  function Refresh() {
		  window.location.reload(true);
	  }
	  $('time').timeago();

	  
	</script>
</body>
</html>
