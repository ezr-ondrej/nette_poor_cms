<?php

use Nette\Application\UI;
/**
 * Description of News
 *
 * @author Ondra
 */
class PageControl extends UI\Control {
    private $model;
	
	private $id;
	private $name;
	private $title;
	private $content;
	
	function __construct($model, $pageName) {
		parent::__construct();
		$this->model = $model;
		$this->loadPageData($pageName);
	}
	
	public function handleEdit()
	{
		$this->presenter->template->activate_admin=true;
		$this->presenter->template->editor=true;
		
		$form = $this['adminForm-pageForm'];
		$form->setDefaults(array('id'=>$this->id,'title'=>$this->title,'content'=>$this->content));
		if ($this->presenter->isAjax()) {
            $this->invalidateControl('adminFrom');
        } 
	}
	
    public function render()
    {
        $template = $this->template;
		
        $template->setFile(dirname(__FILE__) . '/page.latte');
		
		$template->basePath = $this->presenter->template->basePath;
		
		$template->admin = $this->presenter->user->isLoggedIn();
		$template->title = $this->title;
		$template->content = $this->content;
        
        $template->render();
    }
	
	protected function loadPageData($name)
	{
		$this->name = $name;
		$page = $this->model->findOneBy(array('name'=>$name));
		if (!$page) {
			$this->model->insert(array('name'=>$name, 'content'=>''));
			$this->content = 'Jste zde poprvé? Vytvořte prosím obsah';
		} else {
			$this->id = $page->id;
			$this->title = $page->title;
			$this->content = $page->content;
			if ($this->content == '')
				$this->content = "Vytvořte prosím obsah...";
		}
	}
	
	public function pageFormSubmitted(UI\Form $form)
	{
		$values = $form->getValues();
        $id = $values['id'];
		unset($values['id']);
		if ($id) {
            $this->model->update($id, $values);
            $this->flashMessage('Stránka byla úspěšně upravena.');
        }
		$this->redirect('this');
	}
	
	protected function createComponentAdminForm()
    {
		$comp = new AdminForm;
		
        return $comp;
    }
}