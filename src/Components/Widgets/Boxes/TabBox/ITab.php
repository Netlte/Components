<?php


namespace Netlte\Components\Widgets\Boxes\TabBox;

use Nette\ComponentModel\IComponent;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
interface ITab extends IComponent {

	/**
	 * @return string
	 */
	public function getLabel(): string;

	/**
	 * @param string $label
	 * @return ITab
	 */
	public function setLabel(string $label): ITab;

}