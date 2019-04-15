====================
===Featured tests===
====================

This folder contains (5) feature tests 
1.  addProductTest
2.  addToCartTest
3.  loginTest
4.  registerTest
5.  viewProductTest


To run feature tests: 

============
==PRE REQS==
============
--> have compser installed




===========
===STEPS===
===========
--> open cmd
--> navigate to the current project directory   C://xampp/htdocs/online_shopping


=======> To run all feature tests
--> type "vendor\bin\phpunit --testsuite Feature"


=======> To run a single feature test
--> type "vendor\bin\phpunit --filter <1 of 5 test case name>"
    eg. vendor\bin\phpunit --filter addToCartTest
