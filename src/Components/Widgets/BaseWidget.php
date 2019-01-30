<?php


namespace Netlte\Components\Widgets;



use Netlte\Utils\UI\BaseControl;

/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2019, Tomáš Holan [www.tomasholan.eu]
 */
abstract class BaseWidget extends BaseControl {

	public function render(): void {
		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile());
	}

}