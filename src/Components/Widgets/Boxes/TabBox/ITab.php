<?php


namespace Netlte\Components\Widgets\Boxes\TabBox;

use Nette\ComponentModel\IComponent;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2019, Tomáš Holan [www.tomasholan.eu]
 */
interface ITab extends IComponent {

	public function getLabel(): string;

	public function setLabel(string $label): ITab;

}