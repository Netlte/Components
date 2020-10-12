<?php


namespace Netlte\Components\BreadCrumbs;

use Nette\InvalidArgumentException;
use Nette\Utils\ArrayList;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2019, Tomáš Holan [www.tomasholan.eu]
 */
class Bread extends ArrayList {

	public function addBreadCrumb(string $title, string $link, array $args = []): self {
		$this[] = new BreadCrumb($title, $link, $args);

		return $this;
	}

	/**
	 * @param mixed $index
	 * @param IBreadCrumb $value
	 */
	public function offsetSet($index, $value): void {
		self::check($value);
		parent::offsetSet($index, $value);
	}

	/**
	 * @param mixed $index
	 * @return IBreadCrumb
	 */
	public function offsetGet($index): void {
		return parent::offsetGet($index);
	}

	/**
	 * @param IBreadCrumb
	 */
	public function prepend($value): void {
		self::check($value);
		parent::prepend($value);
	}

	/**
	 * @param mixed $value
	 * @throws InvalidArgumentException
	 */
	protected static function check($value): void {
		if (!$value instanceof IBreadCrumb) {
			throw new InvalidArgumentException("Argument must be instance of " . IBreadCrumb::class);
		}
	}


}
