<div class="content-wrapper">
    <?php require_once "side-menu.php"; ?>

    <section class="documentation">
        <h1>Installation</h1>

        <p>To get started and install Nero framework you can go to  <a href="https://github.com/germancar/nero">Github repo</a> and download it like a zip file which you can extract,
        or clone the repo with git command.</p>

        <p>Once you have the framework on your local computer set it up in your localhost folder so the contents can be served by the server. You will need Apache web server with
        MySQL database installed, in other words you need a LAMP stack. </p>

        <p>After you've setup your localhost you will need to do some setting up on the Nero side of things. First things first, you need to open up the .htaccess file and edit
            the line: RewriteBase /nero/public/ . If you are using the default nero name for the folder no editing is necessary. Otherwise edit the line </p>

        <p>"RewriteBase /nero/public" to "RewriteBase /yourfolder/public/" .</p> 


        <h1>Config</h1>

        <p>Alright, with installation out of the way lets configure the framework. Open up the nero/src/app/conf.php file. It's the main config file. It should look like this:</p>

        <pre class="brush: php">
        /**
 * Return the array containing all the config information
 *
 * @return assoc array
 */
return [
    //build target, used for error reporting
    'build' => 'development',

    //database config
    'db_hostname' => 'localhost',
    'db_username' => '',
    'db_password' => '',
    'db_name'     => '',

    //default route config(used with Basic Router)
    'default_controller' => 'Welcome',
    'default_method'     => 'index',

    //site base path config
    'base_path' => 'http://localhost/nero/public/',

    //auth config
    'auth_table' => 'users',
    'auth_key' => 'email',
    'auth_return_model' => 'User' 
];
        </pre> 
        
        <p>As you can see here we have a few options. Database settings are listed first, setup your hostname(localhost if you are developing localy), username, password and
database name. Nero is using PDO behind the scenes to interact with the database, so you are safe from SQL injection and have a bit of abstraction from the raw database connection.</p>

        <p>Next we have default controller and method settings, these are used to specify which controller and method will be loaded by default if we are using BasicRouter which
        is based on CodeIgniter routing.</p>

        <p>Base path is exactly what you think it is, base url that is used when constructing url routes.</p>

        <p>Auth config specifies settings to be used with Auth service which is tasked with registering and logging in users. You can specify the user table, login key and
        return model which tells the framework which model will be used.</p>

        <p>So that's about it for setting up the framework. Hit up the welcome page( localhost/nero/public ) and you should see a splash screen page. You are ready to start
        using the framework.</p>
    </section>

</div>
