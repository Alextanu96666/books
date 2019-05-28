<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
    <input type="text" name="the Name">
    <input type="file" name="theFile" value="Välj fil">
    <input type="submit" value="send">
</form>
<pre>
    <?php
    
    $path = realpath('./') . '/uploaded_files/' . uniqid() . '.csv';
    var_dump($_FILES);
    move_uploaded_file($_FILES['theFile']['tmp_name'], $path);

    ?>
</body>
</html>