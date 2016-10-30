<div class="auth-box">
    <img alt="" src="<?= url('images/profile-icon1.png')?>"/>

    <form method="POST" action="<?= url('auth/login')?>">
        <div class="form-group">
            <label for="">Username</label>
            <input class="form-control" name="username" type="text" value="<?= old('username') ?>" placeholder="Username"/>
        </div>

        <div class="form-group">
            <label for="">Password</label>
            <input class="form-control" name="password" type="password" value="" placeholder="Password"/>
        </div>
        
        <button class="btn btn-default" type="submit">Login</button> <a href="<?= url('auth/register')?>">Don't have an account? Register</a>
    </form>

    <!-- Lets output the errors if there are any -->
    <?php if(hasErrors()): ?>
        <ul class="error-list">
        <?php foreach(errors() as $error): ?>
            <li><?= $error?></li>
        <?php endforeach;  ?>
        </ul>
    <?php endif; ?>
</div>


