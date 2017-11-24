<?php


namespace Netlte\Components\Widgets\Boxes\TabBox;

use AsIS\UI\Containers\BaseContainer;
use Nette\Localization\ITranslator;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2017, Tomáš Holan [www.tomasholan.eu]
 */
class Tab extends BaseContainer implements ITab {

	/** @var string */
	private $label;

	/**
	 * Tab constructor.
	 * @param string           $label
	 * @param ITranslator|null $translator
	 */
	public function __construct(string $label, ITranslator $translator = NULL) {
		parent::__construct(NULL, ['translator' => $translator]);
		$this->label = $label;
	}

	public function render() {
		foreach ($this->getComponents() as $component) {
			$component->render();
		}
	}

	/**
	 * @return string
	 */
	public function getLabel(): string {
		return $this->label;
	}

	/**
	 * @param string $label
	 * @return ITab
	 */
	public function setLabel(string $label): ITab {
		$this->label = $label;

		return $this;
	}


}