<?php


View::template('medica');

class PacienteController extends AppController
{
    /**
     * Obtiene una lista para paginar los menús
     *
     * @param int $page [opcional]
     */
    public function index($page = 1,$busca=null)
    {
        //$busca="marcos";
        //$valor=isset($busca);

        if (Input::hasPost('paciente')) {    
            $Buscar=$_POST["nombre"];
            if (empty($Buscar)){
        
                }else{
                //Flash::valid("el valor2 $Buscar");
                $this->listPaciente = (new Paciente)->getPaciente2($page,$ppage=20,$Buscar);
                $Buscar='null'; 
                }

            }else{
            $this->listPaciente = (new Paciente)->getPaciente($page,$ppage=20,$busca); 


        } 
    }
 
    /**
     * Crea un Registro
     */
    public function agregar()
    {
       
        if (Input::hasPost('paciente')) {
           
            $paciente = new paciente(Input::post('paciente'));
            //En caso que falle la operación de guardar
            if ($paciente->create()) {
                Flash::valid('Operación exitosa');
                //Eliminamos el POST, si no queremos que se vean en el form
                Input::delete();
                return;
            }
 
            Flash::error('Falló Operación');
        }
            //Flash::error('Falló');

    }
    public function edit($id)
    {
        $paciente = new paciente();
 
        //se verifica si se ha enviado el formulario (submit)
        if (Input::hasPost('paciente')) {
 
            if ($paciente->update(Input::post('paciente'))) {
                 Flash::valid('Operación exitosa');
                //enrutando por defecto al index del controller
                return Redirect::to();
            }
            Flash::error('Falló Operación');
            return;
        }
 
        //Aplicando la autocarga de objeto, para comenzar la edición
        $this->paciente = $paciente->find_by_id((int) $id);
 
    }


    public function del($id)
    {
        if ((new Pacientes)->delete((int) $id)) {
                Flash::valid('Operación exitosa');
        } else {
                Flash::error('Falló Operación');
        }
 
        //enrutando por defecto al index del controller
        return Redirect::to();
    }
     public function cita($id) 
    {
        //Load::models('paciente');
        $pacientess = new paciente();
        //$paciente->find_by_id((int) $id);
        Flash::valid("1 nombre apellido");

        foreach($pacientess->find("conditions: id='$id'") as $paciente){


        $nombres=$paciente->nombres;
        $apellido=$paciente->apellidos;
        $telefono=$paciente->telefono;
        //$telefono=$paciente->telefono;
        session_start();

        $_SESSION["idpa"]=$id;
        $_SESSION["nombrepa"]=$nombres;
        $_SESSION["apellidopa"]=$apellido;
        $_SESSION["telefonopa"]=$telefono;

        //Flash::valid(" es $nombres $apellido $paciente->nombre");


        }

        header('Location: /AgenMed/citas/index2');

        //$paciente = $paciente->find_by_sql("select * from cita");
        //print $paciente->nombre;
        //Flash::valid("1 nombre $paciente->nombres apellido");

    
    }
}