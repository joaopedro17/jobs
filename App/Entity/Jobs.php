<?php

namespace App\Entity;

use App\Db\Database;
use PDO;

class Jobs
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string(s/n)
     */
    public $active;

    /**
     * @var string
     */
    public $date;

    /**
     * @var return boolean
     */
    public function register()
    {
        $this->date = date('y-m-d H:1:s');

        $obDatabase = new Database('jobs');
        $this->id = $obDatabase->insert([
            'title' => $this->title,
            'description' => $this->description,
            'active' => $this->active,
            'date' => $this->date,
        ]);
        
        return true;
    }

    public function edit()
    {
        $payload = (new Database('jobs'))
        ->update('id = '.$this->id, [
            'title' => $this->title,
            'description' => $this->description,
            'active' => $this->active,
            'date' => $this->date,
        ]);

        return $payload;
    }

    public function delete()
    {
        $payload = (new Database('jobs'))->delete('id = '.$this->id);
        
        return $payload;
    }

    public static function getJobs($where = null, $order = null, $limit = null)
    {
        $payload = (new Database('jobs'))
        ->select($where, $order, $limit)
        ->fetchall(PDO::FETCH_CLASS,self::class);

        return $payload;
    }

    public static function getJob($id)
    {
        $payload = (new Database('jobs'))
        ->select('id = '.$id)
        ->fetchObject(self::class);

        return $payload;
    }
}
