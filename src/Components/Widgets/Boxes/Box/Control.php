<?php


namespace Netlte\Components\Widgets\Boxes\Box;

use Netlte\Components\Widgets\BaseWidget;
use Netlte\Exceptions\BadRequestException;
use Nette\Utils\ArrayHash;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2019, Tomáš Holan [www.tomasholan.eu]
 */
class Control extends BaseWidget {

	const DEFAULT_TEMPLATE = __DIR__ . DIRECTORY_SEPARATOR . 'default.latte';

	const DEFAULT_BACKGROUND = 'default';

	/** @var string */
	public static $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @var string|null */
	private $title = null;

	/** @var string */
	private $background = self::DEFAULT_BACKGROUND;

	/** @var Tool[]|ArrayHash */
	private $tools;

	/** @var bool */
	private $solid = true;

	/** @var bool */
	private $collabsed = false;

	/** @var bool */
	private $collabsable = false;

	/** @var bool */
	private $removable = false;

	/** @var bool */
	private $overlay = false;

	/** @var bool */
	private $padding = true;

	/** @var bool */
	private $border = true;

	public function __construct() {
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);
		$this->tools = new ArrayHash();
	}

	public function render(): void {
		parent::render();

		$this->getTemplate()->title = $this->getTitle();
		$this->getTemplate()->tools = $this->getTools();
		$this->getTemplate()->background = $this->getBackground();
		$this->getTemplate()->isSolid = $this->isSolid();
		$this->getTemplate()->isCollabsable = $this->isCollabsable();
		$this->getTemplate()->isCollabsed = $this->isCollabsed();
		$this->getTemplate()->isRemovable = $this->isRemovable();
		$this->getTemplate()->hasOverlay = $this->hasOverlay();
		$this->getTemplate()->hasPadding = $this->hasPadding();
		$this->getTemplate()->hasBorder = $this->hasBorder();
		$this->getTemplate()->hasTools = $this->hasTools();
		$this->getTemplate()->components = $this->getComponents();

		$this->getTemplate()->render();
	}

	/**
	 * @throws BadRequestException
	 */
	public function handleTool(string $tool) {
		$t = $this->getTool($tool);
		if ($t === null) {
			throw new BadRequestException("Tool with name {$tool} not found");
		}

		$t->invokeClick();
	}

	public function getBackground(): string {
		return $this->background;
	}

	public function isCollabsed(): bool {
		return $this->collabsed;
	}

	public function isCollabsable(): bool {
		return $this->collabsable;
	}

	public function hasPadding(): bool {
		return $this->padding;
	}

	public function hasBorder(): bool {
		return $this->border;
	}

	public function hasTools(): bool {
		return (bool) $this->getTools()->count() || $this->isCollabsable() || $this->isRemovable();
	}

	/**
	 * @return ArrayHash|Tool[]
	 */
	public function getTools(): ArrayHash {
		return $this->tools;
	}

	public function getTool(string $name): ?Tool {
		return $this->getTools()->offsetExists($name) ? $this->getTools()->offsetGet($name) : null;
	}

	public function removeTool(string $name): self {
		if ($this->getTools()->offsetExists($name)) {
			$this->getTools()->offsetUnset($name);
		}

		return $this;
	}

	public function addTool(string $name, string $icon): Tool {
		$tool = new Tool($icon);
		$this->getTools()->offsetSet($name, $tool);
		return $tool;
	}

	public function getTitle(): ?string {
		return $this->title;
	}

	public function isSolid(): bool {
		return $this->solid;
	}

	public function isRemovable(): bool {
		return $this->removable;
	}

	public function hasOverlay(): bool {
		return $this->overlay;
	}

	public function setBackground(string $background = self::DEFAULT_BACKGROUND): self {
		$this->background = $background;
		return $this;
	}

	public function setCollabsed(bool $collabsed = true): self {
		$this->collabsed = $collabsed;
		$this->setCollabsable($collabsed ?: $this->isCollabsable());
		return $this;
	}

	public function setCollabsable(bool $collabsable = true): self {
		$this->collabsable = $collabsable;
		return $this;
	}

	public function setPadding(bool $padding = true): self {
		$this->padding = $padding;
		return $this;
	}

	public function setBorder(bool $border = true): self {
		$this->border = $border;
		return $this;
	}

	public function setTitle(string $title = null): self {
		$this->title = $title;
		return $this;
	}

	public function setSolid(bool $solid = true): self {
		$this->solid = $solid;
		return $this;
	}

	public function setRemovable(bool $removable = true): self {
		$this->removable = $removable;
		return $this;
	}

	public function setOverlay(bool $overlay = true): self {
		$this->overlay = $overlay;
		return $this;
	}


}