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
$ bin/gulp watch # or bin/gulp build
```

The server mut be given write access to these folders:
```
embobidon-www/don/var/
```

You can refer to the Symfony documentation on [setting up permissions](http://symfony.com/doc/current/book/installation.html#book-installation-permissions)


## Updating

```sh
$ cd embibidon-www
$ git pull origin master
$ cd don/
$ composer.phar update
$ npm update
$ bin/gulp watch
```

## Deploying

Before uploading to production:

```sh
$ cd embobidon-www/don
$ bin/console clear:cache
$ bin/console clear:logs
$ bin/gulp deploy
```

## Usage


### Thumbnails

To regenerate thumbnails in htdocs/don/img/pics:

```sh
# Install ImageMagick and GNU parallel if you don't have them
$ sudo apt-get install imagemagick parallel

$ embobidon-www/don/bin/generate-thumbnails.sh
```
