<?php
namespace App\Models;
use CodeIgniter\Model;

class PeopleModel extends Model {
    protected $table = 'peoples';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['id','firstname', 'lastname', 'email', 'age', 'city'];
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;

}