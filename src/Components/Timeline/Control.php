<?php


namespace Netlte\Components\Timeline;

use AsIS\Exceptions\InvalidStateException;
use DateTime;
use Holabs\UI\BaseControl;
use Netlte\Components\Timeline\Entry\Control as Entry;
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

	/** @var string */
	public static $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @var bool */
	private $chapters = TRUE;


	/**
	 * Control constructor.
	 * @param ITranslator|null $translator
	 */
	public function __construct(ITranslator $translator = NULL) {
		parent::__construct($translator);
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);
	}

	public function render() {
		$this->getTemplate()->chapters = $this->chapters;

		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile());
		$this->getTemplate()->render();
	}

	/**
	 * @param IComponent  $component
	 * @param string      $name
	 * @param string|null $insertBefore
	 * @return Control
	 * @throws InvalidStateException
	 */
	public function addComponent(IComponent $component, $name, $insertBefore = NULL): self {
		throw new InvalidStateException('Cannot add custom components into the timeline');
	}

	/**
	 * @param DateTime         $time
	 * @param Html|string|null $title
	 * @return Entry
	 */
	public function addEntry(DateTime $time, $title = NULL): Entry {
		$entry = new Entry($this->getTranslator(), $time);
		$entry->setTitle($title);
		$i = 1;
		do {
			$name = "{$time->getTimestamp()}N{$i}";
			$i++;
		} while ($this->getComponent($name, FALSE) !== NULL);

		parent::addComponent($entry, $name);

		return $entry;
	}

	/**
	 * @param bool $show
	 * @return Control
	 */
	public function showChapters(bool $show = TRUE): self {
		$this->chapters = $show;

		return $this;
	}


}