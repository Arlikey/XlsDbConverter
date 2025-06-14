<?php
namespace Src;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class DatabaseManager
{
    protected $capsule;
    public function __construct()
    {
        $this->capsule = new Capsule;

        $this->capsule->addConnection([
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'site_db',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);

        $this->capsule->setEventDispatcher(new Dispatcher(new Container));
        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }

    function getCategories()
    {
        return $this->capsule->table('categories')->get();
    }

    function getProducts()
    {
        return $this->capsule->table('products')->get();
    }

    // returns products collection (objects) with CATEGORY NAME
    function getProductsWithCategory()
    {
        return $this->capsule
            ->table('products as p')
            ->join('categories as c', 'p.category_id', '=', 'c.id')
            ->select('p.id', 'p.name', 'p.price', 'c.name as category_name')
            ->get();
    }
    
    // inserts product in table, firstly checking if category name exists, if not creating it
    public function insertProduct($data)
    {
        if (empty($data['name']) || empty($data['price']) || empty($data['category_name'])) {
            return;
        }

        $category = $this->capsule
            ->table('categories')
            ->where('name', $data['category_name'])
            ->first();

        if (!$category) {
            $categoryId = $this->capsule
                ->table('categories')
                ->insertGetId(['name' => $data['category_name']]);
        } else {
            $categoryId = $category->id;
        }
        $this->capsule
            ->table('products')
            ->insert([
                    'name' => $data['name'],
                    'price' => $data['price'],
                    'category_id' => $categoryId
                ]);
    }

}
?>