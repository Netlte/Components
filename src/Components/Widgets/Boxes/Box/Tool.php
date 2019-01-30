<?php


namespace Netlte\Components\Widgets\Boxes\Box;

use Nette\SmartObject;


/**
 * @internal
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2019, Tomáš Holan [www.tomasholan.eu]
 *
 * @method onClick(Tool $sender)
 */
final class Tool {

	use SmartObject;

	const DEFAULT_ICON_PREFIX = 'fa fa-';

	/** @var string */
	public static $ICON_PREFIX = self::DEFAULT_ICON_PREFIX;

	/** @var \Closure[]|callable[]|array */
	public $onClick = [];

	/** @var bool */
	private $ajax = true;

	/** @var string|null */
	private $color = null;

	/** @var string */
	private $icon;

	/** @var string|null */
	private $title = null;


	public function __construct(string $icon, string $title = null, string $color = null) {
		$this->color = $color;
		$this->icon = $icon;
		$this->title = $title;
	}

	public function isAjaxEnabled(): bool {
		return $this->ajax;
	}

	public function setAjax(bool $enable = true): self{
		$this->ajax = $enable;
		return $this;
	}

	public function getColor(): ?string {
		return $this->color;
	}

	public function setColor(?string $color): self {
		$this->color = $color;
		return $this;
	}

	public function getIcon(): string {
		return $this->icon;
	}

	public function getFQNIcon(): string {
		return self::$ICON_PREFIX . $this->getIcon();
	}

	public function setIcon(string $icon): self {
		$this->icon = $icon;
		return $this;
	}

	public function getTitle(): ?string {
		return $this->title;
	}

	public function setTitle(?string $title): self {
		$this->title = $title;
		return $this;
	}

	public function invokeClick(): void {
		$this->onClick($this);
	}


}