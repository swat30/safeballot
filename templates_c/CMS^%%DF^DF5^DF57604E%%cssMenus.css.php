<?php /* Smarty version 2.6.21-dev, created on 2008-08-26 12:02:35
         compiled from db:css/cssMenus.css */ ?>
#navUl, #navUl ul { /* all lists */
  padding: 0;
  margin: 0;
  list-style: none;
}
ul#navUl {
width:548px;
height:35px;
}
#navUl li.menuDivider {
  width:1px;
  height:11px;
  line-height:33px;
  color:#a4c93d;
  font-size:11px;
}
#navUl a {
  display: block;
  font-family:Trebuchet MS, Arial, sans-serif;
  font-size:12px;
  font-weight:700;
  text-decoration:none;
  color:#5a9096;
  line-height:35px;
  padding-bottom:3px;
}
#navUl a:hover {
color:#a4c93d;
}

#navUl li { /* all list items */
  float:left;
  height:33px;
}
#navUl li a {
  padding: 0 8px;
  line-height:33px;
}
#navUl li ul{ /* second-level lists */
  position: absolute;
  background: #a4c93d;
  width: 10em;
  left: -999em; /* using left instead of display to hide menus because display: none isn't read by screen readers */
  text-align:left;
}

#navUl li ul li {
  display: block;
  clear: left;
  width: 100%;
  line-height:24px;
  border-bottom:1px dotted #FFF;
}
#navUl li ul li a {
  font-size: 14px;
  line-height: 30px;
color:#fff;
font-size:11px;
}
#navUl li ul ul { /* third-and-above-level lists */
  margin: -1em 0 0 10em;
}

#navUl li:hover ul ul, #navUl li:hover ul ul ul, #navUl li.sfhover ul ul, #navUl li.sfhover ul ul ul {
  left: -999em;
}

#navUl li:hover ul, #navUl li li:hover ul, #navUl li li li:hover ul, #navUl li.sfhover ul, #navUl li li.sfhover ul, #navUl li li li.sfhover ul { /* lists nested under hovered list items */
  left: auto;
}

#navUl li ul li:hover, #navUl li ul li.sfhover {
  background:#5a9096;
}

#navUl li ul li a:hover {
  color:#000;
}

#navUl li ul li ul li {
  top:0;
}