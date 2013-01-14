<?php

use Nette\Application\UI;
/**
 * Services presenter.
 */
class ServicesPresenter extends BasePresenter
{
    /** @var Jampl\Reference */
    private $services;
    //private $reference_count = 15;
    
    private $show_admin = false;
    
    protected function startup()
    {
        parent::startup();
        $this->services = $this->context->services;
    }
    
    protected function beforeRender()
    {
        parent::beforeRender();
        $this->template->show_admin = $this->show_admin;
    }
    
    public function handleDelete($id)
    {
        if ($this->user->isLoggedIn())
            $this->services->delete($id);
        
        $this->redirect('this');
    }
    
    public function handleEdit($id)
    {
        $this->template->activate_admin=true;
        $item = $this->services->find($id);
        $form = $this['adminForm-realizace'];
        $form->setDefaults($item);
        if ($this->presenter->isAjax()) {
            $this->invalidateControl('adminFrom');
        }
    }
    
    public function renderDefault()
    {
        if ($this->user->isLoggedIn()) {
            $this['adminForm-realizace']; //vytvoří formulář
        }
		// z databáze vybírá už base presenter, kvůli menu služeb... not implemented yet... tak by se to sem dalo hodit no... xD
    }
    
    public function renderShow($id)
    {
        $this->template->item = $this->services->find($id);
    }
    
    // volá se po úspěšném odeslání formuláře
    public function servicesFormSubmitted(UI\Form $form)
    {
        $values = $form->getValues();
        
        $id = $values['id'];
        unset($values['id']);
        
        if ($values['foto'] != '')
            $values['foto'] = $this->services->saveFoto($values['foto']);
        
        if(!$id) {
            //uložení obrázku
            $this->services->insert($values);
            $this->flashMessage('Reference byla úspěšně přidána.');
        } else {
            $this->services->update($id, $values);
            $this->flashMessage('Reference byla úspěšně upravena.');
        }
        $this->redirect('this');
    }
    
    protected function createComponentAdminForm()
    {
        return new AdminForm;
    }

}
