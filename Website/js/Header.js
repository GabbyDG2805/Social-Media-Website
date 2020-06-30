
    console.log('Header Page JS loaded');
    
    //Animated search bar
    function expand() {
        $(".search").toggleClass("close");
        $(".input").toggleClass("square");
        if ($('.search').hasClass('close')) {
            $('input').focus();
        } else {
            $('input').blur();
        }
    }

    $('button').on('click', expand);
    window.onload = function() {
        //stores the windows dimensions for checking later on
        height = $(window).height();
        width = $(window).width();
        //displays the mobile menu if the screen size is small enough on the page loading
        if (width <= 610) {
            document.getElementById("menu").style.display = "block";
            document.getElementById("mobile-search").style.display = "block"
        } else if (width >= 610) {
            document.getElementById("menu").style.display = "none";
            document.getElementById("mobile-search").style.display = "none"
        }
        //function does the same as above but dynamically, not just on page load
        var resize = $(window).resize(function () {
            // This will execute whenever the window is re-sized
            var win = $(this); //this = window
            if (win.width() <= 610) {
                document.getElementById("menu").style.display = "block";
                document.getElementById("mobile-search").style.display = "block"
            } else if (win.width() >= 610) {
                console.log('Resize function');
                document.getElementById("menu").style.display = "none";
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("mobile-search").style.display = "none"
            }

        });
    }

    //displays the menu when clicked
    $('#menu').click(function () {
        document.getElementById("mySidenav").style.width = "200px";
    })
    //closes menu when exit icon is clicked
    $('#close').click(function () {
        document.getElementById("mySidenav").style.width = "0";
    })