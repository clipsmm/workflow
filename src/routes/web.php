<?php

Route::group([
    'prefix' => config('workflow.url'),
    'as' => 'workflow::',
    'namespace' => "Clipsmm\Workflow\Http\Controllers",
    'middleware' => array_merge(['web'], config('workflow.middleware', []))
], function () {
    Route::get('', function(){
        return redirect()->route('workflow::workflows.index');
    })->name('index');
    Route::group(['prefix' => 'workflows', 'as' => 'workflows.'], function(){
        Route::get('', 'WorkflowController@index')->name('index');
        Route::post('', 'WorkflowController@store')->name('store');
        Route::get('{workflow}', 'WorkflowController@show')->name('show');
        Route::get('{workflow}/edit', 'WorkflowController@edit')->name('edit');
        Route::post('{workflow}/edit', 'WorkflowController@update')->name('edit');
        Route::delete('{workflow}/remove', 'WorkflowController@delete')->name('delete');
    });

    Route::group(['prefix' => 'stages', 'as' => 'stages.'], function(){
        Route::post('', 'StageController@store')->name('new');
        Route::get('{stage}', 'StageController@show')->name('show');
        Route::get('{stage}/edit', 'StageController@edit')->name('edit');
        Route::post('{stage}/edit', 'StageController@update')->name('edit');
        Route::delete('{stage}/remove', 'StageController@delete')->name('delete');
    });

    Route::group(['prefix' => 'actions', 'as' => 'actions.'], function(){
        Route::post('', 'ActionController@store')->name('new');
        Route::get('{action}/edit', 'ActionController@edit')->name('edit');
        Route::post('{action}/edit', 'ActionController@update')->name('edit');
        Route::delete('{action}/remove', 'ActionController@delete')->name('delete');
    });
});
