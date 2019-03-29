<!DOCTYPE html>
<html>
    <head>
	   <title><?php echo $pagetitle; ?></title>
        <!-- Bootstrap scripts -->
        <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script> 
        <link href="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>

        <!-- Our custome styles that take precedent over the bootstrap defaults -->
        <link rel="stylesheet" type="text/css" href="style.css">
        <link rel="icon" type="image/png" href="ImbroglioDevelopmentThinkingDogClothed.png"/>
    </head>
    <body>
        <div class="topBar">
            <img id="logo"  src="ImbroglioDevelopmentThinkingDogClothed.png" onclick="window.location.href = 'homePlaceholder.php';" >
            <a id="settings" class="glyphicon glyphicon-cog" id="settingsIcon" onclick="window.location.href = 'config.php';"></a>
        </div>
