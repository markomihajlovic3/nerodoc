<div class="auth-box">
    <form method="POST" action="<?= url('auth/register')?>">
        <div class="form-group">
            <label for="">Username</label>
            <input class="form-control" name="username" type="text" value="<?= old('username')?>" placeholder="Username"/>
        </div>
        
        <div class="form-group">
            <label for="">Name</label>
            <input class="form-control" name="name" type="text" value="<?= old('name')?>" placeholder="Name"/>
        </div>

        <div class="form-group">
            <label for="">E-mail</label>
            <input class="form-control" name="email" type="text" value="<?= old('email')?>" placeholder="Email"/>
        </div>

        <div class="form-group">
            <label for="">Password</label>
            <input class="form-control" name="password" type="password" value="<?= old('password')?>" placeholder="Password"/>
        </div>

        <div class="form-group">
            <label for="">Confirm password</label>
            <input class="form-control" name="password_confirmation" type="password" value="<?= old('password_confirmation')?>" placeholder="Confirm password"/>
        </div>

        <button class="btn btn-default" type="submit">Register</button> <a href="<?= url('auth/login')?>">Already have an account? Login</a>
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

