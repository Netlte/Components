<?php


namespace Netlte\Components\Widgets\Boxes;

use Netlte\Components\Widgets\BaseWidget;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2019, Tomáš Holan [www.tomasholan.eu]
 */
abstract class BaseBox extends BaseWidget {

	/** @var string|null */
	private $background = null;

	/** @var string|null */
	private $icon = null;

	/** @var string */
	private $text;


	public function __construct(
		string $text,
		string $icon = null,
		string $background = null
	) {
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

	public function getBackground(): ?string {
		return $this->background;
	}

	public function setBackground(?string $background): self {
		$this->background = $background;
		return $this;
	}

	public function getIcon(): ?string {
		return $this->icon;
	}

	public function setIcon(string $icon = null): self {
		$this->icon = $icon;
		return $this;
	}

	public function getText(): string {
		return $this->text;
	}

	public function setText(string $text): self {
		$this->text = $text;
		return $this;
	}

}