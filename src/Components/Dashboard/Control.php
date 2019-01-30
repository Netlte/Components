<?php


namespace Netlte\Components\Dashboard;

use Netlte\Utils\UI\BaseControl;
use Nette\ComponentModel\Container;
use Nette\ComponentModel\IComponent;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2019, Tomáš Holan [www.tomasholan.eu]
 */
class Control extends BaseControl {

	const DEFAULT_TEMPLATE = __DIR__ . DIRECTORY_SEPARATOR . 'default.latte';

	public static $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @var Container */
	private $boxes;

	/** @var Container */
	private $widgets;

	public function __construct() {
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);

		$this->boxes = new Container();
		$this->widgets = new Container();

		parent::addComponent($this->boxes, 'boxes');
		parent::addComponent($this->widgets, 'widgets');
	}

	public function render(): void {
		$this->getTemplate()->boxes = $this->getBoxes()->getComponents();
		$this->getTemplate()->widgets = $this->getWidgets()->getComponents();

		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile());
		$this->getTemplate()->render();
	}

	public function addComponent(IComponent $component, ?string $name, string $insertBefore = null): self {
		$this->getWidgets()->addComponent($component, $name, $insertBefore);
		return $this;
	}

	public function addWidget(IComponent $component, ?string $name, string $insertBefore = null): self {
		return $this->addComponent($component, $name, $insertBefore);
	}

	public function addBox(IComponent $component, ?string $name, string $insertBefore = null): self {
		$this->getBoxes()->addComponent($component, $name, $insertBefore);
		return $this;
	}

	public function getBoxes(): Container {
		return $this->boxes;
	}

	public function getWidgets(): Container {
		return $this->widgets;
	}


}