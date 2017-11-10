<?php


namespace Netlte\Components\BreadCrumbs;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
interface IBreadCrumb {

	/**
	 * @return string
	 */
	public function getTitle(): string;

	/**
	 * @return string
	 */
	public function getLink(): string;

	/**
	 * @return array
	 */
	public function getArgs(): array;

}