# Couchbase PHP workshop
Source code for the Couchbase PHP workshop

# Workshop Agenda

## Day 1 - Couchbase Architecture and Administration Basics

* Introduction and Use Cases
* Couchbase Server Technical Architecture
* Couchbase Server as a Distributed System
* Installation and Configuration
* Testing the Installation
* Working with Buckets
* Working with the Cluster
* Backup and Restore
* XDCR explained


## Day 2 - Using the Couchbase PHP SDK 2.x

* Document Modeling Basics
* Managing Connections
* Creating Documents
* Updating Documents
* Deleting Documents
* Querying via Views
* Error Handling and Logging
* Sample Application (Idea, Requirements, ...)
* Outlook

# Preparations on MacOS

* Prepare 3 VM-s with CentOS 6.x as your Couchbase Server node hosts
** 1.5 GB RAM
** 10 GB HDD
** Static IP-s
** Can reach each other

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

These steps should more or less also work on other *IX systems. Please follow our documentation for the installation on Windows (http://docs.couchbase.com/developer/php-2.0/download-links.html)!


# Get started

There is a PHP file 'settings.php' which contains the connection details to the Couchbase Cluster

```
define(CB_HOST, "couchbase://192.168.7.155,192.168.7.160");
define(CB_BUCKET, "workshop");
define(CB_BUCKET_PWD, "test");
```

I used Netbeans 8.x for developing this, which allows you to run the application within the PHP built-in Web Server.


```
/usr/bin/php -S "localhost:9090"
```
