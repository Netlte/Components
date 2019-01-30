<?php


namespace Netlte\Components\Widgets\Boxes\InfoBox;

use Netlte\Components\Widgets\Boxes\BaseBox;
use Nette\ArgumentOutOfRangeException;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2019, Tomáš Holan [www.tomasholan.eu]
 */
class Control extends BaseBox {

	const DEFAULT_TEMPLATE = __DIR__ . DIRECTORY_SEPARATOR . 'default.latte';

	const PROGRESS_FROM = 0;

	const PROGRESS_TO = 100;

	/** @var string */
	public static $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @var float */
	private $value = 0.0;

	/** @var float|null */
	private $progress = null;

	/** @var string|null */
	private $hint = null;

	/** @var string|null */
	private $link = null;

	public function __construct(
		string $text,
		string $icon = null,
		string $background = null,
		float $value = 0.0,
		float $progress = null,
		string $hint = null,
		string $link = null
	) {
		parent::__construct($text, $icon, $background);
		self::progressCheck($progress);

		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);
		$this->value = $value;
		$this->progress = $progress;
		$this->hint = $hint;
		$this->link = $link;
	}

	/**
	 * @throws \Nette\Application\UI\InvalidLinkException
	 */
	public function render(): void {
		parent::render();
		$this->getTemplate()->value = $this->getValue();
		$this->getTemplate()->progress = $this->getProgress();
		$this->getTemplate()->hint = $this->getHint();
		$this->getTemplate()->link = $this->getLink() !== null ? $this->getPresenter()->link($this->getLink()) : null;
		$this->getTemplate()->render();
	}

	public function getValue(): float {
		return $this->value;
	}

	public function setValue(float $value): self {
		$this->value = $value;
		return $this;
	}

	public function getProgress(): ?float {
		return $this->progress;
	}

	public function setProgress(float $progress = null): self {
		self::progressCheck($progress);
		$this->progress = $progress;
		return $this;
	}

	public function getHint(): ?string {
		return $this->hint;
	}

	public function setHint(string $hint = null): self {
		$this->hint = $hint;
		return $this;
	}

	public function getLink(): ?string {
		return $this->link;
	}

	public function setLink(string $link = null): self {
		$this->link = $link;
		return $this;
	}

	/**
	 * @throws ArgumentOutOfRangeException
	 */
	protected static function progressCheck(float $progress = null) {
		if ($progress !== null && ($progress < self::PROGRESS_FROM || $progress > self::PROGRESS_TO)) {
			throw new ArgumentOutOfRangeException(
				sprintf(
					'Progress value should be between %f and %f, %f given',
					self::PROGRESS_FROM,
					self::PROGRESS_TO,
					$progress
				)
			);
		}
	}

}