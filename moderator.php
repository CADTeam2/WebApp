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
?>
	<!--Refresh Button and speaker button-->
<div id="optionsButtons" style="padding-left: 10px; padding-bottom: 30px;">
	<div  id="refreshButton"  class="btn btn-success useButton" onclick="return Refresh();" style="padding: 7px;">Refresh</div>
	<div  id="speakerButton"  class="btn btn-success useButton" onclick="window.location.href = 'speaker.php?sessionID=<?php echo "$sessionID"; ?>'" style="padding: 7px;">Go to Speaker</div>
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
		<div style="display:inline;">
			<h3>Accept Questions?</h3>
			<input type="submit" class="btn btn-success acceptButton" name="enable" value="Enable!"onclick="" style="padding: 7px;">
		</div>
        <textarea type="text" name="updatedq" id="updateq" class="form-control" rows="10" cols="65" maxlength="250">On click questions will appear here... In this box...</textarea>
		<!-- submit, delete and modify priority stuff -->
		<h4>Set Question Priority</h4>
		<div id="modifyOptions" style="">
			<input type="submit" class="btn btn-success" name="submission" id="submitBtn" value="Submit!" onclick="if(confirm('Are you sure you want to submit this question?')) return true; return false;">
			<input type="submit" class="btn btn-success" name="delete" id="deleteBtn" value="Delete Question!" onclick="if(confirm('Are you sure you want to delete this question?')) return true; return false;">
			<div class="col-xs-2 col-ys-1">
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
		<textarea readonly type="text" name="userName" id="uName" style="display: none">Username</textarea>
		<textarea type="text" name="enableQuest" id="enableQues" style="display: none;"><?php echo "$allowQuest"; ?></textarea>
		<textarea type="text" name="sessionID" id="questionID" style="display: none;"><?php echo "$sessionID"; ?></textarea>
		<textarea type="text" name="user" id="question" rows="1" cols="5" style="display: none">question id will appear here</textarea>
		
	</form>

</div>
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
	  
	  
	</script>
</body>
</html>
