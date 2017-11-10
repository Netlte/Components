<?php

namespace Netlte\Components\Navigation;

/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
interface IFactory {

	/**
	 * @return Control
	 */
	public function create();
	
}