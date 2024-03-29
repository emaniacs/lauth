<?php

class BaseController extends Controller {

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
	
	protected function is($role) {
		if (Auth::check() and Auth::user()->is($role)) {
            return true;
        }
        
        throw new NotAllowedException();
	}

}
