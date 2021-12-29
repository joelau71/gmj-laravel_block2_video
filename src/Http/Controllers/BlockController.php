<?php

namespace GMJ\LaravelBlock2Video\Http\Controllers;

use App\Http\Controllers\Controller;
use Alert;
use App\Models\Element;
use App\Models\Page;
use GMJ\LaravelBlock2Video\Models\Block;
use GMJ\LaravelBlock2Video\Models\Config;

class BlockController extends Controller
{
    public function index($element_id)
    {
        $config = Config::where("element_id", $element_id)->first();
        if (!$config) {
            return redirect()->route("LaravelBlock2Video.config.create", $element_id);
        }

        $element = Element::findOrFail($element_id);
        if ($element->is_active) {
            return redirect()->route("LaravelBlock2Video.edit", $element_id);
        }
        return redirect()->route("LaravelBlock2vdieo.create", $element_id);
    }

    public function create($element_id)
    {
        $element = Element::find($element_id);
        $pages = Page::where("is_active", 1)->get();
        return view("LaravelBlock2Video::create", compact("element", "element_id", "pages"));
    }

    public function store($element_id)
    {

        $element = Element::findOrFail($element_id);

        if (request()->is_youtube_link) {
            $rules["youtube_link"] = "required";
        } else {
            $rules["video"] = "required|mimes:mp4";
        }

        request()->validate($rules);

        $text = [];
        foreach (config("translatable.locales") as $locale) {
            $text[$locale] = request()["text_{$locale}"];
        }

        $collection = new Block;
        $collection->element_id = $element_id;
        $collection->is_youtube_link = request()->is_youtube_link;
        $collection->youtube_link = request()->youtube_link;
        $collection->text = $text;
        $collection->save();

        if (!request()->is_youtube_link) {
            $collection->addMediaFromRequest("video")->toMediaCollection('laravel_block2_video');
        }

        if (request()->page_id) {
            foreach (config("translatable.locales") as $locale) {
                $link_title[$locale] = request()["link_title_{$locale}"];
            }
            $collection->link()->create([
                "element_id" => $element->id,
                "page_id" => request()->page_id,
                "title" => $link_title,
            ]);
        }

        $element->active();
        Alert::success("Add Element {$element->title} Video success");
        return redirect()->route("admin.element.index");
    }

    public function edit($element_id)
    {
        $element = Element::findOrFail($element_id);
        $collection = Block::where("element_id", $element_id)->first();
        $pages = Page::where("is_active", 1)->get();

        return view("LaravelBlock2Video::edit", compact("element", "element_id", "collection", "pages"));
    }

    public function update($element_id)
    {
        $element = Element::findOrFail($element_id);
        $collection = Block::where("element_id", $element_id)->first();

        if (request()->is_youtube_link) {
            request()->validate([
                "youtube_link" => "required"
            ]);
        }

        if (!request()->is_youtube_link) {
            request()->validate([
                "video" => "required|mimes:mp4"
            ]);
        }


        foreach (config("translatable.locales") as $locale) {
            $text[$locale] = request()["text_{$locale}"];
        }

        $collection->is_youtube_link = request()->is_youtube_link;
        $collection->youtube_link = request()->youtube_link;
        $collection->text = $text;
        $collection->save();

        $collection->link()->delete();

        if (!request()->is_youtube_link && request()->video) {
            $collection->addMediaFromRequest("video")->toMediaCollection('laravel_block2_video');
        }

        if (request()->page_id) {
            foreach (config("translatable.locales") as $locale) {
                $link_title[$locale] = request()["link_title_{$locale}"];
            }
            $collection->link()->create([
                "element_id" => $element->id,
                "page_id" => request()->page_id,
                "title" => $link_title,
            ]);
        }

        Alert::success("Edit Element {$element->title} Video success");
        return redirect()->route("admin.element.index");
    }
}
