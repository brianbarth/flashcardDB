<?php
    class Users {

        private static $user = null;
        private $attributes = array('id' => 0, 'username' => '', 'password' => '');
        private static $db = null;

        private static function init_db() {
            if ( self::$db == null ) {
                self::$db = new PDO( "mysql:host=localhost:3306;dbname=flashcard","Brian","Depeche" );
                self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
            }
        } // end of init_db()
        
        public function __construct($data = null) {
            if ( $data ) {
                $this->id = $data['id'];
                $this->username = $data['username'];
                $this->password = $data['password'];
            }
        } // end of __construct()

        public function open( $info ) {
            self::init_db();
    
            $result = self::$db->query('select * from users'); 
        
            while ( $record = $result->fetch() ) {
               
                $itemInfo = new Users(array( 'id'=>$record[0], 'username'=>$record[1], 'password'=>$record[2] ));
    
                $info[$itemInfo->id] = $itemInfo;
            }                  
    
            return $info;  
        }  // end of open()

        public function append( $info ) {   //function for new user creation
            self::init_db();
    
            $stment = self::$db->prepare( 'insert into users (username, password) values (:username, :password)' ); // framework for sql statement
            $stment->execute( array( 'username' => $_POST['username'], 'password' => $_POST['password'] ) );
            $lastID = self::$db->lastInsertId();
    
            header( "location: addUser.php?id=" . $lastID );
            exit;      
        }  //end of append function

        public function remove( $hotID ) {   
            self::init_db();
    
            $stment = self::$db->prepare(' delete from users where id=:id' );
            $stment->execute( array('id' => $hotID ) );
         
            header ('location: addUser.php');
            exit;
             
        }  // end of remove()

    } // end of Users class
?>