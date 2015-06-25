<?php

/**
 * Couchbase Connection Manager
 *
 * @author David Maier <david.maier at couchbase.com>
 */
class ConnManager {
     
    //Instance
    private static $bucket;
    
    
    public static function getBucketCon()
    {
        if (!isset(ConnManager::$bucket))
        {
            
            self::createBucketCon();
        }
        
        return self::$bucket;
        
    }
    
    public static function createBucketCon()
    {
        $cluster = new CouchbaseCluster(CB_HOST);
        self::$bucket = $cluster->openBucket(CB_BUCKET, CB_BUCKET_PWD);
    }
    
}
