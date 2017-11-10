<?php


namespace Netlte\Components\SideBar\User;

use Holabs\UI\BaseControl;
use Nette\Localization\ITranslator;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class Control extends BaseControl {

	const DEFAULT_TEMPLATE = __DIR__ . DIRECTORY_SEPARATOR . 'default.latte';

	/** @var string */
	public static $DEFAULT_TEMPLATE = self::DEFAULT_TEMPLATE;

	/** @var null */
	private $avatar;

	/** @var string */
	private $name;

	/** @var null|string */
	private $text = NULL;

	/** @var null|string */
	private $link = NULL;

	/**
	 * Control constructor.
	 * @param string           $name
	 * @param string           $avatar
	 * @param null|string      $text
	 * @param null|string      $link
	 * @param ITranslator|null $translator
	 */
	public function __construct(
		string $name,
		string $avatar,
		string $text = NULL,
		string $link = NULL,
		ITranslator $translator = NULL
	) {
		parent::__construct($translator);
		$this->setTemplateFile(self::$DEFAULT_TEMPLATE);
		$this->avatar = $avatar;
		$this->name = $name;
		$this->text = $text;
		$this->link = $link;
	}

	public function render() {
		$this->getTemplate()->name = $this->name;
		$this->getTemplate()->avatar = $this->avatar;
		$this->getTemplate()->text = $this->text;
		$this->getTemplate()->link = $this->link;

		$this->getTemplate()->setTranslator($this->getTranslator());
		$this->getTemplate()->setFile($this->getTemplateFile());
		$this->getTemplate()->render();
	}


}