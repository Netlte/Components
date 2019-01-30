<?php


namespace Netlte\Components\Timeline;

use DateTime;
use Netlte\Components\Timeline\Entry\Control as Entry;
use Netlte\Exceptions\InvalidStateException;
use Netlte\Utils\UI\BaseControl;
use Nette\ComponentModel\IComponent;
use Nette\Utils\Html;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2019, Tomáš Holan [www.tomasholan.eu]
 */
class Control extends BaseControl {

	const DEFAULT_TEMPLATE = __DIR__ . DIRECTORY_SEPARATOR . 'default.latte';

	/** @var string */
	public static $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @var bool */
	private $chapters = true;


	public function __construct() {
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);
	}

	public function render(): void {
		$this->getTemplate()->chapters = $this->chapters;

		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile());
		$this->getTemplate()->render();
	}

	public function addComponent(IComponent $component, ?string $name, string $insertBefore = null): self {
		throw new InvalidStateException('Cannot add custom components into the timeline');
	}

	/**
	 * @param DateTime         $time
	 * @param Html|string|null $title
	 * @return Entry
	 */
	public function addEntry(DateTime $time, $title = null): Entry {
		$entry = new Entry($time);
		$entry->setTitle($title);
		$i = 1;
		do {
			$name = "{$time->getTimestamp()}N{$i}";
			$i++;
		} while ($this->getComponent($name, false) !== null);

		parent::addComponent($entry, $name);

		return $entry;
	}

	public function showChapters(bool $show = true): self {
		$this->chapters = $show;
		return $this;
	}


}