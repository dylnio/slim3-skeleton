<?php
namespace App\Action\Web;

use App\Action\BaseAction;
use Slim\Http\Request as HttpRequest;
use Slim\Http\Response as HttpResponse;

class HomeAction extends BaseAction
{
    public function dispatch(HttpRequest $request, HttpResponse $response, $args)
    {
        return $this->view()->render($response, 'home.twig');
    }

}
