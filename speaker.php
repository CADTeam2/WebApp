<?php
    //include the header and top bar
    $pagetitle = "Questions";
    include ("pageComponents/topBar.php");
?>
        <h1>Header</h1>
        <div class="list">
        <?php
            $jsondata = file_get_contents('https://cadgroup2.jdrcomputers.co.uk/api/questions');
            $json = json_decode($jsondata, true);
			$questions = array();
            foreach($json as $question) {
                $line = $question['priority']."".$question['question'];
				$line2 = substr($line,0 , 1);
				if ($line2 != 0) {
					array_push($questions, $line);
				}
            }
			sort($questions);
			echo '<ul>';
			foreach($questions as $ques) {
				$quest = "".$ques;
				$q = substr($quest, 1);
				echo '<li>'.$q.'</li>';
			}
			echo '</ul>';

        ?>
        </div>
        <!--/list-->
        <div class="submissionblock">
            <button type="button" onclick="return Refresh();">Refresh</button>
            <textarea style="font-size: 35px;" rows="10%" cols="40%" id="demo" readonly="true" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'>Please select a question</textarea>
			<form action="moderator.php">
				<input type="submit" value="Go to Moderator" />
			</form>
        </div>
        <script type="text/javascript">
            $('#selections li').click(function() {
            $('#demo').html($(this).text());
            });
			
			function Refresh() {
				window.location.reload(true);
			}
        </script>
    </body>
</html>
