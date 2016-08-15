<div class="auth-box">
    <form method="POST" action="<?= url('auth/login')?>">
        <label for="">Username</label><br/>
        <input class="form-input" name="" type="text" value="" placeholder="Username"/><br/>

        <label for="">Password</label><br/>
        <input class="form-input" name="password" type="password" value="" placeholder="Password"/><br/>

        <button class="auth-button" type="submit">Login</button> <a href="<?= url('auth/register')?>">Don't have an account? Register</a>
    </form>
</div>


