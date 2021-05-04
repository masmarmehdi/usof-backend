<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<h1>Login</h1>
    <form action="check" method="post">
        Email:<input type="email" placeholder="Email" name="email"><br>
        Password:<input type="password" placeholder="Password" name="password"><br>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type='submit' value="Login">
    </form>
</body>
</html>