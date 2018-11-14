<div class="navbar">
    <div class="container">
        <div class="all_links">
            <ul class="UnListStyle">
                <li> <a href="dashbord.php"><?php echo 'home'?> </a> </li>
                <li> <a href="categories.php"><?php echo 'categories'?> </a> </li>
                <li> <a href="item.php"><?php echo 'items'?> </a> </li>
                <li> <a href="member.php"><?php echo 'member'?> </a> </li>
                <li> <a href="comments.php"><?php echo 'comments'?> </a> </li>
                <li> <a href="#"><?php echo 'statistic'?> </a> </li>
                <li> <a href="#"><?php echo 'logs'?> </a> </li>
            </ul>
        </div>
 <div class="brand" style="display: inline-block;
                             float: right;
                             width: 26%;
                             font-size: 22px;
                             list-style: none;
                             padding: 15px;
                             text-transform: capitalize">
        <li  id="click_to_show_and_hide"  style="float: right;
                                                 color: white;
                                                 cursor: pointer">
           abanoub >
            <ul 
                id="show_and_hide" 
                class="UnListStyle another" 
                style="background: #bcc3bc;
                       position: absolute;
                       top: 60px;
                       display: none;">

                <li 
                   style='text-align: center;
                          background: #c1bfbf;
                          padding: 12px 33px;'> 
                    <a href="../index.php?do=Edit&id=<?php echo $_SESSION['UserId']?>" 
                       style="color: black;
                              text-transform:capitalize;
                              text-decoration: none;">
                              Visist Shop
                     </a> 
                </li>
                
                <li 
                   style='text-align: center;
                          background: #c1bfbf;
                          padding: 12px 33px;'> 
                    <a href="member.php?do=Edit&id=<?php echo $_SESSION['UserId']?>" 
                       style="color: black;
                              text-transform:capitalize;
                              text-decoration: none;">
                               Edit profile
                     </a> 
                </li>
                <li style='text-align: center;
                           background: #c1bfbf;
                           padding: 12px 33px;'> 
                    <a href="#" style="color: black;
                                       text-transform:capitalize;
                                       text-decoration: none;"> 
                                   Setting</a>
                 </li>

                <li style='text-align: center;
                           background: #c1bfbf;
                           padding: 12px 33px;'>
                     <a href="logout.php" style="color: black;
                                          text-transform:capitalize;
                                          text-decoration: none;"> 
                    Log out</a> 
                </li>
            </ul>
        </li>
    </div>
    </div> <!--container-->
</div> <!--navbar-->





<script src="theme/js/navbar.js"></script>
