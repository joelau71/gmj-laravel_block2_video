<?php

namespace GMJ\LaravelBlock2Video\View\Components;

use GMJ\LaravelBlock2Video\Models\Block;
use GMJ\LaravelBlock2Video\Models\Config;
use Illuminate\View\Component;

class Frontend extends Component
{
    public $element_id;
    public $page_element_id;
    public $collection;

    public function __construct($pageElementId, $elementId)
    {
        $this->page_element_id = $pageElementId;
        $this->element_id = $elementId;
        $this->collection = Block::where("element_id", $elementId)->first();
    }

    public function render()
    {
        $config = Config::where("element_id", $this->element_id)->first();
        $layout = $config->layout;
        return view("LaravelBlock2Video::components.{$layout}.frontend");
    }
}
