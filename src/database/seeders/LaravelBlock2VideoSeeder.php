<?php

namespace Database\Seeders;

use App\Models\Element;
use App\Models\ElementTemplate;
use App\Models\Page;
use Faker\Factory;
use GMJ\LaravelBlock2Video\Models\Block;
use GMJ\LaravelBlock2Video\Models\Config;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class LaravelBlock2VideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $template = ElementTemplate::where("component", "LaravelBlock2Video")->first();

        if ($template) {
            return false;
        }

        $template = ElementTemplate::create(
            [
                "title" => "Laravel Block2 Video",
                "component" => "LaravelBlock2Video",
            ]
        );

        $element = Element::create([
            "template_id" => $template->id,
            "title" => "laravel-block2-video-sample",
            "is_active" => 1
        ]);

        $faker = Factory::create();
        $pages = Page::orderBy("id")->pluck("id")->toArray();

        Config::create([
            "element_id" => $element->id,
            "layout" => "full-page"
        ]);

        foreach (config('translatable.locales') as $locale) {
            $text[$locale] = $faker->text(100);
            $link_title[$locale] = $faker->name;
        }

        $collection = Block::create([
            "element_id" => $element->id,
            "is_youtube_link" => 1,
            "youtube_link" => "5gBJrZmbGLo",
            "text" => $text
        ]);

        $page_id = Arr::random($pages);

        $collection->link()->create([
            "element_id" => $element->id,
            "page_id" => $page_id,
            "title" => $link_title,
        ]);
    }
}
