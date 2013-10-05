<?php

/**
 * Webhooks module definition
 *
 * @package activeCollab.modules.webhooks
 * @subpackage models
 */
class WebhooksModule extends AngieModule
{
	/**
	 * Plain module name
	 *
	 * @var string
	 */
	protected $name = 'webhooks';

	/**
	 * Module version
	 *
	 * @var string
	 */
	protected $version = '1.0.4013';

	// ---------------------------------------------------
	//  Events and Routes
	// ---------------------------------------------------

	/**
	 * Define module routes
	 */
	function defineRoutes()
	{
		// Admin
		Router::map('admin_webhooks', '/admin/tools/webhooks', array('controller' => 'webhooks_admin', 'action' => 'index'));
	}

	/**
	 * Define event handlers
	 */
	function defineHandlers()
	{
		EventsManager::listen('on_admin_panel', 'on_admin_panel');

		$handlers_path	=	ENVIRONMENT_PATH.'/custom/modules/webhooks/handlers';
		
		if( ! is_writable($handlers_path))
			throw new Exception($handlers_path.' is not writable!');
		
		$handler_tpl_content	=	file_get_contents(ENVIRONMENT_PATH.'/custom/modules/webhooks/resources/callback_template.php');
				
		foreach(Webhooks::getEvents() as $eventname)
		{
			EventsManager::listen($eventname, 'callback_'.$eventname);

			$path	=	$handlers_path.'/callback_'.$eventname.'.php';

			// create handler if needed
			if( ! is_file($path))
				file_put_contents($path, str_replace('{$eventname}', $eventname, $handler_tpl_content));
		}
	}

	// ---------------------------------------------------
	//  Name
	// ---------------------------------------------------

	/**
	 * Get module display name
	 *
	 * @return string
	 */
	function getDisplayName()
	{
		return lang('Webhooks');
	}

	/**
	 * Return module description
	 *
	 * @return string
	 */
	function getDescription()
	{
		return lang('Enables you to call an external url on an event-base');
	}

	/**
	 * Return module uninstallation message
	 *
	 * @return string
	 */
	function getUninstallMessage()
	{
		return lang('Module will be deactivated. All data generated using it will be deleted');
	}
}