<?php
    //include the header and top bar
    $pagetitle = "Speaker";
    include ("pageComponents/topBar.php");
?>
        <h1>Header</h1>
        <div class="list">
        <?php
            $jsondata = file_get_contents('https://cadgroup2.jdrcomputers.co.uk/api/questions');
            $json = json_decode($jsondata, true);
            $output = '<ul id="selections">';
            foreach($json as $question) {
                $output .= "<li>Question: ".$question['question']."</li>";
            }
            $output .= "</ul>";
            echo $output;
        ?>
        </div>
        <!--/list-->
        <div class="flip">
            <button type="button" onclick="myFunction()">Refresh</button>
            <textarea style="font-size: 35px;" rows="10%" cols="40%" id="demo" readonly="true" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'>Please select a question</textarea>
        </div>
        <script type="text/javascript">
            $('#selections li').click(function() {
            $('#demo').html($(this).text());
            });
        </script>
    </body>
</html>
