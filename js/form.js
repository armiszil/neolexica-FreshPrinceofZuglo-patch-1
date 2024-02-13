document.addEventListener('DOMContentLoaded', function() {
    var contactForm = document.getElementById('contactForm');

    if (contactForm) {
        contactForm.addEventListener('submit', function(event){
            event.preventDefault();

            var xhr = new XMLHttpRequest();
            var formData = new FormData(contactForm);

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Show popup message
                    var formPopup = document.getElementById('formPopup');
                    if (formPopup) {
                        formPopup.style.display = 'block';
                        // Optionally, hide the popup after a few seconds
                        setTimeout(function() {
                            formPopup.style.display = 'none';
                        }, 3000);
                    }
                }
            };

            xhr.open('POST', 'email.php', true);
            xhr.send(formData);
        });
    }

    document.getElementById('sameAsDelivery').addEventListener('change', function() {
        var billingDetails = document.getElementById('billingDetails');
        if (this.checked) {
            billingDetails.classList.add('active');
        } else {
            billingDetails.classList.remove('active');
        }
    });
    
    var totalPriceElement = document.getElementById('totalPrice');
    var quantityInputs = document.querySelectorAll('.quantity-input');

    var bookPrices = {
        'book1': 5000, // Price in HUF
        'book2': 6000,
        // ... other books and their prices ...
    };

    // Function to update the total price
    function updateTotalPrice() {
        var total = 0;
        quantityInputs.forEach(function(input) {
            var bookKey = input.name.split('[')[1].split(']')[0]; // Extract the book key from the input name
            var quantity = parseInt(input.value) || 0;
            if (bookPrices[bookKey]) {
                total += bookPrices[bookKey] * quantity;
            }
        });
        totalPriceElement.textContent = total + 'HUF';
    }

    // Add event listeners to each quantity input
    quantityInputs.forEach(function(input) {
        input.addEventListener('input', updateTotalPrice);
    });

    // Initial total price calculation
    updateTotalPrice();
});

        quantityInput.addEventListener('input', function() {
            var total = 0;
            document.querySelectorAll('.quantity-input').forEach(function(input) {
                var book = input.name.split('[')[1].split(']')[0];
                var quantity = parseInt(input.value) || 0;
                if (bookPrices[book]) {
                    total += bookPrices[book] * quantity;
                }
            });
            totalPriceElement.textContent = total + 'HUF';
        });
   



