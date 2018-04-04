<?php
/**
 * Created by PhpStorm.
 * User: petar
 * Date: 4.4.18.
 * Time: 10.59
 */

require_once './vendor/autoload.php';

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
                <a class="nav-link active" href="./login.php">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./register.php">Register</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="./search.php">
            <input class="form-control mr-sm-2" name="search" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>

<?php if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    $userFactory = new \Quantox\Domain\Factories\Base\UserFactory();
    $repo        = $userFactory::getRepository();
    $user        = $repo->login($_POST['username'], $_POST['password']);

    if ($user) {
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time(); ?>
        <h1>Welcome, <?= $user->getName(); ?></h1>
<?php
    }?>
<?php
}
?>
    <form class="form-signin" action="./login.php">
        <img class="mb-4" src="./assets/img/quantox.jpg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Please sing in</h1>
        <label for="inputUsername" class="sr-only">Email address</label>
        <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" name="login" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
    </form>
</body>
</html>
