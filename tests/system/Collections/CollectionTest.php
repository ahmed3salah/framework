<?php

use App\system\Collections\Collection;

class CollectionTest extends \PHPUnit\Framework\TestCase
{

    
    public function testGet()
    {
        $collection = new Collection([20, 43]);

        $this->assertEquals(20, $collection->get()[0]);
    }

    public function testAdd()
    {
        $collection = new collection();

        $collection->add(20);

        $this->assertCount(1, $collection->get());
    }

    public function testCount()
    {
        $collection = new collection([20, 30, 20]);

        $this->assertEquals(3, $collection->count());
    }

    public function testMerge()
    {
        $collection1 = new Collection([3,4]);
        $collection2 = new Collection([20,40,30]);

        $collection1->merge($collection2);
        
        # check if the first item in the collection is 3 (from collection 1)
        $this->assertEquals(3, $collection1->get()[0]);
        # check if the third item in the collection is 20 (from collection 2)
        $this->assertEquals(20, $collection1->get()[2]);
        # count the new array lenght
        $this->assertEquals(5, $collection1->count());
    }

    public function testToJson()
    {
        $collection = new Collection([
            ['name' => 'ahmed', 'email' => 'ahmed@gmail.com'],
            ['name' => 'test', 'email' => 'email@gamil.com']
        ]);

        $json_data = json_encode($collection->ToJson());

        $this->assertEquals('[{"name":"ahmed","email":"ahmed@gmail.com"},{"name":"test","email":"email@gamil.com"}]', $json_data);
    }


}
