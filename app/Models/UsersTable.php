<?php namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class UsersTable
{
    protected $db;

    public  function __construct(ConnectionInterface &$db)
    {
        $this->db =& $db;
    }

    /*
     * Get all rows from table
     */
    function getAll(){
        return $this->db->table('sys_users')->get()->getResult();
    }
    /*
    * Get count of rows from table
    */

    /*
     * get()
     * getRow()
     * getResult()
     * orderBy
     */
    function getCount(){
        $query = $this->db->query(" 
         SELECT count(id) as id FROM sys_users
         ")->getResult();
        return $query;
    }

}