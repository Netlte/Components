<?php


namespace Netlte\Components\BreadCrumbs;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2019, Tomáš Holan [www.tomasholan.eu]
 */
interface IFactory {

	public function create(Bread $nodes): Control;

}