<?php

/**
 * Webhooks module initialization file
 *
 * @package activeCollab.modules.webhooks
 */
define('WEBHOOKS_MODULE', 'webhooks');
define('WEBHOOKS_MODULE_PATH', CUSTOM_PATH.'/modules/webhooks');

AngieApplication::useModel('webhooks', WEBHOOKS_MODULE);
