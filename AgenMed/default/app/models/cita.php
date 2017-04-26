<?php
class Cita extends ActiveRecord
{
    /**
     * Retorna los menús para ser paginados
     *
     * @param int $page  [requerido] página a visualizar
     * @param int $ppage [opcional] por defecto 20 por página
     */
    public function getCita($page, $ppage=20)
    {
        $idmedi=Auth::get('id');
        return $this->paginate( 'columns: * ', 'join: right outer join paciente on cita.idpaciente = paciente.id where idmedico='.$idmedi,"page: $page", " per_page: $ppage");


    }

//    SELECT * FROM cita right outer join paciente on cita.idpaciente = paciente.id

}