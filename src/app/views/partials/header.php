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

	<!-- Font awesome -->
	<script src="https://use.fontawesome.com/67e6db4897.js"></script>
    </head>
    <body>
        <div class="top-menu">
            <nav class="main-nav">
                <h1 class="logo"><a href="<?= url('/')?>">Nero</a></h1>

                <ul>
                    <li>
                        <a class="nav-item" href="<?= url('docs')?>">Documentation</a>
                    </li>

                    <li>
                        <a class="nav-item" href="<?= url('forum')?>">Forum</a>
                    </li>
                    <li>
                        <?php if(container('Auth')->check()):?>
                            <a class="nav-item" href="<?= url('profile/' . container('Auth')->user()->username)?>">Profile</a>
                        <?php else: ?>
                            <a class="nav-item" href="<?= url('auth/login')?>">Login</a>
                        <?php endif; ?>
                    </li>

                </ul>

		<?php if($user = container('Auth')->user()): ?>
		    <div class="logged-in-as">
			<h4><i class="fa fa-user-o" aria-hidden="true"></i>  <a href="<?= url('profile/'.$user->username); ?>"><?= $user->name;?></a><a href="<?= url('auth/logout')?>"><i class="fa fa-sign-out" aria-hidden="true"></i></a></h4>

		    </div>
		<?php endif; ?>

            </nav>



            <div class="clearfix"></div>
        </div>
        
