<?php

/**
 * Concos - Calibre on Nextcloud OPDS Server
 *
 * @author Claas Lisowski
 * @copyright 2018 Claas Lisowski
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 */

namespace OCA\Concos;

/**
 * Config class for publishing as OPDS
 */
class Config
{
	/**
	 * @brief get user config value
	 *
	 * @param string $key value to retrieve
	 * @param string $default default value to use
	 * @return string retrieved value or default
	 */
	public static function get($key, $default) {
		return \OCP\Config::getUserValue(\OCP\User::getUser(), 'concos', $key, $default);
	}

	/**
	 * @brief set user config value
	 *
	 * @param string $key key for value to change
	 * @param string $value value to use
	 * @return bool success
	 */
	public static function set($key, $value) {
		return \OCP\Config::setUserValue(\OCP\User::getUser(), 'concos', $key, $value);
	}

	/**
	 * @brief get app config value
	 *
	 * @param string $key value to retrieve
	 * @param string $default default value to use
	 * @return string retrieved value or default
	 */
	public static function getApp($key, $default) {
		return \OCP\Config::getAppValue('concos', $key, $default);
	}

	/**
	 * @brief set app config value
	 *
	 * @param string $key key for value to change
	 * @param string $value value to use
	 * @return bool success
	 */
	public static function setApp($key, $value) {
		return \OCP\Config::setAppValue('concos', $key, $value);
	}
}
