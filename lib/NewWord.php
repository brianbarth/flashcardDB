<?php 

 class NewWord {

    private static $db = null;
    private static $dbopts = null;


    private static function init_db() {
        if ( self::$db == null ) {
            // self::$db = new PDO( "mysql:host=localhost:3306;dbname=flashcard","Brian","Depeche" );   ********code to use locally
            // self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );                    ********code to use locally
            self::$dbopts = parse_url(getenv('CLEARDB_DATABASE_URL'));
            $db_server = $dbopts['host'];
            $db_username = $dbopts['user'];
            $db_password = $dbopts['pass'];
            $cleardb_db = substr($dbopts['path'],1);

            self::$db = new PDO( "mysql:host=$db_server;dbname=heroku_a5a10f179f5026e",$db_username,$db_password );     
        }
    } // end of init_db()

    public function __construct($data = null) {
        if ($data) {
            $this->id = $data['id'];
            $this->word = $data['word'];
        }
    } // end of construct()

    public function open($data) {
        self::init_db();

        $result = self::$db->query('SELECT * FROM words'); 
    
        while ( $record = $result->fetch() ) {
           
            $wordValue = new NewWord(array( 'id'=>$record[0], 'word'=>$record[1] ));

            array_push($data, $wordValue);
        }                      

        return $data;  
    }  // end of open()

    public function remove( $hotID ) {   
        self::init_db();

        $stment = self::$db->prepare('DELETE FROM words WHERE id=:id' );
        $stment->execute( array('id' => $hotID ) );
        
        header ('location:admin.php');
        exit;
         
    }  // end of remove()

    public function update( $data ) {
        $this->word = $data['word'];
           
        self::init_db();
        
        $stment = self::$db->prepare( 'UPDATE words SET word=:word WHERE id=:id' );
        $stment->execute( array( 'id' => $this->id, 'word' => $this->word ) );

    } // end of update()

    public function find( $hotID ) {
        self::init_db();
        $result = self::$db->query("SELECT * FROM words WHERE id=$hotID");
        $record = $result->fetch();
        $data = new NewWord(array( 'id'=>$record[0], 'word'=>$record[1] ));
       
        return $data;
    } // end of find()

    public function validate($data) {

        $errors = array();
        
        if (empty($data['word'])) {
            $errors['word'] = "Word cannot be left blank!";    
        }
        if ( $data['word'] == '__' ) {
            $errors['word'] = "Word already in database!". "<br/>" . "Change entry or navigate away from page!";
        }
        
        return $errors;

    }   //end of validate()

    public function append() {   //function for new Word creation
        self::init_db();

        $stment = self::$db->prepare( 'INSERT INTO words (word) VALUES (:word)' ); // framework for sql statement
        $stment->execute( array( 'word' => $_POST['word'] ) );
        $lastID = self::$db->lastInsertId();

        header( "location:admin.php?id=" . $lastID );
        exit;

    }  //end of append function

    public function alphabetize($data2) {
        self::init_db();

        $sorted = array();
        
        $result = self::$db->query('SELECT * FROM words ORDER BY word'); 
    
        while ( $record = $result->fetch() ) {
           
            $wordValue = new NewWord(array( 'id'=>$record[0], 'word'=>$record[1] ));

            array_push($sorted, $wordValue);
        } 
        return $sorted;
    } // end of alphabetize() function                     

 } // end of NewProduct class

?>