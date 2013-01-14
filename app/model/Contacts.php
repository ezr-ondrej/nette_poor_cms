<?php

namespace Jampl;
use Nette;

/**
 * Model starající se o tabulku user
 */
class Contacts extends Table
{
	/** @var string */
	protected $tableName = 'contact';
	
	public function findGroups()
	{
		return $this->connection->table('contact_group');
	}
	
}