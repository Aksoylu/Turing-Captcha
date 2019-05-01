
function refresh_image()
{
    
	document.getElementById("captchacode").src = "drawcaptcha.php";
    setTimeout(function() {
    get_guide();
    }, 100);
}

function get_guide()
{
       
    var dataset = {
        keycode: "get_guide"
		
    }
    $.ajax({
        type: 'post',
        url: 'core.php',
        data: {query: dataset},
        success: function(result) 
        {

            document.getElementById("UserCaptchaCode").placeholder = result;
        }
    });
 
}

function verification()
{

var d = document.getElementById("UserCaptchaCode").value;
   var dataset = {
        keycode: "verification",
        captchatext: d
        
    }
    $.ajax({
        type: 'post',
        url: 'core.php',
        data: {query: dataset},
        success: function(result) 
        {
         
            if(result == "ok")
            {
          
                 document.getElementById("container").innerHTML = '<center><div class="circle-loader"><div class="checkmark draw"></div></div></center>';
                 setTimeout(function() {
                 $('.circle-loader').toggleClass('load-complete');
                 $('.checkmark').toggle();
                 }, 1000);
              
            }
            else
            {
                document.getElementById("errormessage").innerHTML ="Your answer is wrong. Please try again";
                refresh_image();
            }
        }
    });

    
}