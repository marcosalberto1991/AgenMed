<?php
 
class MenusController extends AppController
{
    /**
     * Obtiene una lista para paginar los menús
     *
     * @param int $page [opcional]
     */
    public function index($page = 1)
    {
         $this->listMenus = (new Menus)->getMenus($page);
    }
 
    /**
     * Crea un Registro
     */
    public function create()
    {
        /**
         * Se verifica si el usuario envío el form (submit) y si además
         * dentro del array POST existe uno llamado "menus"
         * el cual aplica la autocarga de objeto para guardar los
         * datos enviado por POST utilizando autocarga de objeto
         */
        if (Input::hasPost('menus')) {
            /**
             * se le pasa al modelo por constructor los datos del form y ActiveRecord recoge esos datos
             * y los asocia al campo correspondiente siempre y cuando se utilice la convención
             * model.campo
             */
            $menu = new Menus(Input::post('menus'));
            //En caso que falle la operación de guardar
            if ($menu->create()) {
                Flash::valid('Operación exitosa');
                //Eliminamos el POST, si no queremos que se vean en el form
                Input::delete();
                return;
            }
 
            Flash::error('Falló Operación');
        }
    }
 
    /**
     * Edita un Registro
     *
     * @param int $id (requerido)
     */
    public function edit($id)
    {
        $menu = new Menus();
 
        //se verifica si se ha enviado el formulario (submit)
        if (Input::hasPost('menus')) {
 
            if ($menu->update(Input::post('menus'))) {
                 Flash::valid('Operación exitosa');
                //enrutando por defecto al index del controller
                return Redirect::to();
            }
            Flash::error('Falló Operación');
            return;
        }
 
        //Aplicando la autocarga de objeto, para comenzar la edición
        $this->menus = $menu->find_by_id((int) $id);
 
    }
 
    /**
     * Eliminar un menú
     *
     * @param int $id (requerido)
     */
    public function del($id)
    {
        if ((new Menus)->delete((int) $id)) {
                Flash::valid('Operación exitosa');
        } else {
                Flash::error('Falló Operación');
        }
 
        //enrutando por defecto al index del controller
        return Redirect::to();
    }
}