<?php
class IndexController extends BaseController {
		protected $hotel;
		protected $user;
        protected $travel;
		public function __construct( Travel $travel, User $user, Hotel $hotel)
		{
				parent::__construct();
                $this->hotel = $hotel;
                $this->user  = $user;
                $this->travel= $travel;
		}


		public function getIndex(){
            $travels = $this->travel->orderBy('created_at','ASC')->take(2)->get();
            $hotels = $this->hotel->orderBy('created_at','ASC')->take(2)->get();
            $users = $this->user->orderBy('created_at','ASC')->take(6)->get();
				return View::make('fiji/index',compact('travels','hotels','users'));
		}

}
?>
