<?php

use Nette\Application\UI;
/**
 * Galery presenter.
 */
class GaleryPresenter extends BasePresenter
{
    /** @persistent int */
    //public $galery_id;
    private $galery;
    
    /** @param int actual album id */
    private $galery_id;
    
    /** @param int actual album id */
    private $album_id;
    
    protected function startup()
    {
        parent::startup();
        $this->galery = $this->context->galery;
    }
    
    protected function beforeRender()
    {
        parent::beforeRender();
        if ($this->user->isLoggedIn())
            $this->template->categories = $this->galery->findCategories(true);
        else
            $this->template->categories = $this->galery->findCategories();
    }
    
    public function handleDelpic($id)
    {
        if ($this->user->isLoggedIn()) {
            $this->galery->deleteImg($id);
        }
        $this->restoreRequest($this->mySession->backlink);
    }
    
    public function handleDelalb($id)
    {
        if ($this->user->isLoggedIn())
            $this->galery->deleteAlbum($id);
        
        $this->restoreRequest($this->mySession->backlink);
    }
    
    public function handleDelcat($id)
    {
        if ($this->user->isLoggedIn())
            $this->galery->deleteCategory($id);
        $this->redirect('default');
    }
    
    public function handleEditpic($id)
    {
        $this->template->activate_admin=true;
        $item = $this->galery->find($id);
        $form = $this["adminFotoForm-foto"];
        $form->setDefaults($item);
        $form->removeComponent($form['img']);
        if ($this->presenter->isAjax()) {
            $this->invalidateControl('adminFrom');
        }
    }
    
    public function renderDefault($id = null) //category id
    {
        $this->galery_id = $id;
		
        // visual paginator
        // TODO - tady je potenciální problém, v tomhle dotazu jsou i prázdná alba, omezují se až v šabloně
        $vp = new VisualPaginator($this, 'paginator');
        $paginator = $vp->getPaginator();
        $paginator->itemsPerPage = 9;
        $paginator->itemCount = $this->galery->countAlbas($id, $this->user->isLoggedIn());
		
        $this->template->albaprev = $this->galery->findAlbumPreview($id, $this->user->isLoggedIn(), $paginator->itemsPerPage, $paginator->offset);
    }
    
    public function renderShow($id)
    {
        $this->album_id = $id;
        $this->template->album_des = $this->galery->findAlbum($id);
        $this->template->picts = $this->galery->findAlbumPics($id);
		
		// visual paginator
        // TODO - tady je potenciální problém, v tomhle dotazu jsou i prázdná alba, omezují se až v šabloně
        $vp = new VisualPaginator($this, 'paginator');
        $paginator = $vp->getPaginator();
        $paginator->itemsPerPage = 9;
        $paginator->itemCount = count($this->template->picts);

		$this->template->picts->limit($paginator->itemsPerPage, $paginator->offset);
    }
    
    public function fotoFormSubmitted(UI\Form $form)
    {
        $values = $form->getValues();
        //uložení obrázku
        $id = $values['id'];
        unset($values['id']);
        $image = $values['img'];
        unset($values['img']);
        if(!$id) {
            $fileName = $this->galery->saveImage($image);
            $values['name'] = $fileName;
            $this->galery->insert($values);
            $this->flashMessage('Fotografie byla úspěšně přidána.');
        } else {
            $this->galery->update($id,$values);
            $this->flashMessage('Fotografie byla úspěšně upravena.');
        }
        $this->restoreRequest($this->mySession->backlink);
    }
    
    public function createComponentAdminFotoForm()
    {
        $form = new UI\Form;
        $form->addHidden('id');
        $form->addHidden('galery_album_id')
            ->setDefaultValue($this->album_id);
        $form->addUpload('img', 'Fotografie')
            ->addRule(UI\Form::IMAGE, 'Obrázek musí být JPEG, PNG nebo GIF.');
        $form->addTextArea('description', 'Popis:')
            ->addRule(UI\Form::MAX_LENGTH, 'Text je příliš dlouhý', 7000);
        
        $form->addSubmit('save', 'Uložit');
        $form->addSubmit('savenext', 'Uložit a Další');
        $form->onSuccess[] = callback($this, 'fotoFormSubmitted');
        
        $comp = new AdminForm();
        $comp->addComponent($form, "foto");
        return $comp;
    }
    
    public function categoryFormSubmitted(UI\Form $form)
    {
        $values = $form->getValues();
        $this->galery->insertCategory($values);
        $this->flashMessage('Kategorie byla úspěšně přidána.');
        $this->restoreRequest($this->mySession->backlink);
    }
    
    public function albumFormSubmitted(UI\Form $form)
    {
        $values = $form->getValues();
        $this->galery->insertAlbum($values);
        $this->flashMessage('Album bylo úspěšně přidáno.');
        $this->restoreRequest($this->mySession->backlink);
    }
    
    public function createComponentAdminAlbumForm()
    {
        $form_cat = new UI\Form;
        $form_cat->addText('name', 'Název:')
            ->addRule(UI\Form::LENGTH, 'Délka názvu musí být mezi %d a %d znaky', array(2, 30));
        $form_cat->addSubmit('save', 'Uložit kategorii');
        $form_cat->onSuccess[] = callback($this, 'categoryFormSubmitted');
        
        $categories = $this->galery->findCategories(true)->fetchPairs('id','name');
        
        $form = new UI\Form;
        $form->addText('name', 'Název:')
            ->addRule(UI\Form::LENGTH, 'Délka nadpisu musí být mezi %d a %d znaky', array(2, 30));
        $form->addTextArea('description', 'Popis:', 20, 5)
            ->addRule(UI\Form::MAX_LENGTH, 'Text je příliš dlouhý', 250);
        $form->addSelect('galery_cat_id', 'Kategorie:', $categories)
                ->setPrompt('--Nezařazeno--')
                //->addRule(UI\Form::FILLED, 'Kategorie musí být vybrána')
                ->setDefaultValue($this->galery_id);
        $form->addSubmit('save', 'Uložit Album');
        $form->onSuccess[] = callback($this, 'albumFormSubmitted');
        
        $comp = new AdminForm();
        $comp->addComponent($form_cat, "Kategorie");
        $comp->addComponent($form, "Album");
        return $comp;
    }
}
