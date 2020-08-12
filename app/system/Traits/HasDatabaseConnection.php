<?php


trait HasDatabaseConnection{

    protected $connection;

    public function Connection(){
        try{
            # try to establish the connection with the database
            $this->connection = new mysqli(Config('DATABASE_SERVER'), Config('DATABASE_USER'), Config('BATABASE_PASS'), Config('DATABASE_NAME'));
            return $this->connection;
            
        }catch(Throwable $th){
            throw new Exception($th);
        }

    }

    public function CloseConnection(){
        $this->connection->close();
    }


}


?>