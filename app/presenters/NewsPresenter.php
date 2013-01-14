<?php

use Nette\Application\UI;
/**
 * Homepage presenter.
 */
class NewsPresenter extends BasePresenter
{
    private $news;
	private $news_count = 4;
    
    private $show_admin = false;
    
    protected function startup()
    {
        parent::startup();
        $this->news = $this->context->news;
    }
    
    public function handleDelete($id)
    {
        if ($this->user->isLoggedIn())
            $this->news->delete($id);
        
        $this->redirect('this');
    }
    
    public function handleEdit($id)
    {
        $this->template->activate_admin=true;
        $item = $this->news->find($id);
        $this['adminForm-actualityForm']->setDefaults($item);
        if ($this->presenter->isAjax()) {
            $this->invalidateControl('adminFrom');
        } else {
        }
    }
    
    protected function beforeRender()
    {
        parent::beforeRender();
        $this->template->show_admin = $this->show_admin;
    }
    
    public function renderDefault()
    {
        if ($this->user->isLoggedIn())
            $this['adminForm-actualityForm'];
    }
	
	public function renderShow($id)
    {
		$this->template->item = $this->news->find($id);
    }
    
    // volá se po úspěšném odeslání formuláře
    public function actualityFormSubmitted(UI\Form $form)
    {
        $values = $form->getValues();
        $id = $values['id'];
        unset($values['id']);
        if($values['img'] != '')
            $values['img'] = $this->news->saveFoto ($values['img']);
        if (!$id) {
            $this->news->insert($values);
            $this->flashMessage('Aktualita byla úspěšně přidána.');
        } else {
            $this->news->update($id, $values);
            $this->flashMessage('Aktualita byla úspěšně upravena.');
        }
        $this->redirect('this');
    }
    
    protected function createComponentAdminForm()
    {
        return new AdminForm;
    }

}
