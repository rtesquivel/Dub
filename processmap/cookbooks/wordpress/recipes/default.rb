
include_recipe "apache2"
include_recipe "mysql::server"
include_recipe "php"
include_recipe "php::module_mysql"
include_recipe "apache2::mod_php5"
include_recipe "phpmyadmin"
include_recipe "git"

if node.has_key?("ec2")
  server_fqdn = node['ec2']['public_hostname']
else
  server_fqdn = node['fqdn']
end

node.set_unless['wordpress']['db']['password'] = secure_password

directory "#{node['wordpress']['dir']}" do
  owner "vagrant"
  group "vagrant"
  mode "0755"
  action :create
  recursive true
end

directory "#{node['apache']['log_dir']}" do
  owner "vagrant"
  group "vagrant"
  mode "0755"
  action :create
  recursive true
end

execute "mysql-install-wp-privileges" do
  command "/usr/bin/mysql -u root -p\"#{node['mysql']['server_root_password']}\" < #{node['mysql']['conf_dir']}/wp-grants.sql"
  action :nothing
  notifies :run, "execute[create #{node['wordpress']['db']['database']} database]", :immediately
end

template "#{node['mysql']['conf_dir']}/wp-grants.sql" do
  source "grants.sql.erb"
  owner "root"
  group "root"
  mode "0600"
  variables(
    :user     => node['wordpress']['db']['user'],
    :password => node['wordpress']['db']['password'],
    :database => node['wordpress']['db']['database']
  )
  notifies :run, "execute[mysql-install-wp-privileges]", :immediately
end

execute "create #{node['wordpress']['db']['database']} database" do
  command "/usr/bin/mysqladmin -u root -p\"#{node['mysql']['server_root_password']}\" create #{node['wordpress']['db']['database']}"    
  action :nothing
end

file "/etc/php5/apache2/php.ini" do
  action :delete
end

# link /etc/php5/cli/php.ini
link "/etc/php5/apache2/php.ini" do
  to "/etc/php5/cli/php.ini"
end

package "php5-curl" do
  action :install
end

apache_site "000-default" do
  enable false
end

web_app "process" do
  template "wordpress.conf.erb"
  docroot "#{node['wordpress']['dir']}"
  server_name server_fqdn
  server_aliases node['wordpress']['server_aliases']
end


