<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/login.css">
</head>
<body>
    <main>
        <form>
            <h1>Iniciar Sesion</h1>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="username">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="username">

            <input type="submit" value="Iniciar Sesion">

            <p>¿No tienes cuenta? <a href="<?php constant('URL') ;?>signup"> Registrate</a></p>
        </form>
    </main>
</body>
</html>