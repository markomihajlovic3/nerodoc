<div class="content-wrapper">
    <?php require_once "side-menu.php"; ?>

    <section class="documentation">
        <h1>Welcome to the Nero framework</h1>

        <p>Nero is a personal project started by Marko Mihajlovic and is currently in alpha phase. It started as a fun project and ended up as a valuable learning experience
        There is still much work to be done, but I decided it's time to start documenting the project as its getting bigger and bigger and more complex. This is a first attempt at
        making an official documentation. It's work in progrees</p>

        <p>Anyway, menu on the left will guide you through all the features of the framework and give you a starting point from which you can continue to explore Nero. Remember, it's
        all about learning, so dig in!</p>

        <p>To start you off, let's check out a simple controller that is rigged to respond to demo routes.</p>

        <p>The routes file is where you register your end points(routes) that you want to respond to. Here is an example</p>

        <pre class="brush: php">
//simple routes demonstrate different possible responses(views, json, redirects and simple text)
Router::register('get', '/', 'IntroController@welcome');
Router::register('get', '/json', 'IntroController@json');
Router::register('get', '/redirect', 'IntroController@redirect');
Router::register('get', '/text', 'IntroController@text');
        </pre>

        <p>And so we have an IntroController to demonstrate responses</p>

        <pre class="brush: php">

class IntroController extends BaseController
{
    public function welcome()
    {
        //lets greet the user with a view
        return view()->add('nero/welcome');
    }


    public function json()
    {
        //sample data
        $data['greeting'] = 'Welcome to Nero';

        //lets return the data in json format
        return json($data);
    }


    public function redirect()
    {
        //lets redirect the user to the welcome page
        return redirect();
    }


    public function text()
    {
        //lets just return string, which will be converted to response behind the scenes
        return "Welcome to Nero!";
    }

}
        </pre>


        <p>Alright, you've gotten a taste of Nero, its really simple, it's inspired by Laravel. So lets dig in and start reading...</p>
    </section>
</div>
