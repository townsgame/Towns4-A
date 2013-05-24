<!DOCTYPE html> 
<html>
    <head>
    
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <script type="text/javascript" src="definitions.js"></script>
        
    </head>
    <body>

        <div id="fb-root"></div>
        <script type="text/javascript">
            var button;
            var logintext;
            var userInfo;
            window.fbAsyncInit = function() {
            
                FB.init({ appId: app_id,
                    status: true, 
                    cookie: true,
                    xfbml: true,
                    oauth: true});
                    
               function updateButton(response) {
                    button = document.getElementById('fb-auth');
                    logintext = document.getElementById('logintext');
                    userInfo = document.getElementById('user-info');
                    
                    if (response.authResponse) {   
                        // the user is already logged in                    
                        FB.api('/me', function(info) {
                            login(response, info);
                        });
                        
                        alert('a');
                        button.onclick = function() {
                            FB.logout(function(response) {
                                logout(response);
                            });
                        };
                    } else {  
                        button.innerHTML = logintext.innerHTML;
                           
                        button.onclick = function() {alert('aaa');
                            FB.login(function(response) {
                                if (response.authResponse) {
                                    FB.api('/me', function(info) {
                                        login(response, info);
                                    });	   
                                } else {
                                }
                            }, {scope:'user_about_me,email'});  	
                        }
                    }
                }
                
                FB.getLoginStatus(updateButton);
                FB.Event.subscribe('auth.statusChange', updateButton);	
            };
            (function() {
                var e = document.createElement('script'); e.async = true;
                e.src = document.location.protocol 
                    + '//connect.facebook.net/en_US/all.js';
                document.getElementById('fb-root').appendChild(e);
            }());
            
            
            function login(response, info)
            {
                if (response.authResponse) {
                    
                    // check wheter the user 
                    // 1.) is in the database - otherwise create
                    // 2.) is logged in - otherwise log in
                    // TODO: AJAX     
                                                     
                    userInfo.innerHTML =  info.id + ',' + info.name + ',' + info.email; // delete
                    
                    var logouttext;
                    logouttext = document.getElementById('logouttext');
                    button.innerHTML = logouttext.innerHTML;
                }
            }
        
            function logout(response)
            {
                // log out the user
                // TODO: AJAX
                
                userInfo.innerHTML = ""; // delete
            }
        </script>


        <button id="fb-auth">Login with Facebook</button>
        <div id="logintext" style="display: none;">Log in with Facebook</div>
        <div id="logouttext" style="display: none;">Log out</div>
        
        <br />
        <div id="user-info"></div>
        <br />
    </body>
</html>
