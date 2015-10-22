#!/usr/bin/env bash

# Update the box
# --------------
# Downloads the package lists from the repositories
# and "updates" them to get information on the newest
# versions of packages and their dependencies
sudo aptitude update

# Install nano, htop, php
sudo aptitude install -y nano htop php5

# Install robo
wget http://robo.li/robo.phar
sudo chmod +x robo.phar; mv robo.phar /usr/bin/robo

# Install composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/bin/composer
