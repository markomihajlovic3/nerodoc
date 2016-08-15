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
