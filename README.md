# Couchbase PHP workshop
Source code for the Couchbase PHP workshop

# Preparations on MacOS


* Install/update libcouchbase
```
brew update
brew update libcouchbase
```

* Install PEAR
```
curl -O http://pear.php.net/go-pear.phar
php -d detect_unicode=0 go-pear.phar
```

* Install the Couchbase PHP SDK
```
sudo pecl install couchbase
```

* Make sure that the php.ini file is there

```
php --ini
```

* Edit the php.ini file and add the couchbase extension

```
;;;;;;;;;;;;;;;;;;;;;;
; Dynamic Extensions ;
;;;;;;;;;;;;;;;;;;;;;;
extension=couchbase.so
```

* Double check if the right ini file is loaded by executing phpinfo() on a PHP shell (php -a)

```
Loaded Configuration File => /etc/php.ini
```

These steps should more or less also work on other *IX systems.


# Start a local Web Server

```
/usr/bin/php -S "localhost:9090"
```