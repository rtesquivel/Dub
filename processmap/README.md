## Dev Environment

- [172.16.0.20](http://172.16.0.20)
- [PHPMyAdmin](http://172.16.0.20/phpmyadmin)
- Database User: <code>process</code>
- Database Password: <code>process</code>
- MySQL Root Password: <code>root</code>
- Vagrant Site Root <code>/data/www/process</code>

Starting up the virtual server

    $ git clone git@github.com:duarteinc/processmap.git process
    $ cd process
    $ vagrant up

Copy the <code>.htaccess.example</code> file and name it <code>.htaccess</code> to finish your installation.

After Vagrant finishes creating the virtual server, now you can import your database or start fresh. Using PHPMyAdmin to import a database dump from the production server would be ideal.

## Process site theme

    /wp-content/themes/process
