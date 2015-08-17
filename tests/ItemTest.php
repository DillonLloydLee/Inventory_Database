<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Item.php";

    $server = 'mysql:host=localhost;dbname=inventory';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class ItemTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Item::deleteAll();
        }

        function test_getName()
        {
            $name = "Gold Liberty Dollar";
            $test_Item = new Item($name);

            $result = $test_Item->getName();

            $this->assertEquals($name, $result);
        }

        function test_save() {
            $name = "Gold Liberty Dollar";
            $test_Item = new Item($name);
            $test_Item->save();

            $result = Item::getAll();

            $this->assertEquals($test_Item, $result[0]);
        }

        function test_getAll() {
            $name = "Gold Liberty Dollar";
            $name2 = "Bronze My Little Pony: Applejack";
            $test_Item = new Item($name);
            $test_Item->save();
            $test_Item2 = new Item($name2);
            $test_Item2->save();

            $result = Item::getAll();

            $this->assertEquals([$test_Item, $test_Item2], $result);
        }

        function test_deleteAll() {
            $name = "Gold Liberty Dollar";
            $name2 = "Bronze My Little Pony: Applejack";
            $test_Item = new Item($name);
            $test_Item->save();
            $test_Item2 = new Item($name2);
            $test_Item2->save();

            Item::deleteAll();
            $result = Item::getAll();

            $this->assertEquals([], $result);
        }
    }
 ?>
