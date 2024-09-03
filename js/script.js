
document.addEventListener("DOMContentLoaded", function() {
    const cardItems = document.querySelectorAll('.card-item-product');
    cardItems.forEach(function(item) {
        item.classList.add('show');
    });
});

function goBack() {
    window.history.back();
  }
  