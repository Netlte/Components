<?php


namespace Netlte\Components\Timeline\Entry;

use DateTime;
use Netlte\Exceptions\InvalidArgumentException;
use Netlte\Utils\UI\BaseControl;
use Nette\Utils\Html;


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
	public static $DEFAULT_ICON_PREFIX = self::DEFAULT_ICON_PREFIX;

	/** @var DateTime */
	private $datetime;

	/** @var string */
	private $icon = 'circle';

	/** @var string */
	private $color = 'blue';

	/** @var Html|string|null */
	private $title = null;

	
	public function __construct(\DateTime $datetime) {
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);

		$this->datetime = $datetime;
	}

	public function render(): void {
		$this->getTemplate()->datetime = $this->getDatetime();
		$this->getTemplate()->icon = $this->getIcon();
		$this->getTemplate()->color = $this->getColor();
		$this->getTemplate()->title = $this->getTitle();
		$this->getTemplate()->prefix = self::$DEFAULT_ICON_PREFIX;

		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile());
		$this->getTemplate()->render();
	}

	public function getDatetime(): DateTime {
		return $this->datetime;
	}

	public function setDatetime(DateTime $datetime): self {
		$this->datetime = $datetime;
		return $this;
	}

	public function getIcon(): string {
		return $this->icon;
	}

	public function setIcon(string $icon): self {
		$this->icon = $icon;
		return $this;
	}

	public function getColor(): string {
		return $this->color;
	}

	public function setColor(string $color): self {
		$this->color = $color;
		return $this;
	}

	/**
	 * @return Html|null|string
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * @param Html|null|string $title
	 */
	public function setTitle($title): self {
		if ($title instanceof Html || $title === null) {
			$this->title = $title;
		} elseif (is_scalar($title)) {
			$this->title = (string) $title;
		} else {
			throw new InvalidArgumentException(
				sprintf(
					'Method %s expect Argument 1 as NULL, scalar or %s, %s given.',
					__METHOD__,
					Html::class,
					is_object($title) ? get_class($title) : gettype($title)
				)
			);
		}

		return $this;
	}


}