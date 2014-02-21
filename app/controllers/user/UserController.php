<?php

class UserController extends BaseController {

    /**
     * User Model
     * @var User
     */
    protected $user;
	protected $userpic;
	protected $travel;

    /**
     * Inject the models.
     * @param User $user
     */
    public function __construct(User $user, Userpic $userpic,Travel $travel)
    {
        parent::__construct();
        $this->user = $user;
		$this->userpic = $userpic;
		$this->travel = $travel;
    }

	public function getUserList()
	{
			//只获取普通用户组
			$users = $this->user->orderBy('created_at', 'DESC')->paginate(3);
			if(empty($users)){
					return "获取用户失败　";

			}
			return View::make('fiji/user/index', compact('users'));
	}

	public function getUserShow($id){
        $user = $this->user->where('id','=',$id)->first();
        if(empty($user)){
                //return Redirect::to('user/login');
            return App::abort(404);
        }
        $users = $this->user->orderBy('created_at','ASC')->take(8)->get();
        $usersincity = $this->user->where('city','=',$user->city)->take(8)->get();
        $p = Input::get('p');
        $userpics = $this->userpic->where('user_id', '=', $user->id)->orderBy('created_at','DESC')->take(8)->get();
        $travels = $this->travel->where('user_id','=',$user->id)->orderBy('created_at','DESC')->paginate(5);
        $comments = $user->comments()->orderBy('created_at', 'DESC')->paginate(4);
        //TO-DO 加入用户权限控制
        


	//		$user = $this->user->where('id', '=', $user)->first();
	//		if(is_null($user)){
	//				return App::abort(404);
	//		}

	//		//判断是否是用户自己, 若是别人则不显示上传图片和发表攻略链接。
            $currentuser = $this->user->currentUser();
	//		if(!empty($user)){
	//				return App::abort(404);

	//		}
	//		//结束判断

			return View::make('fiji/user/user',compact('usersincity','users','currentuser','user','userpics','travels','comments'));
	}

    public function postUserShow($id){
        $owner = $this->user->currentUser();
        if(is_null($owner)){
            return Redirect::to('user/login')
                ->with( 'notice', '评论需要先行登陆' );
        }

        $user = $this->user->where('id','=',$id)->first();

        
		$rules = array(
			'comment' => 'required|min:3'
		);

		// Validate the inputs
		$validator = Validator::make(Input::all(), $rules);

		// Check if the form validates with success
		if ($validator->passes())
		{
			// Save the comment
			$usercomment = new Usercomment;
			$usercomment->owner_id = Auth::user()->id;
            $usercomment->user_id = $user->id;
			$usercomment->content = Input::get('comment');

			// Was the comment saved with success?
			if($user->comments()->save($usercomment))
			{
				// Redirect to this blog post page
				return Redirect::to('user/show/'.$user->id.'#usercomment')->with('notice', 'Your comment was added with success.');
			}

			// Redirect to this blog post page
			return Redirect::to('user/show/'.$user->id.'#usercomment')->with('error', 'There was a problem adding your comment, please try again.');
		}

		// Redirect to this blog post page
		return Redirect::to('user/show/'.$user->id.'#usercomment')->withInput()->withErrors($validator);
    }


    public function getSet(){
        $user = $this->user->currentUser();
        if(is_null($user)){
            return Redirect::to('user/login');
        }


        return View::make('fiji/user/set',compact('user'));
    }

    public function postSet(){
        $user = $this->user->currentUser();
        if(is_null($user)){
            return Redirect::to('user/login');
        }

		$rules = array(
			//'avatar' => 'required',
            'intro' => 'required',
		);

		// Validate the inputs
		$validator = Validator::make(Input::all(), $rules);

		// Check if the form validates with success
		if ($validator->passes())
		{
            $oldUser = clone $user;
            $user->intro = Input::get('intro');

			// Was the comment saved with success?
            
            $user->prepareRules($oldUser, $user);

            // Save if valid. Password field will be hashed before save
            
			if($user->amend())
			{
				// Redirect to this blog post page
				return Redirect::to('user/show/'.$user->id)->with('notice', '保存成功');
			}

			// Redirect to this blog post page
			//return Redirect::to('user/show/'.$user->id.'#usercomment')->with('error', '不要玩了');
            return var_dump($user);
		}

		// Redirect to this blog post page
		//return Redirect::to('user/show/'.$user->id.'#usercomment')->withInput()->withErrors($validator);
        return e("没验证");

    }

    public function getInfo(){
        $user = $this->user->currentUser();
        if(is_null($user)){
            return Redirect::to('user/login');
        }


        return View::make('fiji/user/info',compact('user'));
    }

    public function postInfo(){
        $user = $this->user->currentUser();
        if(is_null($user)){
            return Redirect::to('user/login');
        }

		$rules = array(
			//'avatar' => 'required',
            'intro' => 'required',
		);

		// Validate the inputs
		$validator = Validator::make(Input::all(), $rules);

		// Check if the form validates with success
		if ($validator->passes())
		{
            $oldUser = clone $user;
            $user->intro = Input::get('intro');

			// Was the comment saved with success?
            
            $user->prepareRules($oldUser, $user);

            // Save if valid. Password field will be hashed before save
            
			if($user->amend())
			{
				// Redirect to this blog post page
				return Redirect::to('user/show/'.$user->id)->with('notice', '保存成功');
			}

			// Redirect to this blog post page
			//return Redirect::to('user/show/'.$user->id.'#usercomment')->with('error', '不要玩了');
            return var_dump($user);
		}

		// Redirect to this blog post page
		//return Redirect::to('user/show/'.$user->id.'#usercomment')->withInput()->withErrors($validator);
        return e("没验证");

    }

    /**
     * 用户头像设置页面
     *
     * @return View
     */

    public function getAvatar(){
        $user = $this->user->currentUser();
        if(is_null($user)){
            return Redirect::to('user/login');
        }

        $userpics = $this->userpic->where('user_id', '=', $user->id)->orderBy('created_at','DESC')->get();

        return View::make('fiji/user/avatar',compact('userpics'));
    }

    public function postAvatar(){
        $user = $this->user->currentUser();
        if(is_null($user)){
            return Redirect::to('user/login');
        }

		$rules = array(
			//'avatar' => 'required',
		);

		// Validate the inputs
		$validator = Validator::make(Input::all(), $rules);

		// Check if the form validates with success
		if ($validator->passes())
		{
            $oldUser = clone $user;
            $user->avatar = Input::get('avatar');

			// Was the comment saved with success?
            
            $user->prepareRules($oldUser, $user);

            // Save if valid. Password field will be hashed before save
            
			if($user->amend())
			{
				// Redirect to this blog post page
				return Redirect::to('user/show/'.$user->id)->with('notice', '保存成功');
			}

			// Redirect to this blog post page
			//return Redirect::to('user/show/'.$user->id.'#usercomment')->with('error', '不要玩了');
            return var_dump($user);
		}

		// Redirect to this blog post page
		//return Redirect::to('user/show/'.$user->id.'#usercomment')->withInput()->withErrors($validator);
        return e("没验证");

    }



    public function getEdit()
    {
        list($user,$redirect) = $this->user->checkAuthAndRedirect('user');
        if($redirect){return $redirect;}

        // Show the page
        return View::make('site/user/index', compact('user'));
    }

    /**
     * Stores new user
     *
     */
    public function postIndex()
    {
        $this->user->username = Input::get( 'username' );
        $this->user->email = Input::get( 'email' );
		$this->user->telephone = Input::get('telephone');
		$this->user->city = Input::get('city');
		$this->user->intro = Input::get('intro');

        $password = Input::get( 'password' );
        $passwordConfirmation = Input::get( 'password_confirmation' );

        if(!empty($password)) {
            if($password === $passwordConfirmation) {
                $this->user->password = $password;
                // The password confirmation will be removed from model
                // before saving. This field will be used in Ardent's
                // auto validation.
                $this->user->password_confirmation = $passwordConfirmation;
            } else {
                // Redirect to the new user page
                return Redirect::to('user/create')
                    ->withInput(Input::except('password','password_confirmation'))
                    ->with('error', Lang::get('admin/users/messages.password_does_not_match'));
            }
        } else {
            unset($this->user->password);
            unset($this->user->password_confirmation);
        }

        // Save if valid. Password field will be hashed before save
        $this->user->save();

        if ( $this->user->id )
        {
            // Redirect with success message, You may replace "Lang::get(..." for your custom message.
            return Redirect::to('user/login')
                ->with( 'notice', Lang::get('user/user.user_account_created') );
        }
        else
        {
            // Get validation errors (see Ardent package)
            $error = $this->user->errors()->all();

            return Redirect::to('user/create')
                ->withInput(Input::except('password'))
                ->with( 'error', $error );
        }
    }

    /**
     * Edits a user
     *
     */
    public function postEdit()
    {
        $user = $this->user->currentUser();

        if(is_null($user)){
            return Redirect::to('user/login');
        }
        // Validate the inputs
        $validator = Validator::make(Input::all(), $user->getUpdateRules());


        if ($validator->passes())
        {
            $oldUser = clone $user;
            $user->username = Input::get( 'username' );
            $user->email = Input::get( 'email' );
            $user->city = Input::get('city');
            $user->telephone = Input::get('telephone');

            $password = Input::get( 'password' );
            $passwordConfirmation = Input::get( 'password_confirmation' );

            if(!empty($password)) {
                if($password === $passwordConfirmation) {
                    $user->password = $password;
                    // The password confirmation will be removed from model
                    // before saving. This field will be used in Ardent's
                    // auto validation.
                    $user->password_confirmation = $passwordConfirmation;
                } else {
                    // Redirect to the new user page
                    return Redirect::to('users')->with('error', Lang::get('admin/users/messages.password_does_not_match'));
                }
            } else {
                unset($user->password);
                unset($user->password_confirmation);
            }

            $user->prepareRules($oldUser, $user);

            // Save if valid. Password field will be hashed before save
            $user->amend();
        }

        // Get validation errors (see Ardent package)
        $error = $user->errors()->all();

        if(empty($error)) {
            return Redirect::to('user/show/'.$user->id)
                ->with( 'success', Lang::get('user/user.user_account_updated') );
        } else {
            return Redirect::to('user/show/'.$user->id)
                ->withInput(Input::except('password','password_confirmation'))
                ->with( 'error', $error );
        }
    }

    /**
     * Displays the form for user creation
     *
     */
    public function getCreate()
    {
        return View::make('fiji/user/create');
    }


    /**
     * Displays the login form
     *
     */
    public function getLogin()
    {
        $user = Auth::user();
        if(!empty($user->id)){
            return Redirect::to('/');
        }

        return View::make('fiji/user/login');
    }

    /**
     * Attempt to do login
     *
     */
    public function postLogin()
    {
        $input = array(
            'email'    => Input::get( 'email' ), // May be the username too
            'username' => Input::get( 'email' ), // May be the username too
            'password' => Input::get( 'password' ),
            'remember' => Input::get( 'remember' ),
        );

        // If you wish to only allow login from confirmed users, call logAttempt
        // with the second parameter as true.
        // logAttempt will check if the 'email' perhaps is the username.
        // Check that the user is confirmed.
        if ( Confide::logAttempt( $input, true ) )
        {
            $r = Session::get('loginRedirect');
            if (!empty($r))
            {
                Session::forget('loginRedirect');
                return Redirect::to($r);
            }
            return Redirect::to('/');
        }
        else
        {
            // Check if there was too many login attempts
            if ( Confide::isThrottled( $input ) ) {
                $err_msg = Lang::get('confide::confide.alerts.too_many_attempts');
            } elseif ( $this->user->checkUserExists( $input ) && ! $this->user->isConfirmed( $input ) ) {
                $err_msg = Lang::get('confide::confide.alerts.not_confirmed');
            } else {
                $err_msg = Lang::get('confide::confide.alerts.wrong_credentials');
            }

            return Redirect::to('user/login')
                ->withInput(Input::except('password'))
                ->with( 'error', $err_msg );
        }
    }

    /**
     * Attempt to confirm account with code
     *
     * @param  string  $code
     */
    public function getConfirm( $code )
    {
        if ( Confide::confirm( $code ) )
        {
            return Redirect::to('user/login')
                ->with( 'notice', Lang::get('confide::confide.alerts.confirmation') );
        }
        else
        {
            return Redirect::to('user/login')
                ->with( 'error', Lang::get('confide::confide.alerts.wrong_confirmation') );
        }
    }

    /**
     * Displays the forgot password form
     *
     */
    public function getForgot()
    {
        return View::make('site/user/forgot');
    }

    /**
     * Attempt to reset password with given email
     *
     */
    public function postForgot()
    {
        if( Confide::forgotPassword( Input::get( 'email' ) ) )
        {
            return Redirect::to('user/login')
                ->with( 'notice', Lang::get('confide::confide.alerts.password_forgot') );
        }
        else
        {
            return Redirect::to('user/forgot')
                ->withInput()
                ->with( 'error', Lang::get('confide::confide.alerts.wrong_password_forgot') );
        }
    }

    /**
     * Shows the change password form with the given token
     *
     */
    public function getReset( $token )
    {

        return View::make('site/user/reset')
            ->with('token',$token);
    }


    /**
     * Attempt change password of the user
     *
     */
    public function postReset()
    {
        $input = array(
            'token'=>Input::get( 'token' ),
            'password'=>Input::get( 'password' ),
            'password_confirmation'=>Input::get( 'password_confirmation' ),
        );

        // By passing an array with the token, password and confirmation
        if( Confide::resetPassword( $input ) )
        {
            return Redirect::to('user/login')
            ->with( 'notice', Lang::get('confide::confide.alerts.password_reset') );
        }
        else
        {
            return Redirect::to('user/reset/'.$input['token'])
                ->withInput()
                ->with( 'error', Lang::get('confide::confide.alerts.wrong_password_reset') );
        }
    }

    /**
     * Log the user out of the application.
     *
     */
    public function getLogout()
    {
        Confide::logout();

        return Redirect::to('/');
    }

    /**
     * Get user's profile
     * @param $username
     * @return mixed
     */
    public function getProfile($username)
    {
        $userModel = new User;
        $user = $userModel->getUserByUsername($username);

        // Check if the user exists
        if (is_null($user))
        {
            return App::abort(404);
        }

        return View::make('site/user/profile', compact('user'));
    }

    public function getSettings()
    {
        list($user,$redirect) = User::checkAuthAndRedirect('user/settings');
        if($redirect){return $redirect;}

        return View::make('site/user/profile', compact('user'));
    }

    /**
     * Process a dumb redirect.
     * @param $url1
     * @param $url2
     * @param $url3
     * @return string
     */
    public function processRedirect($url1,$url2,$url3)
    {
        $redirect = '';
        if( ! empty( $url1 ) )
        {
            $redirect = $url1;
            $redirect .= (empty($url2)? '' : '/' . $url2);
            $redirect .= (empty($url3)? '' : '/' . $url3);
        }
        return $redirect;
    }
}
