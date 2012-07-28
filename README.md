README
------------

My simple web application to save url collection locally with note and tagging.

REQUIREMENTS
------------

*  PHP 5.3
*  Apache
*  MySQL Server

INSTALLATION
------------

1.  `git clone https://github.com/simukti/UrlNote.git`
2.  `cd UrlNote`
3.  `curl -O http://getcomposer.org/composer.phar` to get latest composer
4.  `php composer.phar install` to install required library
5.  create mysql database named `url_note` and set your db user and password in `application/configs/db.php`
6.  import schema in `application/data/schema.sql`
7.  create Apache virtual host, then set document_root to `/absolute/path/to/UrlNote/public` and activate your mod_rewrite with `RewriteEngine on`

SCREENSHOT
------------

![UrlNote](https://lh6.googleusercontent.com/-TTrwVUhnG0E/UBMDcJ46TZI/AAAAAAAAAAs/J21kob562YA/s700/scr_urlnote.jpg)
![UrlNote Add](https://lh4.googleusercontent.com/-k7JghlmHs84/UBMEtXQbEjI/AAAAAAAAAA0/LlUEckpQ22A/s700/scr_urlnote_add.jpg)

TODO
------------

*  Url screenshot