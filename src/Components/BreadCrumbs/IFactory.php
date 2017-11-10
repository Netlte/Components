<?php


namespace Netlte\Components\BreadCrumbs;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
interface IFactory {

	/**
	 * @param Bread|IBreadCrumb[] $nodes
	 * @return Control
	 */
	public function create(Bread $nodes): Control;

}