<?php


namespace Netlte\Components\BreadCrumbs;

use Netlte\Utils\UI\BaseControl;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2019, Tomáš Holan [www.tomasholan.eu]
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

	public function __construct(Bread $nodes) {
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);
		$this->nodes = $nodes;
	}

	public function render(): void {
		$this->getTemplate()->nodes = $this->getNodes();
		$this->getTemplate()->icon = $this->getIcon() ? self::$ICON_PREFIX . $this->getIcon() : null;
		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile());
		$this->getTemplate()->render();
	}

	public function getIcon(): ?string {
		return $this->icon;
	}

	public function setIcon(string $icon = null): self {
		$this->icon = $icon;
		return $this;
	}

	protected function getNodes(): Bread {
		return clone $this->nodes;
	}


}