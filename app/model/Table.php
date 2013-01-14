<?php

namespace Jampl;
use Nette;

/**
 * Reprezentuje repozitář pro databázovou tabulku
 */
abstract class Table extends Nette\Object
{

    /** @var Nette\Database\Connection */
    protected $connection;

    /** @var string */
    protected $tableName;

    protected $img_dir = '/files/';
    
    /**
     * @param Nette\Database\Connection $db
     * @throws \Nette\InvalidStateException
     */
    public function __construct(Nette\Database\Connection $db)
    {
        $this->connection = $db;

        if ($this->tableName === NULL) {
            $class = get_class($this);
            throw new Nette\InvalidStateException("Název tabulky musí být definován v $class::\$tableName.");
        }
    }
    
    /**
     * Kontroluje, jestli soubor s daným jménem již neexistuje
     * @param string $dir
     * @param string $fileName
     * @return int
     */
    protected function checkName($dir, $fileName)
    {
        $orig=$fileName;
        for ($i=0; (file_exists( $dir . $fileName)) ;$i++) {
            $tmp = explode('.', $orig);
            $tmp[0] = $tmp[0] . '_' . $i;
            $fileName = implode('.',$tmp);
        }
        return $fileName;
    }
    
    public function saveFoto($image)
    {
        $fileName =  Nette\Utils\Strings::webalize($image->getName(), '.');
        
        $fileName = $this->checkName(WWW_DIR . $this->img_dir, $fileName);
        
        $img = Nette\Image::fromFile($image);
        
        $img->resize(900, NULL, Nette\Image::SHRINK_ONLY);
        $img->sharpen();
        $img->save(WWW_DIR . $this->img_dir . $fileName);
        
        $img->resize(200, NULL, Nette\Image::SHRINK_ONLY);
        $img->sharpen();
        $img->save(WWW_DIR . $this->img_dir .'thumb_'. $fileName);
        
        return $fileName;
    }

    /**
     * Přidává pole do tabulky
     * @param array $values
     * @return int
     */
    public function insert($values)
    {
        //return $this->connection->exec('INSERT INTO '.$this->tableName, $values);
        return $this->getTable()->insert($values);
    }
    
    /**
     * Aktualizuje pole tabulky s id $id
     * @param int $id
     * @param array $values
     * @return int
     */
    public function update($id, $values)
    {
        return $this->getTable()->get($id)->update($values);
    }
    
    /**
     * Maže řádek s předaným id
     * @param int $id
     * @return int
     */
    public function delete($id)
    {
        return $this->getTable()->get($id)->delete();
    }
    
    /**
     * Vrací celou tabulku z databáze
     * @return \Nette\Database\Table\Selection
     */
    protected function getTable()
    {
        return $this->connection->table($this->tableName);
    }

    /**
     * Vrací všechny záznamy z databáze
     * @return \Nette\Database\Table\Selection
     */
    public function findAll()
    {
        return $this->getTable();
    }

    /**
     * Vrací vyfiltrované záznamy na základě vstupního pole
     * (pole array('name' => 'David') se převede na část SQL dotazu WHERE name = 'David')
     * @param array $by
     * @return \Nette\Database\Table\Selection
     */
    public function findBy(array $by)
    {
        return $this->getTable()->where($by);
    }

    /**
     * To samé jako findBy akorát vrací vždy jen jeden záznam
     * @param array $by
     * @return \Nette\Database\Table\ActiveRow|FALSE
     */
    public function findOneBy(array $by)
    {
        return $this->findBy($by)->limit(1)->fetch();
    }

    /**
     * Vrací záznam s daným primárním klíčem
     * @param int $id
     * @return \Nette\Database\Table\ActiveRow|FALSE
     */
    public function find($id)
    {
        return $this->getTable()->get($id);
    }
    
    public function findLimit($limit, $offset=Null)
    {
        if (isset($offset))
            return $this->getTable()->limit($limit, $offset);
        else
            return $this->getTable()->limit($limit);
    }
	
	public function count()
	{
		return $this->getTable()->count('*');
	}
}
