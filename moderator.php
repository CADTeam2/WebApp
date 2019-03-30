<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <title>Questions</title>
    </head>
    <body>
        <h1>Header</h1>
        <div class="list">
          <?php
	    $sessionID = $_GET['sessionID'];
	    $url = "https://cadgroup2.jdrcomputers.co.uk/api/questions/session/{$sessionID}";
            $jsondata = file_get_contents($url);
	    $json = json_decode($jsondata, true);
            $output = '<ul id="selections">';
	    foreach($json as $question) {
                $output .= "<li>".$question['userID'].": ".$question['question']."<div style='display: none;'>".'-'.$question['questionID']."</div></li>";
            }
            $output .= "</ul>";
	    echo $output;
	  ?>
	</div>

	<div class="submissionblock">
	<!--/Refresh Button-->
	<button type="button" id="refreshButton" onclick="return Refresh();">Refresh</button>
	<input type="checkbox" id="questionAllow" name="questionsOnOff" value="Submit"/>
		<form action="put.php" method="get">
            <textarea type="text" name="updatedq" id="updateq" rows="10" cols="65">On click questions will appear here... In this box...</textarea>
			<textarea type="text" name="user" id="question" rows="1" cols="5">question id will appear here</textarea>
				<select name="priority" type="text">
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
             <input type="submit" name="submission"  value="Submit!" onclick="if(confirm('Are you sure you want to submit this question?')) return true; return false;">
			<input type="submit" id="y" value="Delete Question" onclick="if(confirm('Are you sure you want to delete this question?')) return true; return false;">
		</form>

	</div>

	<script type="text/javascript">
	  $('#selections li').click(function() {
		var question = $(this).text();
		var nQuestion = question.split(':')[1];
		var compQuestion = nQuestion.split('-')[0];
		var questionIdentification = nQuestion.split('-')[1]
	    $('#updateq').html(compQuestion.trim());
		$('#question').html(questionIdentification);
	  });
	  function Refresh() {
		  window.location.reload(true);
	  }
	  
	  function confirmation() {
          var r = confirm("Are you sure you want to submit the question?");
		  if (r== true) {
			  return true;
		  } else {
			  return false;
		  }
		  

	  }
	  
	</script>
    </body>
</html>
