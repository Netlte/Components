<?php


namespace Netlte\Components\Widgets;

use Holabs\UI\BaseControl;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
abstract class BaseWidget extends BaseControl {

	public function render(){
		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile());
	}

}