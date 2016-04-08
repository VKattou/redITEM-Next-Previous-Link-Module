<?php
// No direct access
defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

// Get ID of current item
$input = JFactory::getApplication()->input;
$itemid = $input->getInt('id', '');

// If no ID was gotten, get it the hard way
if (empty($itemid))
{
	$templateid = $input->get('templateId', '');

	preg_match("~^(\d+)~", $templateid, $match);
	$itemid = $match[0];
}

// Get parameters
$category = $params->get('ricategory', '1');
$sort = $params->get('risort', 'id');
$urloptions = $params->get('urloptions', '');

$rows = modReditemNextPrevLinkHelper::getItems($itemid, $category, $sort);

require JModuleHelper::getLayoutPath('mod_reditem_next_prev_link');
