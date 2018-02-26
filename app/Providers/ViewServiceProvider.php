<?php namespace TeachMe\Providers;

use TeachMe\Http\ViewComposers\TicketsListComposer;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		view()->composer('tickets.list', TicketsListComposer::class);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

}
