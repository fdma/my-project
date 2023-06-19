<?php
namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\RequestInterface;

class People extends ResourceController {
    protected $modelName = 'App\Models\PeopleModel';
    protected $format = 'json';
    public function index() {
        return $this->respond($this->model->findAll());
    }

    public function create() {
        $json = $this->request->getJSON();
        $firstname = $json->firstname;
        $lastname = $json->lastname;
        $email = $json->email;
        $age = $json->age;
        $city = $json->city;

        $data = array(
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'age' => $age,
            'city' => $city
        );

        $this->model->insert($data);

        $response = array(
            'status'   => 201,
            'messages' => array(
                'success' => 'People information created successfully'
            )
        );
        return $this->respondCreated($response);
    }

    public function show($id = null) {
        $data = $this->model->where('id', $id)->first();

        if($data){
            return $this->respond($data);
        }else{
            return $this->failNotFound('No person found');
        }
    }

    public function update($id = NULL)
    {
        $json = $this->request->getJSON();

        $firstname = $json->firstname;
        $lastname = $json->lastname;
        $email = $json->email;
        $age = $json -> age;
        $city = $json -> city;

        $data = array(
            'id' => $id,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'age' => $age,
            'city' => $city
        );

        $this->model->update($id, $data);
        $response = array(
            'status'   => 200,
            'messages' => array(
                'success' => 'People information updated successfully'
            )
        );

        return $this->respond($response);
    }

    public function delete($id = NULL){
        $data = $this->model->find($id);

        if($data) {
            $this->model->delete($id);

            $response = array(
                'status'   => 200,
                'messages' => array(
                    'success' => 'People information successfully deleted'
                )
            );

            return $this->respondDeleted($response);
        } else {
            return $this->failNotFound('No people found');
        }
    }
}