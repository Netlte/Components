<?php


namespace Netlte\Components\Widgets\Boxes\SmallBox;

use Netlte\Components\Widgets\Boxes\BaseBox;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2019, Tomáš Holan [www.tomasholan.eu]
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
	private $link = null;

	/** @var bool */
	private $smaller = false;


	public function __construct(
		string $text,
		string $icon = null,
		string $background = null,
		string $header = '',
		string $link = null
	) {
		parent::__construct($text, $icon, $background);
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);
		$this->header = $header;
		$this->link = $link;
	}

	/**
	 * @throws \Nette\Application\UI\InvalidLinkException
	 */
	public function render(): void {
		parent::render();
		$this->getTemplate()->icon_prefix = self::$ICON_PREFIX;
		$this->getTemplate()->header = $this->getHeader();
		$this->getTemplate()->link = $this->getLink() !== null ? $this->getPresenter()->link($this->getLink()) : null;
		$this->getTemplate()->isSmaller = $this->isSmaller();
		$this->getTemplate()->render();
	}

	public function getHeader(): string {
		return $this->header;
	}

	public function setHeader(string $header): self {
		$this->header = $header;
		return $this;
	}

	public function getLink(): ?string {
		return $this->link;
	}

	public function setLink(string $link = null): self {
		$this->link = $link;
		return $this;
	}

	public function isSmaller(): bool {
		return $this->smaller;
	}

	public function setSmaller(bool $smaller = true): self {
		$this->smaller = $smaller;
		return $this;
	}


}