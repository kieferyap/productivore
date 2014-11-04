<?php

/**
 * AchievementsForm class.
 * AchievementsForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class JournalForm extends CFormModel
{
	public $journal_title;
	public $journal_body;
	public $list_id;

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('journal_body, list_id', 'required'),
			array('journal_title', 'safe'),
			array('journal_title, journal_body, list_id', 'validateForm'),
		);
	}
	
	public function validateForm()
	{
		$fields = array();
		$error_message = '';
		if(trim($this->journal_body) == ''){
			$fields[] = 'Journal Body';
		}
		
		if(count($fields) > 0){
			$temp = '<ul>';
			foreach($fields as $field){
				$temp.='<li>'.$field.'</li>';
			}
			$temp.= '</ul>';
			
			$error_message = 'The following fields need to be filled: '.$temp;
		}
		
		$fields = array();
		if(strlen($this->journal_title) > 128){
			$fields[] = 'Journal Title (128 characters maximum)';
		}
		
		if(count($fields) > 0){
			$temp = '<ul>';
			foreach($fields as $field){
				$temp.='<li>'.$field.'</li>';
			}
			$temp.= '</ul>';
			
			$error_message .= 'The character counts of the following fields exceeded their limits: '.$temp;
		}
		
		if($error_message != '')
			Yii::app()->user->setFlash('error',$error_message);
	}
	
	public function addJournalEntry(){
		$journalPosts = new JournalPosts;
		
		$journalPosts->title = $this->journal_title;
		$journalPosts->body = $this->journal_body;
		$journalPosts->inserted_on = date('Y-m-d H:i:s');		
		$journalPosts->parent_list_id = $this->list_id;
		$journalPosts->user_id = Yii::app()->user->getId();		
		
		if($journalPosts->save()){
			return true;
		}
		return false;
	}
	 
}
