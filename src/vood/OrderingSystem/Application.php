<?php

namespace vood\OrderingSystem;

use vood\OrderingSystem\Model\Factory;

class Application extends \Slim\Slim {

    public function __construct($settings = array()) {
        parent::__construct($settings);

        $db = DB::getInstance($settings['db']);
        $this->container['model_factory'] = new Factory($db);
        $this->add(new \Slim\Middleware\ContentTypes());
        $this->registerActions();
    }

    public function registerActions() {

        $app = $this;

        //Products
        $app->get('/products', function() use ($app) {
                echo json_encode($app->getModelFactory()->model('product')->select());
            });


        //Orders
        $app->post('/orders', function() use ($app)  {
                echo json_encode($app->getModelFactory()->model('order')->create($app->request->getBody()));
            });


        //Admin Products
        $app->get('/admin/products', function() use ($app)  {
                echo json_encode($app->getModelFactory()->model('product')->select());
            });

        $app->post('/admin/products', function() use ($app)  {
                echo json_encode($app->getModelFactory()->model('product')->create($app->request->getBody()));
            });

        $app->get('/admin/products/:id', function($id) use ($app)  {
                echo json_encode($app->getModelFactory()->model('product')->get($id));
            });

        $app->delete('/admin/products/:id', function($id) use ($app)  {
                echo json_encode($app->getModelFactory()->model('product')->delete($id));
            });

        $app->put('/admin/products/:id', function($id) use ($app)  {
                echo json_encode($app->getModelFactory()->model('product')->update($id, $app->request->getBody()));

            });

        //Admin Orders
        $app->get('/admin/orders', function() use ($app)  {
                echo json_encode($app->getModelFactory()->model('order')->select());
            });

        $app->post('/admin/orders', function() use ($app)  {
                echo json_encode($app->getModelFactory()->model('order')->create($app->request->getBody()));
            });

        $app->get('/admin/orders/:id', function($id) use ($app) {
                echo json_encode($app->getModelFactory()->model('order')->get($id));
            });

        $app->delete('/admin/orders/:id', function($id) use ($app)  {
                echo json_encode($app->getModelFactory()->model('order')->delete($id));
            });

        $app->put('/admin/orders/:id', function($id) use ($app)  {
                echo json_encode($app->getModelFactory()->model('order')->update($id, $app->request->getBody()));
            });
    }

    /**
     * @return Factory
     */
    public function getModelFactory()
    {
        return $this->container['model_factory'];
    }

}