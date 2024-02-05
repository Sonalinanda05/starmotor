document.addEventListener("DOMContentLoaded", function () {
    const loadingContainer = document.getElementById("loading-container");
    loadingContainer.style.display = "flex"; 
    setTimeout(function () {
        loadingContainer.style.display = "none";
    }, 2000);
});

document.addEventListener("DOMContentLoaded", function() {
    var dropdowns = document.querySelectorAll('.nav-item.dropdown');
    dropdowns.forEach(function(dropdown) {
        dropdown.addEventListener('mouseover', function() {
            this.querySelector('.dropdown-menu').classList.add('show');
        });
        dropdown.addEventListener('mouseout', function() {
            this.querySelector('.dropdown-menu').classList.remove('show');
        });
    });
});
function filterOptions() {
    var input, filter, options, option, i;
    input = document.querySelector(".custom-dropdown input");
    filter = input.value.toUpperCase();
    options = document.querySelectorAll(".custom-dropdown-option");

    for (i = 0; i < options.length; i++) {
        option = options[i];
        if (option.textContent.toUpperCase().indexOf(filter) > -1) {
            option.style.display = "";
        } else {
            option.style.display = "none";
        }
    }

   
    document.getElementById("customDropdownOptions").style.display = "block";
}

function selectOption(value) {
   
    document.querySelector(".custom-dropdown input").value = value;
  
    document.getElementById("customDropdownOptions").style.display = "none";
}
// input.addEventListener("click",()=>{
//     document.getElementById(".custom-dropdown-option").style.display="block";
// })
function changeRating(element) {
    
    let currentRating = parseInt(element.getAttribute("data-rating"));

    
    currentRating = (currentRating % 5) + 1;

    element.setAttribute("data-rating", currentRating);
    displayStars(element, currentRating);
}

function displayStars(element, rating) {
   
    const starSymbol = "&#9733;"; 
    const stars = starSymbol.repeat(rating);
    element.innerHTML = stars.padEnd(5, "&#9734;"); 
}

function toggleOptions(id) {
    var suboptions = document.querySelector('.' + id);
    suboptions.style.display = suboptions.style.display === 'block' ? 'none' : 'block';
  }

  function toggleMenu(menuId, symbolId) {
    var menu = $('#' + menuId);
    var menuSymbol = $('#' + symbolId);

    if (menu.css('display') === 'none') {
      // Show menu and change symbol to minus
      menu.show();
      menuSymbol.html('<i class="fas fa-minus"></i>');
    } else {
      // Hide menu and change symbol to plus
      menu.hide();
      menuSymbol.html('<i class="fas fa-plus"></i>');
    }
  }
 

  var menu = document.getElementById("menu-icon");
  var nav = document.getElementById("nav");

  menu.addEventListener("click",()=>{
    nav.style.display = "block";
  })