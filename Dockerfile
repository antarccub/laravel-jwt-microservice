#
#--------------------------------------------------------------------------
# Image Setup
#--------------------------------------------------------------------------
#

FROM antarccub/laravel-workspace

MAINTAINER Antarccub <antarccub@gmail.com>

# Setting up environment
COPY . /var/www/html/app/

# Enabling sites
COPY docker/vhosts.conf /etc/nginx/sites-available/default

RUN service nginx start
RUN service php7.2-fpm start