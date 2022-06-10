<?php

class task_item
{
	/**
	* Constructor
	*
	* @access    public
	* @param     object        ipsRegistry reference
	* @param     object        Parent task class
	* @param    array         This task data
	* @return    void
	*/
	public function __construct(ipsRegistry $registry, $class, $task)
	{
		$this->registry  = $registry;
	    $this->class     = $class;
	    $this->task      = $task;
	}
	
	public function runTask()
	{
		$from = time() - (86400*35);
		
		ipsRegistry::DB()->delete('search_visitors', 'date < ' . $from);
		ipsRegistry::DB()->update('task_manager', array('task_locked' => 0), 'task_key = \'ipseo_sitemap_generator\'');
		
		$this->class->appendTaskLog($this->task, 'Daily cleanup completed.');
		$this->class->unlockTask($this->task);
		
		return true;
	}
}