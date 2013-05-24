<?php

use Nette\Application\UI\Form;
use Nette\Utils\Strings;
use Nette\Http\Url;

class PayPresenter extends BasePresenter
{
    protected static $myReceive = "http://www.ancwis.com/pay/receive";
    protected static $payPal = "www.paypal.com";
    protected static $payPalAccount = "info@injectioncomp.com";
    protected static $token = "scpKKc8YIQ46M_WL7XKYJuqqmgpaZRPkNM3pbx0CJ6_d5iJaA61NGtc4Sgi";
    
    // send to paypal
    // default   
    public function actionDefault($first = 0, $second = 0)
    {
        // language
        $this->template->lang = $this->getText('pay');

        $this->template->block = true;
                
        $line_id = (int)$first;
        $user_id = (int)$second;
        // must exist 
        if ($line_id > 0 && $user_id > 0)
        {
            $line = Project::read_Lines($line_id);
            $user = Project::read_User($user_id);
            // must exist
            if ($line != null && $user != null)
            {
                // prepare
                // ini_set('allow_url_fopen', '1');
                
                // new order
                if (true)
                {
                    // not twice
                    Project::setData("block", 0);
                
                    // return URL
                    $url = $this->getHttpRequest()->getUrl();
                    $url = new Url($url);            
                    $url = (string)($url->hostUrl . $url->path) . 'receive';
        
                    $data = array(
                      "cmd" => "_xclick",
                      "business" => self::$payPalAccount,
                      "currency_code" => "USD",
                      "item_name" => $line['title'],
                      "amount" => $line['amount'],
                      "return" => self::$myReceive,
                      "on0" => "user",
                      "os0" => $user['name'],
                      "custom" => $line_id . '+' . $user_id, 
                    );                     
                    
                    $this->template->data = $data;
                    $this->template->url = self::$payPal . "/cgi-bin/webscr";
                    $this->template->block = false;
                    
                    // log
                    Project::writeLog('The order of ' . $line_id  . ' started to be delivered to: ' . $user_id);
                    
                    // only in the same session
                    // Project::setData("registered_id", session_id());                    
                }
            }    
        }
    }
    
    // receive from paypal 
    // receive
    public function actionReceive($tx = '')
    {
        // language
        $this->template->lang = $this->getText('pay');
        
        /*
        $request = $this->getRequest();
        $params = $request->getParams();     
        */
        // on0, os0, on1, os1 (custom)
        if ($tx != '')
        {             
            $token = self::$token;
            // $token = "_3RXDSwsRXAwKVTpfs7Qac4yDq2ms7t9Ds5OseXYXgVEx1OYGgY1nlAyZRa"; // TEMPORARY
            $data = array(
               "cmd" => "_notify-synch",
               "tx" => $tx,
               "at" => $token, 
            ); 
            $res = self::postRequest(self::$payPal, $data);
            
            if ($res)
            {
                 // parse the data
                $lines = explode("\n", $res);
                $keyarray = array();
                if (strcmp($lines[0], "SUCCESS") == 0) 
                {
                    $key = '';
                    $val = '';
                    for ($i = 1; $i < count($lines); $i++)
                    {
                        $value = (array)Strings::split($lines[$i], '~[=]\s*~');
                        if (array_key_exists(0, $value) && array_key_exists(1, $value))
                            $keyarray[urldecode($value[0])] = urldecode($value[1]);
                    } 
                    
                    // order process
                    $custom = Strings::split($keyarray['custom'], '~[+]\s*~');
                    $line_id = (int)$custom[0];
                    $line = Project::read_Lines($line_id);
                    $user_id = (int)$custom[1];
                    $user = Project::read_User($user_id);
                   
                    // check line exists
                    if ($line == null)
                    {
                        Project::writeLog('Hacker (line): the order was NOT created between user: ' . $user_id . ' and line: ' . $line_id);
                        $this->flashMessage($this->template->lang['hack_line']);
                        return;
                    }
                    // check user exists
                    if ($user == null)
                    {
                        Project::writeLog('Hacker (user): the order was NOT created between user: ' . $user_id . ' and line: ' . $line_id);
                        $this->flashMessage($this->template->lang['hack_user']);
                        return;
                    }
                    
                    // check amount
                    if ($keyarray['payment_gross'] != $line['amount'])
                    {
                        Project::writeLog('Hacker (payment_gross): the order was NOT created between user: ' . $user_id . ' and line: ' . $line_id);
                        $this->flashMessage($this->template->lang['hack_amount']);
                        return;
                    }
                    // check currency
                    if ($keyarray['mc_currency'] != "USD")
                    {
                        Project::writeLog('Hacker (mc_currency): the order was NOT created between user: ' . $user_id . ' and line: ' . $line_id);
                        $this->flashMessage($this->template->lang['hack_currency']);
                        return;
                    }                   
                    // check receiver email 
                    if ($keyarray['receiver_email'] != self::$payPalAccount)
                    {
                        Project::writeLog('Hacker (receiver_email): the order was NOT created between user: ' . $user_id . ' and line: ' . $line_id);
                        $this->flashMessage($this->template->lang['hack_email']);
                        return;
                    }                 
                    
                    /*
                    // only in the same session
                    if (Project::getData("registered_id") != session_id())
                    {
                        Project::writeLog('Hacker (wrong_session): the order was NOT created between user: ' . $user_id . ' and line: ' . $line_id); 
                        $this->flashMessage($this->template->lang['hack_session']);
                        return;
                    }                 
                    */                 
                    
                    // new order
                    if (true)
                    {                     
                        // once
                        if ((int)Project::getData("block") == 0)
                        {                             
                            // the same token as before; here because of multiple paypal input
                            $add = (string)Project::getLast($user_id);
                            $lasttokensDB = Strings::split($add, '~[;]\s*~');
                            foreach ($lasttokensDB as $no)
                            {                       
                                if ($no == $tx)
                                {
                                    Project::writeLog('Hacker (token_again): the order was NOT created between user: ' . $user_id . ' and line: ' . $line_id); 
                                    $this->flashMessage($this->template->lang['hack_token']);
                                    return;
                                } 
                            }
                        
                            // log
                            Project::writeLog('The order of ' . $line_id . ' was delivered to: ' . $user_id);

                            // create the oreder NOW
                            $credit = $user['credit'] + $line['credit'];
                            // Authenticator::update($user_id, array('credit' => $credit));                           
                                                        
                            // database
                            // token once
                            $add = $tx . ';';                
                            // make string
                            foreach ($lasttokensDB as $value)
                                if ($value != "")
                                  $add .= $value . ';';                               
                            self::setLast($user_id, $add); 
                            
                            // once
                            // set data
                        }
                        
                        $this->template->data = array(
                            "first_name" => $keyarray['first_name'],
                            "last_name" => $keyarray['last_name'],
                            "item_name" => $keyarray['item_name'],
                            "amount" => $keyarray['payment_gross'],
                            "user" => $user['name'],
                        );
                        
                        $this->flashMessage($this->template->lang['purchased']);
                    }
                }
                else if (strcmp($lines[0], "FAIL") == 0) 
                {
                    Project::writeLog('FAIL: One order was NOT created.');
                    $this->flashMessage($this->template->lang['fail']);
                }
            }
            else
            {
               Project::writeLog('NO RESULT: One order was NOT created.');
               $this->flashMessage($this->template->lang['noresult']);
            }  
        } 
    }
    
       public static function postRequest($url, $data, $optional_headers = null)
        {          
          // setting
          $params = array('http' => array(
                      'method' => 'POST',
                      'content' => http_build_query($data),
                      'header' => "Content-type: application/x-www-form-urlencoded"
                    ));
          if ($optional_headers !== null) 
          {
              $params['http']['header'] = $optional_headers;
          }
          
          // sending
          $ctx = stream_context_create($params);          
          $fp = fopen("https://" . $url . "/cgi-bin/webscr", 'rb', false, $ctx);
          // once more
          if (!$fp) 
          {
             $fp = fopen("https://" . $url . "/cgi-bin/webscr", 'rb', false, $ctx);
          }
          
          // return
          $response = stream_get_contents($fp);
          // once more
          if ($response == false)
          {
              $response = stream_get_contents($fp);
          }
                    
          return $response;
                 
          /*       
          // setting and sending
          $req = 'cmd=_notify-synch';
          $req .= "&tx=" . $data['tx'] . "&at=" . $data['at'];          
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, "https://$url/cgi-bin/webscr");
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: $url"));
          $res = curl_exec($ch);
          curl_close($ch);
          */
                    
          // return
          //return $res;   
        }
        
        public static function setLast($id, $token)
        {
            $db = self::getDb();             
                      
            $db->presenter_user()->where('id', $id)->update(array("last" => $token));
        }
}
