<?php

namespace App\Services;
use App\Services\Contracts\YodleeContract;
use App\Models\YodleeUser;
use App\Models\User;
use App\Utility\Utility;
use Crypt;
use Carbon\Carbon;

class YodleeService implements YodleeContract {

    
	public function cobrandLogin() {
        
		$array['cobrand'] = array(
			'cobrandLogin' => env('COBRAND_LOGIN'),
			'cobrandPassword' => env('COBRAND_PASSWORD'),
			);
			$url = config('constants.YODLEE_URL').'/cobrand/login';

            $headers = [
					'Content-Type: application/json',
					'Cobrand-Name: '.config('constants.COBRAND_NAME'),
					'Api-Version: '.config('constants.YODLEE_VERSION'),
			];
           
            $params = json_encode($array);
			$result = $this->getContent($url, $headers, $params);       
            return json_decode($result, true);
	}

    public function userRegister($request) {

            $array['user'] = $request->all();
            $url = config('constants.YODLEE_URL').'/user/register';
            $headers = [
                    'Content-Type: application/json',
                    'Cobrand-Name: '.config('constants.COBRAND_NAME'),
                    'Api-Version: '.config('constants.YODLEE_VERSION'),
                    'Authorization: {cobSession='.$request->cobSession.'}',
            ];
            
            $params = json_encode($array);
            $result = $this->getContent($url, $headers, $params);
            return json_decode($result, true);

    }

    public function saveYodleeUser($data) {
        $yodleeUser = YodleeUser::saveYodleeUser($data);
    }

    public function setFlag($id) {
        $flag = ['is_yodlee_account' => 1];
        User::updateData($id, $flag); 
    }

    public function setExpireTime($id){
        $yodleeUserId = User::find($id)->yodleeUser;
        if(isset($yodleeUserId)){
            $id = $yodleeUserId->id;
            $expireTime = ['session_created_at' => date('Y-m-d H:i:s')];
            YodleeUser::updateData($id, $expireTime);
        }
        
    }
    

    public function userLogin($request) {
            $array['user'] = $request->all();
            $url = config('constants.YODLEE_URL').'/user/login';

            $headers = [
                    'Content-Type: application/json',
                    'Cobrand-Name: '.config('constants.COBRAND_NAME'),
                    'Api-Version: '.config('constants.YODLEE_VERSION'),
                    'Authorization: {cobSession='.$request->cobSession.'}', 
                ];
            $params = json_encode($array);
            $result = $this->getContent($url, $headers, $params);
            return json_decode($result, true);
    }

    public function getAccessToken($request) {
            $data = $request->all();
            $url = config('constants.YODLEE_URL').'/user/accessTokens?appIds=10003600';

            $headers = [
                    'Content-Type: application/json',
                    'Cobrand-Name: '.config('constants.COBRAND_NAME'),
                    'Api-Version: '.config('constants.YODLEE_VERSION'),
                    'Authorization: {cobSession='.$data['YodleeToken']['cobSession'].',userSession='.$data['YodleeToken']['userSession'].'}', 
                ];

            $result = $this->getContent($url, $headers);
            return json_decode($result, true);

    }

    public function getFastLinkFormAction() {
        return 'https://node.developer.yodlee.com/authenticate/'.config('constants.COBRAND_NAME').'/';
    }

    public function getTransaction(){
        $cobrands = $this->cobrandLogin(); 
        $users = User::getYodleeUsers();

        $transactionRequest['cobSession'] = $data['cobSession'] = $cobrands['session']['cobSession'];

        foreach ($users as $user) {
            $data['loginName'] = $user->yodleeUser->login_name;
            $data['password'] = Crypt::decryptString($user->yodleeUser->password);
            $request = Utility::createRequest($data);
            $userlogin = $this->userLogin($request);
            $transactionRequest['userSession'] = $userlogin['user']['session']['userSession'];
            $transactions = $this->readTransactionApi($transactionRequest);
            $this->setRoundUp($transactions['transaction'], $user);
        }
            
    }

    public function setRoundUp($transactions, $user) {
        foreach ($transactions as $key => $value) {
            $amount = $value['amount']['amount'];
            $roundUpAmt = $this->getRoundUp($amount);
            $roundupData = ['round_up' => $user->round_up + $roundUpAmt]; 
            User::updateData($user->id, $roundupData);
        }
    }

    public function getRoundUp($amount){
        $ceil = ceil($amount);
        $roundUp = $ceil - $amount;
        return $roundUp; 
    }

    public function readTransactionApi($data){

        $query = array (
                'categoryType' => 'EXPENSE',
                'type' => 'PURCHASE',
                'fromDate'=> '2017-01-01',
                'toDate' => '2018-03-01'
                );
        
        $params = '';
            foreach($query as $key=>$value)
                $params .= $key.'='.$value.'&';
         
        $params = trim($params, '&');

        $url = config('constants.YODLEE_URL').'/transactions?'.$params;
        $headers = [
                'Content-Type: application/json',
                'Cobrand-Name: '.config('constants.COBRAND_NAME'),
                'Api-Version: '.config('constants.YODLEE_VERSION'),
                'Authorization: {cobSession='.$data['cobSession'].',userSession='.$data['userSession'].'}', 
            ];

            $result = $this->getContent($url, $headers);
            return json_decode($result, true);

    }


    public function getContent($url, $headers, $postdata = false) {
     
        if (!function_exists('curl_init')){
            return 'Sorry cURL is not installed!';
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        // curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        if ($postdata)
        {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        }
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $contents = curl_exec($ch);
        
        curl_close($ch);
        return $contents;
	}





}