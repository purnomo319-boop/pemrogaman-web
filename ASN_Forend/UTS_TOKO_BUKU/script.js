let cart = localStorage.getItem("cart")
? parseInt(localStorage.getItem("cart"))
: 0;

let total = 0;

// TAMPILKAN CART
document.addEventListener("DOMContentLoaded", () => {

  const cartElement =
  document.getElementById("cart-count");

  if(cartElement){
    cartElement.innerText = cart;
  }

  // SEARCH
  const search =
  document.getElementById("search");

  if(search){

    search.addEventListener("keyup", function(){

      let filter =
      search.value.toLowerCase();

      let cards =
      document.querySelectorAll(".card");

      cards.forEach(card => {

        let text =
        card.innerText.toLowerCase();

        if(text.includes(filter)){
          card.style.display = "block";
        }else{
          card.style.display = "none";
        }

      });

    });

  }

});

// MENU MOBILE
function toggleMenu(){

  document
  .getElementById("nav")
  .classList.toggle("show");

}

// TOAST
function showToast(){

  let toast =
  document.getElementById("toast");

  toast.style.display = "block";

  setTimeout(() => {

    toast.style.display = "none";

  },2000);

}

// TAMBAH KERANJANG
function addToCart(price){

  cart++;

  total += price;

  localStorage.setItem("cart", cart);

  document
  .getElementById("cart-count")
  .innerText = cart;

  showToast();

}

// LOGIN
function login(){

  alert("Login berhasil!");

}

// DARK MODE
function toggleDarkMode(){

  document.body.classList.toggle("dark");

}

// CHECKOUT
function checkout(){

  alert(
    "Checkout berhasil!\nTotal Belanja Rp " +
    total.toLocaleString()
  );

}

// SLIDER
let images = [

  "https://picsum.photos/1200/400?1",
  "https://picsum.photos/1200/400?2",
  "https://picsum.photos/1200/400?3"

];

let index = 0;

setInterval(() => {

  index++;

  if(index >= images.length){
    index = 0;
  }

  const slide =
  document.getElementById("slide");

  if(slide){
    slide.src = images[index];
  }

},3000);

// CLOCK
setInterval(() => {

  let now = new Date();

  let time = now.toLocaleTimeString();

  let clock =
  document.getElementById("clock");

  if(clock){
    clock.innerText = time;
  }

},1000);