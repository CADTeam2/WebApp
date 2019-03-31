<?php
    //include the header and top bar
    $pagetitle = "Questions";
    include ("pageComponents/topBar.php");
?>
        <h1>Header</h1>
        <div class="list">
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
				echo '<li>'.$x[0]."<div style='display: none;'>".'-'.$x[1].'</div></li>';
			}
			echo '</ul>';

        ?>
        </div>
        <!--/list-->
        <div class="submissionblock">
            <button type="button" onclick="return Refresh();">Refresh</button>
			<form action="put.php?" method="get">
			<textarea type="text" name="sessionID" id="questionID" style="display: none;"><?php echo "$sessionID"; ?></textarea>
            <textarea style="font-size: 35px;" rows="10%" cols="40%" id="demo" readonly="true" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'>Please select a question</textarea>
			<textarea type="text" name="user" id="question" rows="1" cols="5">question id will appear here</textarea>
			<input type="submit" name="complete" id="y" value="Completed">
			</form>
			<form action="speaker.php?<?php echo $head; ?>">
				<input type="submit" value="Go to Moderator" />
			 </form>
			
        </div>
        <script type="text/javascript">
            $('#selections li').click(function() {
				var question = $(this).text();
				var compQuestion = question.split('-')[0];
				var questionIdentification = question.split('-')[1]
            $('#demo').html(compQuestion);
			$('#question').html(questionIdentification);
            });
			
			function Refresh() {
				window.location.reload(true);
			}
        </script>
    </body>
</html>
