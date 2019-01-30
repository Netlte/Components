<?php

namespace Netlte\Components\Navigation;

use Holabs\Navigation\IManager;
use Netlte\Utils\UI\BaseControl;

/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2019, Tomáš Holan [www.tomasholan.eu]
 */
class Control extends BaseControl {

	const DEFAULT_TEMPLATE = __DIR__ . DIRECTORY_SEPARATOR . 'default.latte';

	/** @var string */
	public static $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @var IManager */
	private $manager;

	public function __construct(IManager $manager) {
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);
		$this->manager = $manager;
	}

	public function render(): void {
		$this->getTemplate()->sections = $this->manager->getSections();
		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile());
		$this->getTemplate()->render();
	}

	public function getManager(): IManager {
		return $this->manager;
	}

}