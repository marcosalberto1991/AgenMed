<?php
class Paciente extends ActiveRecord
{
    /**
     * Retorna los menús para ser paginados
     *
     * @param int $page  [requerido] página a visualizar
     * @param int $ppage [opcional] por defecto 20 por página
     */
    public function getPaciente2($page, $ppage,$busca)
    {
        return $this->paginate("page: $page"," nombres like '%$busca%' or apellidos like '%$busca%' or correo like '%$busca%' ", "per_page: $ppage", 'order: id desc');
    }
    public function getPaciente($page, $ppage,$busca)
    {
        return $this->paginate("page: $page","per_page: $ppage", 'order: id desc');
    }
}