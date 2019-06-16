<?php

namespace App\Models;

use App\Core\Model;

class Turnos extends Model
{
    protected $table = 'turnos';

    public function get()
    {
        return $this->db->selectAll($this->table);
    }

    public function insert(array $task)
    {
        $this->db->insert($this->table, $task);
    }
public function deleteTurno($Id){
    $this->db->delete($this->table, $Id);
}
public function getById($id){
        $turno= $this->db->selectTurnoById($this->table,$id);
        $miTurno = json_decode(json_encode($turno), True);  
        return $miTurno[0];
    }
 public function update(array $datos,$id)
    {
        $this->db->updateTurno($this->table, $datos,$id);
    }
}
