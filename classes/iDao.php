<?php

/**
 *
 * Describes a data access object
 * 
 * @author David Maier <david.maier at couchbase.com>
 */
interface iDao {
    
    /**
     * Get an object
     */
    public function get();
    
    /**
     * Persist an object
     */
    public function persist();
    
    
    /**
     * Delete an object
     */
    public function delete();
    
}
