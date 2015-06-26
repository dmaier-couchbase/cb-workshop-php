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
        array_push($this->users, $user);
        
        return $this;
    }

    /**
     * Get the company object
     */
    public function get() {
       
        $bucket = ConnManager::getBucketCon();
        
        $key = self::TYPE . "::" . $this->id;
                
        //The type is a standard class object
        $doc = $bucket->get($key)->value;
        $this->id = $doc->id;
        $this->name = $doc->name;
        $this->address = $doc->address;
        
        if (isset($doc->users))
        {
            foreach ($doc->users as $uid)
            {
                //Get also the associated users
                $user = (new User($uid))->get();
                
                array_push($this->users, $user);
            }
        }

        return $this;
    }

    /**
     * Persist the company object
     */
    public function persist() {
        
        $bucket = ConnManager::getBucketCon();  
  
        //Use an associative array or a standard object to store as JSON
        //Even the $this could be stored directly
        $doc = new stdClass();
       
        $doc->type = self::TYPE;
        $doc->id = $this->id;
        $doc->name = $this->name;
        $doc->address = $this->address;
        
        if (!empty($this->users))
        {
                $doc->users = array();
        }
              
        foreach ($this->users as $u)
        {
            array_push($doc->users, $u->uid);
          
            //Persist also associated users
            $u->persist();
        }
        
        $bucket->upsert(self::TYPE . "::" . $this->id, $doc);
    }

    public function delete() {
     
        $bucket = ConnManager::getBucketCon();  
        
        return $bucket->remove(self::TYPE . "::" . $this->id);
    }

}
