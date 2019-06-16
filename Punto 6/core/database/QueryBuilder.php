<?php

namespace App\Core\Database;

use PDO;
use Exception;

class QueryBuilder
{
    /**
     * The PDO instance.
     *
     * @var PDO
     */
    protected $pdo;

    /**
     * Create a new QueryBuilder instance.
     *
     * @param PDO $pdo
     */
    public function __construct($pdo, $logger = null)
    {
        $this->pdo = $pdo;
        $this->logger = ($logger) ? $logger : null;
    }

    /**
     * Select all records from a database table.
     *
     * @param string $table
     */
    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("select * from {$table}");
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    /**
     * Insert a record into a table.
     *
     * @param  string $table
     * @param  array  $parameters
     */
    public function insert($table, $parameters)
    {
        $parameters = $this->cleanParameterName($parameters);
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($parameters);
        } catch (Exception $e) {
            $this->sendToLog($e);
        }
    }

    private function sendToLog(Exception $e)
    {
        if ($this->logger) {
            $this->logger->error('Error', ["Error" => $e]);
        }
    }

    /**
     * Limpia guiones - que puedan venir en los nombre de los parametros
     * ya que esto no funciona con PDO
     *
     * Ver: http://php.net/manual/en/pdo.prepared-statements.php#97162
     */
    private function cleanParameterName($parameters)
    {
        $cleaned_params = [];
        foreach ($parameters as $name => $value) {
            $cleaned_params[str_replace('-', '', $name)] = $value ;
        }
        return $cleaned_params;
    }
public function delete($table,$Id){
    
        $statement = $this->pdo->prepare(
            "DELETE FROM $table  WHERE id = $Id"
        );
        $statement->execute();
    }

public function selectTurnoById($table, $id){
        $statement = $this->pdo->prepare(
            "SELECT * FROM {$table} 
            WHERE id={$id}"
        );
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

public function updateTurno($table, $parameters, $id){
        $parameters = $this->cleanParameterName($parameters);
        $sql = "UPDATE $table SET  telefono=:telefono,
        edad=:edad, altura=:altura,email=:email, nombre=:nombre talla_calzado=:talla_calzado,fecha_de_nacimiento=:fecha_de_nacimiento,fecha_del_turno=:fecha_del_turno,horario_del_turno=:horario_del_turno WHERE id=$id"; 
            try {
                $statement = $this->pdo->prepare($sql);
                $statement->execute($parameters);
            } catch (Exception $e) {
                $this->sendToLog($e);
            }   
    }


}
