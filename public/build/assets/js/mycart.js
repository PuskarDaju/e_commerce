function sendOrder(){
    
    let items= document.querySelectorAll('input[type="checkbox"]');
    let ids=[];
   items.forEach( pro =>{
    if(pro.checked){
        ids.push(pro.id);
    }
   });
    if(ids==null){
        ids.push(0);
    }

    $(document).ready(function(){
    
        $.ajax({
           
            type: "POST",
            url:'/addOrders',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') , // Add CSRF token to the request headers
            },
            data:{
                'ids':ids,
            },
            success: function (data) {
                console.log(data.msg);  // Log success message from server
            },
            error: function (xhr, status, error) {
                console.log('Error:', error);  // Log error in case the request fails
                console.log('Status:', status);  // Log status
                console.log('XHR:', xhr);  // Log the complete xhr response
            }
            
            
        });
    
       });
    };

    function openCheckoutForm() {
        document.getElementById("checkoutForm").style.display = "flex";
    }
    
    // Function to close the checkout form
    function closeCheckoutForm() {
        document.getElementById("checkoutForm").style.display = "none";
    }
    function openCheckoutForm() {
        const checkboxes = document.querySelectorAll(".product-checkbox:checked");
        console.log(checkboxes);
        
        const hiddenFieldsDiv = document.getElementById("hiddenFields");
        const totalPriceInput = document.getElementById("totalPrice");
        console.log(totalPriceInput);
        
        
    
        // Clear previous hidden fields
        hiddenFieldsDiv.innerHTML = "";
    
        // Populate hidden fields for selected items
        checkboxes.forEach((checkbox) => {
            const productId = checkbox.getAttribute("data-id");
            const productPrice = checkbox.getAttribute("data-price");
            const productQuantity = checkbox.getAttribute("data-quantity");
            const productTotal = checkbox.getAttribute("data-total");

            console.log(productId);
            console.log(productPrice);
    
            // Calculate total price
           
    
            // Add hidden inputs
            hiddenFieldsDiv.innerHTML += `
                <input type="hidden" name="products[]" value="${productId}">
                <input type="hidden" name="quantities[${productId}]" value="${productQuantity}">
                <input type="hidden" name="prices[${productId}]" value="${productPrice}">
            `;
        });
        hiddenFieldsDiv.innerHTML+=`<input type="hidden" name="totalprice" id='totalprice' value=${totalPriceInput.value}>`;
    
        // Update total price in the form
        // totalPriceInput.value = total.toFixed(2);
    
        // Show the checkout form
        document.getElementById("checkoutForm").style.display = "block";
    }
