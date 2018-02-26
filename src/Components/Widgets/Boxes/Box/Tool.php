<?php


namespace Netlte\Components\Widgets\Boxes\Box;

use Nette\SmartObject;


/**
 * @internal
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 *
 * @method onClick(Tool $sender)
 */
final class Tool {

	use SmartObject;

	const DEFAULT_ICON_PREFIX = 'fa fa-';

	/** @var string */
	public static $ICON_PREFIX = self::DEFAULT_ICON_PREFIX;

	/** @var \Closure[]|callable|array */
	public $onClick = [];

	/** @var bool */
	private $ajax = TRUE;

	/** @var string|null */
	private $color = NULL;

	/** @var string */
	private $icon;

	/** @var string|null */
	private $title = NULL;

	/**
	 * Tool constructor.
	 * @param string      $icon
	 * @param string|null $title
	 * @param string|null $color
	 */
	public function __construct(string $icon, string $title = NULL, string $color = NULL) {
		$this->color = $color;
		$this->icon = $icon;
		$this->title = $title;
	}

	/**
	 * @return bool
	 */
	public function isAjaxEnabled(): bool {
		return $this->ajax;
	}

	public function setAjax(bool $enable = true): self{
		$this->ajax = $enable;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getColor(): ?string {
		return $this->color;
	}

	/**
	 * @param null|string $color
	 * @return Tool
	 */
	public function setColor(?string $color): Tool {
		$this->color = $color;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getIcon(): string {
		return $this->icon;
	}

	/**
	 * @return string
	 */
	public function getFQNIcon(): string {
		return self::$ICON_PREFIX . $this->getIcon();
	}

	/**
	 * @param string $icon
	 * @return Tool
	 */
	public function setIcon(string $icon): Tool {
		$this->icon = $icon;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getTitle(): ?string {
		return $this->title;
	}

	/**
	 * @param null|string $title
	 * @return Tool
	 */
	public function setTitle(?string $title): Tool {
		$this->title = $title;

		return $this;
	}

	public function invokeClick(): void {
		$this->onClick($this);
	}


}