<?php
 
 View::template('medica');

    class LoginController extends AppController
    {
 
	public function indexw() 
	{
 
	}
 
	public function ingresa2()
	{
            Load::lib('auth');
 
            if ($this->has_post("correo","contrasena"))
	    {
		$usuario = $this->post("correo");
		$pwd = $this->post("contrasena");
        $pwd=md5($pwd);
                $auth = new Auth("model", "class: usuarios", "correo: $usuario", "contrasena: $pwd");
 
                if ($auth->authenticate())
                {
                    //Session::set('usuario', 'medico');
                    Flash::success("Correcto");
                } 
                else 
                {
                    Flash::error("Falló");
                }
            }
        }
        public function ingresa(){
        if (Input::hasPost("correo","contrasena")){
            $pwd = Input::post("contrasena");
            $usuario=Input::post("correo");
            $pwd=md5($pwd);
 
            $auth = new Auth("model", "class: login", "correo: $usuario", "contrasena: $pwd");
            if ($auth->authenticate()) {
                


                Flash::error("si llego");
                $this->id=Auth::get('id');
                $correo=$this->correo=Auth::get('correo');
                $this->estado=Auth::get('estado');
                Flash::error("si llego $correo");
                $pacientess = new medico();
                foreach($pacientess->find("conditions: id='$id'") as $medico){

                $nombresme=$medico->nombre;
                $apellidome=$medico->apellido;
                $telefonome=$medico->telefono;
                //$telefono=$paciente->telefono;
                session_start();

                $_SESSION["idpame"]=$id;
                $_SESSION["nombrepame"]=$nombresme;
                $_SESSION["apellidopame"]=$apellidome;
                $_SESSION["telefonopame"]=$telefonome;

                //Flash::valid(" es $nombres $apellido $paciente->nombre");


                }
              header('Location: /AgenMed/citas/index2');


            } else {
                Flash::error("Falló");
                }
            }
        }
        public function salir(){
            Auth::destroy_identity();
            header('Location: /AgenMed/index');

        }
    }
?>