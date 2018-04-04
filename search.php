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

    <title>Quantox backend developer test</title>

    <!-- Bootstrap core CSS -->
    <link href="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
        body {
            padding-top: 3.5rem;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="./index.php">Quantox</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="./index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./login.php">Login</a>
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

<main role="main">
    <div class="container">
        <?php if (isset($_POST['search']) && $_SESSION['valid']) {
            $userFactory = new \Quantox\Domain\Factories\Base\UserFactory();
            $repo        = $userFactory::getRepository();
            $users       = $repo->search($_POST['search']);

            if ($users->count() > 0) { ?>
                <!-- Example row of columns -->
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($results as $result) {?>
                        <tr>
                            <th scope="row"><?= $result->getId(); ?></th>
                            <td><?= $result->getName(); ?></td>
                            <td><?= $result->getUsername(); ?></td>
                            <td><?= $result->getEmail(); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                <hr>
            <?} else { ?>
                <p>Please login first!</p>
            <?php
            }
        }
        ?>

    </div> <!-- /container -->

</main>

<footer class="container">
    <p>&copy; Company 2017-2018</p>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/popper.min.js"></script>
<script src="./vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>
