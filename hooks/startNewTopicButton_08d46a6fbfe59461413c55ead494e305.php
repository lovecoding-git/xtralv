<?php

class startNewTopicButton
{
	public $registry;
	public $member;
	
	public function __construct()
	{
		$this->registry = ipsRegistry::instance();
		$this->request  =& $this->registry->fetchRequest();
		$this->lang		=  $this->registry->getClass('class_localization');
	}
	
	public function getOutput()
	{	
		if (!isset( $this->request['f'] ) )
		{
			return '';
		}
	
		$canPost = $this->registry->getClass('class_forums')->canStartTopic( $this->request['f'] );

		return $this->registry->getClass('output')->getTemplate('topic')->startNewTopic( $canPost);
	}
}