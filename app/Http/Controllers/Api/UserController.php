<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\testMail;

use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Validator; 

use App\User;
use App\Faqs;
use App\TermsNCondition;
use App\PrivacyPolicy;
use Config;
// use Mail;
use Auth;
use DB;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd('index');
    }

    //---------------------------------------
    
    public function signup(Request $request)
    {
        $validator = Validator::make(Input::all(),
            [
                'email'         => 'required|email|unique:users',
                'password'      => 'required|min:6',
                'first_name'    => 'required|max:255',
                'last_name'     => 'required|max:255',
                'phone'        => 'required|max:255'
            ]);

        if($validator->fails()){

            return $this->sendResponse(
                Config::get('error.code.BAD_REQUEST'),
                null,
                $validator->getMessageBag()->all(),
                Config::get('error.code.BAD_REQUEST')
            );
        }

        try{

            $avatarfile = "user.png";
            $nameAvatar = url('images/').'/'.$avatarfile;

            $u = new User;
            $u->email           = Input::get('email');
            $u->password        = bcrypt(Input::get('password'));
            $u->first_name      = Input::get('first_name');
            $u->last_name       = Input::get('last_name');
            $u->phone           = Input::get('phone');
            $u->role_id         = '3';
            $u->city            = Input::get('city');
            $u->country         = Input::get('country');
            $u->avatar          = $nameAvatar;
            
            $u->device          = $request->header('client-id');
            $u->access_token    = uniqid();
            $u->save();

            $response['id']             = $u->id;
            $response['first_name']     = $u->first_name;
            $response['last_name']      = $u->last_name;
            $response['email']          = $u->email;
            $response['phone']          = $u->phone;
            $response['city']           = $u->city;
            $response['country']        = $u->country;
            $response['avatar']         = $u->avatar;


            return $this->sendResponse(Config::get('constants.status.OK'),$response, null);

        }
        catch(\Illuminate\Database\QueryException $e){

            return $this->sendResponse(
                Config::get('error.code.INTERNAL_SERVER_ERROR'),
                null,
                [$e->errorInfo[2]],
                $e->errorInfo[0]
            );
        }
    }

    //---------------------------------------
    
    public function login(Request $request){
        
        $email      = Input::get('email');
        $password   = Input::get('password');

        if(Auth::attempt(['email'=>$email, 'password'=>$password, 'role_id'=>3])){
                
                $userAuth   = Auth::user();

                if(!$userAuth){
                    return $this->sendResponse( 
                        Config::get('error.code.PASSWORD_INVALID'),
                        null,
                        [Config::get('error.message.PASSWORD_INVALID')],
                        Config::get('error.code.PASSWORD_INVALID')
                    );
                }else{

                    $user = User::where([
                            'email'=>$userAuth->email
                        ])
                        ->get([
                            'access_token',
                            'id',
                            'email',
                            'first_name',
                            'last_name',
                            'phone',
                            'city',
                            'country',
                            'role_id',
                            'device'
                        ])->first();

                    
                    $user->access_token = uniqid();
                    $user->device=$request->header('client-id');
                    $user->save();

                    $response['id']             = $user->id;
                    $response['email']          = $user->email;
                    $response['first_name']     = $user->first_name;
                    $response['last_name']      = $user->last_name;
                    $response['phone']          = $user->phone;
                    $response['city']           = $user->city;
                    $response['role_id']        = $user->role_id;
                    $response['device']         = $user->device;
                    $response['access_token']   = $user->access_token;

                    return $this->sendResponse(Config::get('constants.status.OK'),$response, null);
                }

            }
            else{

               return $this->sendResponse( Config::get('error.code.NOT_FOUND'),
                    null,
                    [Config::get('error.message.USER_NOT_FOUND')],
                    Config::get('error.code.NOT_FOUND')
                );
            }
    }

    //---------------------------------------

    public function getCode(Request $request){
        
        $user_id = $request['user']->id;

        $eCode = substr(number_format(time() * rand(),0,'',''),0,6);
        $mCode = substr(number_format(time() * rand(),0,'',''),0,6);

        $user = User::find($user_id);

        $user->mobile_code = $eCode;
        $user->email_code =  $mCode;
        $user->save();

        $response['email_code'] = $eCode;
        $response['mobile_code'] = $mCode;

        return $this->sendResponse(Config::get('constants.status.OK'),$response, null);

    }

    //---------------------------------------

    public function verifyUser(Request $request){

        $user_id = $request['user']->id;

        $e_code = $request->email_code;
        $m_code = $request->mobile_code;

        $user = User::find($user_id);


        if($user->mobile_code == $m_code && $user->email_code ==$e_code){
            $user->verified = 1;
            $user->save();

            $response = "You are now verified!";

            return $this->sendResponse(Config::get('constants.status.OK'),$response, null);
        }
        else{
            
            return $this->sendResponse( Config::get('error.code.INVALID_CODE'),
                    null,
                    [Config::get('error.message.INVALID_CODE')],
                    Config::get('error.code.INVALID_CODE')
                );
        }

    }
    
    //---------------------------------------

    public function forgetPassword(Request $request){
        
        $email = Input::get('email');
        
       /* if(mail($email, 'Hi leokhoa', 'I like Mail Sender feature.'))
        {
            echo "YES";
        }
        else{
             echo "NO";
        }*/

        $u = User::where('email',$email)->first();

        $to         = $email;
        $new_pwd    = uniqid(); 
        $subject    = "Forget Password - VANITY";
        $message    = "Dear Cusatumer,  Your new password is: ".$new_pwd.".";


        $u->password = bcrypt($new_pwd);
        $u->save();

        $header = "From:help@vanity-gop.com\r\n";
        $header .= "MIME-version:1.0 \r\n";
        $header .= "Content-type:text/html charset=UTF-8 \r\n";

        if(mail($to,$subject,$message,$header)){
            echo "mail succesfully";
            return $this->sendResponse(Config::get('constants.status.OK'),null,null);
        }
        else{

            echo "mail un-succesfully";
        }
        
    }

    //---------------------------------------

    public function logout(Request $request){

        // $user_id = \GuzzleHttp\json_decode($request->input('user'))->id;  
        $id         = $request['user']->id;
        $user_email = $request['user']->email;

        $user = User::where('email',$user_email)->get()->first();
        
        $user->access_token = null;
        $user->gcm_token = null;
        $user->save(); 

        Auth::logout();

        return $this->sendResponse(Config::get('constants.status.OK'),null,null);
    }

    //---------------------------------------

    public function faqs(Request $request){

        $limit = $request->limit;
        $f          = new Faqs();
        $response   = $f->getFaqs($limit);

        return $this->sendResponse(Config::get('constants.status.OK'),$response,null);
    }

    //---------------------------------------

    public function tnc(Request $request){

        $limit = $request->limit;
        $f          = new TermsNCondition();
        $response   = $f->getTnC($limit);

        return $this->sendResponse(Config::get('constants.status.OK'),$response,null);
    }

    //---------------------------------------
    public function privacy_policy(Request $request){

        $limit = $request->limit;
        $f          = new PrivacyPolicy();
        $response   = $f->getPrivacyPolicy($limit);

        return $this->sendResponse(Config::get('constants.status.OK'),$response,null);
    }

    //---------------------------------------

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
