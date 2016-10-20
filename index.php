<?php

/* Roteamento de recursos e ações */

require __DIR__ . '/vendor/autoload.php';
include './models/Conexao.php';
include './models/Client.php';
include './models/Vehicle.php';
include './models/Parking.php';
include './models/Payment.php';

date_default_timezone_set('America/Sao_Paulo');

//Raíz do projeto
$root = 'tecweb/t1';

use Phroute\Phroute\RouteCollector;

$router = new RouteCollector();

//Recurso : Cliente
$router->group(['prefix' => $root], function($router){

  //Visualizar
  $router->get('/', function(){
    require 'dashboard.php';
  });

  //Recurso : Cliente
  $router->group(['prefix' => 'api'], function($router){

    //Recurso : Cliente
    $router->group(['prefix' => 'client'], function($router){

      //Visualizar
      $router->get('/', function(){
        $client = new Client();
        return json_encode($client->read());
      });

      //Criar
      $router->post('/', function(){
        $data = $_POST;
        $client = new Client();
        $client->name = $data['name'];
        $client->validate();
        $client->save();
        return 'Sucesso';
      });

      //Buscar
      $router->get('/{id}', function($id){
        $client = new Client();
        return json_encode($client->select($id, 'id'));
      });

      //Apagar
      $router->delete('/{id}', function($id){
        $client = new Client();
        $client->id = $id;
        $client->delete();
        return 'Sucesso';
      });
    });

    //Recurso : Estacionamento
    $router->group(['prefix' => 'parking'], function($router){

      //Saída
      $router->post('/exit', function(){
        $now = date('Y-m-d H:i:s');

        $data = $_POST;
        $parking = new Parking();
        $park_exist = $parking->select($data['parking_id'], 'id');

        $parking->id = $data['parking_id'];
        $parking->details = $data['details'];
        $parking->end_at = date('Y-m-d H:i:s');
        $parking->save();

        $payment = new Payment();
        $payment->vehicle_id = $park_exist['vehicle_id'];
        $payment->method_id = 1;
        $payment->price = $data['payment_total'];
        $payment->created_at = $now;
        $payment->save();

        return 'Sucesso';
      });

      //Listar
      $router->get('/', function(){
        $parking = new Parking();
        $parkings = $parking->read();
        $data_return = [];

        if(is_array($parkings) && count($parkings) > 0){
          foreach($parkings as $k => $v){
            $client_new = new Client(); $client = $client_new->select($v['client_id'], 'id');
            $vehicle_new = new Vehicle(); $vehicle = $vehicle_new->select($v['vehicle_id'], 'id');
            $data_return[$k]['id'] = $v['id'];
            $data_return[$k]['name'] = $vehicle['plaque'].' / '.$vehicle['title'].' / '.$client['name'];
          }
        }

        return(json_encode($data_return));
      });

      //Criar
      $router->post('/', function(){

        $now = date('Y-m-d H:i:s');

      $data = $_POST;

      if($data['client_new'] != null){
        $client = new Client();
        $client->name = $data['client_new'];
        $client->created_at = $now;
        $data['client_id'] = $client->save();
      }

        if($data['vehicle_new'] != null){
            $vehicle = new Vehicle();
            $vehicle->client_id = $data['client_id'];
            $vehicle->title = null;
            $vehicle->model = null;
            $vehicle->plaque = $data['vehicle_new'];
            $vehicle->created_at = $now;
            $data['vehicle_id'] = $vehicle->save();
        }

        $park = new Parking();
        $park->client_id = $data['client_id'];
        $park->vehicle_id = $data['vehicle_id'];
        $park->details = $data['details'];
        $park->start_at = $now;
        $park->validate();
        $park->save();

        return 'Sucesso';
      });

      //Buscar
      $router->get('/{id}', function($id){
        $parking = new Parking();
        return json_encode($parking->select($id, 'id'));
      });

      //Atualizar
      $router->put('/{id}', function($id){
      });

      //Apagar
      $router->delete('/{id}', function($id){
        $parking = new Parking();
        $parking->id = $id;
        $parking->delete();
        return 'Sucesso';
      });

    });


    //Recurso : Veículo
    $router->group(['prefix' => 'vehicle'], function($router){

      //Listar
      $router->get('/', function(){
        //$_POST
        $vehicle = new Vehicle();
        $vehicle_list = $vehicle->read();
        $data_return = [];
        foreach($vehicle_list as $k => $v){
          $data_return[$k]['id'] = $v['id'];
          $data_return[$k]['name'] = $v['plaque'].' / '.$v['title'];
        }

        return(json_encode($data_return));
      });

      //Criar
      $router->post('/', function(){
        $data = $_POST;
        $vehicle = new Parking();
        $vehicle->client_id = $data['client_id'];
        $vehicle->title = $data['title'];
        $vehicle->model = $data['model'];
        $vehicle->plaque = $data['plaque'];
        $vehicle->validate();
        $vehicle->save();

        return 'Sucesso';
      });

      //Visualizar
      $router->get('/{id}', function(){

      });

      //Atualizar
      $router->put('/{id}', function($id){
      });

      //Apagar
      $router->delete('/{id}', function($id){
        $vehicle = new Vehicle();
        $vehicle->id = $id;
        $vehicle->delete();
        return 'Sucesso';
      });

    });

    //Recurso : Pagamento
    $router->group(['prefix' => 'payment'], function($router){

      //Criar
      $router->get('/', function(){
      });
      //Visualizar
      $router->get('/calculate/{parking_id}', function($parking_id) {

        $parking = new Parking();
        $data = $parking->select($parking_id, 'id');

        if($data == null)
          return 0;

        $t2 = strtotime(date('Y-m-d H:i:s'));
        $t1 = strtotime($data['start_at']);
        $hours = round(abs($t2 - $t1)/(60*60), 2);

        return(round($hours * Payment::PRICE_HOUR,2));
      });

      //Atualizar
      $router->put('/{id}', function($id){
      });

      //Apagar
      $router->delete('/{id}', function($id){
      });

    });
  });
});

# NB. You can cache the return value from $router->getData() so you don't have to create the routes each request - massive speed gains
$dispatcher = new Phroute\Phroute\Dispatcher($router->getData());

$response = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

// Print out the value returned from the dispatched function
echo $response;
