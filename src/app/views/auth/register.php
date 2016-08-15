<div class="auth-box">
    <form method="POST" action="<?= url('auth/register')?>">
        <label for="">Username</label><br/>
        <input class="form-input" name="" type="text" value="" placeholder="Username"/><br/>
        
        <label for="">Name</label><br/>
        <input class="form-input" name="name" type="text" value="" placeholder="Name"/><br/>

        <label for="">E-mail</label><br/>
        <input class="form-input" name="email" type="text" value="" placeholder="Email"/><br/>


        <label for="">Password</label><br/>
        <input class="form-input" name="password" type="password" value="" placeholder="Password"/><br/>

        <label for="">Confirm password</label><br/>
        <input class="form-input" name="password_confirmation" type="password" value="" placeholder="Confirm password"/><br/>

        <button class="auth-button" type="submit">Register</button> <a href="<?= url('auth/login')?>">Already have an account? Login</a>
    </form>
</div>

