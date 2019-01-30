<?php


namespace Netlte\Components\BreadCrumbs;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2019, Tomáš Holan [www.tomasholan.eu]
 */
interface IBreadCrumb {

	public function getTitle(): string;

	public function getLink(): string;

	public function getArgs(): array;

}