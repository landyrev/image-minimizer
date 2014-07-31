
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Картиночный уменьшатель</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container" id="mainBody">
        <h1>Картиночный уменьшатель</h1><br>
        <input id="dirInput" type="text" class="form-control" value="<?php /*echo(getcwd())*/ echo("/home/user1120552/www/testprofcoma/wp-content/uploads ")?>"><br>
        <button type="button" class="btn btn-default" onclick="startResize()">Начать</button>
        <p><div class="progress">
        <div id="pbar" class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
            <span class="sr-only">40% Complete (success)</span>
        </div>
    </div></p>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
        var items = [];

        function startResize() {
            $.ajax({
                async: false,
                dataType: "json",
                url: "FilesList.php?dir=" + $("#dirInput").val(),
                success: function(data) {
                    $.each(data, function(key, val) {
                        items.push(val);
                    });

                    $("#mainBody").append("<div id='status'></div>");
                    $("#mainBody").append(items.length + " Файлов найдено<br>");
                    resizer(0);
                    /*$.each(items, function(k, v) {
                        $("status").append("Обрабатываем файл " + i + "из " + items.length);
                        $.ajax({
                            url: 'resize.php?filename=' + v,
                            success: function(result) {
                                console.log(result);
                            },
                            async: false
                        })
                        i++;
                    });*/
                }
            });
        }

        function resizer(i) {
            $("#status").html("Обрабатываем файл " + i + " из " + items.length);
            $('#pbar').width( Math.floor((i / items.length) * 100) + '%' );
            $.ajax({
                url: 'resize.php?filename=' + items[i],
                success: function(result) {
                    console.log(items[i] + "<b>");
                    console.log(result);
                    i++;
                    if (i < items.length) resizer(i);
                }
            });
        }
    </script>
</body>

</html>