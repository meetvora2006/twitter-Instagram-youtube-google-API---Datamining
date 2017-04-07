ADMIN PANEL

Admin login

Post section - 
* used datatable for all post listing
* admin can add post, and select category and sub category for the post
* Each post is linked with post stack list (stack list is like playlist - user make their own stack list and name it )
* Each post is linked post favourite user list  (which users has made this post favourite )
* (changes in post will update Google spreadsheet) - ZandGdata Library is used to modify Google spreadsheet with php command.
   
User section - user list from twitter login, linking with stack list, favourite list

Category - admin can add category 

Subcategory- admin can add sub category by selecting parent category created in category section

-------------------------------------------------------------------------------------------------------------

FRONT

Filter, twitter login, search, user stack list, card list in stack, before / after login alert message, live 
data from Instagram using curl and sort code.

User can login with twitter.  Search for key word, filter posts using check box (All Ajax Based work)
User can add posts to their favourite list, can create their personal stack list and add post the stack 
list as well. (All Ajax Based work)

We get live data from Instagram with API call using Curl technology. Code is written in title function 
Allcard.php controller file.

-----------------------------------------------------------------------------------------------------
In codeigniter first front loading page can be found in data_application / config / config.php.

The first loading page is view/welcome.php + where all data comes with Ajax call and that Ajax code 
is written in card.js - path can be find in the welcome.php

All data will displayed in view file after Ajax call on controller function and according model 
function... - Path can be find in Ajax function written in card.js

Post can be added or modified in MySQL database from Google spread sheet. That code is done in 
Google spreadsheet itself (with MySQL) JDBC connection. I can show that code but it is not php code 
it is spreadsheet script.
