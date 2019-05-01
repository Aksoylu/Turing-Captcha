
<link rel="stylesheet" type="text/css" href="style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> </script>
<script type="text/javascript" src="box.js"></script>

  <fieldset> 


<div  id="container">
    <input type="text" id="UserCaptchaCode" class="CaptchaTxtField" placeholder=''>
    <div class='CaptchaWrap'>
      <div  class="captchatext"> <br>
        <img id="captchacode"  src="drawcaptcha.php" class="captchacode" width="300" height="80">
      </div> 
      <input type="button" onClick="refresh_image();" class="btnreload">
    </div>

    <input type="button" onClick="verification();" class="btnsubmit"  value="Submit">
    <br>
        <span id="errormessage" class="error"></span>
</div>
  </fieldset>


<script>

get_guide();
 </script> 