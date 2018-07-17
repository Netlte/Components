<?php


namespace Netlte\Components\Widgets\Boxes\TabBox;

use Netlte\Components\Widgets\BaseWidget;
use Nette\Localization\ITranslator;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class Control extends BaseWidget {

	const DEFAULT_TEMPLATE = __DIR__ . DIRECTORY_SEPARATOR . 'default.latte';

	/** @var string */
	public static $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @var string|null @persistent */
	public $active = NULL;

	/**
	 * @param ITranslator|NULL $translator
	 */
	public function __construct(ITranslator $translator = NULL) {
		parent::__construct($translator);
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);
	}

	public function render() {
		$this->getTemplate()->tabs = $this->getComponents(FALSE, ITab::class);
		$this->getTemplate()->active = $this->active;

		parent::render();
		$this->getTemplate()->render();
	}

	/**
	 * @param string      $name
	 * @param string      $label
	 * @param string|null $insertBefore
	 * @return Tab
	 */
	public function addTab(string $name, string $label, string $insertBefore = NULL): Tab {
		$tab = new Tab($label, $this->getTranslator());

		$this->addComponent($tab, $name, $insertBefore);

		return $tab;
	}

	/**
	 * @param string $name
	 * @return ITab|null
	 */
	public function getTab(string $name): ?ITab {
		$tab = $this->getComponent($name);

		if (!$tab instanceof ITab) {
			return NULL;
		}

		return $tab;
	}

	/**
	 * @param string|NULL $name
	 * @return Control
	 */
	public function setActiveTab(string $name = NULL): Control {
		if ($name === NULL) {
			$this->active = NULL;
			return $this;
		}

		// check if component exist - throws
		$this->getComponent($name);

		$this->active = $name;
		return $this;
	}

}