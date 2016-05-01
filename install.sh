#!/usr/bin/env bash
USERNAME='root'
PASSWORD=''
DBNAME='db_blogphp'
HOST='localhost'

USER_USERNAME='laravelws'
USER_PASSWORD='laravelws'

MySQL=$(cat <<EOF
DROP DATABASE IF EXISTS $DBNAME;
CREATE DATABASE $DBNAME DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
DELETE FROM mysql.user WHERE user='$USER_USERNAME' and host='$USER_PASSWORD';
CREATE USER '$USER_USERNAME'@'$HOST' IDENTIFIED BY '$USER_PASSWORD' ;
GRANT ALL PRIVILEGES ON $DBNAME.* to '$USER_USERNAME'@'$HOST' WITH GRANT OPTION;
EOF
)
echo $MySQL | mysql --user=$USERNAME --password=$PASSWORD

php artisan migrate:refresh --seed

if [ ! -d "./node_modules/" ]; then
    npm install gulp -g
    npm install gulp --save-dev
    npm install gulp-sass --save-dev
    npm install gulp-minify-css --save-dev
    npm install gulp-concat --save-dev
    npm install gulp-uglify --save-dev
    npm install gulp-rename --save-dev
fi

echo 'Le script sh a bien fonctionne.'

