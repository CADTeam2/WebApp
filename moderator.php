<?php
    //include the header and top bar
    $pagetitle = "Questions";
    include ("pageComponents/topBar.php");
	$head = $_GET['sessionID'];
	echo '<h1>Room Number: '.$head.'</h1>';
?>
        <div class="list">
          <?php
	    $sessionID = $_GET['sessionID'];
	    $url = "https://cadgroup2.jdrcomputers.co.uk/api/questions/session/{$sessionID}";
        $jsondata = file_get_contents($url);
	    $json = json_decode($jsondata, true);
        $output = '<ul id="selections">';
	    foreach($json as $question) {
				$id = $question['userID'];
				$users = "https://cadgroup2.jdrcomputers.co.uk/api/users/{$id}";
				$userdata = file_get_contents($users);
				$userjson = json_decode($userdata, true);
                $output .= "<li>".$userjson['username'].": ".$question['question']."<div style='display: none;'>".'-'.$question['questionID']."</div></li>";
            }
            $output .= "</ul>";
	    echo $output;
	  ?>
	</div>

	<div class="submissionblock">
	<!--/Refresh Button-->
	<button type="button" id="refreshButton" onclick="return Refresh();">Refresh</button>
	<form action="speaker.php">
		<input type="submit" value="Go to Speaker" />
	</form>
	<div style="display: inline-block;">
		<h3>Accept Questions?</h3>
	</div>
	<input type="checkbox" id="questionAllow" name="questionsOnOff" value="Submit"/>
		<form action="put.php" method="get">
			<textarea readonly type="text" name="userName" id="uName">Username</textarea>
            <textarea type="text" name="updatedq" id="updateq" rows="10" cols="65" maxlength="250">On click questions will appear here... In this box...</textarea>
			<textarea type="text" name="user" id="question" rows="1" cols="5">question id will appear here</textarea>
				<select name="priority" type="text">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
				<textarea type="text" name="sessionID" id="questionID" style="display: none;"><?php echo "$sessionID"; ?></textarea>
             <input type="submit" name="submission"  value="Submit!" onclick="if(confirm('Are you sure you want to submit this question?')) return true; return false;">
			<input type="submit" name="delete" id="y" value="Delete Question!" onclick="if(confirm('Are you sure you want to delete this question?')) return true; return false;">
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
	  0
	  
	</script>
    </body>
</html>
