<?php


namespace Netlte\Components\Widgets\Boxes;

use Netlte\Components\Widgets\BaseWidget;
use Nette\Localization\ITranslator;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
abstract class BaseBox extends BaseWidget {

	/** @var string|null */
	private $background = NULL;

	/** @var string|null */
	private $icon = NULL;

	/** @var string */
	private $text;

	/**
	 * BaseBox constructor.
	 * @param string           $text
	 * @param string|NULL      $icon
	 * @param string|NULL      $background
	 * @param ITranslator|null $translator
	 */
	public function __construct(
		string $text,
		string $icon = NULL,
		string $background = NULL,
		ITranslator $translator = NULL
	) {
		parent::__construct($translator);

		$this->text = $text;
		$this->icon = $icon;
		$this->background = $background;
	}

	public function render() {
		parent::render();
		$this->getTemplate()->text = $this->getText();
		$this->getTemplate()->icon = $this->getIcon();
		$this->getTemplate()->background = $this->getBackground();
	}

	/**
	 * @return null|string
	 */
	public function getBackground(): ?string {
		return $this->background;
	}

	/**
	 * @param null|string $background
	 * @return BaseBox
	 */
	public function setBackground($background): self {
		$this->background = $background;

		return $this;
	}

	/**
	 * @return null|string
	 */
	public function getIcon(): ?string {
		return $this->icon;
	}

	/**
	 * @param string|null $icon
	 * @return BaseBox
	 */
	public function setIcon(string $icon = NULL): self {
		$this->icon = $icon;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getText(): string {
		return $this->text;
	}

	/**
	 * @param string $text
	 * @return BaseBox
	 */
	public function setText(string $text): self {
		$this->text = $text;

		return $this;
	}

}