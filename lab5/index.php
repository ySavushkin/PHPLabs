<?php
class Product{
    public $name;
    public $description;
    protected $price;

    function __construct($name_var, $description_var, $price_var){
        $this->name = $name_var;
        $this->description = $description_var;
        $this->setPrice($price_var);
    }

    function setPrice($price_var){
        if ($price_var >= 0) {
            $this->price = $price_var;
        } else {
            echo "ціна не може бути від'ємною<br>";
            $this->price = 0;
        }
    }

    function __destruct(){

    }

    function getInfo(){
        echo "Name: " . $this->name . "<br> Price: " . $this->price . "<br> Description: " . $this->description . "<br><br>";    }
}

class DiscountedProduct extends Product{
    public $discount; //в процентах

    function __construct($name_var, $description_var, $price_var, $discount_var){
        $this->name = $name_var;
        $this->description = $description_var;
        $this->price = $price_var;
        $this->discount = $discount_var;
    }

    function __destruct(){

    }

    function discountPrice(){
        if($this->discount >= 0 && $this->discount <= 100) {
            $this->price = $this->price - ($this->price * ($this->discount / 100));
        } else {
            echo "неправильна знижка";
        }
    }
}

class Category {
    public $categoryName;
    public $products = [];

    function __construct($categoryName_var) {
        $this->categoryName = $categoryName_var;
    }

    function addProduct($product) {
        $this->products[] = $product;
    }

    function displayProducts() {
        echo "<br>категорія: " . $this->categoryName . "<br><br>";
        foreach ($this->products as $product) {
            $product->getInfo();
        }
    }
}

$product1 = new Product("Телефон", "Новий смартфон", 12000);
$product2 = new DiscountedProduct("Ноутбук", "Потужний ноутбук", 30000, 15);
$product3 = new Product("Навушники", "Безпровідні навушники", -500); //для тесту

$product2->discountPrice();

$electronics = new Category("Електроніка");

$electronics->addProduct($product1);
$electronics->addProduct($product2);
$electronics->addProduct($product3);
$electronics->displayProducts(); 

