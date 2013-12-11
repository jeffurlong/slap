<?php
namespace Controllers;

use View;

class BaseController extends \Controller {

	/**
	 * Calls CSRF filter on all posts
	 */
	public function __construct()
	{
	    $this->beforeFilter('csrf', array('on' => array('post', 'put')));
	}

	/**
	 * Setup the layout used by the controller.
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
