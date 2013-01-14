<?php

namespace Jampl;
use Nette;

/**
 * Model starající se o tabulku user
 */
class News extends Table
{
    /** @var string */
    protected $tableName = 'news';
    
    protected function getTable()
    {
        return parent::getTable()->order('added DESC');
    }
    
    public function deleteImg($filename)
    {
        unlink(WWW_DIR.$this->img_dir.$filename);
        unlink(WWW_DIR.$this->img_dir.'thumb_'.$filename);
    }
    
    public function delete($id)
    {
        $item = $this->find($id);
        if ($item->img != '') {
            $this->deleteImg($item->img);
        }
        $item->delete();
    }
    
    public function update($id, $values)
    {
        $item = $this->find($id);
        
        if ($values['img'] == '')
            unset($values['img']);
        else if ( $item->img != '' )
            $this->deleteImg($item->img);
        
        $item->update($values);
    }
}