<?php
namespace App;

use App\Exceptions\CannotRunQuery;
use App\Exceptions\NullValue;
use App\Exceptions\PrimaryKeyIsNull;
use DB;
use Error;
use Exception;
use HasAttributes;
use HasDatabaseConnection;

class Model{

    use HasDatabaseConnection, HasAttributes;

    # table name
    protected $table = "table";

    # primacy key for the table
    protected $primary_key = "id";
    
    # attributes
    protected $attaributes = [];

    public function __construct($attributes = null){
        
        $this->attributes = $attributes;
        
        $this->SyncFields();

        if(isset($attributes[$this->primary_key]))
            $this->SyncRecord();
    }

    public function SyncFields(){
        $sql = "SELECT * FROM {$this->table} limit 1";
        $query = $this->Connection()->query($sql);
        # fetch the fields
        $fieldInfo = $query->fetch_fields();
        # number of attributes
        $num = 0;

        foreach($fieldInfo as $field){
            $this->fields[] = $field->name;
            $this->attributes[$field->name] = 'NULL';
            $num++;
        }

        $this->attributes_count = $num;

        $query->free_result();

        $this->CloseConnection();
    }

    public function num_rows($condition){
        $sql = "SELECT * FROM `{$this->table}` WHERE $condition";
        
        return $this->Connection()->query($sql)->num_rows ?? 0;
    }

    public function SyncRecord(){
        if(! isset($this->attributes[$this->primary_key])){
            throw new PrimaryKeyIsNull('Primary key is null');
        }

        # fetch values
        $sql = "SELECT * FROM {$this->table} where {$this->primary_key} = {$this->attributes[$this->primary_key]}";
        $query = $this->Connection()->query($sql);
        
        
        if($query->num_rows <= 0){
            throw(new NullValue('Cannot find the record'));
        }

        while($row = $query->fetch_assoc()){
            foreach($this->fields as $field){
                $this->attributes[$field] = $row[$field];
            }        
        }
        
    }

    public function __get($name)
    {
        return $this->GetAttribute($name);
    }

    public function __set($name, $value)
    {
        return $this->SetAttribute($name, $value);
    }

    public function save(){

        if(isset($this->fields[$this->primary_key])){
            $sql = "SELECT id FROM {$this->table} WHERE {$this->primary_key} = {$this->fields[$this->primary_key]}";
            
            if($this->Connection()->query($sql)->num_rows > 0){
                # if we have the user
                foreach ($this->attributes as $attribute){
                    if( ! $this->Connection()->query("UPDATE {$this->table} SET (`$attribute`) VALUES ('{$this->fields['$attribute']}')"))
                        throw (new NullValue("Cannot find attribute {$attribute}"));

                        return true;
                }
            }

        }

        # create new record
        $sql = "INSERT INTO {$this->table} (";
        $currentIndex = 0;
        $temp_attaributes_array = [];


        foreach($this->fields as $attribute){
            $currentIndex++;
            if($this->attributes_count > $currentIndex){
                $sql .= $attribute. ',';
                $temp_attaributes_array[] = $attribute;
            }else{
                $sql .= $attribute;
                $temp_attaributes_array[] = $attribute;
            }
        }

        $currentIndex = 0;

        $sql .= ") ";
        
        $sql .= "VALUES (";

        foreach($temp_attaributes_array as $attribute){
            $currentIndex++;
            if($this->attributes_count > $currentIndex){
                $sql .= "'{$this->attributes[$attribute]}'" .  ',';
            }else
                $sql .= "'{$this->attributes[$attribute]}'";
        }
        $sql .= ")";

        if($this->Connection()->query($sql) === TRUE){
            return true;
        }

        throw new CannotRunQuery("Cannot run {$sql}");
    }

    
    public function Find($id){
        $sql = "SELECT * FROM {$this->table} where {$this->primary_key} = {$id} limit 1";
        if($this->Connection()->query($sql)->num_rows > 0){



        }else
            throw (new NullValue("Cannot find the record in the database"));
    }

    public function update($attributes){

    }

    public static function all(){

    }

    public function query($conditions){
        $db = new DB;
        $db->SELECT()->Table($this->table)->Where($condition)->Get();

        return $db;
    }



}

?>