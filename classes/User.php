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
        
        $bucket = ConnManager::getBucketCon();
        
        $key = self::TYPE . "::" . $this->uid;
        
        //The type is a standard class object
        $doc = $bucket->get($key)->value;
        $this->uid = $doc->uid;
        $this->first_name = $doc->first_name;
        $this->last_name = $doc->last_name;
        $this->mail = $doc->mail;
        $this->birth_day = DateTime::createFromFormat('U', $doc->bday);
        
        return $this;
    }

    public function persist() {
        
        $bucket = ConnManager::getBucketCon();  
  
        //Use an associative array or a standard object to store as JSON
        //Even the $this could be stored directly
        $doc = new stdClass();
        
        $doc->type = self::TYPE;
        $doc->uid = $this->uid;
        $doc->first_name = $this->first_name;
        $doc->last_name = $this->last_name;
        $doc->mail = $this->mail;
        $doc->bday = $this->birth_day->format('U');
              
        $bucket->upsert(self::TYPE . "::" . $this->uid, $doc);
        
    }
    
    public function delete() {
        
        $bucket = ConnManager::getBucketCon();  
        
        return $bucket->remove(self::TYPE . "::" . $this->uid);
        
    }

    /**
     * Assumes that you have a View for the last name
     * 
     * function (doc, meta) {
     *
     *   if (doc.type == "user")
     *   {
     *       if ( typeof doc.last_name != undefined)
     *       {
     *           emit(doc.last_name, doc.uid);  
     *       }
     *   }
     * 
     * 
     * @param type $prop
     * @param type $start_value
     * @param type $end_value
     */
    public static function queryByLastName($start_value, $end_value) {
        
        $bucket = ConnManager::getBucketCon();
        
        $query = CouchbaseViewQuery::from(CB_DESIGN_DOC, CB_VIEW)
                ->stale(CouchbaseViewQuery::UPDATE_BEFORE)
                ->range($start_value, $end_value);
        
        $queryResult = $bucket->query($query);
        
        $result = array();
        
        foreach ($queryResult["rows"] as $row)
        {
            array_push($result, (new User($row["value"]))->get());
        }
        
        //DEBUG
        //var_dump($result);
        
        return $result;

    }
}
