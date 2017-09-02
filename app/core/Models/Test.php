<?php namespace App\Models;

class Test extends \CodeIgniter\Model
{
    protected $DBGroup        = 'default';
	protected $table          = 'mytable';
	protected $returnType     = 'object';
	protected $useSoftDeletes = false;
    protected $skipValidation = true;
    protected $useTimestamps  = false;
}
