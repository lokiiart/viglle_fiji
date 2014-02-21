<?php

class TravelController extends BaseController{
		protected $travel;
		protected $user;

		public function __construct(Travel $travel, User $user){
				parent::__construct();
				$this->travel=$travel;
				$this->user = $user;
		}

		public function getIndex(){
                $user = $this->user->currentUser();
				$travels = $this->travel->orderBy('created_at', 'DESC')->paginate(10);
				return View::make('fiji/travel/index',compact('travels','user'));
		}

		public function getCreate(){
						$user = Auth::user();
						if(empty($user)){
								return Redirect::to('user/login');
						}
				return View::make('fiji/travel/create_edit');
		}

		public function postCreate(){
				$rules = array(
						'title' => 'required|min:3',
						'content' => 'required|min:3'
				);

				$validator = Validator::make(Input::all(), $rules);

				if($validator->passes())
				{
						$user = Auth::user();
						if(empty($user)){
								return Redirect::to('user/login');
						}

						$this->travel->user_id = $user->id;

						$this->travel->title   = Input::get('title');
						$this->travel->content = Input::get('content');
                        $this->travel->has_pic = $this->getpic($this->travel->content);

						if($this->travel->save()){
								return Redirect::to('travel/'.$this->travel->id.'/show')->with('success','成功发布旅游攻略');
						}
						return Redirect::to('travel/'.$this->travel->id.'/show')->with('error','发布文章失败');
				}

				return Redirect::to('travel/create')->withInput()->withErrors($validator);
		}


      private  function getpic($str_img){
                preg_match_all("/<img.*\>/isU",$str_img,$ereg);//正则表达式把图片的整个都获取出来了 
                $img=$ereg[0][0];//图片 
                $p="#src=('|\")(.*)('|\")#isU";//正则表达式
                preg_match_all ($p, $img, $img1); 
                $img_path =$img1[2][0];//获取第一张图片路径  
                return $img_path; 
    }


        public function getShow($id){
            $travel = $this->travel->where('id','=',$id)->first();
            $author = $this->user->where('id','=',$travel->user_id)->first();
            if(is_null($travel)){
                return App::abort(404);
            }
            $user = $this->user->currentUser();
            //return var_dump($author);
            return View::make('fiji/travel/show',compact('travel','user','author'));
        }


        public function addMark(){
            //TO-DO添加验证
            $user_id = Input::get('user_id');
            $travel_id = Input::get('travel_id');
            $travel = $this->travel->where('id','=', $travel_id)->first();
            $travel->mark++;
            $travel->save();
            return Response::json(array('mark' => $travel->mark));
        }
        public function subMark(){
            //TO-DO添加验证
            $user_id = Input::get('user_id');
            $travel_id = Input::get('travel_id');
            $travel = $this->travel->where('id','=', $travel_id)->first();
            $travel->mark--;
            $travel->save();
            return Response::json(array('mark' => $travel->mark));
        }
}
