<?php
/**
 * Air Quality Map Module 
 * @link https://www.nordmograph.com/extensions
 * @copyright Copyright (C) 2017 Adrien Roussel nordmograph.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */
// no direct access
defined('_JEXEC') or die;
JHtml::_('jquery.framework');					
					
echo '<div><select id="select'.$module->id.'" onchange="map'.$module->id.'.overlayMapTypes.insertAt(0,waqiMapOverlay'.$module->id.');" class="airselect">
	<option value="usepa-aqi" '; if($aqi =="usepa-aqi") echo ' selected="selected" ';
	echo '>- '.JText::_('MOD_AIRMAP_USEPA-AQI').'</option>
	<option value="usepa-pm25" '; if($aqi =="usepa-pm25") echo ' selected="selected" ';
	echo '>- '.JText::_('MOD_AIRMAP_USEPA-PM25').'</option>
	<option value="usepa-pm10"'; if($aqi =="usepa-pm10") echo ' selected="selected" ';
	echo '>- '.JText::_('MOD_AIRMAP_USEPA-PM10').'</option>
	<option value="usepa-o3"'; if($aqi =="usepa-o3") echo ' selected="selected" ';
	echo '>- '.JText::_('MOD_AIRMAP_USEPA-O3').'</option>
	<option value="usepa-no2"'; if($aqi =="usepa-no2") echo ' selected="selected" ';
	echo '>- '.JText::_('MOD_AIRMAP_USEPA-NO2').'</option>
	<option value="usepa-so2"'; if($aqi =="usepa-so2") echo ' selected="selected" ';
	echo '>- '.JText::_('MOD_AIRMAP_USEPA-SO2').'</option>
	<option value="usepa-co"'; if($aqi =="usepa-co") echo ' selected="selected" ';
	echo '>- '.JText::_('MOD_AIRMAP_USEPA-CO').'</option>
	<option value="asean-pm10"'; if($aqi =="asean-pm10") echo ' selected="selected" ';
	echo '>- '.JText::_('MOD_AIRMAP_ASEAN-PM10').'</option>
</select>
</div>
<div id="airmap'.$module->id.'" style="width:'.$width.';height:'.str_replace('px','', $height).'px" ></div>';

$s = "var  map".$module->id."  =  new  google.maps.Map(document.getElementById('airmap".$module->id."'),  {  
                  center:  new  google.maps.LatLng(".$latitude.",  ".$longitude."),  
                  mapTypeId:  google.maps.MapTypeId.ROADMAP,  
                  zoom:  ".$zoom." ,
				  streetViewControl: false,
				  mapTypeControl:false,
				  scrollwheel:false
              });  
	var  t  =  new  Date().getTime(); 
    var  waqiMapOverlay".$module->id."  =  new  google.maps.ImageMapType({  
		getTileUrl:  function(coord,  zoom )  {  
		var aqi  = jQuery( '#select".$module->id."' ).val();
		//jQuery( '#legend".$module->id."' ).replaceWith( 'yo' );
		return  '".$http."://tiles.aqicn.org/tiles/' + aqi + '/'  +  zoom  +  '/'  +  coord.x  +  '/'  +  coord.y  +  '.png?token=".$token."';  
    },  
    name:'Air  Quality',  
    });  
      map".$module->id.".overlayMapTypes.insertAt(0,waqiMapOverlay".$module->id."); ";
if($geoloc)
{
	$s .= "if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      map".$module->id.".setCenter(pos);
    });
  } ";
}
echo '<script>'.$s.'</script>';
?>
