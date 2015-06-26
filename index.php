<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
           
            include_once 'imports.php';
                     
     
            echoln("<h1> Couchbase PHP Workshop </h1>");
           
            try {
                
                demoAddUser();
                demoAddCompany();
                demoAddUserToCompany();
                demoGetUserAndCompany();
                demoQueryUsers();
    
            } catch (Exception $exc) {
                
                //Global error handling, exceptions could be indeed catched locally
                echoerr($exc->getMessage());
                echoerr($exc->getTraceAsString());
            }
         
            /**
             * 1.) Add an user 
             */
            function demoAddUser()
            {
                echoln("<h3>demoAddUser</h3>");
                
                $user_dmaier = new User("dmaier", "David", "Maier", "david.maier@couchbase.com", new DateTime());
                $user_mmustermann = new User("mmustermann", "Max", "Mustermann", "max.mustermann@mm.de", new DateTime());
                
                echoln("Persisting " . $user_dmaier->uid . "...");
                $user_dmaier->persist();
                echoln("Persisting " . $user_mmustermann->uid . "...");
                $user_mmustermann->persist();
                
            }
            
            /**
             * 2.) Add a company
             */
            function demoAddCompany()
            {
                echoln("<h3>demoAddCompany</h3>");
                
                $company_couchbase = new Company("couchbase.com","Couchbase Corp.", "Mountain View");
                
                echoln("Persisting " . $company_couchbase->id . "...");
                $company_couchbase->persist();
            }
            
            /**
             * 3.) Add a user to the company
             */
            function demoAddUserToCompany()
            {
                echoln("<h3>demoAddUserToCompany</h3>");
                echoln("Adding user to company ...");
                
                $dmaier = (new User("dmaier"))->get();
                $mmustermann = (new User("mmustermann"))->get();
              
                $company = (new Company("couchbase.com"))->get();
                $company->addUser($dmaier)->addUser($mmustermann)->persist();
            }
            
            
            /**
             * 4.) Get the user and the company
             */
            function demoGetUserAndCompany() {
                
                echoln("<h3>demoGetUserAndCompany</h3>");
                echoln("Getting companies and users ..."); 
                
                $user = new User("dmaier");
                $user->get();
                echoln("user = " . $user->first_name . " " . $user->last_name);
                
                $company = new Company("couchbase.com");
                $company->get();
                echoln("company = " . $company->name);
                echoln("employee #1 = " . $company->users[0]->last_name);
                echoln("employee #2 = " . $company->users[1]->last_name);
 
            }
            
            /**
             *  5.) Query users
             */
            function demoQueryUsers() {
                
                echoln("<h3>demoQueryUsers</h3>");
                echoln("Querying users by name ...");
                
                $users = User::queryByLastName("A", "Z");
                
                foreach($users as $u)
                {
                    echoln($u->first_name . " " . $u->last_name);
                }
            }
            
        ?>
    </body>
</html>
