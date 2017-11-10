<?php


namespace Netlte\Components\Widgets\Boxes\InfoBox;

use Netlte\Components\Widgets\Boxes\BaseBox;
use Nette\ArgumentOutOfRangeException;
use Nette\Localization\ITranslator;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
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
	private $progress = NULL;

	/** @var string|null */
	private $hint = NULL;

	/** @var string|null */
	private $link = NULL;

	/**
	 * Control constructor.
	 * @param string           $text
	 * @param string|null      $icon
	 * @param string|null      $background
	 * @param float            $value
	 * @param float|null       $progress
	 * @param string|null      $hint
	 * @param string|null      $link
	 * @param ITranslator|null $translator
	 */
	public function __construct(
		string $text,
		string $icon = NULL,
		string $background = NULL,
		float $value = 0.0,
		float $progress = NULL,
		string $hint = NULL,
		string $link = NULL,
		ITranslator $translator = NULL
	) {
		parent::__construct($text, $icon, $background, $translator);

		self::progressCheck($progress);

		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);
		$this->value = $value;
		$this->progress = $progress;
		$this->hint = $hint;
		$this->link = $link;
	}

	public function render() {
		parent::render();
		$this->getTemplate()->value = $this->getValue();
		$this->getTemplate()->progress = $this->getProgress();
		$this->getTemplate()->hint = $this->getHint();
		$this->getTemplate()->link = $this->getLink() !== NULL ? $this->getPresenter()->link($this->getLink()) : NULL;
		$this->getTemplate()->render();
	}

	/**
	 * @return float
	 */
	public function getValue(): float {
		return $this->value;
	}

	/**
	 * @param float $value
	 * @return Control
	 */
	public function setValue(float $value): Control {
		$this->value = $value;

		return $this;
	}

	/**
	 * @return float|null
	 */
	public function getProgress(): ?float {
		return $this->progress;
	}

	/**
	 * @param float|null $progress
	 * @return Control
	 */
	public function setProgress(float $progress = NULL): self {
		self::progressCheck($progress);
		$this->progress = $progress;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getHint(): ?string {
		return $this->hint;
	}

	/**
	 * @param null|string $hint
	 * @return Control
	 */
	public function setHint(string $hint = NULL): self {
		$this->hint = $hint;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getLink(): ?string {
		return $this->link;
	}

	/**
	 * @param null|string $link
	 * @return Control
	 */
	public function setLink(string $link = NULL): self {
		$this->link = $link;

		return $this;
	}

	/**
	 * @param float|null $progress
	 */
	protected static function progressCheck(float $progress = NULL) {
		if ($progress !== NULL && ($progress < self::PROGRESS_FROM || $progress > self::PROGRESS_TO)) {
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