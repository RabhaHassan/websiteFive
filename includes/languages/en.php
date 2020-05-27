<?php
function lang($phrases){
    static $lang =array(
        //NAVBAR Header And  cart  and products
        'HOME_PAGE'=>"Home",
        'products'=>"Posts",
        'categories'=>"Categories",
        'My_profile'=>"My Profile",
        'Add_Item'=>"Add Item",
        'My_Item'=>"My Item",
        'Log_out'=>"Logout",
        'Top_categories'=>"Top Categories",
        'New_post'=>'Posts',
        'Add_tocart'=>'Add To Cart',
        'Items_cart'=>'Items',
        'shopping_cart'=>'Shopping Cart',
        'Total_Items'=>'Total Items',
        'Total_Price'=>'Total Price',
        'Remove_cart'=>'Remove',
        'pro_cart'=>'Product',
        'Quanty_cart'=>'Quanty',
        'Sub_total'=>'Sub Total',
        'Update_cart'=>'Update Cart',
        'Continue_shopping'=>'Continue To Shopping',
        'Checkout'=>'Checkout',
        'Change'=>'Change',
        'Show_cat'=>'Show Category items',
        'login_signup'=>'Login/SignUp',
        'Login'=>'Login',
        'SignUp'=>'SignUp',
        //NAVBAR
        'HOME_ADMIN'=>"home",
        'CATEGORIES'=>"Categories",
        'ITEMS'=>"Items",
        'MEMBERS'=>"Members",
        'COMMENTS'=>"Comments",
        'STATISTICS'=>"Statistics",
        'LOGS'=>"Logs",
        'Stock'=>"Stock",
        'My_Store'=>"Store",
        'clear_noti'=>"clear All",
        'all_noti'=>"Show All",
        'stores'=>"Stores"
        
    );
    return $lang[$phrases];
}//end function
?>