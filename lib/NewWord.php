<?php 

 class NewWord {

    private static $db = null;

    private static function init_db() {
        if ( self::$db == null ) {
            self::$db = new PDO( "mysql:host=localhost:3306;dbname=flashcard","Brian","Depeche" );
            self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); 
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

        $result = self::$db->query('select * from words'); 
    
        while ( $record = $result->fetch() ) {
           
            $wordValue = new NewWord(array( 'id'=>$record[0], 'word'=>$record[1] ));

            // $data[$wordValue->id] = $wordValue;
            array_push($data, $wordValue);
        }                      

        return $data;  
    }  // end of open()

    public function remove( $hotID ) {   
        self::init_db();

        $stment = self::$db->prepare('delete from words where id=:id' );
        $stment->execute( array('id' => $hotID ) );
        
        header ('location:admin.php');
        exit;
         
    }  // end of remove()

    public function update( $data ) {
        $this->word = $data['word'];
           
        self::init_db();
        
        $stment = self::$db->prepare( 'update words set word=:word where id=:id' );
        $stment->execute( array( 'id' => $this->id, 'word' => $this->word ) );

    } // end of update()

    public function find( $hotID ) {
        self::init_db();
        $result = self::$db->query("select * from words where id=$hotID");
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

        $stment = self::$db->prepare( 'insert into words (word) values (:word)' ); // framework for sql statement
        $stment->execute( array( 'word' => $_POST['word'] ) );
        $lastID = self::$db->lastInsertId();

        header( "location:admin.php?id=" . $lastID );
        exit;

    }  //end of append function

 } // end of NewProduct class
?>