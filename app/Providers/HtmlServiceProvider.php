<?php

namespace TeachMe\Providers;

use Collective\Html\HtmlServiceProvider as CollectiveHtmlServiceProvider;
use TeachMe\Components\HtmlBuilder;

class HtmlServiceProvider extends CollectiveHtmlServiceProvider
{
    protected function registerHtmlBuilder()
    {
        $this->app->bindShared('html', function($app)
        {
            return new HtmlBuilder($app['url'], $app['config'], $app['view']);
        });
    }
}
