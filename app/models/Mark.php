<?php

//use Illuminate\Support\Facades\URL; # not sure why i need this here :c
//use Robbo\Presenter\PresentableInterface;

class Mark extends Eloquent{


	public function created_at()
	{
		return $this->date($this->created_at);
	}

	/**
	 * Returns the date of the blog post last update,
	 * on a good and more readable format :)
	 *
	 * @return string
	 */
	public function updated_at()
	{
        return $this->date($this->updated_at);
	}


}
