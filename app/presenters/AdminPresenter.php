<?php

use Nette\Application\UI,
	Nette\Security as NS;

/**
 * Homepage presenter.
 */
class AdminPresenter extends BasePresenter
{
    private $moderators;
    
    protected function startup()
    {
        parent::startup();
        if(!$this->getUser()->isLoggedIn() && $this->getView()!='in' )
            $this->redirect('in');
	$this->moderators = $this->context->moderators;
    }

    public function handleEditpass($id)
    {
        $this->template->activate_admin=true;
        $form = $this["adminForm-heslo"];
        $form['id']->setDefaultValue($id);
        if ($this->presenter->isAjax()) {
            $this->invalidateControl('adminFrom');
        }
    }
	public function handleAddmod()
    {
        $this->template->activate_admin=true;
        $this["adminForm-addModerator"];
        if ($this->presenter->isAjax()) {
            $this->invalidateControl('adminFrom');
        }
    }
    
    protected function beforeRender()
    {
        parent::beforeRender();
        $this->template->hide_left = true;
    }
    
    public function renderDefault()
    {
        $data = $this->user->getIdentity()->getData();
	$this->template->userid = $this->user->getIdentity()->getId();
	$this->template->username = $data["username"];
	    
	$this->template->moderators = $this->moderators->getModerators($this->template->userid);
    }

    	/**
	 * Sign in form component factory.
	 * @return Nette\Application\UI\Form
	 */
	protected function createComponentSignInForm()
	{
		$form = new UI\Form;
		$form->addText('username', 'Username:')
			->setRequired('Please provide a username.');

		$form->addPassword('password', 'Password:')
			->setRequired('Please provide a password.');

		$form->addCheckbox('remember', 'Remember me on this computer');

		$form->addSubmit('send', 'Sign in');

		$form->onSuccess[] = $this->signInFormSubmitted;
		return $form;
	}



	public function signInFormSubmitted($form)
	{
		try {
			$values = $form->getValues();
			if ($values->remember) {
				$this->getUser()->setExpiration('+ 14 days', FALSE);
			} else {
				$this->getUser()->setExpiration('+ 20 minutes', TRUE);
			}
			$this->getUser()->login($values->username, $values->password);
			$this->redirect('Admin:');

		} catch (NS\AuthenticationException $e) {
			$form->addError($e->getMessage());
		}
	}



	public function actionOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('You have been signed out.');
		$this->redirect('in');
	}
	
    public function passwordFormSubmitted(UI\Form $form)
    {
		$values = $form->getValues();
		$id = $values['id'];
		unset($values['id']);

		$this->moderators->setPassword($id, $values->newPassword);
		$this->flashMessage('Heslo bylo změněno.', 'success');
		$this->redirect('this');
    }
    
    public function createComponentAdminForm()
    {
        
        return new AdminForm;
    }
    
	public function userFormSubmitted(UI\Form $form)
	{
		if (!$this->user->isLoggedIn()) {
			$this->flashMessage('Nemáte dostatečná oprávnění.');
			$this->redirect('this');
		}
		
		$values = $form->getValues();
		$values['password'] = $values['newPassword'];
		unset($values['newPassword']);
		unset($values['confirmPassword']);
		$this->moderators->addModerator($values);
		
		$this->flashMessage('Moderátor úspěšně přidán');
		$this->redirect('this');
	}
}
