<?php

use DevinGray\CustomAuth\Http\Controllers\Extract\FileDownloadController;
use DevinGray\CustomAuth\Http\Controllers\Extract\ReportConfigurationController;
use DevinGray\CustomAuth\Http\Controllers\Extract\ReportExtratController;
use Illuminate\Support\Facades\Route;


#Extract
Route::group(['middleware' => ['auth','web','guest']], function() {
    Route::get('report/index', [ReportExtratController::class, 'index']);
    Route::get('report/new', [ReportExtratController::class, 'new']);
    Route::resource('meusficheiros', [ReportExtratController::class]);
    Route::get('meusficheiros/deletefile/{filename}', [ReportExtratController::class, 'deletefile']);
    Route::get('meusficheiros/all/deletefile', [ReportExtratController::class, 'alldeletefile']);
    Route::post('report/filtro', [ReportExtratController::class, 'filtro']);

    Route::get('file/download/{filename}', [FileDownloadController::class, 'index'])->name('file/download');

    Route::get('report/config', [ReportConfigurationController::class, 'index']);
    Route::post('report/config/store/new', [ReportConfigurationController::class, 'store']);
    Route::get('report/config/delete/{id}', [ReportConfigurationController::class, 'delete']);
    Route::get('report/config/edit/{id}', [ReportConfigurationController::class, 'edit']);
    Route::post('report/config/store/edit', [ReportConfigurationController::class, 'store_edit']);

    Route::get('report/config/filtro', [ReportConfigurationController::class, 'filtro_index']);
    Route::post('report/config/filtro/store', [ReportConfigurationController::class, 'filtro_index_store']);
    Route::get('report/config/filtro/edit/{id}', [ReportConfigurationController::class, 'filtro_index_edit']);
    Route::post('report/config/filtro/edit/store', [ReportConfigurationController::class, 'filtro_index_edit_store']);
    Route::get('report/config/filtro/filtros', [ReportConfigurationController::class, 'filtros_all']);

    Route::post('report/config/filtro/filtros/new/store', [ReportConfigurationController::class, 'filtros_all_store']);
    Route::get('report/config/filtro/filtros/edit/{id}', [ReportConfigurationController::class, 'filtros_all_edit']);
    Route::post('report/config/filtro/filtros/edit/store', [ReportConfigurationController::class, 'filtros_all_edit_store']);
    Route::get('report/config/filtro/list', [ReportConfigurationController::class, 'filtros_list']);
    Route::post('report/config/filtro/list/store', [ReportConfigurationController::class, 'filtros_list_store']);
#
    Route::get('report/config/filtro/list/edit/{id}', [ReportConfigurationController::class, 'filtros_list_edit']);
    Route::post('report/config/filtro/list/edit/store', [ReportConfigurationController::class, 'filtros_list_edit_store']);
    Route::get('report/config/filtro/columuns', [ReportConfigurationController::class, 'filtros_columuns']);
    Route::post('report/config/filtro/columuns/store', [ReportConfigurationController::class, 'filtros_columuns_store']);
    Route::get('report/config/filtro/columuns/edit/{id}', [ReportConfigurationController::class, 'filtros_columuns_edit']);

    Route::post('report/config/filtro/columuns/edit/store', [ReportConfigurationController::class, 'filtros_columuns_edit_store']);

});
