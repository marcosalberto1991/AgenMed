<?php
 
    class UsuariosController extends ApplicationController
    {
 
	public function index() 
	{
 
	}
 
	function ingresar()
	{
            Load::lib('auth');
 
            if ($this->has_post("usuario","clave"))
	    {
		$usuario = $this->post("usuario");
		$pwd = $this->post("clave");
                $auth = new Auth("model", "class: usuarios", "usuario: $usuario", "clave: $pwd");
 
                if ($auth->authenticate())
                {
                    Flash::success("Correcto");
                } 
                else 
                {
                    Flash::error("Falló");
                    Auth::destroy_identity();

                }
            }
        }
    }
?>