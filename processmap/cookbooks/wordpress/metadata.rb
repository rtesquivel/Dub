name             "wordpress"
maintainer       "Barry Steinglass"
maintainer_email "cookbooks@opscode.com"
license          "Apache 2.0"
description      "Installs/Configures WordPress"
long_description IO.read(File.join(File.dirname(__FILE__), 'README.md'))
version          "1.0.0"

recipe "WordPress", "Installs and configures WordPress LAMP stack on a single system"

depends "php"
depends "openssl"
depends "apache2"
depends "mysql"

supports "debian"
supports "ubuntu"


attribute "WordPress/dir",
  :display_name => "WordPress installation directory",
  :description => "Location to place WordPress files.",
  :default => "/data/www/process"

attribute "WordPress/db/database",
  :display_name => "WordPress MySQL database",
  :description => "WordPress will use this MySQL database to store its data.",
  :default => "wordpressdb"

attribute "WordPress/db/user",
  :display_name => "WordPress MySQL user",
  :description => "WordPress will connect to MySQL using this user.",
  :default => "wordpressuser"

attribute "WordPress/db/password",
  :display_name => "WordPress MySQL password",
  :description => "Password for the WordPress MySQL user.",
  :default => "randomly generated"

attribute "WordPress/server_aliases",
  :display_name => "WordPress Server Aliases",
  :description => "WordPress Server Aliases",
  :default => "FQDN"
