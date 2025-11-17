document.addEventListener("DOMContentLoaded", () => {
  const navLinks = document.querySelectorAll("nav a");
  const currentPage = window.location.pathname.split("/").pop().toLowerCase();

  navLinks.forEach(link => {
    const linkPage = link.getAttribute("href").toLowerCase();

    if (
      linkPage === currentPage ||
      (currentPage.includes("laptop") && linkPage.includes("product")) ||
      (currentPage.includes("keyboard") && linkPage.includes("product")) ||
      (currentPage.includes("headset") && linkPage.includes("product")) ||
      (currentPage.includes("monitor") && linkPage.includes("product")) ||
      (currentPage.includes("printer") && linkPage.includes("product")) ||
      (currentPage.includes("pc") && linkPage.includes("product")) ||
      (currentPage.includes("router") && linkPage.includes("product")) ||
      (currentPage.includes("mice") && linkPage.includes("product"))
    ) {
      link.classList.add("active"); 
    } else {
      link.classList.remove("active");
    }
  });

  const searchInput = document.querySelector(".search-bar input");
  if (searchInput) {
    searchInput.addEventListener("focus", () => {
      searchInput.style.boxShadow = "0 0 8px rgba(255, 218, 167, 0.7)";
    });
    searchInput.addEventListener("blur", () => {
      searchInput.style.boxShadow = "none";
    });
  }
});

// NEW: PHP-Compatible Add to Cart Function
function addToCart(productId, productName, price, image) {
    // Create a form to submit to PHP
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'addtocart.php';
    
    // Add product data as hidden inputs
    const fields = {
        product_id: productId,
        product_name: productName,
        price: price,
        image: image
    };
    
    for (const [key, value] of Object.entries(fields)) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = value;
        form.appendChild(input);
    }
    
    // Submit the form
    document.body.appendChild(form);
    form.submit();
}


function addToCart(productId, productName, price, image) {
    // Create a form to submit to PHP
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = 'addtocart.php';
    
    // Add product data as hidden inputs
    const fields = {
        product_id: productId,
        product_name: productName,
        price: price,
        image: image
    };
    
    for (const [key, value] of Object.entries(fields)) {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = key;
        input.value = value;
        form.appendChild(input);
    }
    
    // Submit the form
    document.body.appendChild(form);
    form.submit();
}


const transition = document.querySelector('.page-transition');
if (transition) {
  window.onload = () => {
    transition.classList.add('fade-out');
  };
}

