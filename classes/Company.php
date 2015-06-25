<?php

/**
 * Description of Company
 *
 * @author David Maier <david.maier at couchbase.com>
 */
class Company implements iDao {
    
    const TYPE = "company"; 
    
    public $id;
    public $name;
    public $address;
    public $users = array();
    
    
    /**
     * The default constructor
     */
    public function __construct() {
        
        $a = func_get_args(); 
        $i = func_num_args(); 
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
    }
    
    /**
     * The constructor which takes the id
     * @param type $id
     */
    function __construct1($id) {
        
        $this->id = $id;
        
    }
    
    
    function __construct3($id, $name, $address)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;  
    }
    
    
    /**
     * Add a user to this company
     * 
     * @param type $user
     */
    public function addUser($user)
    {
        $this->users[$user.uid] = $user;
    }




    public function get() {
        
        return TRUE;
    }

    public function persist() {
        
        $bucket = ConnManager::getBucketCon();  
  
        //Use an associative array to store as JSON
        $doc = array();
        

        $doc["type"] = self::TYPE;
        $doc["id"] = $this->id;
        $doc["name"] = $this->name;
        $doc["address"] = $this->address;
              
        $bucket->upsert(self::TYPE . "::" . $this->id, $doc);
    }

}
