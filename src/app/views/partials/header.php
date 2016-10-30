<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Nero</title>

        <!-- Google web font -->
        <link href='https://fonts.googleapis.com/css?family=Lato:100,400' rel='stylesheet' type='text/css'>

        <!-- css -->
        <?= css('css/main.css'); ?>
        <?= css('css/shCore.css'); ?>
        <?= css('css/shThemeDefault.css'); ?>

        <!-- bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


        <!-- code highlighting -->
        <?= javascript('js/shCore.js') ?>
        <?= javascript('js/shBrushPhp.js') ?>
    </head>
    <body>
        <div class="top-menu">
            <nav class="main-nav">
                <h1 class="logo">Nero</h1>

                <ul>
                    <li>
                        <a class="nav-item" href="<?= url('docs')?>">Documentation</a>
                    </li>

                    <li>
                        <a class="nav-item" href="<?= url('forum')?>">Forum</a>
                    </li>

                    <li>
                        <a class="nav-item" href="<?= url('/')?>">About</a>
                    </li>

                    <li>
                        <?php if(container('Auth')->check()):?>
                            <a class="nav-item" href="#">Profile</a>
                        <?php else: ?>
                            <a class="nav-item" href="<?= url('auth/login')?>">Login</a>
                        <?php endif; ?>
                    </li>

                    <li>
                        <?php if(container('Auth')->check()):?>
                            <a class="nav-item" href="<?= url('auth/logout')?>">Logout</a>                      
                        <?php endif; ?>
                    </li>
                </ul>
            </nav>

            <div class="clearfix"></div>
        </div>
        
