#!/bin/sh

###############################################################################
#  Deploy Script                                                              #
#                                                                             #
#  Author: Victor Tesoura Júnior  <txsoura@yahoo.com>                         #
###############################################################################
#                                                                             #
#  This script, is to be used after a release is made in the server.          #
#                                                                             #
###############################################################################

composer install --no-interaction --prefer-dist --optimize-autoloader

php artisan cache:clear
php artisan migrate --force
