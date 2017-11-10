<?php


namespace Netlte\Components\Dashboard;

use Holabs\UI\BaseControl;
use Nette\ComponentModel\Container;
use Nette\ComponentModel\IComponent;
use Nette\Localization\ITranslator;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class Control extends BaseControl {

	const DEFAULT_TEMPLATE = __DIR__ . DIRECTORY_SEPARATOR . 'default.latte';

	public static $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @var Container */
	private $boxes;

	/** @var Container */
	private $widgets;

	/**
	 * Control constructor.
	 * @param ITranslator|null $translator
	 */
	public function __construct(ITranslator $translator = NULL) {
		parent::__construct($translator);
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);

		$this->boxes = new Container();
		$this->widgets = new Container();

		parent::addComponent($this->boxes, 'boxes');
		parent::addComponent($this->widgets, 'widgets');
	}

	public function render() {
		$this->getTemplate()->boxes = $this->getBoxes()->getComponents();
		$this->getTemplate()->widgets = $this->getWidgets()->getComponents();

		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile());
		$this->getTemplate()->render();
	}

	/**
	 * @param IComponent  $component
	 * @param string      $name
	 * @param string|null $insertBefore
	 * @return Control
	 */
	public function addComponent(IComponent $component, $name, $insertBefore = NULL): self {
		$this->getWidgets()->addComponent($component, $name, $insertBefore);

		return $this;
	}

	/**
	 * @param IComponent  $component
	 * @param string      $name
	 * @param string|null $insertBefore
	 * @return Control
	 */
	public function addWidget(IComponent $component, $name, $insertBefore = NULL): self {
		return $this->addComponent($component, $name, $insertBefore);
	}

	/**
	 * @param IComponent  $component
	 * @param string      $name
	 * @param string|null $insertBefore
	 * @return Control
	 */
	public function addBox(IComponent $component, $name, $insertBefore = NULL): self {
		$this->getBoxes()->addComponent($component, $name, $insertBefore);

		return $this;
	}

	/**
	 * @return Container
	 */
	public function getBoxes(): Container {
		return $this->boxes;
	}

	/**
	 * @return Container
	 */
	public function getWidgets(): Container {
		return $this->widgets;
	}


}