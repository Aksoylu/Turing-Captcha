# What is Turing Captcha
Unlike all the captcha systems that you have used so far Turing Captcha is completely independent and free.

In addition to the usual 'retype' type captcha, there are too many question combinations by asking logical or mathematical questions.
Therefore it cannot be manipulated by intelligent systems.

# Why Turing Captcha

- Turing captcha is completely free.
- All implementations and system of Turing captcha can be hosted on your server so you don't need any services of zoogle, hoogle or soogle.
- You can add more font types. this may make it impossible to manipulate the system
- mathematical and cultural questions are written in captcha style and humanistic answers are asked. Moreover, you can add your own questions.



#### Working With Example Page of Turing Captcha
You can add Turing Captcha to your project with only this one line of code !  
For getting started, you should get clone.zip of project and open example.html

if you looking for a ready-running example, look at : http://turingcaptcha.aksoylu.space


#### How can i implement Turing Captcha in my project ?

Step 1: Copy Turingcaptcha folder in your project's directory.  

Step 2 : Copy this iframe code and paste in your code  

Step 3: in backend (php side); if value of  
**$_SESSION["XCAPTCHA_QUESTION"]** is equals to TRUE,  
this means user has verified himself as human.  

<iframe src="captcha.php" width="400px" height="250px"></iframe>  

#### How to add or remove fonts ?

Attention : xx is supports only .otf font types for now.  

if you want use another font format, you must work on drawcaptcha.php  

Step 1: Copy your .otf font file into turingcaptcha/fonts directory  

Step 2: Edit settings.php,  
add your new font's name without file extension into  
**$FONTS = array();**

#### How to add humanistic-logic questions ?

Edit settings.php add your new question answer duo into  

**$TURING_QUESTIONS = array();**

example :  

Q: Capital city of Turkey  
A : Ankara  
Code :  
**$TURING_QUESTIONS = array(...,Capital city of Turkey" => "Ankara");**

#### What should i know more ?

Turing Captcha supports three types of questions.  

- Math Questions : system asks simple mathematical questions to users  

- Turing Questions : system asks humanistic - cultural questions to users  

example;  
q:Capital city of Turkey  
a:Ankara  

- Captcha Questions : system asks regular captcha retype questions to users.  

you can enable or disable easily any of these question types with updating value of  

**$IS_MATH_QUESTIONS_ENABLED  
$IS_TURING_QUESTIONS_ENABLED  
IS_CAPTCHA_QUESTIONS_ENABLED**

Also you can adjust difficulty level of math questions with updating  
value of **$MATH_QUESTIONS_DIFFICULTY** variable.  

1 : Easy  
2: Medium  
3: Humans maybe can't solve
