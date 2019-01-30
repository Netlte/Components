<?php


namespace Netlte\Components\Widgets\Boxes\TabBox;

use Netlte\Components\Widgets\BaseWidget;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2019, Tomáš Holan [www.tomasholan.eu]
 */
class Control extends BaseWidget {

	const DEFAULT_TEMPLATE = __DIR__ . DIRECTORY_SEPARATOR . 'default.latte';

	/** @var string */
	public static $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @var string|null @persistent */
	public $active = null;

	public function __construct() {
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);
	}

	public function render(): void {
		parent::render();
		$this->getTemplate()->tabs = $this->getComponents(false, ITab::class);
		$this->getTemplate()->active = $this->active;
		$this->getTemplate()->render();
	}

	public function addTab(string $name, string $label, string $insertBefore = null): Tab {
		$tab = new Tab($label, $this->getTranslator());
		$this->addComponent($tab, $name, $insertBefore);
		return $tab;
	}

	public function getTab(string $name): ?ITab {
		$tab = $this->getComponent($name);
		return $tab instanceof ITab ? $tab : null;
	}

	public function setActiveTab(string $name = null): self {
		if ($name !== null) {
			// throw exception if Tab not exists
			$this->getComponent($name);
		}

		$this->active = $name;
		return $this;
	}

}