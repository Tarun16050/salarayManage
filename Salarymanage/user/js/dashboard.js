// function openNav() {
//     document.getElementById("navigation").style.width = "250px";
//     document.getElementById("row").style.marginLeft = "250px";
// }

// function closeNav() {
//     document.getElementById("navigation").style.width = "0";
//     document.getElementById("row").style.marginLeft= "0";
// }

// function toggleNav() {
//     var navWidth = document.getElementById("navigation").style.width;
//     if (navWidth === "250px") {
//         closeNav();
//     } else {
//         openNav();
//     }
// }


    // function toggleNav() {
    //     var navigation = document.getElementById('navigation');
    //     if (navigation.classList.contains('sidebar-open')) {
    //         navigation.classList.remove('sidebar-open');
    //     } else {
    //         navigation.classList.add('sidebar-open');
    //     }
    // }
    // function toggleNav() {
    //     document.body.classList.toggle('sidebar-open');
    // }
    


    $(document).ready(function () {
        $("#sidebarCollapse").on("click", function () {
          $("#sidebar").toggleClass("active");
          $(this).toggleClass("active");
        });
      });
      

