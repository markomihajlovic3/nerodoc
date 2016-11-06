<!-- SCROLL CAPSULE -->
<div class="scroll-section">
    <div class="scroll-capsule">
	<ul>
	    <li><a href="#first-section"><i class="fa fa-circle active-nav" aria-hidden="true"></i></a></li>
	    <li><a href="#second-section"><i class="fa fa-circle" aria-hidden="true"></i></a></li>
	    <li><a href="#third-section"><i class="fa fa-circle" aria-hidden="true"></i></a></li>
	</ul>
	
    </div>
</div>

<!-- FIRST SECTION -->
<div id="first-section">
    <div class="first-wrap">
	<!-- If the user is not logged in -->
        <?php if(!container('Auth')->check()): ?>
            <a href="<?= url('auth/register')?>">
                <div class="flat-box">
                    <h1>Register</h1>
                    <p>Register and make an account to access the forums.</p>
                    <p>You can ask questions and delve deep into the framework. It's a place for Nero community.</p>
                </div>
            </a>

            <a href="<?= url('forum')?>">
                <div class="flat-box">
                    <h1>Forums</h1>
                    <p>Join the forums and be a part of the Nero community.We are a friendly bunch of people aimed at helping each other
		    out with whatever problems that we face.</p>
                </div>
            </a>

            <a href="<?= url('docs')?>">
                <div class="flat-box">
                    <h1>Documentation</h1>
                    <p>Read up on the official Nero documentation.</p>
                    <p>Here you will find all the references you need when working with Nero itself.</p>
                </div>
            </a>
        <?php else: ?>
	    <!-- If the user is logged in -->
            <div class="logged-wrapper">
		<?php $user = container('Auth')->user(); ?>


		<!-- user information -->
		<h1><a href="<?= url('profile/'. $user->username); ?>"><?= $user->name; ?></a></h1>
		<img alt="" src="<?= url('users/'. $user->username . "/" . $user->profile_image);?>"/>

		<!-- flash message -->
		<?php if($flash = flash('welcome')): ?>
		    <div class="flash">
			<h5><?= $flash;?></h5>
		    </div>
		<?php endif; ?>

		<p>Welcome to the Nero framework <?= $user->name;?>, I hope you will enjoy your stay! You can browse
		    the documentation to learn more about the framework, or jump right into discussion with other members at the forum.
		</p>

            </div>
        <?php endif; ?>
    </div>
</div>


<!-- SECOND SECTION -->
<div id="second-section">
    <div class="second-wrap">
            <div class="intro-code">
                <h1>Powerful and simple code</h1>
                
                <pre class="brush: php">
class IntroController extends BaseController
{
    /**
     * Welcome to the Nero framework
     *
     * @return awesome
     */
    public function welcome($id, Request $request)
    {
        //lets get the data using a Model
        $data['user'] = User::find($id);

        //lets greet the user with our new data
        return view()->add('nero/welcome', $data);
    }
}
                </pre>

            </div>

            <div class="intro-text">
                <h1>Unleash your creativity</h1>
                <p>Nero is a lightweight PHP MVC framework. This is a project that was started as a means to learn as much as possible about PHP  modern web development.
            Here you will find official documentation and forums to help you get to grips with the framework.
            This is primarily a learning experience, code can and will be improved, and you are encouraged to contribute.
                </p>

                <p>
            You will be able to read my own posts which will be aimed at inspiring you on your own coding journey and motivate you to code like never before. I'm a
            strong believer that if you want to learn something about a programming topic you better try and build it, if it's feasible ofcourse. This project is a
            result of my inquiry into PHP frameworks. Laravel in particular.
                </p>

                <p>Besides being an MVC framework, other features include Laravel style routing, request filters, dependency injection container, query builder and active record
                implementation based on Laravel Eloquent. Take a look at the source code and check out my implementations.</p>
            </div>
        </div>



	<div class="clearfix"></div>
</div>
</div>


<div id="third-section">
    <div class="zen-quote">
        <h1>Let simplicity be your window into the world.</h1>
        <p>Daily message from Nero</p>
    </div>
</div>


