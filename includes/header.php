<header id="header">
    <nav class="navbar">
    <div class="nav-content">
        <div class="logo"><a href="#">St. Josh Church</a></div>
            <ul class="menu-list">
            <div class="icon cancel-btn">
                <i class="fa fa-times"></i>
            </div>
                <li><a href="#">home</a></li>
                <li><a href="#about">about us</a></li>
                <li><a href="#people">people</a></li>
                <li><a href="#menu">event</a></li>
                <li><a target="_blank" href="login.php">sign in</a></li>
            </ul>
            <div class="icon menu-btn">
              <i class="fa fa-bars"></i>
            </div>
    </div>
   
    </nav>
</header>

<script>
    const menu = document.querySelector(".menu-list");
    const menuBtn = document.querySelector(".menu-btn");
    const cancelBtn = document.querySelector(".cancel-btn");
    menuBtn.onclick = ()=>{
        menu.classList.add("active");
    }
    cancelBtn.onclick = ()=>{
        menu.classList.remove("active");
    }
        </script>