<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Post:</h1>
    <form action="post" method="post">
        Title:<input type="text" name="title"><br>
        Content:<textarea name="content" rows="3" cols="5"></textarea>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="submit" value="Create Post">
    </form>
</body>
</html>