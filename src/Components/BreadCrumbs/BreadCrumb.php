<?php


namespace Netlte\Components\BreadCrumbs;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2019, Tomáš Holan [www.tomasholan.eu]
 */
class BreadCrumb implements IBreadCrumb {

	/** @var string */
	private $title;

	/** @var string */
	private $link;

	/** @var array */
	private $args = [];


	public function __construct(string $title, string $link, array $args = []) {
		$this->title = $title;
		$this->link = $link;
		$this->args = $args;
	}

	public function getTitle(): string {
		return $this->title;
	}

	public function setTitle(string $title): self {
		$this->title = $title;
		return $this;
	}

	public function getLink(): string {
		return $this->link;
	}

	public function setLink(string $link): self {
		$this->link = $link;
		return $this;
	}

	public function getArgs(): array {
		return $this->args;
	}

	public function setArgs(array $args = []): self {
		$this->args = $args;
		return $this;
	}
}