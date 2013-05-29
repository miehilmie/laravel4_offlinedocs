<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('docs/{markdown?}', function($file = 'introduction')
{
    $markdown = new \dflydev\markdown\MarkdownParser();

    $path_side = app_path()."/docs/documentation.md";
    $path_main = app_path()."/docs/$file.md";

    if(file_exists($path_main) && file_exists($path_side)) {
        $data = [
            'side' => $markdown->transformMarkdown(file_get_contents($path_side)),
            'content' => $markdown->transformMarkdown(file_get_contents($path_main))
        ];

        return View::make('docs.index', $data);
    }

    App::abort(404);

});

