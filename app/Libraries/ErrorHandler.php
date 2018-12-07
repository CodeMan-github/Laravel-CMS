<?php

namespace App\Libraries;

use App;

class ErrorHandler extends App\Http\Controllers\BaseController
{

    public function __construct()
    {
        parent::__construct();
    }


    public function handle($e)
    {

        switch ($e->getStatusCode()) {

            case '403':
                return $this->show403();
                break;

            case '404':
                return $this->show404();
                break;

            case '500':
                return $this->show500();
                break;

            case '503':
                return $this->show503();
                break;

            default:
                return $this->show500();
                break;
        }

    }

}