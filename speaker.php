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
            <textarea id="demo" oninput='this.style.height = "";this.style.height = this.scrollHeight + "px"'>This is a question maaaaaaaaate</textarea>
        </div>
        <script type="text/javascript">
            $('#selections li').click(function() {
            $('#demo').html($(this).text());
            });
        </script>
    </body>
</html>
