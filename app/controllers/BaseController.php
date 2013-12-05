<?php
namespace Controllers;

class BaseController extends \Controller {

	/**
	 * Calls CSRF filter on all posts
	 */
	public function __construct()
	{
	    $this->filter('before', 'csrf')->on('post');
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
