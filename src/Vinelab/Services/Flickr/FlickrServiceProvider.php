<?php namespace Vinelab\Services\Flickr;

use Illuminate\Support\ServiceProvider;

class FlickrServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('vinelab/flickr');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['social_flickr'] = $this->app->share(function($app){
			return new Agent($this->app['config'], $this->app['httpClient']);
		});

		$this->app->booting(function() {

			$loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Flickr', 'Vinelab\Services\Flickr\Facades\Agent');
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}