@extends('layouts.app')

@section('title', 'System Documentation')

@section('content')
	
<div class="page-wrapper">
        
    <!-- ******Header****** -->
    <header class="about-header text-center">
        <div class="container">
            <div class="branding">
                <h1 class="logo">
                    <span aria-hidden="true" class="icon_documents_alt icon"></span>
                    <span class="text-highlight">ONLINE</span><span class="text-bold">SHOPPING</span>
                </h1>
            </div>
            <div class="tagline">
                <p>Online Shopping System TECHNICAL and MANUAL documentation</p>
                <p>Online Shopping <i class="fas fa-heart"></i> "do what you do best"</p>
            </div>
            
             <div class="main-search-box pt-3 pb-4 d-inline-block">
                 <form id="search-about" name="search-about" class="form-inline search-form justify-content-center" action="" method="get">
            
                    <input type="search" id="search" placeholder="Search this page..." name="search" class="form-control search-input">
                    
                    <button type="submit" id="submit" name="submit" class="btn search-btn" value="Search"><i class="fas fa-search"></i></button>
                    
                </form>
             </div>
             
            <div class="social-container"> 
                    <a class="btn btn-primary btn-cta" href="/"><i class="fas fa-home"></i>Home Page</a>
            </div><!--//social-container-->
             
            
        </div><!--//container-->
    </header><!--//header-->
    
    <section class="cards-section text-center">
        <div class="container">
            <h2 class="title">Getting started is easy!</h2>
            <div class="intro">
                <p>Welcome to Online Shopping website. If you are new to our site, please follow the user manual below. Learn how to create an account and how to use additonal features of our system. </p>
                <div class="cta-container">
                    <a class="btn btn-primary btn-cta" target="_blank" href="https://github.com/Andrew-Shal/online_shopping#readme" target="_blank"><i class="fas fa-book"></i> Go to Technical Documentation</a>
                </div>
            </div><!--//intro-->
           
            <div id="cards-wrapper" class="cards-wrapper row">
                <div class="item item-pink col-lg-12 col-12">
                    <div class="item-inner">
                        <div class="icon-holder">
                            <i class="fas fa-book"></i>
                        </div><!--//icon-holder-->
                        <h1 class="title">User Manual</h1>
                       
                        
                            <h2>Purpose</h2>
                            <p> 
                            The purpose of the user documentation is to teach and guide the user on how to use the carry out their task when using the Online Shopping system. A student can be a buyer, seller or a guest, however, the tutorial is similar for all except the guest. The guest is only allowed to search and view the product. Guest is not allowed to login but does have the option to register.
                            </p>
                            <h3>
                            Create an account 
                            </h3>
                            <ol align="left">
                                <li>
                                The login page will be the first webpage that any user will see when they load the  www.onlineshopping.com website.
                                </li>
                                <li>
                                If user does not have an account as yet, the user can click the Create Account button.
                                </li>
                                <li>
                                The register page will appear, there user will add their credentials.
                                </li>
                                <li>
                                User must confirm their password and then click the Register button.
                                </li>
                                <li>
                                Congrats! You have successfully created your account.
                                </li>
                            </ol>
                            <h3>
                            Add your form of payment
                            </h3>
                            <ol align="left">
                                <li>
                                    User must be logged in to add form of payment.
                                </li>
                                <li>
                                    Only a register user can add their form of payment.
                                </li>
                                <li>
                                    The user can go into their Billing information and add their method of payment.
                                </li>
                                <li>
                                    User should also type their username, email, address and phone number.
                                </li>
                                <li>
                                    After completion click Submit to save Billing Information.
                                </li>
                            </ol> 
                            
                            <h3>
                            View Product
                            </h3>
                            <ol align="left">
                                <li>
                                    Any user can view a product. User should search product.
                                </li>
                                <li>
                                    After search the user will click on the product.
                                </li>
                                <li>
                                    When user clicks on product, the user will be able to view product name, description, price and stock amount.
                                </li>
                                <li>
                                    Note: Only registered user can rate or add to cart.
                                </li>
                            </ol>
                            
                            <h3>
                            View Recommended Products
                            </h3>
                            <ol align="left">
                                <li>
                                    Only registered user can view recommended products.
                                </li>
                                <li>
                                    User will search product.
                                </li>
                                <li>
                                    Based on user search history, the user will see recommended product.
                                </li>
                                <li>
                                    The recommended product will be displayed under current product.
                                </li>
                                <li>
                                    Note: The user can also see recommended product  based on their purchase history.
                                </li>
                            </ol>
                            
                            <h3>
                            Add Product to Cart
                            </h3>
                            <ol align="left">
                                <li>
                                    Only a registered user can add product to cart.
                                </li>
                                <li>
                                    User should select product.
                                </li>
                                <li>
                                    Then click on Add to Cart
                                </li>
                                <li>
                                    The screen will display the ID number, Product name, quantity and price.
                                </li>
                                <li>
                                    User can modify quantity by selecting the button beside the text box.
                                </li>
                                <li>
                                    User then have the option to Continue Shopping or Check out. 
                                </li>
                                <li>
                                    If user clicks Continue Shopping then it will go back to the search page.
                                </li>
                                <li>
                                    If user clicks Checkout it will give total and go to Checkout Page.
                                </li>
                                <li>
                                    If user wants to remove product from cart, the user can click the Clear my Cart button.
                                </li>
                            </ol>
                            
                            
                            <h3>
                            Checking Out
                            </h3>
                            <ol align="left">
                                <li>
                                    Only registered user can checkout. 
                                </li>
                                <li>
                                    After user have clicked the checkout button on the Shopping Cart page, it will direct to the Checkout Page.
                                </li>
                                <li>
                                    User can view their billing details.
                                </li>
                                <li>
                                    User can also update their payment details.
                                </li>
                                <li>
                                    User can view their order details.
                                </li>
                                <li>
                                    If user wishes to go back and change their product, click the Back to Cart button.
                                </li>
                                <li>
                                    After user have added their Checkout information the user should click Pay Now.
                                </li>
                                <li>
                                    The user will then be notified of their new order.
                                </li>
                            </ol>

                        
              
                    </div>
                </div>

                <div class="item item-pink item-2 col-lg-12 col-12" id="TechnicalDocID">
                    <div class="item-inner">
                        <div class="icon-holder">
                            <span aria-hidden="true" class="fas fa-book"></span>
                        </div><!--//icon-holder-->
                        <h3 class="title">Technical Documentation</h3>
                       
                            <h1>Preface</h1>
                            <h2>Purpose of this Document</h2>
                            <ul align="left">
                            <li>This document is a Technical Documentation for use by members of Group 2. It provides reading material and guidance that assists group members in producing an online shopping system.</li>
                            </ul>
                            <h2>Use of this Document</h2>
                            <p>&nbsp;</p>
                            <table width="574" style="border:'2px solid black'">
                            <tbody>
                            <tr>
                            <td width="286">
                            
                            <p align="center">&nbsp;&nbsp;&nbsp;&nbsp; A.&rdquo;Summary&rdquo; Properties</p>
                                                            
                            </td>
                            <td width="288">
                            <p>&nbsp;</p>
                            </td>
                            </tr>
                            <tr>
                            <td width="286">
                            <p>Title</p>
                            </td>
                            <td width="288">
                            <p>Group 2 Technical Documentation</p>
                            </td>
                            </tr>
                            <tr>
                            <td width="286">
                            <p>Author</p>
                            </td>
                            <td width="288">
                            <p>Group members of Group 3: Andrew Shal, Delroy Coc, Danay Chavarria, George Price, Allando Li</p>
                            </td>
                            </tr>
                            <tr>
                            <td width="286">
                            <p>Keywords</p>
                            </td>
                            <td width="288">
                            <p>Group 2, Online Shopping</p>
                            </td>
                            </tr>
                            </tbody>
                            </table>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <table width="576">
                            <tbody>
                            <tr>
                            <td width="288">
                            <p>&nbsp;&nbsp;&nbsp;&nbsp; b.&rdquo;Custom&rdquo; Properties</p>
                            </td>
                            <td width="288">
                            <p>&nbsp;</p>
                            </td>
                            </tr>
                            <tr>
                            <td width="288">
                            <p>Project</p>
                            </td>
                            <td width="288">
                            <p>Online Shopping</p>
                            </td>
                            </tr>
                            <tr>
                            <td width="288">
                            <p>Contract</p>
                            </td>
                            <td width="288">
                            <p>Full Name of Contract to Template for specification development</p>
                            </td>
                            </tr>
                            <tr>
                            <td width="288">
                            <p>Version</p>
                            </td>
                            <td width="288">
                            <p>Issue 1</p>
                            </td>
                            </tr>
                            <tr>
                            <td width="288">
                            <p>Date</p>
                            </td>
                            <td width="288">
                            <p>14th April 2019</p>
                            </td>
                            </tr>
                            </tbody>
                            </table>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <p>&nbsp;</p>
                            <h2>Specific Design Considerations and Constraints</h2>
                            <ul>
                            <li>Object Oriented Development is being used in the development of the Online Shopping Project. It is greatly emphasized in the architecture of the project&rsquo;s Graphical User Interface. Samples are also available in the folder.</li>
                            </ul>
                            <p>&nbsp;</p>
                            <h1>Introduction</h1>
                            <p>&nbsp;</p>
                            <h2>Purpose</h2>
                            <ul align="left">
                            <li>This document was created to help with the creation of the Online Shopping project.</li>
                            </ul>
                        
                            <ul align="left">
                            <li>This document is intended for the group members of the Online Shopping project and the lecturer that will review the project.</li>
                            </ul>
                            <h2>Scope</h2>
                            <ul  align="left">
                            <li>The goal of this project is to create an open marketplace that allows anyone to buy, browse or sell products. This will allow students to easily earn money by selling whatever available product they have, or be able to locate a hard to find product that stores may not carry.</li>
                            </ul>
                            
                            <ul  align="left">
                            <li>The Programming section of this online shopping system targeted mostly for Students but not restricted to. The system has 3 complexities which is the recommendation, online payment and Sales Queue ( packaging and handling) feature.</li>
                            </ul>
                
                            <ul  align="left">
                            <li>The recommendation feature gives suggestions to users based on their search history, viewed items, and what other people buy with items that the user buys.</li>
                            </ul>
                            
                            <ul align="left">
                            <li>Paying Online via credit card requires validations and data/information processing. Users will also be able to choose their form of payment. (Cash, Credit Card)</li>
                            </ul>
                        
                            <ul align="left">
                            <li>Items give feedback to user if the item they want to buy is in stock or is sold. The system will then place that use in a queue until item is restocked.</li>
                            <li>User will also be able to identify locations for drop off and pick up of products.</li>
                            </ul>
                            <h2>Definitions, Acronyms and Abbreviations</h2>
                            <ol  align="left">
                            <li>Authorization - The process where your customer&rsquo;s credit card issuer gives permission and allows the payment transaction to proceed.</li>
                            <li>Billing address - The address where the customer&rsquo;s credit card statement is mailed to.</li>
                            <li>Inventory - The retailer&rsquo;s current quantity of products on hand, waiting to be sold.</li>
                            <li>Order Fulfilment - Refers to the steps involved in this process from the point of sale until delivery of the order.</li>
                            <li>PayPal - Founded in 1998, PayPal is a leading, worldwide payment processing company. The service can process payments for merchants.</li>
                            <li>Point-of-Sale (POS) - A software which enables the online store to accept transactions, manage inventory, add products, process payments and send receipts digitally.</li>
                            <li>Shipping - Physically transferring a product from the seller&rsquo;s warehouse to the customer&rsquo;s delivery address.</li>
                            <li>Transaction - A record of actions taken for every order.</li>
                            <li>Usability - The relative ease of navigating, reading, or otherwise interacting with a website or web application.</li>
                            <li>User Interface (UI) - User Interface is a way in which everything is designed to facilitate users to interact with an application or a website.</li>
                            <li>Void - A type of transaction that cancels a transaction that has not been completed yet.</li>
                            </ol>
                            <p>&nbsp;</p>
                            <h1>System Overview</h1>
                            <h2>System Characteristics</h2>
                            <p  align="left">The description of the system should be given in terms of the Architecture of the solution that is being applied with high level data flows described to set the context of the system, for instance, to look at its external interfaces. This section should also set out to &lsquo;characterise&rsquo; the system describing aspects of its operation that specify if the system has, inter alia:</p>
                            <ul align="left">
                            <li>Online Shopping system will operate in real-time.</li>
                            <li>Online Shopping system will cater to mainly students who can be buyers, sellers and a guest.</li>
                            <li>Online Shopping system will be user friendly towards users.</li>
                            <li>Online Shopping system is to be highly robust.</li>
                            <li>Online Shopping system provides security feature to protect data.</li>
                            <li>Online Shopping system will be scalable and easily maintainable in the future.</li>
                            </ul>
                            <h2>Infrastructure Services</h2>
                            <ul align="left">
                            <li>Online Shopping system provides the following infrastructure services:</li>
                            </ul>
                            <ol  align="left">
                            <li>Security</li>
                        
                            <p>m.Online payment</p>
                            <p>n.Recommendations/suggestions of product</p>
                            <p>o.Sales Queue</p>
                            <p>p.Registration</p>
                            <p>q.Shopping Cart</p>
                            </ol>
                            
                            <h2>Naming Conventions</h2>
                            <ul>
                            <li>The Online Shopping system uses naming conventions such as Delimiter-separated words to name variables.</li>
                            </ul>
                            <h2>Programming Standards</h2>
                            <ul align="left" >
                            <li>In general, the programming standard should define a consistent and uniform programming style. Since the Online Shopping uses java and PHP, here are some standards:</li>
                            </ul>
                            <ol align="left">
                            <p>r.Use four spaces for indentation</p>
                            <p>s.Always put braces around statement contained in control structures.</p>
                            <p>t.use nouns of adjectives when naming interfaces</p>
                            <p>u.Use documentation comments to describe the programming interface</p>
                            <p>v.Document public,protected,package, and private members.</p>
                            </ol>
                            <h2>Software Development Tools</h2>
                            <ul align="left">
                            <li>Laravel is a free, open-source PHP web framework, created by Taylor Otwell and intended for the development of web applications following the MVC architectural pattern.</li>
                            <li>Object-relational mapping is a technique of accessing a relational database form an object-oriented language such as Java,</li>
                            </ul>
                            <h2>Software Requirements Traceability Matrix</h2>
                            <p><strong><u>Table 1: Table displaying traceability matrix</u></strong></p>
                            <h1>References</h1>
                            <p>&nbsp;</p>
                            <p>Ghosh, S., &amp; Ghosh, S. (n.d.). SOFTWARE REQUIREMENT SPECIFICATION FOR ONLINE FASHION STORE. Retrieved from https://www.academia.edu/29499527/SOFTWARE_REQUIREMENT_SPECIFICATION_FOR_ONLINE_FASHION_STORE
                            </p>     
                    </div>
                </div>
             
            </div>
            
        </div><!--//container-->
    </section>
</div><!--//page-wrapper-->

@endsection

@section('scripts')
<script>

$('#submit').click(function(e){
    e.preventDefault();
    if($('#search').val().trim().length < 1) return;


    $('span').each(function () {
        ($(this).css('background-color') == "rgb(255, 192, 203)") ? $(this).css("background-color", "") : 0;
        console.log($(this).css('background-color'));
    });

    doSearch($('#search').val(),'pink');
});



/*
 * Search for text in the window ignoring tags
 * 
 * Parameters:
 *     text: a string to search for
 *     backgroundColor: 
 *         "pink" for example, when you would like to highlight the words
 *         "transparent", when you would like to clear the highlights
 * */
function doSearch(text, backgroundColor) {
  if (window.find && window.getSelection) {
    document.designMode = "on";
    var sel = window.getSelection();
    sel.collapse(document.body, 0);

    while (window.find(text)) {
      document.execCommand("HiliteColor", false, backgroundColor);
      sel.collapseToEnd();
    }
    document.designMode = "off";
  }
}
</script>
@endsection