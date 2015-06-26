<?php

/**
 *
 * Describes a data access object
 * 
 * @author David Maier <david.maier at couchbase.com>
 */
interface iDao {
    
    /**
     * Get an user
     */
    public function get();
    
    /**
     * Persist an user
     */
    public function persist();
    
}
