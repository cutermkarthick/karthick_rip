<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Signup  </title>
<link rel="stylesheet" href="./css/style.css" type="text/css" />
<script type="text/javascript" src="./js/plugins/jquery-1.7.min.js"></script>
<script type="text/javascript" src="./js/plugins/jquery-ui-1.8.16.custom.min.js"></script>
<script language="javascript" src="scripts/crypt.js"></script>
<script language="javascript" src="scripts/login.js"></script>
<script language="javascript" src="scripts/mouseover.js"></script>
<link rel="stylesheet" href="style.css">


<script type="text/javascript">

    $(document).ready(function(){

        $('#login').submit(function(e){
            
            var errmsg = '';
            if (document.getElementById("user_name").value == "") 
            {
                errmsg += 'Please Enter Name \n';
            }
            if (document.getElementById("email").value == "") 
            {
                errmsg += 'Please Enter Email \n';
            }
            // else
            // {
            //     var email = document.getElementById("email").value;

            //     var reg = /^([\w-\.]+@(?!gmail.com)(?!yahoo.com)(?!hotmail.com)(?!yahoo.co.in)(?!aol.com)(?!abc.com)(?!xyz.com)(?!pqr.com)(?!rediffmail.com)(?!live.com)(?!outlook.com)(?!me.com)(?!msn.com)(?!ymail.com)([\w-]+\.)+[\w-]{2,4})?$/;
            //     if (reg.test(email))
            //     {
                    
            //     }
            //     else
            //     {
            //         errmsg += 'Please Enter Business Email Address \n';
                    
            //     }
            // }
            if (document.getElementById("company").value == "") 
            {
                errmsg += 'Please Enter Company \n';
            }


            

            if (errmsg == '')
            {
                e.preventDefault();
                var actionurl = e.currentTarget.action;
                console.log("actionurl " + actionurl);

                $.ajax({

                    url: "processLogin.php",
                    type: 'post',
                    dataType: 'html',
                    data: $("#login").serialize(),
                    success: function(response) 
                    {
                 
                        if (response.trim() == "success") 
                        {
                            console.log("response2w" + response);
                            var x;
                            var msg = "Registration Succesfully, Our Admin will Contact you Shortly";
                            if (confirm(msg) == true) 
                            {
                                window.location.href = "login.php" ;
                            } 
                            
                        }
                        else 
                        {
                           alert("Registration Failed \n"); 
                        } 
                    }
                });
            }
            else
            {
               alert (errmsg);
               return false;
            }

            
            
        });

    });


</script>
<!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->
<meta charset="UTF-8"></head>

<body class="login">

<div class="loginbox radius3">
    <div class="loginboxinner radius3">
        <div class="loginheader">
            <h1 class="bebas">Fluent WMS</h1>
            <div class="logo"><img src="./images/fsi_logo.png" alt="" / ></div>
        </div><!--loginheader-->
                <br>
                <center><h2 class="bebas">Registration</h2></center>

        <div class="loginform">
            
            <form id="login" method="post">
                <p>
                    <label for="username" class="bebas">Name</label>
                    <input type="text" id="user_name" name="user_name" class="radius2" />
                </p>
                <p>
                    <label for="email" class="bebas">Email</label>
                    <input type="text" id="email" name="email" class="radius2" />
                </p>
                <p>
                    <label for="company" class="bebas">Company</label>
                    <input type="text" id="company" name="company" class="radius2" />
                </p>

                <p>
                    <label for="company" class="bebas">Contact No</label>
                    <input type="text" id="phone" name="phone" class="radius2" />
                </p>
                
                <p>
                    <!-- <button onclick="javascript:return check_req_fields4signup()">Sign Up</button> -->
                    <button >Sign Up</button>
                    
                </p>
                <p>
                    <center><a href="login.php" class="radius2">Sign in</a></center>
                </p>
                <input type="hidden" name="pagename" id="pagename" value="signup"></input>
                <!-- <p><a href="" class="whitelink small">Can't access your account?</a></p> -->
            </form>
        </div><!--loginform-->
    </div><!--loginboxinner-->
</div><!--loginbox-->

</body>
</html>
