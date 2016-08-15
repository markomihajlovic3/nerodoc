<div class="content-wrapper">
    <div class="home-info-box">


        <a href="#">
            <div class="flat-box">
                <h1>Register</h1>
                <p>Register and make an account to access the forums.</p>
                <p>You can ask questions and delve deep into the framework. It's a place for Nero community.</p>
            </div>
        </a>

        <a href="#">
            <div class="flat-box">
                <h1>About</h1>
                <p>Read more about motivation behind Nero code base, how it all started and more about the creative process of writing code.</p>
                <p>This is where you get all the inspiration you need.</p>
            </div>
        </a>

        <a href="">
            <div class="flat-box">
                <h1>Documentation</h1>
                <p>Read up on the official Nero documentation.</p>
                <p>Here you will find all the references you need when working with Nero itself.</p>
            </div>
        </a>

        <div class="intro-content">
            <div class="intro-code">
                <h1>Powerfull and simple code</h1>
                
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

