<?php


namespace Netlte\Components\Widgets\Boxes\Box;

use Netlte\Components\Widgets\BaseWidget;
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
	private $border = TRUE;

	public function __construct(ITranslator $translator = NULL) {
		parent::__construct($translator);
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);
	}

	public function render() {

		$this->getTemplate()->title = $this->getTitle();
		$this->getTemplate()->background = $this->getBackground();
		$this->getTemplate()->isSolid = $this->isSolid();
		$this->getTemplate()->isCollabsable = $this->isCollabsable();
		$this->getTemplate()->isCollabsed = $this->isCollabsed();
		$this->getTemplate()->isRemovable = $this->isRemovable();
		$this->getTemplate()->hasOverlay = $this->hasOverlay();
		$this->getTemplate()->hasBorder = $this->hasBorder();
		$this->getTemplate()->components = $this->getComponents();

		parent::render();
		$this->getTemplate()->render();
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
	public function hasBorder(): bool {
		return $this->border;
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