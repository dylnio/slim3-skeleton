<?php
// Routes

use App\Action\Web\HomeAction;

$app->getGeneric('/', HomeAction::class)->setName('home');