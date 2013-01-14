<?php

use Nette\Application\UI;
/**
 * Homepage presenter.
 */
class ContactPresenter extends BasePresenter
{
	private $contacts;

	protected function startup()
	{
		parent::startup();
		$this->contacts = $this->context->contacts;
	}

	public function handleAddContact($group_id)
	{
		$this->template->activate_admin=true;
		$this['adminForm-contact']['contact_group_id']->setDefaultValue($group_id);
	}
	
	public function handleDelcont($id)
	{
		if (!$this->user->isLoggedIn()) {
			$this->flashMessage('Nemáte dostatečná oprávnění');
			$this->redirect ('this');
		}
		$this->contacts->delete($id);
		$this->flashMessage('Kontakt byl smazán');
		$this->redirect('this');
	}
	
	public function handleEditcont($id)
	{
		$this->template->activate_admin=true;
		$item = $this->contacts->find($id);
		$form = $this['adminForm-contact'];
		$form->setDefaults($item);
		if ($this->presenter->isAjax()) {
			$this->invalidateControl('adminFrom');
		}
	}

	protected function beforeRender()
	{
		parent::beforeRender();
		$this->template->hide_left = true;
	}
	
	public function contactFormSubmitted(UI\Form $form)
	{
		if (!$this->user->isLoggedIn()) {
			$this->flashMessage('Nemáte dostatečná oprávnění');
			$this->redirect ('this');
		}
		
		$values = $form->getValues();
		$id = $values['id'];
		unset($values['id']);
		if (!$id) {
			$this->contacts->insert($values);
			$this->flashMessage('Kontakt byl úspěšně přidán.');
		} else {
			$this->contacts->update($id, $values);
			$this->flashMessage('Kontakt byl úspěšně upraven.');
		}
		
		$this->redirect('this');
	}

	public function renderDefault()
	{
		$this->template->contact_groups = $this->contacts->findGroups();
	}
}
