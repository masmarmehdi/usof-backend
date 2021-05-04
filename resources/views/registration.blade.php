<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Register</h1>
    <form action="store" method="post">
        Name:<input type="text" placeholder="Name" name="name"><br>
        Email:<input type="email" placeholder="Email" name="email"><br>
        Password:<input type="password" placeholder="Password" name="password"><br>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type='submit' value="register">
    </form>
</body>
</html>