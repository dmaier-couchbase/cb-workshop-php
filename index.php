<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
           
            //Imports
            include_once 'classes/iDao.php';
            include_once 'classes/User.php';
            include_once 'classes/Company.php';
            include_once 'classes/ConnManager.php';
            include_once 'settings.php';
            include_once 'util.php';
            
            
     
            echoln("-- Starting Couchbase Demo");
           
            try {
                
                demoAddUser();
                demoAddCompany();
              
    
            } catch (Exception $exc) {
                
                //Global error handling, exceptions could be indeed catched locally
                echoerr($exc->getTraceAsString());
            }
         
            /**
             * Add a user 
             */
            function demoAddUser()
            {
                echoln("- demoAddUser");
                
                $user_dmaier = new User("dmaier", "David", "Maier", "david.maier@couchbase.com", new DateTime("1980-01-01"));
                $user_mmustermann = new User("mmustermann", "Max", "Mustermann", "max.mustermann@mm.de", new DateTime("2000-07-01"));
                
                echoln("Persisting " . $user_dmaier->uid . "...");
                $user_dmaier->persist();
                echoln("Persisting " . $user_mmustermann->uid . "...");
                $user_mmustermann->persist();
                
            }
            
            
            function demoAddCompany()
            {
                echoln("- demoAddCompany");
                
                $company_couchbase = new Company("couchbase.com","Couchbase Corp.", "Mountain View");
                
                echoln("Persisting " . $company_couchbase->id . "...");
                $company_couchbase->persist();
            }
            
            
            /**
             * Get the user and the company
             */
            function demoGetUserAndCompany() {

                echoln("Initiating a user and a company ...<br/>");
                $user = new User("dmaier");

                //DEBUG
                //var_dump($user);

                echoln("user = " . $user->uid . "<br/>");
                $company = new Company("couchbase");
                echoln("company = " . $company->id . "<br/>");

                //DEBUG
                //var_dump($company);
            }
        ?>
    </body>
</html>
