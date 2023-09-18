<!doctype html>
<html lang="en">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Product Create</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
   <style>
      @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css");

      #myform {
    text-align: center;
    padding: 5px;
    border: 1px dotted #ccc;
    margin: 2%;
}
.qty {
    width: 40px;
    height: 25px;
    text-align: center;
}
input.qtyplus { width:25px; height:25px;}
input.qtyminus { width:25px; height:25px;}
      

      .error {
         color: red;
         font-weight: 700;
         font-style: initial;
      }
   </style>
</head>

<body>
   <div class="container">
      <div class="row bg-info p-5">
         <h2>Product create </h2>
         <div class="col-md-6">
            <form id="submitProductForm" method="POST" enctype="multipart/form-data">
               <div class="mb-3">
                  <label for="" class="form-label">Product Category</label>
                  <select name="product_category_id" class="form-control" id="">
                     <option value="">Seletc Once</option>
                     <option value="1">Electronics</option>
                     <option value="2">Books</option>
                     <option value="3">Cosmatics</option>
                  </select>
               </div>
               <div class="mb-3">
                  <label for="" class="form-label">Product Name</label>
                  <input type="text" name="product_name" class="form-control" minlength="1">
               </div>
               <div class="mb-3">
                  <label for="" class="form-label">Product Qty</label>

                  <div>
                     <input type='button' value='-' class='qtyminus minus' field='quantity' />
                     <input type='text' name='quantity' value='1' class='qty' style="width:50px"/>
                     <input type='button' value='+' class='qtyplus plus' field='quantity' />

                     {{-- <span><i class="bi bi-plus"></i></span>
                     <input type="text" name="product_qty" style="width:50px">
                     <span><i class="bi bi-dash"></i></span> --}}
                  </div>

                  {{-- <input type="number" name="product_qty" class="form-control"> --}}
               </div>
               <div class="mb-3">
                  <label for="" class="form-label">Product Price</label>
                  <input type="text" name="product_price" class="form-control">
               </div>
               <div class="mb-3">
                  <label for="" class="form-label">Product Date</label>
                  <input type="text" name="product_date" class="form-control">
               </div>
               <div class="mb-3">
                  <label for="" class="form-label">Product Description</label>
                  <input type="text" name="product_feature" class="form-control">
               </div>
               <div class="mb-3">
                  <label for="" class="form-label">Product Image</label>
                  <input type="file" name="product_image" class="form-control" id="">
               </div>

               <div class="mb-3">
                  <label for="" class="form-label">Phone</label>
                  <input type="text" class="form-control" id="phoneNumberInput">
               </div>

               <div class="mb-3">
                  <div class="row">
                     <div class="col-md-6">
                        <label for="" class="form-label">Add More Field</label>
                     </div>
                     <div class="col-md-6">
                        <button type="button" class="btn btn-primary float-end" onclick="addMoreField()"> <i
                              class="bi bi-plus"></i> More</button>
                     </div>
                  </div>

                  <button type="button" class="btn btn-success" id="moreButton">More</button>
                  <div id="moreFieldsContainer"></div>

                  <div class="moreContent">
                     <div class="row default">
                        <div style="width:30%">
                           <label for="">Title</label>
                           <input type="text" name="desc_title[]" class="form-control">
                        </div>
                        <div style="width:30%">
                           <label for="">Description</label>
                           <input type="text" name="description[]" class="form-control">
                        </div>
                        <div style="width:30%">
                           <label for="">More Image</label>
                           <input type="text" name="more_image[]" class="form-control">
                        </div>

                        <button type="button" style="width: 7%; margin: 24px 0px 0px 0px;" class="btn btn-danger"
                           onclick="closeItem(this)"><i class="bi bi-x"></i></button>

                     </div>
                  </div>


               </div>

               <div class="mb-3 form-check">
                  <input type="checkbox" name="type" value="1" class="form-check-input">
                  <label class="form-check-label" for="">Check me out</label>
               </div>
               <button type="submit" class="btn btn-primary">Submit</button>
            </form>
         </div>


      </div>
   </div>
   <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>

   


   <script>
      $(document).ready(function() {
         // Get references to the button and container
         var moreButton = $('#moreButton');
         var moreFieldsContainer = $('#moreFieldsContainer');

         // Define a counter to track the number of added input fields
         var fieldCounter = 0;

         // Function to create a new input field
         function createInputField() {
            fieldCounter++;

            // Create a new input element
            var inputField = $('<input>', {
               type: 'text',
               name: 'field' + fieldCounter
            });

            // Create a close button
            var closeButton = $('<button>', {
               class: 'closeButton',
               text: 'X'
            });

            // Create a container div for the input field and close button
            var fieldContainer = $('<div>', {
               class: 'fieldContainer'
            });

            // Append the input field and close button to the container div
            fieldContainer.append(inputField, closeButton);

            // Append the container div to the main container
            moreFieldsContainer.append(fieldContainer);
         }

         // Event handler for the "More" button click
         moreButton.on('click', createInputField);

         // Event handler for dynamically created close buttons
         moreFieldsContainer.on('click', '.closeButton', function() {
            $(this).parent('.fieldContainer').remove();
         });
      });
   </script>

   <script>
      $(document).ready(function() {
         $("#submitProductForm").validate({
            rules: {
               product_category_id: "required",
               product_name: "required",
               product_price: "required",
               product_date: "required",
               product_desc: "required",
               product_image: "required",
            },
            messages: {
               product_name: "please Name Enter",
               product_price: "please Price Enter",
            },
            submitHandler: function(form) {
               form.submit();
            }
         });
      });
   </script>

   <script>
      function addMoreField() {
         var container = $('.moreContent');
         var item = container.find('.default').clone();
         item.removeClass('default');
         item.appendTo(container).show();
      }

      function closeItem(element) {
         $(element).parent().remove();
      }
   </script>
</body>

</html>
