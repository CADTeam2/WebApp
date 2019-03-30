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
            $output = '<ul id="selections">';
            foreach($json as $question) {
                $output .= "<li>".$question['userID'].": ".$question['question']."<div style='display: none;'>".'-'.$question['questionID']."</div></li>";
            }
            $output .= "</ul>";
            echo $output;
        ?>
        </div>
        <!--/list-->
        <div class="submissionblock">
            <button type="button" onclick="return Refresh();">Refresh</button>
            <textarea style="font-size: 35px;" rows="10%" cols="40%" id="demo" readonly="true" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'>Please select a question</textarea>
			<form action="moderator.php">
				<input type="submit" value="Go to Speaker" />
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
