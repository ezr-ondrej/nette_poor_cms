<?php

use Nette\Application\UI;


class AdminForm extends UI\Control  {
    
    public function validateReferenceForm(UI\Form $form)
    {
        if (!$form['id']->getValue() && $form['foto']->getValue() == '')
            $form->addError('Tato kombinace není možná.');
    }
    
    public function render()
    {
        $template = $this->template;
        $template->setFile(__DIR__ . '/AdminForm.latte');
        $template->render();
    }
    
    private function getBaseRefForm($albas, $date=false)
    {
		$form = new UI\Form;
        $form->addHidden('id');
        $form->addHidden('moderator_id')
            ->setDefaultValue($this->presenter->user->getIdentity()->getId());
        $form->addText('title', 'Nadpis:')
            ->addRule(UI\Form::LENGTH, 'Délka nadpisu musí být mezi %d a %d znaky', array(4, 100));
        $form->addTextArea('text', 'Text:')
            ->addRule(UI\Form::MAX_LENGTH, 'Text je příliš dlouhý', 7000);
	
		if($date)
			$form->addDatePicker('date', 'Datum:')
				->setAttribute('class', 'showyear')
				->addRule(UI\Form::FILLED, 'Prosím vyplňte datum!')
				->addRule(UI\Form::VALID, 'Zadáno neplatné datum!');
	
        $form->addUpload('foto', 'Fotografie:')
            ->addCondition(UI\Form::FILLED)
            ->addRule(UI\Form::IMAGE, 'Obrázek musí být JPEG, PNG nebo GIF.');
		$form->addSelect('galery_album_id', 'Album:', $albas)
            ->setPrompt('Zvolte album');
	
		$form->addSubmit('save', 'Uložit');
        //$form->addSubmit('savenext', 'Uložit a Další');
		$form->onValidate[] = callback($this, 'validateReferenceForm');
        $that=$this;
        $form->onError[] = function() use($that) { $that->presenter->template->activate_admin=true; };
		
		$form->addProtection();
		
		return $form;
    }
	
	protected function createComponentPageForm()
	{
		$form = new UI\Form;
        $form->addHidden('id');
        //$form->addHidden('modified')
            //->setDefaultValue($this->presenter->user->getIdentity()->getId());
        $form->addText('title', 'Nadpis:')
            ->addRule(UI\Form::LENGTH, 'Délka nadpisu musí být mezi %d a %d znaky', array(0, 60));
        $form->addTextArea('content', 'Obsah:', 100, 25)
            ->addRule(UI\Form::MAX_LENGTH, 'Text je příliš dlouhý', 7000)
				->getControlPrototype()->class('mceEditor');;
        
        $form->addSubmit('save', 'Uložit')
			->getControlPrototype()->onclick('tinyMCE.triggerSave()');
		//$form->addSubmit('saveclose', 'Uložit a zavřít')
		//	->getControlPrototype()->onclick('tinyMCE.triggerSave()');
		
        $form->onSuccess[] = callback($this->getParent(), 'pageFormSubmitted');
        
		$form->addProtection();
		
        return $form;
	}
    
    protected function createComponentActualityForm()
    {
        $form = new UI\Form;
        $form->addHidden('id');
        $form->addHidden('moderator_id')
            ->setDefaultValue($this->presenter->user->getIdentity()->getId());
        $form->addText('title', 'Nadpis:')
            ->addRule(UI\Form::LENGTH, 'Délka nadpisu musí být mezi %d a %d znaky', array(4, 60));
        $form->addTextArea('text', 'Text:')
            ->addRule(UI\Form::MAX_LENGTH, 'Text je příliš dlouhý', 5000);
        $form->addUpload('img', 'Fotografie')
            ->addCondition(UI\Form::FILLED)
            ->addRule(UI\Form::IMAGE, 'Obrázek musí být JPEG, PNG nebo GIF.');
        
        $form->addSubmit('save', 'Uložit');
        //$form->addSubmit('savenext', 'Uložit a Další');
        $that=$this;
        $form->onError[] = function() use($that) { $that->presenter->template->activate_admin=true; };
        $form->onSuccess[] = callback($this->presenter, 'actualityFormSubmitted');
        
		$form->addProtection();
		
        return $form;
    }
    
    protected function createComponentRealizace()
    {
        $albas = $this->presenter->context->services->getAlbas();
        $form = $this->getBaseRefForm($albas);
	
		$form->onSuccess[] = callback($this->presenter, 'servicesFormSubmitted');
		
        return $form;
    }
	
	protected function createComponentContact()
    {
        $form = new UI\Form;
		$form->addHidden('id');
		$form->addHidden('contact_group_id');
		$form->addText('name', 'Jméno:');
		$form->addText('function', 'Pozice:');
		$form->addText('phone', 'Telefon:')
			->addCondition(UI\Form::FILLED)
				->addRule(UI\Form::PATTERN, 'Telefon není v platném formátu', '(\+\d{3} ?)?(\d{3} ?){3}');
		$form->addText('mail', 'E-mail:')
			->addCondition(UI\Form::FILLED)
				->addRule(UI\Form::PATTERN, 'E-mail není v platném formátu', '[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}');
		$form->addSubmit('save', 'Uložit');

		$form->onSuccess[] = callback($this->presenter, 'contactFormSubmitted');
		
		$form->addProtection();
		
        return $form;
    }
    
    protected function createComponentReference()
    {
        $albas = $this->presenter->context->reference->getAlbas();
        $form = $this->getBaseRefForm($albas, true);
	
		$form->onSuccess[] = callback($this->presenter, 'referenceFormSubmitted');
		
        return $form;
    }
	
	protected function createComponentHeslo()
	{
		$form = new UI\Form;
        $form->addHidden('id');
	
        $form->addPassword('newPassword', 'Nové heslo:', 30)
            ->addRule(UI\Form::MIN_LENGTH, 'Nové heslo musí mít alespoň %d znaků.', 5);
        $form->addPassword('confirmPassword', 'Potvrzení hesla:', 30)
            ->addRule(UI\Form::FILLED, 'Nové heslo je nutné zadat ještě jednou pro potvrzení.')
            ->addRule(UI\Form::EQUAL, 'Zadná hesla se musejí shodovat.', $form['newPassword']);
        $form->addSubmit('set', 'Změnit heslo');
        $form->onSuccess[] = callback($this->presenter, 'passwordFormSubmitted');
		
		$form->addProtection();
		
		return $form;
	}
	
	protected function createComponentAddModerator()
	{
		$form = new UI\Form;
		
		$form->addText('username', 'Username:')
			->setRequired('Zadejte prosím uživatelské jméno');
		$form->addText('name', 'Jméno:');
		$form->addText('surname', 'Příjmení:');
	
		$form->addPassword('newPassword', 'Nové heslo:', 30)
			->addRule(UI\Form::MIN_LENGTH, 'Nové heslo musí mít alespoň %d znaků.', 5);
		$form->addPassword('confirmPassword', 'Potvrzení hesla:', 30)
			->addRule(UI\Form::FILLED, 'Nové heslo je nutné zadat ještě jednou pro potvrzení.')
			->addRule(UI\Form::EQUAL, 'Zadná hesla se musejí shodovat.', $form['newPassword']);
		$form->addSubmit('submit', 'Přidat uživatele');
		$form->onSuccess[] = callback($this->presenter, 'userFormSubmitted');
		
		$form->addProtection();
		
		return $form;
	}
}

