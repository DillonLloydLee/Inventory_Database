<?php
class Item {

    private $id;
    private $name;

    function __construct($id = null, $name) {
        $this->name = $name;
        $this->id = $id;
    }

    function setName($new_name) {
        $this->name = (string) $new_name;
    }

    function getName() {
        return $this->name;
    }

    function setId($new_id) {
        $this->id = $new_id;
    }

    function getId() {
        return $this->id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO item (name) VALUES ('{$this->getName()}')");
        $result_id = $GLOBALS['DB']->lastInsertId();
        $this->setId($result_id);
    }

    static function getAll()
    {
        $returned_items = $GLOBALS['DB']->query("SELECT * FROM item;");
        $items = array();
        foreach($returned_items as $item) {
            $id = $item['id'];
            $name = $item['name'];
            $new_item = new Item($id, $name);
            array_push($items, $new_item);
        }
        return $items;
    }
    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM item;");
    }
}


 ?>
