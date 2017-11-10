<?php


namespace Netlte\Components\BreadCrumbs;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class BreadCrumb implements IBreadCrumb {

	/** @var string */
	private $title;

	/** @var string */
	private $link;

	/** @var array */
	private $args = [];

	/**
	 * BreadCrumb constructor.
	 * @param string $title
	 * @param string $link
	 * @param array  $args
	 */
	public function __construct(string $title, string $link, array $args = []) {
		$this->title = $title;
		$this->link = $link;
		$this->args = $args;
	}

	/**
	 * @return string
	 */
	public function getTitle(): string {
		return $this->title;
	}

	/**
	 * @param string $title
	 * @return BreadCrumb
	 */
	public function setTitle(string $title): self {
		$this->title = $title;

		return $this;
	}

	/**
	 * @return string
	 */
	public function getLink(): string {
		return $this->link;
	}

	/**
	 * @param string $link
	 * @return BreadCrumb
	 */
	public function setLink(string $link): self {
		$this->link = $link;

		return $this;
	}

	/**
	 * @return array
	 */
	public function getArgs(): array {
		return $this->args;
	}

	/**
	 * @param array $args
	 * @return BreadCrumb
	 */
	public function setArgs(array $args = []): self {
		$this->args = $args;

		return $this;
	}
}