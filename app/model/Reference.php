<?php

namespace Jampl;
use Nette;

/**
 * Model starající se o tabulku user
 */
class Reference extends Table
{
    /** @var string */
    protected $tableName = 'reference';
    
    public function deleteImg($filename)
    {
        unlink(WWW_DIR.$this->img_dir.$filename);
        unlink(WWW_DIR.$this->img_dir.'thumb_'.$filename);
    }
    
    public function delete($id)
    {
        $pic = $this->find($id);
        if (file_exists(WWW_DIR . $this->img_dir . $pic->foto)) {
            unlink( WWW_DIR . $this->img_dir . $pic->foto);
            unlink( WWW_DIR . $this->img_dir . "thumb_".$pic->foto);
        }
        parent::delete($id);
    }
    
    public function update($id, $values)
    {
        $item = $this->find($id);
        
        if ($values['foto'] == '')
            unset($values['foto']);
        else if ( $item->foto != '' )
            $this->deleteImg($item->foto);
        
        $item->update($values);
    }
    
    public function getYears()
    {
        return $this->connection->query("SELECT DISTINCT YEAR(date) FROM reference ORDER BY date DESC");
    }
    
    public function getAlbas()
    {
        return $this->connection->table("galery_album")->where(array('galery_cat_id'=>1))->fetchPairs("id","name");
    }
}