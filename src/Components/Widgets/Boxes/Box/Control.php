<?php


namespace Netlte\Components\Widgets\Boxes\Box;

use Holabs\Utils\ArrayHash;
use Netlte\Components\Widgets\BaseWidget;
use Nette\Application\BadRequestException;
use Nette\Localization\ITranslator;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class Control extends BaseWidget {

	const DEFAULT_TEMPLATE = __DIR__ . DIRECTORY_SEPARATOR . 'default.latte';

	const DEFAULT_BACKGROUND = 'default';

	/** @var string */
	public static $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @var string|null */
	private $title = NULL;

	/** @var string */
	private $background = self::DEFAULT_BACKGROUND;

	/** @var Tool[]|ArrayHash */
	private $tools;

	/** @var bool */
	private $solid = TRUE;

	/** @var bool */
	private $collabsed = FALSE;

	/** @var bool */
	private $collabsable = FALSE;

	/** @var bool */
	private $removable = FALSE;

	/** @var bool */
	private $overlay = FALSE;

	/** @var bool */
	private $padding = TRUE;

	/** @var bool */
	private $border = TRUE;

	public function __construct(ITranslator $translator = NULL) {
		parent::__construct($translator);
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);
		$this->tools = new ArrayHash();
	}

	public function render() {

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

		parent::render();
		$this->getTemplate()->render();
	}

	/**
	 * @param string $tool
	 * @throws BadRequestException
	 */
	public function handleTool(string $tool) {
		$t = $this->getTool($tool);
		if ($t === NULL) {
			throw new BadRequestException("Tool with name {$tool} not found");
		}

		$t->invokeClick();
	}

	/**
	 * @return string
	 */
	public function getBackground(): string {
		return $this->background;
	}

	/**
	 * @return bool
	 */
	public function isCollabsed(): bool {
		return $this->collabsed;
	}

	/**
	 * @return bool
	 */
	public function isCollabsable(): bool {
		return $this->collabsable;
	}

	/**
	 * @return bool
	 */
	public function hasPadding(): bool {
		return $this->padding;
	}

	/**
	 * @return bool
	 */
	public function hasBorder(): bool {
		return $this->border;
	}

	/**
	 * @return bool
	 */
	public function hasTools(): bool {
		return (bool) $this->getTools()->count() || $this->isCollabsable() || $this->isRemovable();
	}

	/**
	 * @return ArrayHash|Tool[]
	 */
	public function getTools() {
		return $this->tools;
	}

	/**
	 * @param string $name
	 * @return Tool|null
	 */
	public function getTool(string $name): ?Tool {
		return $this->getTools()->offsetGetExists($name);
	}

	/**
	 * @param string $name
	 * @return Control
	 */
	public function removeTool(string $name): self {
		if ($this->getTools()->offsetExists($name)) {
			$this->getTools()->offsetUnset($name);
		}

		return $this;
	}

	/**
	 * @param string $name
	 * @param string $icon
	 * @return Tool
	 */
	public function addTool(string $name, string $icon) {
		$tool = new Tool($icon);
		$this->getTools()->offsetSet($name, $tool);
		return $tool;
	}

	/**
	 * @return string|null
	 */
	public function getTitle(): ?string {
		return $this->title;
	}

	/**
	 * @return bool
	 */
	public function isSolid(): bool {
		return $this->solid;
	}

	/**
	 * @return bool
	 */
	public function isRemovable(): bool {
		return $this->removable;
	}

	/**
	 * @return bool
	 */
	public function hasOverlay(): bool {
		return $this->overlay;
	}

	/**
	 * @param string $background
	 * @return Control
	 */
	public function setBackground(string $background = self::DEFAULT_BACKGROUND): Control {
		$this->background = $background;

		return $this;
	}

	/**
	 * @param bool $collabsed
	 * @return Control
	 */
	public function setCollabsed(bool $collabsed = TRUE): Control {
		$this->collabsed = $collabsed;

		if ($collabsed) {
			$this->setCollabsable();
		}

		return $this;
	}

	/**
	 * @param bool $collabsable
	 * @return Control
	 */
	public function setCollabsable(bool $collabsable = TRUE): Control {
		$this->collabsable = $collabsable;

		return $this;
	}

	/**
	 * @param bool $padding
	 * @return Control
	 */
	public function setPadding(bool $padding = TRUE): Control {
		$this->padding = $padding;

		return $this;
	}

	/**
	 * @param bool $border
	 * @return Control
	 */
	public function setBorder(bool $border = TRUE): Control {
		$this->border = $border;

		return $this;
	}

	/**
	 * @param string|null $title
	 * @return Control
	 */
	public function setTitle(string $title = NULL): Control {
		$this->title = $title;

		return $this;
	}

	/**
	 * @param bool $solid
	 * @return Control
	 */
	public function setSolid(bool $solid = TRUE): Control {
		$this->solid = $solid;

		return $this;
	}

	/**
	 * @param bool $removable
	 * @return Control
	 */
	public function setRemovable(bool $removable = TRUE): Control {
		$this->removable = $removable;

		return $this;
	}

	/**
	 * @param bool $overlay
	 * @return Control
	 */
	public function setOverlay(bool $overlay = TRUE): Control {
		$this->overlay = $overlay;

		return $this;
	}


}