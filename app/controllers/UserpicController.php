<?php

class UserpicController extends BaseController {

		protected $userpic;
		protected $user;

		public function __construct(User $user, Userpic $userpic){
				parent::__construct();

				$this->user = $user;
				$this->userpic = $userpic;
		}

		public function getAlbum(){
				$user = $this->user->currentUser();
				if(empty($user)){
						return Redirect::to('user/login');
				}$userpics = $this->userpic->where('user_id', '=', $user->id)->orderBy('created_at','ASC')->get();
				if(empty($userpics)){
				return View::make('fiji/user/album',compact('user','userpics'))->with('warning','jiofjiewjfioaj');
				}
				return View::make('fiji/user/album',compact('user','userpics'));

		}


		public function postAlbumData(){
				$user = $this->user->currentUser();

				$rules = array(
						'imgFile' => 'image|max:1000'
						);

				$validator = Validator::make(Input::all(), $rules);

				if($validator->passes()){

						$this->userpic->user_id = Auth::user()->id;


						//图片处理
						$imgDir = $this->iArtMkPicDir($this->userpic->user_id);

						$this->userpic->pic_url = $imgDir;
						$image = Input::file('imgFile');
						$filetype = substr(Input::file('imgFile')->getMimeType(),6);
						$filesize = Input::file('imgFile')->getSize();
						$this->userpic->filename = $this->iArtSavePic($imgDir,$image,$filetype);
						$this->userpic->filesize = $filesize;
						$this->userpic->filetype = $filetype;


						if($this->userpic->save()){
								//return Redirect::to('user/album')->with('success', '成功添加一张照片');
                            return Response::json(array('error' => 0, 'url' => '../'.$imgDir.'/'.$this->userpic->filename));
						}
								return Redirect::to('user/album')->with('error', '添加照片错误，账号问题请登录重试！');
				}

				return Redirect::to('user/album')->with('error', '程序错误，请联系管理员');
		}

		public function getAlbumData(){
				$user=$this->user->currentUser();

				if(empty($user)){
						return Redirect::to('user/login');
				}
				$userpics = $this->userpic->where('user_id', '=', $user->id)->orderBy('created_at','ASC')->get();
				$i = 0;
				$file_list = array();
				foreach($userpics as $userpic){
						$file_list[$i]['filename']=$userpic->filename;
						$file_list[$i]['filetype']=$userpic->filetype;
						$file_list[$i]['dir_path']='';
						$file_list[$i]['is_dir']=false;
						$file_list[$i]['has_file']=false;
						$file_list[$i]['filesize']=$userpic->filesize;
						$file_list[$i]['is_photo']=true;
						$fuck =(array) $userpic->created_at;
						$file_list[$i]['datatime']=$fuck['date'];
						$i++;
				}
				$test = array();
				$test['moveup_dir_path']='';
				$test['current_dir_path']='';
				$test['current_url'] = '../'.$userpics[count($userpics)-1]->pic_url.'/';
				$test['total_count'] = count($file_list);
				$test['file_list'] = $file_list;
				//$data=json_encode($test);
				return Response::json($test);
		}

		public function postAlbum(){

				$user = $this->user->currentUser();

				$rules = array(
						'pic_url' => 'image|max:1000'
						);

				$validator = Validator::make(Input::all(), $rules);

				if($validator->passes()){

						$this->userpic->user_id = Auth::user()->id;


						//图片处理
						$imgDir = $this->iArtMkPicDir($this->userpic->user_id);

						$this->userpic->pic_url = $imgDir;
						$image = Input::file('pic_url');
						$filetype = substr(Input::file('pic_url')->getMimeType(),6);
						$filesize = Input::file('pic_url')->getSize();
						$this->userpic->filename = $this->iArtSavePic($imgDir,$image,$filetype);
						$this->userpic->filesize = $filesize;
						$this->userpic->filetype = $filetype;


						if($this->userpic->save()){
								return Redirect::to('user/album')->with('success', '成功添加一张照片');
						}
								return Redirect::to('user/album')->with('error', '添加照片错误，账号问题请登录重试！');
				}

				return Redirect::to('user/album')->with('error', '程序错误，请联系管理员');
		}




	private function iArtMkPicDir($name){
			$imgDir = 'site/users/'.$name;
			if(!is_dir($imgDir)){
					$this->mkdirs($imgDir);
			}

			return $imgDir;
	}

	private function mkdirs($dir){
			if(!is_dir($dir))  
			{  
					if(!$this->mkdirs(dirname($dir))){  
							return false;  
					}  
					if(!mkdir($dir,0777)){  
							return false;  
					}  
			}  
			return true;  
	}

	private function iArtSavePic($imgDir,$image,$filetype){
	    $origin_filename = time()."_origin.".$filetype;
		$origin_url = $imgDir.'/'.$origin_filename;
		$origin	= Image::make($image->getRealPath());
		//$thumb	= Image::make($image->getRealPath())->resize(200,200);
		$origin->save($origin_url);
		return $origin_filename;
	}

}
