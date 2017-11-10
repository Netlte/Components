<?php


namespace Netlte\Components\BreadCrumbs;

use Nette\InvalidArgumentException;
use Nette\Utils\ArrayList;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class Bread extends ArrayList {

	/**
	 * @param string $title
	 * @param string $link
	 * @param array  $args
	 * @return Bread
	 */
	public function addBreadCrumb(string $title, string $link, array $args = []): self {
		$this[] = new BreadCrumb($title, $link, $args);

		return $this;
	}

	/**
	 * @param mixed $index
	 * @param IBreadCrumb $value
	 */
	public function offsetSet($index, $value) {
		self::check($value);
		parent::offsetSet($index, $value);
	}

	/**
	 * @param mixed $index
	 * @return IBreadCrumb
	 */
	public function offsetGet($index) {
		return parent::offsetGet($index);
	}

	/**
	 * @param mixed $index
	 * @return bool
	 */
	public function offsetExists($index) {
		return parent::offsetExists($index);
	}

	/**
	 * @param mixed $index
	 */
	public function offsetUnset($index) {
		parent::offsetUnset($index);
	}

	/**
	 * @param IBreadCrumb
	 */
	public function prepend($value) {
		self::check($value);
		parent::prepend($value);
	}

	/**
	 * @param mixed $value
	 * @throws InvalidArgumentException
	 */
	protected static function check($value) {
		if (!$value instanceof IBreadCrumb) {
			throw new InvalidArgumentException("Argument must be instance of " . IBreadCrumb::class);
		}
	}


}