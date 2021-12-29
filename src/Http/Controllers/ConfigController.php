<?php

namespace GMJ\LaravelBlock2Video\Http\Controllers;

use App\Http\Controllers\Controller;
use Alert;
use App\Models\Element;
use GMJ\LaravelBlock2Video\Models\Config;

class ConfigController extends Controller
{

    public function create($element_id)
    {
        $element = Element::find($element_id);
        return view("LaravelBlock2Video.config::create", compact("element", "element_id"));
    }

    public function store($element_id)
    {

        $element = Element::findOrFail($element_id);

        request()->validate([
            "layout" => ["required"],
        ]);

        $element->active();
        Config::create([
            "element_id" => $element_id,
            "layout" => request()->layout,
        ]);

        Alert::success("Add Element {$element->title} Video Config success");
        return redirect()->route("LaravelBlock2Video.create", $element_id);
    }

    public function edit($element_id)
    {
        $element = Element::find($element_id);
        $collection = Config::where("element_id", $element_id)->first();
        return view("LaravelBlock2Video.config::edit", compact("element", "element_id", "collection"));
    }

    public function update($element_id)
    {
        $element = Element::findOrFail($element_id);

        request()->validate([
            "layout" => ["required"],
        ]);

        $colleciton = Config::where("element_id", $element_id)->first();

        $colleciton->update([
            "layout" => request()->layout,
        ]);

        Alert::success("Edit Element {$element->title} Video Config success");
        return redirect()->route("LaravelBlock2Video.edit", $element_id);
    }
}
