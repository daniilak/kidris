<?php

/**
 * HTTP `Accept-Language` header parser
 *
 * @copyright Copyright (c) 2016 Kidris Engine
 * @author    Daniilak
 */
class AcceptLang
{
	public function getArrayLang()
	{
		$httplanguages = getenv('HTTP_ACCEPT_LANGUAGE');
		if (empty($httplanguages) && array_key_exists('HTTP_ACCEPT_LANGUAGE', $_SERVER)) 
		{
			$httplanguages = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
		}
		$languages     = array();
		if (empty($httplanguages)) {
			return $languages;
		}
		$accepted = preg_split('/,\s*/', $httplanguages);
		foreach ($accepted as $accept) 
		{
			$match  = null;
			$result = preg_match('/^([a-z]{1,8}(?:[-_][a-z]{1,8})*)(?:;\s*q=(0(?:\.[0-9]{1,3})?|1(?:\.0{1,3})?))?$/i',
				$accept, $match);

			if ($result < 1) 
			{
				continue;
			}

			if (isset($match[2]) === true) 
			{
				$quality = (float) $match[2];
			} else 
			{
				$quality = 1.0;
			}

			$countrys = explode('-', $match[1]);
			$region   = array_shift($countrys);

			$country2 = explode('_', $region);
			$region   = array_shift($country2);

			foreach ($countrys as $country) 
			{
				$languages[$region . '_' . strtoupper($country)] = $quality;
			}

			foreach ($country2 as $country) 
			{
				$languages[$region . '_' . strtoupper($country)] = $quality;
			}

			if ((isset($languages[$region]) === false) || ($languages[$region] < $quality)) 
			{
				$languages[$region] = $quality;
			}
			return $languages;
		} //foreach ($accepted as $accept)
	} //public function getArrayLang()
	public function getDefineWords($lang)
	{
		switch ($lang) {
		  case isset($lang['uk']):
		    require('lib/locale/en.php');
		    break;
		  case (isset($lang['ru']) || isset($lang['ru_RU'])):
		    require('lib/locale/ru.php');
		    break;
		  case (isset($lang['en']) || isset($lang['en_US'])):
		    require('lib/locale/ru.php');
		    break;
		  case isset($lang['uk4']):
		    require('lib/locale/ru.php');
		    break;
		  default:
		    require('lib/locale/ru.php');
		    break;
		}
		return $_LANG;
	}
}  //class AcceptLang