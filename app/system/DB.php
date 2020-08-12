<?php

use App\system\Collections\Collection;

class DB
{

    use HasDatabaseConnection;

    protected $query;

    public function SELECT(){
        $this->query = 'SELECT FROM';
        
        return $this;
    }

    public function Table(string $table)
    {
        $this->query .= "{$table}";

        return $this;
    }

    public function Where(string $row, string $opration, string $value)
    {
        $this->query .= " WHERE {$row} {$opration} {$value}";
    
        return $this;
    }

    public function LimitBy(int $number){
        $this->query .= "LIMIT {$number}";

        return $this;
    }

    public function Get()
    {
        $query = $this->Connection()->query($this->query);

        return new Collection($query->fetch_all());
    }

    public function Update(string $table, $attributes, $values){

    }
}
