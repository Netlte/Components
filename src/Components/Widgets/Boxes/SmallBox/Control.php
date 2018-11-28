<?php


namespace Netlte\Components\Widgets\Boxes\SmallBox;

use Netlte\Components\Widgets\Boxes\BaseBox;
use Nette\Localization\ITranslator;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class Control extends BaseBox {

	const DEFAULT_TEMPLATE = __DIR__ . DIRECTORY_SEPARATOR . 'default.latte';

	/** @var string */
	public static $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @var string */
	public static $ICON_PREFIX = "ion ion-";

	/** @var string */
	private $header = '';

	/** @var string|null */
	private $link = NULL;

	/** @var bool */
	private $smaller = FALSE;

	/**
	 * Control constructor.
	 * @param string           $text
	 * @param string|null      $icon
	 * @param string|null      $background
	 * @param string           $header
	 * @param string|null      $link
	 * @param ITranslator|null $translator
	 */
	public function __construct(
		string $text,
		string $icon = NULL,
		string $background = NULL,
		string $header = '',
		string $link = NULL,
		ITranslator $translator = NULL
	) {
		parent::__construct($text, $icon, $background, $translator);
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);
		$this->header = $header;
		$this->link = $link;
	}

	public function render() {
		parent::render();
		$this->getTemplate()->icon_prefix = self::$ICON_PREFIX;
		$this->getTemplate()->header = $this->getHeader();
		$this->getTemplate()->link = $this->getLink() !== NULL ? $this->getPresenter()->link($this->getLink()) : NULL;
		$this->getTemplate()->isSmaller = $this->isSmaller();
		$this->getTemplate()->render();
	}

	/**
	 * @return string
	 */
	public function getHeader(): string {
		return $this->header;
	}

	/**
	 * @param string $header
	 * @return Control
	 */
	public function setHeader(string $header): Control {
		$this->header = $header;

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
	 * @return bool
	 */
	public function isSmaller(): bool {
		return $this->smaller;
	}

	/**
	 * @param bool $smaller
	 * @return Control
	 */
	public function setSmaller(bool $smaller = TRUE): self {
		$this->smaller = $smaller;

		return $this;
	}


}