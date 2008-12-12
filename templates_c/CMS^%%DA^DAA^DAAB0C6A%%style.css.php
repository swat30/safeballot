<?php /* Smarty version 2.6.21-dev, created on 2008-08-26 12:10:44
         compiled from db:css/style.css */ ?>
/******************************************************************************************************************************
  Dynamic ASP / Norex.com LTD Content Management System (CMS) Software
  Using this script without obtaining licenses from Norex.com LTD. is illegal.

  Copyright (c) 2003-2007 Norex.com LTD
  This program is a commercially licensed product. No person may redistribute it and/or modify it under the terms of the License agreement.
*****************************************************************************************************************************
============================================================================================================================

    * Filename: style.css
    * Version: 1.0.1 (2008-02-05) YYYY-MM-DD
		* Changelog : 2008-02-07 - Added a banner section
    * Website: http://www.?
    * Author: Norex.com LTD (Justin Bellefontaine, Eric Covert)
    * Description: Standard Cascading Style Sheet for CMS Installation - Handles site-wide styling of elements and structure.
	* Notes: No notes at this time.

    == STRUCTURE NOTES: ========================
    * Page width: 800px
    * Number of columns: 2
    ============================================
	
	== INDEX: ======================================================
	_container : Site Container
	_header : Site Header
	_navi : Site Navigation
	_banner : Banner
	_content : Main Content Area (Left Column/Right Column)
	_footer : Site Footer
	_contentStyles : General Content styles (p, a, h1, h2, etc.)
	_custom : Custom CSS section (Unique to all sites)
	================================================================

=============================================================================================================================*/
ol {
	list-style-type: none;
	padding-left: 0px;
	margin-left: 0px;
}

fieldset {
	border: none;
	padding-left: 0px;
	margin-left: 0px;
}


body {
background-image:url(/images/bg.jpg);
background-repeat:repeat-x;
margin:0;
padding:0;
}

body.tinymce {
	background-image: none;
	background-color: #fff;
}

div#banner { behavior: url(/iepngfix.htc) }

/* _container ==========================================*/
div#container {
width:800px;
}

/* _header ==========================================*/
div#header {
width:800px;
height:76px;
float:left;
}

div#logo {
width:232px;
height:76px;
float:left;
background-image:url(/images/logo.jpg);
background-repeat:no-repeat;
padding:0 20px 0 0;
}

/* _navi ==========================================*/
div#nav {
width:548px;
height:35px;
float:left;
}

/* _banner ==========================================*/
div#banner {
width:800px;
height:274px;
float:left;
background-image:url(/images/banner_bg.png);
background-repeat:no-repeat;
text-align:left;
}

/* _content ==========================================*/
div#mainContent {
width:800px;
float:left;
text-align:justify;
padding-bottom:30px;
}

div#leftCol {
width:565px;
float:left;
padding:15px 48px 0 0;
}

div#rightCol {
width:180px;
float:left;
padding-top:15px;
}

div.block {
width:180px;
float:left;
}

/* _footer ==========================================*/
div#footer {
width:800px;
float:left;
height:50px;
border-top:1px dotted #696969;
padding:5px 0 0;
margin-right:-3px;
}

div.copyright {
font-family:Trebuchet MS, Arial, sans-serif;
font-size:12px;
font-weight:100;
color:#5a9096;
text-align:left;
width:300px;
float:left;
}

div.norexlink {
float:right;
text-align:right;
width:400px;
}

div.norexlink a {
font-family:Trebuchet MS, Arial, sans-serif;
font-size:12px;
font-weight:700;
text-decoration:none;
color:#a4c93d;
margin:0;
padding:0;
}

div.norexlink a:hover {
background-image:url(/images/bg.jpg);
background-repeat:repeat-x;
color:#5a9096;
margin:0;
padding:0;
}

/* _customEnd ==========================================
 _contentStyles ==========================================*/
p {
font-family:Trebuchet MS, Arial, sans-serif;
font-size:14px;
font-weight:100;
color:#696969;
margin:0;
padding:0 0 10px;
}

a {
font-family:Trebuchet MS, Arial, sans-serif;
text-decoration:none;
color:#a4c93d;
font-weight:700;
font-size:14px;
margin:0;
padding:0;
}


a:hover {
color:#5a9096;
}

div#rightCol a:hover {
color:#f3a800;
}

h1 {
font-family:Trebuchet MS, Arial, sans-serif;
font-size:24px;
color:#5a9096;
font-weight:700;
margin:0;
padding:0 0 10px;
}

h2 {
font-family:Trebuchet MS, Arial, sans-serif;
color:#a4c93d;
font-size:24px;
font-weight:700;
margin:0;
padding:0 0 10px;
}

h2 a {
font-size:18px;
}

h3 {
font-family:Trebuchet MS, Arial, sans-serif;
color:#a4c93d;
font-size:18px;
font-weight:700;
margin:0;
padding:0 0 10px;
}

h4 {
font-family:Trebuchet MS, Arial, sans-serif;
color:#5a9096;
font-size:14px;
font-weight:700;
margin:0;
padding:0 0 10px;
}

h5 {
font-family:Trebuchet MS, Arial, sans-serif;
color:#a4c93d;
font-size:12px;
font-weight:700;
margin:0;
padding:0 0 10px;
}

h6 {
font-family:Trebuchet MS, Arial, sans-serif;
color:#5a9096;
font-size:9px;
font-weight:700;
margin:0;
padding:0 0 10px;
}

ul,ol {
font-family:Trebuchet MS, Arial, sans-serif;
font-size:14px;
color:#696969;
margin:0;
padding:0 0 0 30px;
}

ul {
list-style-image:url(/images/bullet.jpg);
}

/* _contentStylesEnd ==========================================
 _custom ==========================================*/
div.divider {
height:1px;
line-height:1px;
width:180px;
border-top:1px dotted #696969;
float:left;
margin:10px 0 0;
padding:0 0 10px;
}

h1.bannerText {
font-family:Trebuchet MS, Arial, sans-serif;
font-size:24px;
color:#fff;
font-weight:700;
float:left;
width:320px;
margin:0;
padding:20px 0 10px;
}

h1.bannerText b {
color:#a4c93d;
}

div#banner img {
float:left;
clear:left;
padding:10px 0 0;
}

div#navSpacer {
float:left;
height:41px;
}

div#rightCol a {
color:#5a9096;
}

/*REGISTRATION FORM*/

form#group_register fieldset {
padding:0;
margin:0;
}

form#group_register ol {
padding:0 0 0 15px;
margin:0;
}

form#group_register ol li {
line-height:40px;
padding:0;
margin:0;
}

form#group_register label {
color:#a3cc32;
padding:0;
margin:0;
font-weight:700;
font-size:14px;
}

form#group_register input {
width:150px;
}

form#group_register input#register_submit {
width:75px;
}

/*END REGISTRATION FORM*/

/*HASH KEY*/

form#insert_hash fieldset {
padding:0;
margin:0;
border:none;
}

form#insert_hash fieldset ol {
padding:0 0 0 15px;
margin:0;
}

form#insert_hash fieldset ol li label {
font-weight:700;
font-size:14px;
color:#a3cc32;
padding:0 0 5px 0;
margin:0;
float:left;
}

form#insert_hash fieldset ol li input#hash {
margin:0 0 10px 0;
}

form#insert_hash fieldset ol li.reqnote {
font-size:10px;
}

form#insert_hash fieldset ol li {
padding:0;
margin:0;
line-height:10px;
}

/*END HASH KEY*/

/*VOTING PAGE*/

div#leftCol h1 i {
color:#a3cc32;
}

form#vote fieldset ol {
padding:0 0 0 15px;
}

form#vote fieldset ol li label.element {
font-weight:700;
}

form#vote fieldset ol li div.element label {
color:#a3cc32;
}

form#vote fieldset ol li {
line-height:30px;
}

/*END VOTING PAGE*/



