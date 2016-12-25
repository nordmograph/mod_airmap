<?php
/**
 * Air Quality Map Module 
 * @link https://www.nordmograph.com/extensions
 * @copyright Copyright (C) 2017 Adrien Roussel nordmograph.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
// no direct access
defined('_JEXEC') or die;

$class_sfx 	= htmlspecialchars($params->get('class_sfx'));
$latitude 	= htmlspecialchars($params->get('latitude','50'));
$longitude 	= htmlspecialchars($params->get('longitude','3'));
$zoom 		= htmlspecialchars($params->get('zoom','10'));
$width 		= $params->get('width','100%');
$height 	= $params->get('width','400px');
$apikey 	= $params->get('apikey');
$token 		= $params->get('token');
$aqi 		= $params->get( 'aqi', 'usepa-aqi');
$http 		= $params->get( 'http', 'http');
$geoloc 	= $params->get( 'geoloc', 1);

$doc = JFactory::getDocument();
$doc->addStylesheet(JURI::base().'modules/mod_airmap/css/style.css');
if($apikey)
	$doc->addScript('//maps.googleapis.com/maps/api/js?key='.$apikey );
require(JModuleHelper::getLayoutPath('mod_airmap', $params->get('layout', 'default')));
