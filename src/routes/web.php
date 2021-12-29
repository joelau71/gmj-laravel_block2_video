<?php

use GMJ\LaravelBlock2Video\Http\Controllers\BlockController;
use GMJ\LaravelBlock2Video\Http\Controllers\ConfigController;

Route::group([
    "middleware" => ["web", "auth"],
    "prefix" => "admin/element/{element_id}/gmj/laravel_block2_video",
    "as" => "LaravelBlock2Video."
], function () {
    Route::get("index", [BlockController::class, "index"])->name("index");
    Route::get("create", [BlockController::class, "create"])->name("create");
    Route::post("store", [BlockController::class, "store"])->name("store");
    Route::get("edit", [BlockController::class, "edit"])->name("edit");
    Route::patch("update", [BlockController::class, "update"])->name("update");
    Route::group(["prefix" => "config", "as" => "config."], function () {
        Route::get("create", [ConfigController::class, "create"])->name("create");
        Route::post("create", [ConfigController::class, "store"])->name("store");
        Route::get("edit", [ConfigController::class, "edit"])->name("edit");
        Route::patch("edit", [ConfigController::class, "update"])->name("update");
    });
});
