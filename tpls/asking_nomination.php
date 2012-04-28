<link href="<?php echo plugins_url("nomination-and-voting/css/");?>vote.css" rel="stylesheet"  />
<style type="text/css">

</style>

<div id="fb-root"></div> 
      <script>
	  
	  function  fblogin(){
	  
	  FB.login(function(response) {
   
 
 
	  	if (response.status === 'connected') {
                  FB.api('/me', function(response) {
				  
                  for (var key in response) {
                      if(key=="email" ||  key=="name"){
                      	SetCookie(key,response[key]);
						document.getElementById("c_"+key).value=response[key];
                      }
                    }
					//alert(ReadCookie("email"));
					if(ReadCookie("email")) {
					//document.getElementById("dark1").style.display="none";
					}
					else{ document.getElementById("dark1").style.display="";}
                  });
				  
				  
                }else{
					SetCookie("email","");
					SetCookie("name","");
				}
				}, {scope: 'email,publish_stream'}); 
	  }
	 
	 
	 function twitlogin(){
	 }
	 
	  
	  function SetCookie(cookieName,cookieValue) {
 var today = new Date();
 var expire = new Date();
 var nDays=1;
 expire.setTime(today.getTime() + 3600000*24*nDays);
 document.cookie = cookieName+"="+escape(cookieValue)
                 + ";expires=0";
}
function ReadCookie(cookieName) {
 var theCookie=" "+document.cookie;
 var ind=theCookie.indexOf(" "+cookieName+"=");
 if (ind==-1) ind=theCookie.indexOf(";"+cookieName+"=");
 if (ind==-1 || cookieName=="") return "";
 var ind1=theCookie.indexOf(";",ind+1);
 if (ind1==-1) ind1=theCookie.length; 
 return unescape(theCookie.substring(ind+cookieName.length+2,ind1));
}

        window.fbAsyncInit = function() {
          FB.init({
            appId      : '332020401868',
            status     : true, 
            cookie     : true,
            xfbml      : true,
            oauth      : true,
          });
          showMe = function(response){
          
              if (response.status === 'connected') {
                  FB.api('/me', function(response) {
				  
                  for (var key in response) {
                      if(key=="email" ||  key=="name"){
                      	SetCookie(key,response[key]);
						document.getElementById("c_"+key).value=response[key];
                      }
                    }
					//alert(ReadCookie("email"));
					if(ReadCookie("email")) document.getElementById("dark1").style.display="none";else{ document.getElementById("dark1").style.display="";}
                  });
				  
				  
                }else{
					SetCookie("email","");
					SetCookie("name","");
				} 
            };
          FB.getLoginStatus(function(response) {
  showMe(response);
  FB.Event.subscribe('auth.statusChange', showMe);
  FB.Event.subscribe('auth.logout', function(response){
  	SetCookie("email","");
	SetCookie("name","");
  });
          });
          
          
          
};
         
        (function(d){
           var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
           js = d.createElement('script'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           d.getElementsByTagName('head')[0].appendChild(js);
         }(document));
      </script>
	  
<div class="outer_div">

<div class="dark" id="dark1">
        <div class="fb-login-button" data-scope="email,publish_stream">        
        Login with Facebook
      </div>
        <script src="http://platform.twitter.com/anywhere.js?id=47CcqrU8EyPgbcZD9pmfZg&v=1" type="text/javascript"></script>
          <span id="twitter-connect-placeholder"></span>

    <script type="text/javascript">
	
      twttr.anywhere(function (T) { 
        var currentUser,screenName, profileImage,profileImageTag;  
        if (T.isConnected()) { 
		//alert('<?php //echo $_GET['access_token'];?>');
          currentUser = T.currentUser;
          screenName = currentUser.data('screen_name');
          SetCookie("twitter_name",screenName);
          document.getElementById("c_name").value=screenName;
          document.getElementById("c_email").value=screenName;
          
          profileImage = currentUser.data('profile_image_url');
          profileImageTag = "<img src='" + profileImage + "'/>";
          jQuery('#twitter-connect-placeholder').append("Logged in as " + profileImageTag + " " + screenName); 
          jQuery('#twitter-connect-placeholder').append('<button id="signout" type="button">Sign out of Twitter</button>');    
              jQuery("#signout").bind("click", function () {
                  twttr.anywhere.signOut();
                  location.href="<?php echo home_url();?>";
                });
        } else { 
          T("#twitter-connect-placeholder").connectButton(); 
        }; 
      });  
	 
    </script>
    
    
    
	  </div>
	  
	  
<form name="nomination" id="nomination" method="post" >
<input type="hidden" name="action" value="nomination_submit">
<div class="inner_top_div">
I nominate <input type="text" name="nominee" id="nominee"> for 
<?php 
global $wpdb;
$categories=$wpdb->get_results("SELECT t. * , tt. *
FROM wp_terms AS t
INNER JOIN wp_term_taxonomy AS tt ON t.term_id = tt.term_id
WHERE tt.taxonomy
IN (
'VotingCategory'
)
ORDER BY t.term_id ASC");
echo "<select name='cat' id='cat'>";
foreach($categories as $key => $value){
	echo "<option value='".$value->term_id."'>".$value->name."</option>";
}
echo "</select>";
?> in the awards.
</div>
<div class="bottom_div">

<div class="bottom_inner_div">
<table class="vote_table" width="100%" border="0">
  <tr>
    <td colspan="3"><table class="vote_table" width="100%" border="0">
      <tr>
        <td width="15%" ><img src="<?php echo plugins_url("nomination-and-voting/tpls/");?>award.png" height="112" /></td>
		
        <td width="85%"  style="vertical-align:top">
		<table border="0" width="100%">
		<tr>
		<td style="background-color:#FFFFFF; text-align:left">
		<strong>The 5th annual awards</strong>
		</td>
		</tr>
		<tr>
        <td valign="top"><textarea rows="4" style="width:100%; height:auto" name="textarea">I just nominated monir for game of the year</textarea></td>
      </tr>
		</table>
		 
		
		</td>
      </tr>
      
    </table>
	
	
	</td>
  </tr>
  <tr>
    <td width="40%"><font style="color:#FFFFFF; font-weight:bold; padding-left:5px;font-size:15px;">Share my nomination to : </font> </td>
    <td width="26%" valign="middle"> 
	<div class="social_media">
	<img src="<?php echo plugins_url("nomination-and-voting/tpls/");?>twitter.png" style="vertical-align:text-bottom" /> Twitter <input type="checkbox" name="tw" id="tw" value="tw" />
	</div>
      </td>
    <td width="34%">
      <input type="submit" name="nominate" id="nominate" value="Nominate" class="nom_btn">
<input name="c_email" id="c_email" type="hidden" value="" />
<input name="c_name" id="c_name" type="hidden" value="" /></td>
  </tr>
</table>

</div>

<br>
</form>
</div>
<div id="message"></div> 
<script language="JavaScript">
    <!--
      jQuery('#nomination').submit(function(){
	  	if(jQuery('#fb').is(':checked')){
            if(jQuery.cookie("email")== null || jQuery.cookie("email")== ""){
                document.getElementById("dark1").style.display="";
                alert("Please Sign in with your facebook account");
				fblogin();
                return false;
            }
          }
           if(jQuery('#tw').is(':checked')){
            if(jQuery.cookie("twitter_anywhere_identity")==null || jQuery.cookie("twitter_anywhere_identity")==""){
                document.getElementById("dark1").style.display="";
                alert("Please Sign in with your twitter account");
				  twttr.anywhere(function (T) {
				  T.signIn();
					T.bind("authComplete", function (e, user) {
					  // triggered when auth completed successfull
					  //alert('<?php //echo $_GET['access_token'];?>');
					});
					
					/*T.bind("signIn", function (e) {
					  // triggered when user logs out
					  
					});*/
				  });
                return false;
            }
          }
          
          if(!jQuery('#fb').is(':checked') && !jQuery('#tw').is(':checked')){ 
            document.getElementById("dark1").style.display="";
            alert("Please tick the checkbox either you nominate facebook/twitter account");
            return false;
        }
          /*if((jQuery.cookie("email")== null || jQuery.cookie("email")== "") && (jQuery.cookie("twitter_name")=="" && jQuery.cookie("twitter_anywhere_identity")=="")){
            
            document.getElementById("dark1").style.display="";
            alert("Please Sign in with your facebook/twitter account");
            return false;
        }*/
        
           if(jQuery('#fb').is(':checked')){
                       if(jQuery.cookie("email")!=""){
                            var nomi=jQuery("#nominee").val();
                            if(nomi==""){
                                alert("Please enter the nominee name");
								//Fb.login(function(res){});
                                return false;
                            }
                           var fbmsg="<?php echo get_option('_wp_nv_fb_twiter_text');?>";
						   var cate=jQuery('#cat option:selected').text();
                           fbmsg=fbmsg.replace("{nominee}", nomi);
                           fbmsg=fbmsg.replace("{category}", cate);
                           var params = {};
                            params['message'] = fbmsg;
                            /*params['name'] = 'asf';
                            params['description'] = 'asf';
                            params['link'] = 'http://apps.facebook.com/summer-mourning/';
                            params['picture'] = 'http://summer-mourning.zoocha.com/uploads';
                            params['caption'] = 'Caption';*/
                              
                            FB.api('/me/feed', 'post', params, function(response) {
                              if (!response || response.error) {
                                alert('You are not logged in to your facebook account.Please login to continue');
                                 fblogin();
								 return false;
                              } else {
                                //alert('Published to stream - you might want to delete it now!');
                                jQuery('#nomination').ajaxSubmit({
                                   'url': '<?php echo home_url()?>/',
                                   'beforeSubmit':function(){
                                       jQuery('#loading').fadeIn();
                                   },
                                   'success':function(res){
                                       jQuery('#loading').fadeOut();
                                       jQuery('#message').text(res);
                                       
                                      
                                       //alert(fbmsg);
                                   }
                               });
                              }
                            }); 
                        }
                   }
                   
                   
                   if(jQuery('#tw').is(':checked')){
                        if(jQuery.cookie("twitter_anywhere_identity")){
                            /*jQuery.post(
                            '<?php //echo home_url();?>/',
                            {
                            action: "post_twitter",
                            name:nomi
                            },
                            function(res){
                            }
                            );*/
							var nomi=jQuery("#nominee").val();
							if(nomi==""){
                                alert("Please enter the nominee name");
                                return false;
                            }
                            jQuery('#nomination').ajaxSubmit({
                               'url': '<?php echo home_url()?>/',
                               'beforeSubmit':function(){
                                   jQuery('#loading').fadeIn();
                               },
                               'success':function(res){
                                   jQuery('#loading').fadeOut();
                                   jQuery('#message').text(res);
                                   
                                   
                                   //alert(fbmsg);
                               }
                           });
                         var cate=jQuery('#cat option:selected').text();   
                        var twmsg='<?php echo get_option('_wp_nv_fb_twiter_text1');?>';
                       twmsg=twmsg.replace("{nominee}", nomi);
                        twmsg=twmsg.replace("{category}", cate);    
                            
                              twttr.anywhere(function (T) { 
                                T("#dark1").tweetBox({
                                  height: 100,
                                  width: 400,
                                  defaultContent: twmsg
                                }); 
                              });
                        }
               }
                   
                   

      return false;
      });
    //-->
    </script>
</div>
