<?php

/**
 * Controller por defecto si no se usa el routes
 *
 */

View::template('medica');

class CitasController extends AppController
{


    public function index($fecha)
    {
    	$this->fecha = date("Y-m-d H:i");


    }
    public function index2() 
    {
        $page = 1;
    	include_once APP_PATH.'cale/get-events.php';
    	include_once APP_PATH.'cale/get-timezones.php';
    	include_once APP_PATH.'cale/utils.php';
        $this->listCita = (new Cita)->getCita($page);

        

    
    }
    
}
