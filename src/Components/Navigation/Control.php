<?php

namespace Netlte\Components\Navigation;

use Holabs\Navigation\IManager;
use Holabs\UI\BaseControl;
use Nette\Localization\ITranslator;

/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class Control extends BaseControl {

	const DEFAULT_TEMPLATE = __DIR__ . DIRECTORY_SEPARATOR . 'default.latte';

	/** @var string */
	public static $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @var IManager */
	private $manager;

	/**
	 * @param IManager         $manager
	 * @param ITranslator|null $translator
	 */
	public function __construct(IManager $manager, ITranslator $translator = NULL) {
		parent::__construct($translator);
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);
		$this->manager = $manager;
	}

	public function render() {
		$this->getTemplate()->sections = $this->manager->getSections();
		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile());
		$this->getTemplate()->render();
	}

	/**
	 * @return IManager
	 */
	public function getManager(): IManager {
		return $this->manager;
	}

}