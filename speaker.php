<?php
    //include the header and top bar
    $pagetitle = "Questions";
	$sessionID = $_GET['sessionID'];
    include ("pageComponents/topBar.php");
	$nameURL = "https://cadgroup2.jdrcomputers.co.uk/api/sessions/{$sessionID}";	
	$nameJsonData = file_get_contents($nameURL);
	$nameJson = json_decode($nameJsonData, true);
	echo '<h1 id="sessionName">'.$nameJson['sessionName'].'</h1>';
?>

		<div id="optionsButtons" style="padding-left: 10px; padding-bottom: 30px;">
			<div  id="refreshButton"  class="btn btn-success useButton" onclick="return Refresh();" style="padding: 7px;">Refresh</div>
			<div  id="speakerButton"  class="btn btn-success useButton" onclick="window.location.href = 'moderator.php?sessionID=<?php echo "$sessionID"; ?>'" style="padding: 7px;">Go To Moderator</div>
			</div>
		
        <div class="list skinnyList">
        <?php
			$sessionID = $_GET['sessionID'];
			
			$url = "https://cadgroup2.jdrcomputers.co.uk/api/questions/session/{$sessionID}";
            $jsondata = file_get_contents($url);
            $json = json_decode($jsondata, true);
			$questions = array();
			
            foreach($json as $question) {
                $line = $question['priority']."".$question['question'].'-'.$question['questionID'];
				$line2 = substr($line,0 , 1);
				if ($line2 != 0) {
					array_push($questions, $line);
				}
            }
			sort($questions);
			echo '<ul id="selections">';
			foreach($questions as $ques) {
				$quest = "".$ques;
				$q = substr($quest, 1);
				$x = explode('-', $q);
				echo '<li class="list-group-item">'.$x[0]."<div style='display: none;'>".'-'.$x[1].'</div></li>';
			}
			echo '</ul>';

        ?>
        </div>
        <!--/list-->
        <div class="viewBlock">
			<form action="put.php?" method="get">
			<textarea type="text" name="sessionID" id="questionID" style="display: none;"><?php echo "$sessionID"; ?></textarea>

			<div style="width: 60vw; height: 40vh">
				<div id= "questionPresent" style="font-size: 55px; text-align: center; color: black background-color: #9fa8da padding-top: 100px; max-width = 30vw;">
					Please select a question
				</div>
			</div>
			<textarea type="text" name="user" id="question" rows="1" cols="5" style="visibility: hidden">question id will appear here</textarea>
			<div style="padding-top: 14vh;">
				<input type="submit" class="btn useButton" name="complete" id="y" value="Completed">
			</div>
			</form>
			
        </div>
        <script type="text/javascript">
            $('#selections li').click(function() {
				var question = $(this).text();
				var compQuestion = question.split('-')[0];
				var questionIdentification = question.split('-')[1]
            $('#questionPresent').html(compQuestion);
			$('#question').html(questionIdentification);
            });
			
			function Refresh() {
				window.location.reload(true);
			}
        </script>
    </body>
</html>
