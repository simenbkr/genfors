
# genfors

##### Voting application for small things and stuff, but isn't really superoverdimensioned


## Install (Ubuntu)

#### Install packages
```bash
sudo apt-get update
sudo apt -y install software-properties-common
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt install php7.4 libapache2-mod-php7.4 php7.4-fpm mariadb-server php7.4-mysql
```

### Setup database
```bash
sudo mysql -u root -p -e "CREATE USER 'genfors'@'localhost' IDENTIFIED BY '<password>';"
sudo mysql -u root -p -e "CREATE database genfors;"
sudo mysql -u root -p -e "GRANT ALL PRIVILEGES ON genfors.* TO 'genfors'@'localhost'; flush privileges"
mysql -u genfors -p genfors < genfors.sql # Get the database-templatethingy
```

### Setup webserver
Write the below into ```/etc/apache2/sites-available/genfors.conf```
```
<VirtualHost *:80>
	ServerAdmin <mailaddress>
	ServerName <domain.tld>
	DocumentRoot /var/www/genfors/www/
	ErrorLog ${APACHE_LOG_DIR}/genfors-error.log
	CustomLog ${APACHE_LOG_DIR}/genfors-access.log combined
</VirtualHost>
```

```
sudo a2ensite genfors
```

### Move all files and stuff
```
cd /var/www && git clone https://github.com/simenbkr/genfors.git
vim config.php # Fix your config with the usernames/passwords required
mkdir genfors/sessions
chown -R www-data:www-data genfors/sessions
chown -R www-data:www-data genfors/www
```
Remember to update the SECRET in the configuration file.

### Run!

```
sudo a2enmod php7.4
sudo systemctl restart apache2
```

### Create your own admin user 
By modifying ```create_admin_user.php```


### Setup TLS using LetsEncrypt
```
sudo add-apt-repository ppa:certbot/certbot
sudo apt install python-certbot-apache
sudo certbot
```