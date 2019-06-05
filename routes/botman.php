<?php
use App\Http\Controllers\BotManController;
use App\Model\Post;
use Illuminate\Support\Facades\Redirect;

$botman = resolve('botman');

$botman->hears('Oi', function ($bot) {
    $bot->reply('Fala meu bom!');


});
$botman->hears('Start conversation', BotManController::class.'@startConversation');
