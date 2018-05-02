<?php


namespace Netlte\Components\Timeline\Entry;

use AsIS\Exceptions\InvalidArgumentException;
use AsIS\Exceptions\InvalidStateException;
use DateTime;
use Holabs\UI\BaseControl;
use Nette\ComponentModel\Container;
use Nette\ComponentModel\IComponent;
use Nette\Localization\ITranslator;
use Nette\Utils\Html;


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
	public static $DEFAULT_ICON_PREFIX = self::DEFAULT_ICON_PREFIX;

	/** @var DateTime */
	private $datetime;

	/** @var string */
	private $icon = 'circle';

	/** @var string */
	private $color = 'blue';

	/** @var Html|string|null */
	private $title = NULL;


	/**
	 * Control constructor.
	 * @param ITranslator|null $translator
	 * @param DateTime         $datetime
	 */
	public function __construct(ITranslator $translator = NULL, \DateTime $datetime) {
		parent::__construct($translator);
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);

		$this->datetime = $datetime;
	}

	public function render() {
		$this->getTemplate()->datetime = $this->getDatetime();
		$this->getTemplate()->icon = $this->getIcon();
		$this->getTemplate()->color = $this->getColor();
		$this->getTemplate()->title = $this->getTitle();
		$this->getTemplate()->prefix = self::$DEFAULT_ICON_PREFIX;

		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile());
		$this->getTemplate()->render();
	}

	/**
	 * @return DateTime
	 */
	public function getDatetime(): DateTime {
		return $this->datetime;
	}

	/**
	 * @param DateTime $datetime
	 * @return Control
	 */
	public function setDatetime(DateTime $datetime): Control {
		$this->datetime = $datetime;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getIcon(): string {
		return $this->icon;
	}

	/**
	 * @param string $icon
	 * @return Control
	 */
	public function setIcon(string $icon): Control {
		$this->icon = $icon;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getColor(): string {
		return $this->color;
	}

	/**
	 * @param string $color
	 * @return Control
	 */
	public function setColor(string $color): Control {
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
	 * @return Control
	 */
	public function setTitle($title) {
		if ($title instanceof Html || $title === NULL) {
			$this->title = $title;
		} elseif (is_scalar($title)) {
			$this->title = (string) $title;
		} else {
			throw new InvalidArgumentException(
				sprintf(
					'Method %s expect Argument 1 as NULL, scalar or \Nette\Utils\Html, %s given.',
					__METHOD__,
					is_object($title) ? get_class($title) : gettype($title)
				)
			);
		}

		return $this;
	}


}