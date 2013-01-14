<?php

use Nette\Application\UI;
/**
 * Description of News
 *
 * @author Ondra
 */
class NewsControl extends UI\Control {
    
    public function render()
    {
        $template = $this->template;
        $template->setFile(dirname(__FILE__) . '/NewsControl.latte');
        
        $template->render();
    }
}
