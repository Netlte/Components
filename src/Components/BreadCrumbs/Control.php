<?php


namespace Netlte\Components\BreadCrumbs;

use Holabs\UI\BaseControl;
use Nette\Localization\ITranslator;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class Control extends BaseControl {

	const DEFAULT_TEMPLATE = __DIR__ . DIRECTORY_SEPARATOR . 'default.latte';

	const DEFAULT_ICON_PREFIX = 'fa fa-';

	/** @var string */
	public static $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @var string */
	public static $ICON_PREFIX = self::DEFAULT_ICON_PREFIX;

	/** @var Bread|IBreadCrumb[] */
	private $nodes;

	/** @var string|null */
	private $icon = 'dashboard';

	/**
	 * Control constructor.
	 * @param Bread|IBreadCrumb[] $nodes
	 * @param ITranslator|null    $translator
	 */
	public function __construct(Bread $nodes, ITranslator $translator = NULL) {
		parent::__construct($translator);
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);
		$this->nodes = $nodes;
	}

	public function render() {
		$this->getTemplate()->nodes = $this->getNodes();
		$this->getTemplate()->icon = $this->getIcon() ? self::$ICON_PREFIX . $this->getIcon() : NULL;
		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile());
		$this->getTemplate()->render();
	}

	/**
	 * @return string|null
	 */
	public function getIcon(): ?string {
		return $this->icon;
	}

	/**
	 * @param string|null $icon
	 * @return Control
	 */
	public function setIcon(string $icon = NULL): self {
		$this->icon = $icon;

		return $this;
	}

	/**
	 * @return Bread|IBreadCrumb[]
	 */
	protected function getNodes() {
		return clone $this->nodes;
	}


}