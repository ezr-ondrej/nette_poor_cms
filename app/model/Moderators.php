<?php

namespace Jampl;
use Nette;

/**
 * Model starající se o tabulku user
 */
class Moderators extends Table
{
    /** @var string */
    protected $tableName = 'moderator';
    
    private $admin_id = 1;
    
    public function calculateHash($password)
    {
	return sha1($password . str_repeat('jamplrules', 10));
    }
    
	public function setPassword($id, $password)
	{
		$this->find($id)->update(array(
			'password' => $this->calculateHash($password)
		));
	}
	
	public function addModerator($values)
	{
		$values['password'] = $this->calculateHash($values['password']);
		$values['role'] = 'admin';
		$this->insert($values);
	}
    
	public function getModerators($user_id)
	{
	if ($user_id == $this->admin_id)
		return $this->findAll();
	else
		return $this->findBy(array('id'=>$user_id));
	}
}