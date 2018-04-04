<?php
/**
 * Created by PhpStorm.
 * User: petar
 * Date: 4.4.18.
 * Time: 10.58
 */

require_once './vendor/autoload.php';

if (isset($_POST['register']) && !empty($_POST['username']) && !empty($_POST['password'])
    && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password2'])) {
    $userFactory = new \Quantox\Domain\Factories\Base\UserFactory();
    $repo        = $userFactory::getRepository();
    $user        = $repo->create(
            array (
            'name'     => $_POST['name'],
            'username' => $_POST['username'],
            'password' => $_POST['password'],
            'email'    => $_POST['email']
            )
    );
    http_redirect('./index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Signin Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./assets/css/login.css" rel="stylesheet">
</head>

<body class="text-center">

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="./index.php">Quantox</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./login.php">Login</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="./register.php">Register</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="./search.php">
            <input class="form-control mr-sm-2" name="search" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<form class="form-signin">
    <img class="mb-4" src="./assets/img/quantox.jpg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Please register</h1>
    <label for="inputName" class="sr-only">Name</label>
    <input type="text" name="name" id="inputName" class="form-control" placeholder="Name" required autofocus>
    <label for="inputUsername" class="sr-only">Username</label>
    <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Name" required>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
    <label for="inputPassword2" class="sr-only">Repeat password</label>
    <input type="password" name="password2" id="inputPassword2" class="form-control" placeholder="Repeat password" required>
    <button class="btn btn-lg btn-primary btn-block" name="register" type="submit">Register</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
</form>
</body>
</html>
