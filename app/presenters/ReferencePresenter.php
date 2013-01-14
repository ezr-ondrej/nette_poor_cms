<?php

use Nette\Application\UI;
/**
 * Reference presenter.
 */
class ReferencePresenter extends BasePresenter
{
    /** @var Jampl\Reference */
    private $reference;
    //private $reference_count = 15;
    
    private $show_admin = false;
    
    protected function startup()
    {
        parent::startup();
        $this->reference = $this->context->reference;
    }
    
    protected function beforeRender()
    {
        parent::beforeRender();
        $this->template->show_admin = $this->show_admin;
    }
    
    public function handleDelete($id)
    {
        if ($this->user->isLoggedIn())
            $this->reference->delete($id);
        
        $this->redirect('this');
    }
    
    public function handleEdit($id)
    {
        $this->template->activate_admin=true;
        $item = $this->reference->find($id);
        $form = $this['adminForm-reference'];
        $form->setDefaults($item);
        if ($this->presenter->isAjax()) {
            $this->invalidateControl('adminFrom');
        }
    }
    
    public function renderDefault($year = null)
    {
        if ($this->user->isLoggedIn()) {
            $this['adminForm-reference']; //vytvoří formulář
        }
        if (!$year) {
            $this->template->reference = $this->reference->findAll();
            $this->template->active_year = 'Vše';
        }
        else {
            $this->template->reference = $this->reference->findBy(array('YEAR(date)'=>$year));
            $this->template->active_year = $year;
        }
		
		// visual paginátor
		$vp = new VisualPaginator($this, 'paginator');
		$paginator = $vp->getPaginator();
		$paginator->itemsPerPage = 5;
		$paginator->itemCount = count($this->template->reference);
		
        $this->template->reference->order('date DESC')->limit($paginator->itemsPerPage, $paginator->offset);
		
    }
    
    public function renderShow($id)
    {
        $this->template->item = $this->reference->find($id);
    }
    
    // volá se po úspěšném odeslání formuláře
    public function referenceFormSubmitted(UI\Form $form)
    {
        $values = $form->getValues();
        
        $id = $values['id'];
        unset($values['id']);
        
        if ($values['foto'] != '')
            $values['foto'] = $this->reference->saveFoto($values['foto']);
        
        if(!$id) {
            //uložení obrázku
            $this->reference->insert($values);
            $this->flashMessage('Reference byla úspěšně přidána.');
        } else {
            $this->reference->update($id, $values);
            $this->flashMessage('Reference byla úspěšně upravena.');
        }
        $this->redirect('this');
    }
    
    protected function createComponentAdminForm()
    {
        return new AdminForm;
    }

}
