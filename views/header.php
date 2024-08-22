<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $page ?>
    </title>
    <link rel="stylesheet" href="/assets/css/global.css">
    <link rel="stylesheet" href="/assets/css/main.css">
</head>

<body>
    <header>
        <div class="row">
            <div class="col">
                <div class="wrapper">
                    <nav>
                        <ul class="flex">
                            <?php if (isset($_SESSION['id'])) {
                                foreach ($loggedInMenu as $prop => $val) {
                                    if ($val == 'active') {
                                        print_r("<li><a href='/$prop'>$prop</a></li>");
                                    }
                                }
                            } else {
                                foreach ($loggedOutMenu as $prop => $val) {
                                    if ($val == 'active') {
                                        print_r("<li><a href='/$prop'>$prop</a></li>");
                                    }
                                }
                            } ?>


                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>