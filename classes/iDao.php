<?php

/**
 *
 * Describes a data access object
 * 
 * @author David Maier <david.maier at couchbase.com>
 */
interface iDao {
    
    public function get();
    
    public function persist();
}
