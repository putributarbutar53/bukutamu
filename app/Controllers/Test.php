<?php

namespace App\Controllers;

use App\Models\PengunjungModel;
use App\Models\DataModel;
use CodeIgniter\Email\Email;
use CodeIgniter\API\ResponseTrait;

class Test extends BaseController
{
    var $pengunjung, $data, $validation;
    use ResponseTrait;
    
    
    public function index(){
        
        echo "Hello World";
    }

}