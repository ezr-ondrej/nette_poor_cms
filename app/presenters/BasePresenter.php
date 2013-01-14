<?php

/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{
    /** @var Nette\Http\SessionSection */
    protected $mySession;
	
	private $news_count = 4;
    
    protected function startup()
    {
        parent::startup();
        $this->mySession = $this->session->getSection("mySession");
    }


    protected function beforeRender()
    {
		parent::beforeRender();
		$this->template->mainmenu = Array(
			"Úvod"=>"Homepage:", 
			"O nás"=>"About:",
			"Realizace"=>"Services:",
			"Reference"=>"Reference:", 
			"Aktuality"=>"News:",
			"Fotogalerie"=>"Galery:",
			"Kontakty"=>"Contact:" );
        
		$reference_years = Array();
		foreach ($this->context->reference->getYears() as $year ) {
			$reference_years[$year['YEAR(date)']] = $this->link('Reference:', $year['YEAR(date)']);
		}
		$this->template->reference_years = $reference_years;
		$this->template->services = $this->context->services->findAll()->order('title');
	
        $this->template->submenu = Array(
            "Úvod"=>null, 
            "O nás"=>array("Naše firma"=>"","Certifikace ISO"=>"iso"),
            "Realizace"=>null,
            "Kontakty"=>null,
            "Reference"=>$reference_years, 
            "Aktuality"=>null,
            "Fotogalerie"=>null );
        
        $this->template->admin = $this->user->isLoggedIn();
        
		$this->template->presentation = $this->context->galery->findAlbumPics(0);
		$this->template->news = $this->context->news->findLimit($this->news_count);
		
        $this->mySession->backlink = $this->storeRequest();
	
    }
    
    public function handleLogout()
    {
        if($this->user->isLoggedIn())
            $this->user->logout();
        $this->redirect('this');
    }
    
    public function createComponentNews()
    {
        return new NewsControl;
    }
	
	protected function createComponentAdminForm()
    {
        return new AdminForm;
    }
	
	protected function createComponentPage()
	{
		$this->template->editor = True;
		return new PageControl($this->context->page, Nette\Utils\Strings::webalize($this->getName().'-'.$this->getView()));
	}
}
