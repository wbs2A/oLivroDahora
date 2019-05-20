<?php
use App\Http\Controllers\BotManController;
use App\Model\Post;
use Illuminate\Support\Facades\Redirect;

$botman = resolve('botman');

$botman->hears('Hi', function ($bot) {
    $bot->reply('Hello!');


});
$botman->hears('Start conversation', BotManController::class.'@startConversation');
