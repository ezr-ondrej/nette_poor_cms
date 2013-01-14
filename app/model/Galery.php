<?php

namespace Jampl;
use Nette;

/**
 * Model starající se o tabulku user
 */
class Galery extends Table
{
    /** @var string */
    protected $tableName = 'galery';
    
    private $galery_dir = '/files/galery/';
    
    public function saveImage($image)
    {
        $fileName =  Nette\Utils\Strings::webalize($image->getName(), '.');
        
        $fileName = $this->checkName(WWW_DIR . $this->galery_dir, $fileName);
        
        $img = Nette\Image::fromFile($image);
        
        $img->resize(900, NULL, Nette\Image::SHRINK_ONLY);
        $img->sharpen();
        $img->save( WWW_DIR . $this->galery_dir . $fileName);

        $img->resize(100, NULL, Nette\Image::SHRINK_ONLY);
        $img->sharpen();
        $img->save( WWW_DIR . $this->galery_dir .'thumb_'. $fileName);
        
        return $fileName;
    }
    
    public function deleteImg($id)
    {
        $pic = $this->find($id);
        unlink( WWW_DIR . $this->galery_dir . $pic->name);
        unlink( WWW_DIR . $this->galery_dir . "thumb_".$pic->name);
        
        $this->delete($id);
    }
    
    protected function getTable($table=null)
    {
        if ($table == 'cat')
            return $this->connection->table('galery_cat');
        else if ($table == 'album')
            return $this->connection->table('galery_album');
        else
            return parent::getTable();
    }
    
    public function insertAlbum($values)
    {
        //return $this->connection->exec('INSERT INTO '.$this->tableName, $values);
        return $this->getTable('album')->insert($values);
    }
    
    public function deleteAlbum($id)
    {
        foreach( $this->findAlbumPics($id) as $pic) {
            $this->deleteImg($pic->id);
        }
        $this->getTable('album')->get($id)->delete();
    }
    
    public function insertCategory($values)
    {
        return $this->getTable('cat')->insert($values);
    }
    
    public function deleteCategory($id)
    {
        $category = $this->getTable('cat')->get($id);
        
        foreach( $category->related('galery_album') as $album) {
            $this->deleteAlbum($album->id);
        }
        $category->delete();
    }
    
    public function findAlbum($album_id)
    {
        return $this->getTable('album')->get($album_id);
    }
    
    public function findAlbumPics($album_id)
    {
        return $this->findBy(array('galery_album_id'=>$album_id));
    }
    
    public function findCategories($all=false)
    {
        if (!$all)
            return $this->getTable('cat')->where(array('user'=>1));
        else
            return $this->getTable('cat')->order('user DESC');
    }
    
    public function findAlbumPreview($cat_id = null, $system = false, $limit = 30, $offset = 0)
    {
		$q = "SELECT galery_album.id, MIN(galery.name), galery_album.name 
			FROM galery_album 
			LEFT JOIN galery on galery_album.id=galery.galery_album_id 
			" . ($cat_id ? 'INNER JOIN' : 'LEFT JOIN') . " galery_cat on galery_album.galery_cat_id=galery_cat.id ";
		
        if ($cat_id) {
            $q .= "WHERE galery_album.galery_cat_id = ? ";
			$q .= "GROUP BY galery_album.id, galery_album.name ";
		} else {
			$q .= "WHERE (galery_cat.user ".($system?'<=':'=')." 1 OR galery_cat.user IS NULL ) ";
			$q .= "GROUP BY galery_album.id, galery_album.name ";
		}
		$q .= ($system ? "" : "HAVING MIN(galery.name) IS NOT NULL ");
		$q .= "ORDER BY galery_album.added ";

		$q .= " LIMIT ". $limit;
		$q .= " OFFSET ". $offset;
		
		return $this->connection->query( $q, $cat_id);
    }
	
    public function countAlbas($cat_id, $system) {
		$q = "SELECT galery_album.id, MIN(galery.name), galery_album.name 
                FROM galery_album 
                LEFT JOIN galery on galery_album.id=galery.galery_album_id 
            " . ($cat_id ? 'INNER JOIN' : 'LEFT JOIN') . " galery_cat on galery_album.galery_cat_id=galery_cat.id ";
		
		if ($cat_id) {
            $q .= "WHERE galery_album.galery_cat_id = ? ";
            $q .= "GROUP BY galery_album.id, galery_album.name ";
		} else {
			$q .= "WHERE (galery_cat.user ".($system?'<=':'=')." 1 OR galery_cat.user IS NULL ) ";
			$q .= "GROUP BY galery_album.id, galery_album.name ";
		}
		$q .= ($system ? "" : "HAVING MIN(galery.name) IS NOT NULL ");
		$q .= "ORDER BY galery_album.added ";

		$result = $this->connection->query( "SELECT count(*) FROM (".$q.") as preview", $cat_id)->fetch();
		return $result[0];
    }
}