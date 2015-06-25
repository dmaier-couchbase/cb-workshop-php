<?php

/**
 * Description of User
 *
 * @author David Maier <david.maier at couchbase.com>
 */
class User implements iDao {
    
    //Constants
    const TYPE = "user"; 
    
    //Properties
    public $uid;
    public $first_name;
    public $last_name;
    public $mail;
    public $birth_day;
            
    
    /**
     * The default constructor
     */
    function __construct() {
        
        
        $a = func_get_args(); 
        $i = func_num_args(); 
        
        
        if (method_exists($this,$f='__construct'.$i)) { 
            call_user_func_array(array($this,$f),$a); 
        }
    }
    
    /**
     * The constructor which takes the uid
     * 
     * @param type $uid
     */
    function __construct1($uid) {
        
        $this->uid = $uid;
    }

    
    /**
     * The full constructor
     * 
     * @param type $uid
     * @param type $first_name
     * @param type $last_name
     * @param type $mail
     * @param type $birth_day
     */
    function __construct5($uid, $first_name, $last_name, $mail, $birth_day)
    {  
        $this->uid = $uid;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->mail = $mail;
        $this->birth_day = $birth_day;
    }
    
    
    public function get() {
        
        return TRUE;
    }

    public function persist() {
        
        $bucket = ConnManager::getBucketCon();  
  
        //Use an associative array to store as JSON
        $doc = array();
        
        $doc["type"] = self::TYPE;
        $doc["uid"] = $this->uid;
        $doc["first_name"] = $this->first_name;
        $doc["last_name"] = $this->last_name;
        $doc["mail"] = $this->mail;
        $doc["bday"] = $this->birth_day->getTimestamp();
              
        $bucket->upsert(self::TYPE . "::" . $this->uid, $doc);
        
    }
        
}
