#
#--------------------------------------------------------------------------
# Image Setup
#--------------------------------------------------------------------------
#

FROM antarccub/laravel-workspace

MAINTAINER Antarccub <antarccub@gmail.com>

ENV APP_ENV=production
ENV APP_DEBUG=false
ENV APP_LOG=daily
ENV APP_LOG_LEVEL=error
ENV APP_URL="http://localhost"

ENV DB_HOST=db
ENV DB_PORT=3306
ENV DB_DATABASE=identity-db
ENV DB_USERNAME=root
ENV DB_PASSWORD=secret

ENV MAIL_DRIVER=smtp
ENV MAIL_HOST=smtp.mailtrap.io
ENV MAIL_PORT=2525
ENV MAIL_USERNAME=null
ENV MAIL_PASSWORD=null
ENV MAIL_ENCRYPTION=null

# Setting up environment
COPY . /var/www/html/app/