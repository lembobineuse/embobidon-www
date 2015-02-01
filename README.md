# Embobidon


## Intalling 

Dependencies:

    * [Composer](https://getcomposer.org/) for PHP dependencies.
    * [npm](https://www.npmjs.com/) for Javascript dependencies.


```sh
$ git clone https://github.com/lembobineuse/embobidon-www.git
$ cd embobidon-www/don/
$ composer.phar install
$ npm intall
$ ./node_modules/.bin/gulp
```

The server mut be given write access to these folders:
```
embobidon-www/don/cache/
embobidon-www/don/logs/
```

You can refer to the Symfony documentation on [setting up permissions](http://symfony.com/doc/current/book/installation.html#book-installation-permissions)


## Updating

```sh
$ cd embibidon-www
$ git pull origin master
$ cd don/
$ composer.phar update
$ npm update
$ ./node_modules/.bin/gulp
```

## Deploying

Before uploading to production:

Run [gulp](http://gulpjs.com/) to build statis assets (scripts, stylesheets, ...):
```sh
$ cd embobidon-www/don
$ ./node_modules/.bin/gulp
```

## Usage


### Thumbnails

To regenerate thumbnails in htdocs/don/img/pics:

```sh
# Install ImageMagick and GNU parallel if you don't have them
$ sudo apt-get install imagemagick parallel

$ embobidon-www/don/bin/generate-thumbnails.sh
```
