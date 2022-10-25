- you download code form this repository
- if you have xampp or wampp for run php scripts and database 
- if you dont have first install form url https://www.apachefriends.org/
- after install you open xampp and start Apache and Mysql
- after this create new folder like CarSystem under c:/xamppp/htdocs and copy downloaded code
- After start mysql click Admin button of MYSQL
- Database admin interface will open create new database like carsystem
- and import file "carsystem.sql" which is inside downloaded folder name "database"  
- if your database name different from "carsystem" then open db.php file inside include folder at downloaded project
- rename carsystem to other database name
- Goto chrome or som other browser and run localhost/your folder name
- All the apis url like here
#forsignup
http://localhost/Your folder name/ajaxcontroller/signup.php
there was three inputs for signup fname,lname,email     fname=>Firstname,lname=>lastname,email=>email
#forlogin
after signup a 7 digit random password send to your email for login.
http://localhost/You folder name /ajaxcontroller/login.php
there was two inputs for login email,password     email=>email,password=>password
after login you save you uid and token that was used to get all other apis

#for get categories
http://localhost/Your folder name/ajaxcontroller/getrecords.php?purpose=getcategories&token=yourlogintoken&uid=your userid

#for get cars
http://localhost/Your folder name/ajaxcontroller/getrecords.php?purpose=getcars&token=yourlogintoken&uid=youruserid


#for get single category
http://localhost/Your folder name/ajaxcontroller/getrecords.php?purpose=get_single_category&token=yourlogintoken&uid=youruserid&id=yourcategoryid


#for get single car
http://localhost/Your folder name/ajaxcontroller/getrecords.php?purpose=get_single_car&token=yourlogintoken&uid=youruserid&id=yourcarid



#for delete category
http://localhost/Your folder name/ajaxcontroller/getrecords.php?purpose=deletecategories&token=yourlogintoken&uid=youruserid&id=yourcategoryid



#for delete car
http://localhost/Your folder name/ajaxcontroller/getrecords.php?purpose=deletecar&token=yourlogintoken&uid=youruserid&id=yourcategoryid



#for get users
http://localhost/Your folder name/ajaxcontroller/getrecords.php?purpose=getusers&token=yourlogintoken&uid=youruserid


#for get users
http://localhost/Your folder name/ajaxcontroller/getrecords.php?purpose=getusers&token=yourlogintoken&uid=youruserid


#for Post category
http://localhost/Your folder name/ajaxcontroller/category_post.php?purpose=insert
There was one input for category name to insert category name=>category name and two hidden items &token=yourlogintoken&uid=youruserid


#for Update category
http://localhost/Your folder name/ajaxcontroller/category_post.php?purpose=update&id=yourcategoryid
There was one input for category name to insert category name=>category name and two hidden items &token=yourlogintoken&uid=youruserid


#for Post car
http://localhost/Your folder name/ajaxcontroller/car_post.php?purpose=insert
There was four input to insert car   name=>car name,category=>categoryname,model=>model,color=>color and registration item will be auto generated and two hidden items &token=yourlogintoken&uid=youruserid


#for Update car
http://localhost/Your folder name/ajaxcontroller/car_post.php?purpose=update&id=yourcarid
There was four input to insert car   name=>car name,category=>categoryname,model=>model,color=>color and registration item will be auto generated and two hidden items &token=yourlogintoken&uid=youruserid



