<?php


namespace Netlte\Components\Widgets\Boxes\TabBox;

use Netlte\Utils\UI\BaseContainer;


/**
 * @author       Tomáš Holan <mail@tomasholan.eu>
 * @package      netlte/components
 * @copyright    Copyright © 2019, Tomáš Holan [www.tomasholan.eu]
 */
class Tab extends BaseContainer implements ITab {

	/** @var string */
	private $label;

	public function __construct(string $label) {
		$this->label = $label;
	}
	
	public function render(): void {
		foreach ($this->getComponents() as $component) {
			$component->render();
		}
	}

	public function getLabel(): string {
		return $this->label;
	}

	public function setLabel(string $label): ITab {
		$this->label = $label;
		return $this;
	}

}
