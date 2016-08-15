<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Nero</title>

        <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>

        <!-- css -->
        <?= css('css/main.css'); ?>
        <?= css('css/shCore.css'); ?>
        <?= css('css/shThemeDefault.css'); ?>

        <!-- code highlighting -->
        <?= javascript('js/shCore.js') ?>
        <?= javascript('js/shBrushPhp.js') ?>
    </head>
    <body>
        <div class="top-menu">
            <div class="logo">
                <h1><a href="<?= url("/"); ?>">Nero</a></h1>
            </div>
            <ul>
                <li><a href="<?= url('docs')?>">Documentation</a></li>
                <li><a href="<?= url('forum')?>">Forum</a></li>
                <li><a href="<?= url('/')?>">About</a></li>
            </ul>
        </div>
        
