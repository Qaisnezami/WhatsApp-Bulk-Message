<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/send',function(Request $request){
    $nodeScript = base_path('puppeteer-whatsapp/sendWhatsAppMessage.js');
    $numbersString = implode(',', $request->numbers);
    $command = "node {$nodeScript} {$numbersString} '{$request->message}'";

    exec($command, $output, $return_var);

    if ($return_var !== 0) {
        // Handle error
        dd(false);
    }

    return redirect()->back();
})->name('send');
