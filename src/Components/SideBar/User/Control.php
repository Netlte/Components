<?php


namespace Netlte\Components\SideBar\User;

use Netlte\Utils\UI\BaseControl;

/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2019, Tomáš Holan [www.tomasholan.eu]
 */
class Control extends BaseControl {

	const DEFAULT_TEMPLATE = __DIR__ . DIRECTORY_SEPARATOR . 'default.latte';

	/** @var string */
	public static $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @var string */
	private $avatar;

	/** @var string */
	private $name;

	/** @var string|null */
	private $text = null;

	/** @var string|null */
	private $link = null;

	public function __construct(
		string $name,
		string $avatar,
		string $text = null,
		string $link = null
	) {
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);
		$this->avatar = $avatar;
		$this->name = $name;
		$this->text = $text;
		$this->link = $link;
	}

	public function render(): void {
		$this->getTemplate()->name = $this->name;
		$this->getTemplate()->avatar = $this->avatar;
		$this->getTemplate()->text = $this->text;
		$this->getTemplate()->link = $this->link;

		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile());
		$this->getTemplate()->render();
	}


}