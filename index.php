<?php
# Initialize the session
session_start();

# If user is not logged in then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== TRUE) {
  echo "<script>" . "window.location.href='./login.php';" . "</script>";
  exit;
}
?>
<!DOCTYPE html>
<html>
  <head>
  <link rel="icon" type="image/png" sizes="128x128" href="img/favicon.ico">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BOTHUB</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap');

*{
    box-sizing: border-box;
    padding: 0;
    margin: 0;
    font-family: 'Roboto', sans-serif;
}
body{
    line-height: 1.4;
}
.main-wrapper img{
    width: 100%;
    display: block;
}
.main-wrapper a{
    color: #000;
    text-decoration: none;
}
.main-wrapper ul li{
    list-style-type: none;
}
.navbar{
    background: linear-gradient(65deg, rgba(125, 172, 255, 0.864),rgb(142, 221, 255),rgb(255, 255, 255),rgb(142, 221, 255), rgba(125, 172, 255, 0.864));
padding: 0.1rem; /* Increase the vertical padding */
position: fixed;
top: 0;
left: 0;
width: 100%;
max-height: 100vh; /* Increase the max-height */
display: flex;
flex-direction: column;
z-index: 10;

}
.brand-and-icon{
    display: flex;
    justify-content: space-between;
    padding: 1rem 0;
    border-bottom: 1px solid #ffffff;
}
.navbar-brand{
    font-size: 1.9rem;
    letter-spacing: 3px;
    font-weight: 700;
}
.navbar-toggler{
    display: block;
    border: none;
    background: transparent;
    font-size: 1.8rem;
    cursor: pointer;
    padding: 0.2rem 0.5rem;
    transition: all 0.4s ease;
    border: 2px solid #000;
    border-radius: 4px;
}
.navbar-toggler:hover{
    opacity: 0.7;
}
.navbar-collapse{
    overflow-y: scroll;
    display: none;
}
.navbar-nav > li > a{
    text-transform: uppercase;
    font-size: 1.5rem;
    font-weight: 800;
    display: block;
    padding: 0.3rem 0;
    margin: 0.2rem 0;
    border-bottom: 1px solid #dddddd4d;
    border-radius: 1px;
    position: relative;
    transition: all 0.4s ease;
    border-radius: 15px;
}
.drop-icon{
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
}
.navbar-nav > li > a:hover{
    opacity: 0.7;
    background:linear-gradient(65deg, rgba(158, 243, 249, 0.674),white,rgba(255, 255, 255, 0.356), rgba(133, 255, 231, 0.707));
    text-size-adjust: 10px;
 border-radius: 10px;
 margin: 0.1rem 0;

}
.sub-menu h4{
    text-transform: capitalize;
    font-size: 1rem;
    padding: 0.5rem 0;
}
.sub-menu ul li{
    text-transform: capitalize;
    padding: 0.5rem 0;
    margin: 0.4rem 0;
    font-size: 0.95rem;
}
.sub-menu ul li a{
    opacity: 0.8;
    transition: all 0.5s ease;
    border-radius: 6%;

}
.sub-menu ul li a:hover{
    padding-left: 14px;
    opacity: 0.9;
    color:#f82900f7;
}
.sub-menu{
    display: none;
}

.sub-menu-item{
    padding-left: 1.2rem;
}
.sub-menu-item:nth-child(3){
    background: #ddd;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: flex-start;
    padding-top: 2rem;
    padding-bottom: 2rem;
}
.sub-menu-item:nth-child(3) h2{
    text-transform: capitalize;
    margin: 1.5rem 0;
}
.sub-menu-item:nth-child(3) .btn{
    border: 1px solid #000;
    text-transform: uppercase;
    font-size: 0.9rem;
    padding: 0.6rem 1rem;
    cursor: pointer;
    background: #000;
    color: #fff;
    transition: all 0.5s ease;
}
.sub-menu-item:nth-child(3) .btn:hover{
    background: transparent;
    color: #000;
}
.sub-menu-item:nth-child(4){
    width: 50%;
    margin: 0 auto;
    padding: 2rem 0;
}

/* header */
.header{
    margin: auto;
   background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url(img/whitebanner.jpg) center/cover no-repeat;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
.header h2{
    margin: 1rem;
    font-size: 4rem;
    font-weight: 900;
    color: #fff;
    letter-spacing: 2px;
    
}
.header p{
    margin: 0.5rem auto;
    color: #fff;
    width: 60%;
    opacity: 0.8;
    font-weight: 400;
    font-size: 1.4rem;
    text-align: center;
}
.header button {
    margin: 5vw;
    font-size: 20px; /* Adjust the font size as needed */
    width: 12%; /* Adjust the width as needed */
    text-transform: uppercase;
    background: linear-gradient(65deg, rgba(103, 159, 255, 0.878), rgba(133, 233, 255, 0.81));
    color: #ffffff;
    border: none;
    padding: 0.8vw 1.2vw; /* Adjust the padding as needed */
    transition: all 0.5s ease;
    cursor: pointer;
    border-radius: 15px;
}
@media screen and (max-width: 768px) {
    .header button {
        font-size: 3vw; /* Adjust the font size for smaller screens */
    }
}
.header button:hover {
    background: linear-gradient(65deg, rgba(133, 233, 255, 0.81), rgba(103, 159, 255, 0.878));
    color: #000;
    transform: scale(1.2);
}
/* Media Queries */
@media screen and (min-width: 992px){
    .navbar{
        flex-direction: row;
        flex-wrap: wrap;
        align-items: center;
        border-bottom: 1px solid #ddd;
        padding: 0 5rem;
        position: relative;
    }
    .navbar-toggler{
        display: none;
    }
    .brand-and-icon{
        flex: 0 0 100px;
        border-bottom: none;
        padding: 0;
    }
    .navbar-collapse{
        display: block!important;
        overflow-y: hidden;
        flex: 1 0 auto;
    }
    .navbar-nav{
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .navbar-nav > li > a{
        border-bottom: none;
        margin: 0 0.4rem;
        padding: 1.7rem 1.8rem 1.7rem 0.8rem;
        font-size: 1.1rem;
        font-weight: 700;
    }
    .sub-menu{
        font-size: 1.4rem;
        position: absolute;
        left: 20%;
        right:30%;
        width:60%;
        height:65%
        background: #f8f8f8;
    }
    .sub-menu:hover{
      box-shadow: 0px 10px 15px rgba(88, 220, 244, 0.988);
      transform: scale(1.03);
    }
    #sub-menu1{
        position: absolute;
        left: 10%;
        right:50%;
        width: 35%;
        top: 100%;
        background: #f8f8f8;
        padding-left: 30px;
        border-radius: 15px;
    }
    #sub-menu1:hover{
      box-shadow: 0px 10px 15px rgba(88, 220, 244, 0.988);
      color:#141896;
      transform: scale(1.03);
      background:linear-gradient(65deg, rgba(214, 255, 247, 0.81),rgba(252, 217, 254, 0.878));
    }
    #sub-menu2{
        position: absolute;
        left: 23;
        right:30%;
        width: 35%;
        top: 100%;
        background: #f8f8f8;
        padding-left: 30px;
        border-radius: 15px;
    }
    #sub-menu2:hover{
      box-shadow: 0px 10px 15px rgba(88, 220, 244, 0.988);
      color:#141896;
      transform: scale(1.03);
      background:linear-gradient(65deg, rgba(214, 255, 247, 0.81),rgba(252, 217, 254, 0.878));

    }
    #sub-menu3{
        position: absolute;
        left: 53%;
        right:30%;
        width: 35%;
        top: 100%;
        background: #f8f8f8;
        padding-left: 30px;
        border-radius: 15px;
    }
    #sub-menu3:hover{
      box-shadow: 0px 10px 15px rgba(88, 220, 244, 0.988);
      color:#141896;
      transform: scale(1.03);
      background:linear-gradient(65deg, rgba(214, 255, 247, 0.81),rgba(252, 217, 254, 0.878));

    }
    #sub-menu4{
        position: absolute;
        left: 67%;
        right:30%;
        width: 35%;
        top: 100%;
        background: #f8f8f8;
        padding-left: 30px;
        border-radius: 15px;
    }
    #sub-menu4:hover{
      box-shadow: 0px 10px 15px rgba(38, 146, 170, 0.988);
      color:#141896;
      background:linear-gradient(65deg, rgba(214, 255, 247, 0.81),rgba(252, 217, 254, 0.878));

    }
    
    .navbar-nav > li:hover .sub-menu{ 
        display: grid!important;
        grid-template-columns: repeat(4, 1fr);
        padding: 0 5rem;
    }
    .navbar-nav > li{
        border-bottom: 2px solid transparent;
        transition: border-bottom 0.4s ease;
    }
    .navbar-nav > li:hover{
        border-bottom-color: #2b2b2b;
    }
  
    .sub-menu-item{
        padding-left: 0;
    }
    .sub-menu-item:nth-child(3){
        padding-left: 2rem;
        padding-right: 2rem;
    }

    /* header */
    .header{
        height: calc(100vh - 75px);
    }
    .header h2{
        font-size: 5rem;
    }
    .header p{
        width: 85%;
    }

.counter {
            font-size: 2em;
            font-weight: bold;
            color: #ddd
        }
    }
    /* Default styles for login icon */
/* flex grid */
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap');

*{
    font-family: 'Poppins', sans-serif;
    margin:0;
     padding:0;
    box-sizing: border-box;
    outline: none; border:none;
    text-decoration: none;
    text-transform: capitalize;
    transition: .2s linear;
}

.container{
    background:linear-gradient(65deg, rgb(255, 255, 255),  rgba(114, 185, 239, 0.61),rgba(255, 255, 255, 0.707), rgba(133, 255, 231, 0.527));
    padding:15px 9%;
    padding-bottom: 100px;
}

.container .heading{
    text-align:justify;
    padding-bottom: 15px;
    color:#000000;
    text-shadow: 0 5px 10px rgba(0,0,0,.2);
    font-size: 20px;
}

.container .box-container{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
    gap:15px;
}

.container .box-container .box{
    box-shadow: 0 5px 10px rgba(0,0,0,.2);
    border-radius: 5px;
    background: #fff;
    text-align: center;
    padding:30px 20px;
}
/*.container .box-container .box:hover{
    box-shadow: 0 5px 10px rgba(0,0,0,.2);
    border-radius: 5px;
    background: #bce1f3c7;
    text-align: center;
    padding:30px 20px;
}*/
.container .box-container .box img{
    height: 80px;
}

.container .box-container .box h3{
    color:#444;
    font-size: 22px;
    padding:10px 0;
}

.container .box-container .box p{
    color:#777;
    font-size: 15px;
    line-height: 1.8;
}

.container .box-container .box .btn{
    margin-top: 10px;
    display: inline-block;
    background:linear-gradient(65deg, rgb(92, 193, 255),rgb(133, 255, 231));
    color:#fffffff7;
    font-size: 17px;
    border-radius: 10px;
    padding: 8px 25px;
}

.container .box-container .box .btn:hover{
    letter-spacing: 2px;
}
.container .box-container .box .btn:hover{
    margin-top: 10px;
    display: inline-block;
    background:linear-gradient(65deg,rgb(133, 255, 231), rgb(92, 193, 255));
    color:#041b4e;
    font-size: 17px;
    border-radius: 5px;
    padding: 8px 25px;
}
.container .box-container .box:hover{
    box-shadow: 0 10px 15px rgba(20, 68, 131, 0.988);
    transform: scale(1.03);
}

@media (max-width:768px){
    .container{
        padding:20px;
    }
}

#count{
    margin: 0;
    font-size: 2em;
   font-weight: bold;
}
/*testimonial*/
/*contact*/
.second-half {
    height: 50vh; /* Set the height of the second half to 50% of the viewport height */
    background:linear-gradient(65deg,rgb(48, 48, 48), rgb(205, 236, 255));
    display: flex;
    justify-content: center;
    align-items: center;
}
@media screen and (max-width: 768px) {
    .second-half {
        font-size: 0.8rem; /* Decrease the font size for smaller screens */
    }
}
@media screen and (max-width: 480px) {
    .second-half {
        font-size: 0.6rem; /* Further decrease the font size for smaller screens */
    }
}
/* container for the about */
#abou {
    margin-top: 0px;
    margin-left: 0px;
    margin-right: 0px;
    padding-left: 0px;
    background: transparent;
    padding-bottom: 50px;
    border-radius: 10px;
    background:linear-gradient( rgba(122, 171, 255, 0.351));
}

.grid-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    grid-gap: 2px;
    padding-left: 180px;
}

.grid-item {
    margin-top: 90px;
    background: rgb(199, 230, 255);
    background:linear-gradient(65deg, rgba(170, 235, 255, 0.268),white, rgba(170, 235, 255, 0.268));
    padding: 20px;
    text-align: center;
    display: flex;
    align-items: center;
    border-radius: 18px;
    width: 500px;
}

.imag {
    max-width: 10%;
    height: auto;
    margin-right: 20px; /* Add margin to separate the logo from text */
}

.icon {
    font-size: 48px; /* Adjust icon size as needed */
}

.align {
    text-align: justify;
    font-size: 16px; /* Set the font size for the paragraph */
    line-height: 1.5; /* Set the line height for better readability */
}

@media (max-width: 768px) {
    .grid-container {
        grid-template-columns: 1fr;
    }

    .grid-item {
        width: 100%;
        margin: 0;
    }

    .imag {
        max-width: 20%;
    }

    .icon {
        font-size: 36px; /* Adjust icon size for smaller screens */
    }

    .align {
        font-size: 14px; /* Adjust font size for smaller screens */
    }
}
/*testimonial*/
@import url("https://fonts.googleapis.com/css2?family=Barlow+Semi+Condensed:wght@500;600&display=swap");
:root {
  --light-gray: hsl(0, 0%, 81%);
  --light-grayish-blue: hsl(210, 46%, 95%);
  --modarate-violet: hsl(263, 55%, 52%);
  --dark-grayish-blue: hsl(217, 19%, 35%);
  --dark-blackish-blue: hsl(219, 29%, 14%);
  --white: hsl(0, 0%, 100%);
  --light-white: rgba(255, 255, 255, 0.5);
  --black: hsl(0, 0%, 0%);
  --body-font: "Barlow Semi Condensed", sans-serif;
}

*,
*:before,
*:after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

html {
  font-size: 0.81rem;
}

body {
  -ms-overflow-style: none; /* for Internet Explorer, Edge */
  scrollbar-width: none; /* for Firefox */
  overflow-y: scroll;
  min-height: 100vh;
  background-color: var(--light-grayish-blue);
  font-family: var(--body-font);
}
body::-webkit-scrollbar {
  display: none; /* for Chrome, Safari, and Opera */
}

/** Testimonials Section **/

.testimonials-section {
  margin: 0 auto;
  margin-top:60px;
  margin-bottom: 12.692rem;
  max-width: 77.083%;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 2.308rem;
  justify-content: center;
}

/** Testimonial Sections **/

.testimonials-section > * {
  display: flex;
  flex-direction: column;
  gap: 14px;
  border-radius: 10px;
  padding: 1.9rem 2.6rem;
}

.section-1,
.section-2,
.section-5 {
  color: var(--white);
}
.section-3,
.section-4 {
  background-color: var(--white);
  color: var(--black);
}

.section-1 {
  background-image: url("images/bg-pattern-quotation.svg");
  background-repeat: no-repeat;
  background-position: top right 18%;
  background-size: 100px;
  grid-column: span 2;
  background-color: var(--modarate-violet);
}
.section-2 {
  background-color: var(--dark-grayish-blue);
}
.section-3 {
  grid-row: span 2;
}
.section-3 .highlight-content p {
  color: var(--dark-grayish-blue);
}
.section-5 {
  background-color: var(--dark-blackish-blue);
  grid-column: span 2;
}

/** Author **/
.author {
  display: flex;
  flex-direction: row;
  align-items: center;
  gap: 15px;
}

.section-1 .author-info,
.section-2 .author-info,
.section-5 .author-info {
  color: var(--white);
  font-weight: 500;
}

.section-3 .author-info,
.section-4 .author-info .section-3 .highlight-content,
.section-4 .highlight-content {
  color: var(--dark-grayish-blue);
}

.author-describtion,
.content {
  opacity: 50%;
}
.author-describtion {
  font-size: 11px;
}

/** Author Images **/
#testm{
  font-size: 35px;
  font-weight: 600;
  color: grey;
  text-align: center;
  margin-top: 20px;
  text-shadow: 2px 2px 3px grey;
}
.author-img {
  border-radius: 50%;
  width: 2.5rem;
  height: 2.5rem;
}

.section-1 .author-img,
.section-5 .author-img {
  border-style: solid;
  border-width: 2px;
}

.section-5 .author-img {
  border-color: var(--modarate-violet);
}

.section-1 .author-img {
  border-color: var(--light-white);
}

/** Hightlight Content **/
.highlight-content {
  font-size: 1.5rem;
  word-spacing: 1.7px;
}
.highlight-content p {
  font-weight: 600;
}

/** Content **/

.content {
  font-size: 1rem;
  padding-top: 0.4rem;
  line-height: 1.4rem;
}

/** Responsive **/

@media screen and (max-width: 1201px) {
  .testimonials-section {
    margin-top: 5.385rem;
  }
  .section-2,
  .section-4 {
    grid-column: span 2;
  }
  .section-3 {
    grid-row: span 1;
    grid-column: span 4;
  }
}

@media screen and (max-width: 801px) {
  .testimonials-section > * {
    grid-column: span 4;
    grid-row: span 1;
  }
}
/*footer*/



footer{
    display: flex;
    flex-wrap: wrap;
    margin-top: auto;
    background-color: #2d2e33;
    padding: 60px 10%;
}

ul{
    list-style: none;
}

.footer-col{
    width: 25%;
}

.footer-col h4{
    position: relative;
    margin-bottom: 30px;
    font-weight: 400;
    font-size: 22px;
    color: #f1bc0d;
    text-transform: capitalize;
}

.footer-col h4::before{
    content: '';
    position: absolute;
    left: 0;
    bottom: -6px;
    background-color: #27c0ac;
    height: 2px;
    width: 40px;
}

ul li:not(:last-child){
    margin-bottom: 8px;
}

ul li a{
    display: block;
    font-size: 19px;
    text-transform: capitalize;
    color: #bdb6b6;
    text-decoration: none;
    transition: 0.4s;
}

ul li a:hover{
    color: white;
    padding-left: 2px;
}

.links a{
    display: inline-block;
    height: 44px;
    width: 44px;
    color: white;
    background-color: rgba(40, 130, 214, 0.8);
    margin: 0 8px 8px 0;
    text-align: center;
    line-height: 44px;
    border-radius: 50%;
    transition: 0.4s;
}

.links a:hover{
    color: #4d4f55;
    background-color: white;
}

@media(max-width: 740px){
    .footer-col{
        width: 50%;
        margin-bottom: 30px;
        text-align: center;
    }

    .footer-col h4::before{
        all: unset;
    }
}

@media(max-width: 555px){
    .footer-col{
        width: 100%;
    }
}
/*floating button*/
.float{
	position:fixed;
    width:55px;
    height:55px;
    bottom:30px;
    right:30px;
    background:linear-gradient(65deg, rgba(227, 85, 249, 0.889),rgba(41, 100, 251, 0.878));
    color:#FFF;
    border-radius:50px;
    text-align:center;
    font-size:30px;
    z-index:100;
    animation: jump 3s infinite, blue 3s infinite, wave 10s linear infinite;
    overflow: hidden;
}

.my-float{
	margin-top:16px;
}
.float:hover{
    box-shadow: 4px 10px 15px rgba(33, 94, 226, 0.988);
    transform: scale(1.03);
}

@keyframes jump {
    0%, 10%, 20%, 30%, 50% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-15px);
    }
    60% {
        transform: translateY(-5px);
    }
}

.bh-icon {
  /* Add your styles here */
  font-weight: bold;
  font-size: 21px; 
  color:#6cfff5;

}
  /* floating icon module completed */
.welcome{
    
    position: absolute; 
    top: 10px;
    right: 70px;
    width: 70px;
    text-align: right;
    vertical-align: top;
    background-color: transparent;
    font-weight: 600;
    font-size: 15px;
    color: #3e0489d8;

}
/*signup page button color*/
.highlight {
    top: 5px;
    background-color: rgba(91, 255, 211, 0.911); /* Change this to the desired color */

    border-radius: 50px;
    }
    .highlight:hover {
    top: 5px;
    background-color: rgb(24, 255, 147); /* Change this to the desired color */
    border-radius: 50px;
    }
    .highlightt {
    top: 5px;
    background-color: rgba(255, 205, 130, 0.911); /* Change this to the desired color */

    border-radius: 50px;
    }
    .highlightt:hover {
    top: 5px;
    background-color: rgb(255, 113, 24); /* Change this to the desired color */
    border-radius: 50px;
    }
</style>  
</head>
  <body>
    <div class = "main-wrapper">
      <nav class = "navbar">
        <div class = "brand-and-icon">
          <a href = "index.php" class = "navbar-brand">BOTHUB</a>
          <button type = "button" class = "navbar-toggler">
            <i class = "fas fa-bars"></i>
          </button>
        </div>

        <div class = "navbar-collapse">
          <ul class = "navbar-nav">
            <li>
              <a href = "chatbot.html">Chatbot</a>
            </li>
            <li>
              <a href = "https://bothuubs.streamlit.app/">chatpdf</a>
            </li>
            <li>
              <a href = "#" class = "menu-link">
                Convert-to-PDF
                <span class = "drop-icon">
                  <i class = "fas fa-chevron-down"></i>
                </span>
              </a>
              <div class = "sub-menu">
                <!-- item -->
                <div class = "sub-menu-item">
                  <div id="sub-menu1">
                  <h4>Others to PDF</h4>

                  <ul>
                    <li><a href = "JPGtoPDF.HTML">JPG-TO-PDF</a></li>
                    <li><a href = "wordtoPDF.HTML">WORD-TO-PDF</a></li>
                    <li><a href = "PPTtoPDF.html">PPT-TO-PDF</a></li>
                    <li><a href = "exceltopdf.html">EXCEL-TO-PDF</a></li>
                    <li><a href = "htmltopdf.html">HTML-TO-PDF</a></li>
                  </ul>
                </div>
                </div>
               
            </li>

            <li>
              <a href = "#" class = "menu-link">
                Convert-to-others
                <span class = "drop-icon">
                  <i class = "fas fa-chevron-down"></i>
                </span>
              </a>
              <div class = "sub-menu">
                <!-- item -->
                <div class = "sub-menu-item">
                  <div id="sub-menu2">
                  <h4>PDF to others</h4>
                  <ul>
                    <li>
                    <a href = "PDFtoJPG.HTML">PDF-TO-JPG</a></li>
                    <li><a href = "PDFtoword.html">PDF-TO-WORD</a></li>
                    <li><a href = "pdftoppt.html">PDF-TO-PPT</a></li>
                    <li><a href = "pdftoexcel.html">PDF-TO-EXCEL</a></li>
                    <li><a href = "pdftopdfa.html">PDF-TO-PDF/A</a></li>
                  </ul>
                </div>
                </div>
                <!-- end of item -->
                <!-- item -->
                
            </li>

            <li>
              <a href = "#" class = "menu-link">
               PDF ORGANIZE
                <span class = "drop-icon">
                  <i class = "fas fa-chevron-down"></i>
                </span>
              </a>
              <div class = "sub-menu">
                <!-- item -->
                <div class = "sub-menu-item">
                  <div id="sub-menu3">
                  <h4>Organizing PDF</h4>
                  <ul>
                    <li><a href = "merge.html">MERGE PDF</a></li>
                    <li><a href = "split.html">SPLIT PDF</a></li>
                    <li><a href = "removepages.html">REMOVE PAGES</a></li>
                    <li><a href = "extract.html">EXTRACT PAGES</a></li>
                    <li><a href = "organize.html">ORGANIZE PDF</a></li>
                  </ul>
                </div>
                </div>
                <!-- end of item -->
                <!-- item -->
            </li>

            <li>
              <a href = "#" class = "menu-link">
                EDIT PDF
                <span class = "drop-icon">
                  <i class = "fas fa-chevron-down"></i>
                </span>
              </a>
              <div class = "sub-menu">
                <!-- item -->
                <div class = "sub-menu-item">
                  <div id="sub-menu4">
                  <h4> Edit Options</h4>
                  <ul>
                    <li><a href = "rotate.html">ROTATE PDF</a></li>
                    <li><a href = "addpage.html">ADD PAGE NUMBER</a></li>
                    <li><a href = "sign.html">SIGN IN PDG</a></li>
                  <!--  <li><a href = "#">fishing</a></li>
                    <li><a href = "#">fitness & yoga</a></li>-->
                  </ul>
                </div>
                </div>
                <!-- end of item -->
                <!-- item -->
            </li>
            <li><br></li>
            <li><br></li>

            <li>
            <a class="highlight" href = "register.php">Sign up</a>
            </li>
            <li>
            <a  class="highlightt" href = "Logout.php">Logout</a>
            </li>
            <li>
            <div class="welcome">
   
   <!-- User profile -->
       <h4 class="my-4">Hello, <?= htmlspecialchars($_SESSION["username"]); ?></h4>
 </div>
            </li>
          </ul>
         

        </div>
      </nav>
    </div>
   
    <section class = "header">
        <br>
      <h2>Convert > Create > Collaborate</h2>
      <p>Welcome to BotHub! Simplifying document transformation for you. Convert, edit, create with ease. Say goodbye to complexity, hello to efficiency. Explore our API for seamless integration. Join us and empower your documents effortlessly. Contact us to access the BotHub API today!</p>
      <button type = "button"><a href="chatbot.html" >Use Bot</a></button>
      <p id="count">Documents converted<div class="counter" id="counter"> 0</div></p>
    </section>
    <div class="container">
        <br>
        <br>
     
  <section>
      <div class="box-container">
  
          <div class="box">
              <img src="img/pdftoimage.png" alt="">
              <h3>PDF-TO-IMAGE</h3>
              <p>Transform your PDF documents into JPG images with our easy-to-use converter tool.</p>
              <a href="PDFtoJPG.HTML" class="btn">Convert</a>
          </div>
  
          <div class="box">
              <img src="img/imagetopdf.png" alt="">
              <h3>IMAGE-TO-PDF</h3>
              <p>Transform your JPG photos into PDF documents with our user-friendly conversion tool.</p>
              <a href="JPGtoPDF.HTML" class="btn">Convert</a>
          </div>
  
          <div class="box">
              <img src="img/WordToPDF.png" alt="">
              <h3>WORD-TO-PDF</h3>
              <p>Transform your Word files into PDF documents with our easy-to-use converter.</p>
              <a href="wordtoPDF.HTML" class="btn">Convert</a>
          </div>
  
          <div class="box">
              <img src="img/pdf to word.png" alt="">
              <h3>PDF-TO-WORD</h3>
              <p>Transform your PDFs into Word documents with our easy-to-use conversion tool.</p>
              <a href="PDFtoword.html" class="btn">Convert</a>
          </div>
  
          <div class="box">
              <img src="img/ppt-to-pdf-.png" alt="">
              <h3>PPT-TO-PDF</h3>
              <p>Transform your PPT files into PDF documents with our efficient conversion tool.</p>
              <a href="PPTtoPDF.html" class="btn">Convert</a>
          </div>
  
          <div class="box">
              <img src="img/pdf-to-ppt.png" alt="">
              <h3>PDF-TO-PPT</h3>
              <p>Transform your PDFs into editable PowerPoint slides with our easy-to-use conversion tool.</p>
              <a href="pdftoppt.html" class="btn">Convert</a>
          </div>
          <div class="box">
              <img src="img/ConvertExcelToPDF.png" alt="">
              <h3>EXCEL-TO-PDF</h3>
              <p>Transform your Excel files into PDF documents with our efficient conversion tool.</p>
              <a href="exceltopdf.html" class="btn">Convert</a>
          </div>  <div class="box">
              <img src="img/pdf-document-to-an-excel-document.png" alt="">
              <h3>PDF-TO-EXCEL</h3>
              <p>Transform your PDFs into editable Excel spreadsheets with our easy-to-use conversion tool.</p>
              <a href="pdftoexcel.html " class="btn">Convert</a>
          </div>  <div class="box">
              <img src="img/html-to-pdf.png" alt="">
              <h3>HTML-TO-PDF</h3>
              <p>Transform your HTML code into PDF documents with our efficient conversion tool.</p>
              <a href="htmltopdf.html" class="btn">Convert</a>
          </div>  <div class="box">
              <img src="img/PDF-to-PDFA-.png" alt="">
              <h3>PDF-TO-PDF/A</h3>
              <p>Transform your PDFs into PDF/A compliant documents with our efficient conversion tool.</p>
              <a href="pdftopdfa.html" class="btn">Convert</a>
          </div>  <div class="box">
              <img src="img/Merge-PDF-files-.png" alt="">
              <h3>MERGE PDF</h3>
              <p>Combine your PDF documents into a single file with our efficient merging tool.</p>
              <a href="merge.html" class="btn">Merge</a>
          </div>  <div class="box">
              <img src="img/split pdf.png" alt="">
              <h3>SPLIT-PDF</h3>
              <p>Split PDF files into smaller documents with our easy-to-use online PDF splitter.</p>
              <a href="split.html" class="btn">Split</a>
          </div>  <div class="box">
              <img src="img/delete-pdf-.png" alt="">
              <h3>REMOVE PAGES</h3>
              <p>Remove specific pages from your PDF document with our easy-to-use online tool.</p>
              <a href="removepages.html" class="btn">Remove pages</a>
          </div>  <div class="box">
              <img src="img/-Extract-.png" alt="">
              <h3>EXTRACT PDF</h3>
              <p>Extract specific pages from your PDF document with our easy-to-use online tool.</p>
              <a href="extract.html" class="btn">Extract</a>
          </div>  <div class="box">
              <img src="img/organize-pdf-rating.png" alt="">
              <h3>ORGANIZE PDF</h3>
              <p>Organize your PDF files with our easy-to-use online tool for rearranging pages.</p>
              <a href="organize.html" class="btn">Organize</a>
          </div>  <div class="box">
              <img src="img/rotate-.png" alt="">
              <h3>ROTATE PDF</h3>
              <p>Rotate pages in your PDF document with our easy-to-use online tool</p>
              <a href="rotate.html" class="btn">Rotate</a>
      </div>
    
     <div class="box">
      <img src="img/page-numbers-rating.png" alt="">
      <h3>ADD PAGE NUMBER</h3>
      <p>Add page numbers to your PDF document with our easy-to-use online tool.</p>
      <a href="addpage.html" class="btn">Add page no</a>
</div>
 <div class="box">
  <img src="img/pdf sign.png" alt="">
  <h3>SIGN IN PDF</h3>
  <p>Sign your PDF documents digitally with our easy-to-use online tool.</p>
  <a href="sign.html" class="btn">Sign</a>
</div>
</div>
</div>
</section>
<section>
<div id="abou">
    <div class="grid-container">
      <div class="grid-item">
        <img src="img/image1.png" alt="Logo" class="imag">
        <p class="align">BotHub is your universal app for document conversions. We support nearly all document formats, including Word, PDF, Excel, PowerPoint, and more. With our AI-powered chatbot, you can generate content based on your queries and convert it into any document format you choose. Plus, you can use our online tool without downloading any software.</p>
      </div>
      <div class="grid-item">
        <img src="img/image2.png" alt="Logo" class="imag">
        <p class="align">BotHub prioritizes your data security. We follow ISO 27001 standards and have been trusted by our users and customers since our inception. Your files are safe with us; no one except you will ever have access to them. We monetize by selling access to our API, not by selling your data. Learn more about our commitment to security in our Security Overview.</p>
      </div>
      <div class="grid-item">
        <img src="img/image3.png" alt="Logo" class="imag">
        <p class="align">BotHub ensures high-quality conversions for your documents. Our advanced algorithms guarantee that your files are converted with precision and accuracy, maintaining the integrity of your content. Whether you're converting to PDF, Word, or any other format, you can trust BotHub to deliver the highest quality results.</p>
      </div>
      <div class="grid-item">
        <img src="img/image4.png" alt="Logo" class="imag">
        <p class="align">Integrate BotHub's powerful API into your applications to unlock a world of document conversion possibilities. Our API supports over 200 document formats, allowing you to seamlessly convert files with ease. With BotHub API, you can deliver high-quality document conversions directly within your app, enhancing its functionality and user experience.</p>
      </div>
    </div>
  </div>
</section>
  <!--testimonial-->
  <main>
  <p id="testm">Users about us</p>

    <!-- Testimonials Section -->
    <section class="testimonials-section">

        <!-- Section 1 -->
        <section class="section-1">

            <!-- Author -->
            <section class="author">

                <img class="author-img" src="img/image-daniel.png" alt="author-img">
                <section class="author-info">

                    <p class="author-name">Daniel Clifford</p>
                    <p class="author-describtion">Verified Graduate</p>
                </section>
            </section>
            <!-- Highlighted Content -->
            <section class="highlight-content">

                <p>My experience with "Bothub" has been excellent. It has become my go-to platform for all document conversion needs, and I highly recommend it to others.</p>
            </section>
            <!-- Content -->
            <section class="content">

                <q>In today's fast-paced digital world, managing documents efficiently is a must. I recently started using this document conversion website, and I must say, it has made my life so much easier. The platform offers a variety of converters, including PDF to Word, Word to PDF, and more, all seamlessly integrated with an AI-powered chatbot.The chatbot is incredibly intuitive. I just specify my requirements and format, and it swiftly processes the information, providing me with the converted document in no time. This level of efficiency and convenience is unmatched. If you're looking for a tool to streamline your document management, I highly recommend giving this platform a try. It's been a game-changer for me!</q>
            </section>
        </section>
        <!-- Section 2 -->
        <section class="section-2">

            <!-- Author -->
            <section class="author">

                <img class="author-img" src="img/image-daniel.png" alt="author-img">
                <section class="author-info">

                    <p class="author-name">Jonathan Walters</p>
                    <p class="author-describtion">Verified Graduate</p>
                </section>
            </section>
            <!-- Highlighted Content -->
            <section class="highlight-content">

                <p>I trust "Bothub" to deliver high-quality conversions every time. </p>
            </section>
            <!-- Content -->
            <section class="content">

                <q>This document conversion website has been a game-changer for me. The AI-powered chatbot makes converting documents a breeze. I highly recommend it for anyone looking to streamline their document management.</q>
            </section>
        </section>
        <!-- Section 3 -->
        <section class="section-3">

            <!-- Author -->
            <section class="author">

                <img class="author-img" src="img/image-daniel.png" alt="author-img">
                <section class="author-info">

                    <p class="author-name">Kira Whittle</p>
                    <p class="author-describtion">Verified Graduate</p>
                </section>
            </section>
            <!-- Highlighted Content -->
            <section class="highlight-content">

                <p>Such a life-changing
                    experience. Highly
                    recommended!
                </p>
            </section>
            <!-- Content -->
            <section class="content">
<q>n today's digital age, managing documents efficiently is crucial, and this document conversion website has truly made a difference for me. The platform offers a variety of converters, including PDF to Word, Word to PDF, and more, all seamlessly integrated with an AI-powered chatbot.The chatbot is incredibly intuitive, allowing me to specify my requirements and format effortlessly. It swiftly processes the information, providing me with the converted document almost instantly. This level of efficiency and convenience is unmatched.Since I started using this platform, managing documents has become so much easier. It has saved me a lot of time and effort. I highly recommend this platform to anyone looking to streamline their document management process."</q>
            </section>
        </section>
        <!-- Section 4 -->
        <section class="section-4">

            <!-- Author -->
            <section class="author">

                <img class="author-img" src="img/image-daniel.png" alt="author-img">
                <section class="author-info">

                    <p class="author-name">Jeanette Harmon</p>
                    <p class="author-describtion">Verified Graduate</p>
                </section>
            </section>
            <!-- Highlighted Content -->
            <section class="highlight-content">

                <p>An overall wonderful
                    and rewarding
                    experience
                </p>
            </section>
            <!-- Content -->
            <section class="content">

                <q>This document conversion website is a lifesaver. The chatbot simplifies the entire process, making document conversion quick and easy</q>
            </section>
        </section>
        <!-- Section 5 -->
        <section class="section-5">

            <!-- Author -->
            <section class="author">

                <img class="author-img" src="img/image-daniel.png" alt="author-img">
                <section class="author-info">

                    <p class="author-name">Patrick Abrams</p>
                    <p class="author-describtion">Verified Graduate</p>
                </section>
            </section>
            <!-- Highlighted Content -->
            <section class="highlight-content">

                <p>I appreciate the innovative features offered by "Bothub," such as the chatbot integration.
                </p>
            </section>
            <!-- Content -->
            <section class="content">

                <q>This document conversion website has truly transformed the way I manage documents. With its AI-powered chatbot, converting documents has become effortless. I can specify my requirements and format, and the chatbot swiftly delivers the converted document. This level of efficiency has saved me so much time. I highly recommend this platform to anyone looking for a convenient and reliable document conversion solution.</q>
            </section>
        </section>
    </section>
</main>

  <!--footer-->
  <footer>
        <div class="footer-col">
            <h4>Converters</h4>
            <ul>
                <li><a href="PDFtoword.html">PDF-WORD</a></li>
                <li><a href="wordtoPDF.HTML">WORD-PDF</a></li>
                <li><a href="JPGtoPDF.HTML">JPG-PDF</a></li>
                <li><a href="PDFtoJPG.HTML">PDF-JPG</a></li>

            </ul>
        </div>
        <div class="footer-col">
            <h4>BotHub</h4>
            <ul>
                <li><a href="chatbot.html">Chatbot</a></li>
                <li><a href="https://bothuubs.streamlit.app/">Chat with PDF</a></li>
                <li><a href="exceltopdf.html">Excel-pdf</a></li>
                <li><a href="pdftoexcel.html">Pdf-excel</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Deals</h4>
            <ul>
                <li><a href="#">about</a></li>
                <li><a href="#">API</a></li>
                <li><a href="#">contact us</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>follow us</h4>
            <div class="links">
                <a href="https://www.linkedin.com/in/muthukumarshub"><i class="fab fa-linkedin-in"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </footer>
    <link rel="stylesheet" >
<a href="chatbot.html" class="float" target="_blank">
<i class="fa fa-comments chatgpt-icon"></i>
</a>
    <!--jQuery-->
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
    <script >
        $(document).ready(function(){
    $('.navbar-toggler').click(function(){
        $('.navbar-collapse').slideToggle(300);
    });
    
    smallScreenMenu();
    let temp;
    function resizeEnd(){
        smallScreenMenu();
    }

    $(window).resize(function(){
        clearTimeout(temp);
        temp = setTimeout(resizeEnd, 100);
        resetMenu();
    });
});


const subMenus = $('.sub-menu');
const menuLinks = $('.menu-link');

function smallScreenMenu(){
    if($(window).innerWidth() <= 992){
        menuLinks.each(function(item){
            $(this).click(function(){
                $(this).next().slideToggle();
            });
        });
    } else {
        menuLinks.each(function(item){
            $(this).off('click');
        });
    }
}

function resetMenu(){
    if($(window).innerWidth() > 992){
        subMenus.each(function(item){
            $(this).css('display', 'none');
        });
    }
}

{let count = 0;
        const counterElement = document.getElementById('counter');

        function updateCounter() {
            count += 7+1;
            counterElement.textContent = count;
        }

        setInterval(updateCounter, 500); 
}
// This is script file
    </script>
  </body>
  
</html>
