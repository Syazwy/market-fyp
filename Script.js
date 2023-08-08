// Sample product data (replace this with your own product list)
const products = [
    { name: "Laptop", category: "electronics", price: "$800" },
    { name: "T-Shirt", category: "clothing", price: "$20" },
    { name: "Sofa", category: "furniture", price: "$500" },
    // Add more products as needed...
  ];
  
  // Function to display products on the page
  function displayProducts() {
    const productsList = document.getElementById("products-list");
    productsList.innerHTML = "";
  
    products.forEach(product => {
      const productDiv = document.createElement("div");
      productDiv.className = "product";
      productDiv.innerHTML = `
        <h3>${product.name}</h3>
        <p>Category: ${product.category}</p>
        <p>Price: ${product.price}</p>
      `;
      productsList.appendChild(productDiv);
    });
  }
  
  // Function to filter products based on selected category
  function filterProducts() {
    const selectedCategory = document.getElementById("category").value;
    const filteredProducts = selectedCategory === "all" ? products : products.filter(product => product.category === selectedCategory);
    displayFilteredProducts(filteredProducts);
  }
  
  // Function to display filtered products on the page
  function displayFilteredProducts(filteredProducts) {
    const productsList = document.getElementById("products-list");
    productsList.innerHTML = "";
  
    filteredProducts.forEach(product => {
      const productDiv = document.createElement("div");
      productDiv.className = "product";
      productDiv.innerHTML = `
        <h3>${product.name}</h3>
        <p>Category: ${product.category}</p>
        <p>Price: ${product.price}</p>
      `;
      productsList.appendChild(productDiv);
    });
  }
  
  // Initial display of all products on page load
  document.addEventListener("DOMContentLoaded", () => {
    displayProducts();
  });
  