<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

<style>
   * {
      box-sizing: border-box;
   }

   body {
      background-color: #f1f1f1;
   }

   #regForm {
      background-color: #ffffff;
      margin: 100px auto;
      font-family: senserif;
      padding: 40px;
      width: 70%;
      min-width: 300px;
   }

   h1 {
      text-align: center;
   }

   input {
      padding: 10px;
      width: 100%;
      font-size: 17px;
      font-family: senserif;
      border: 1px solid #aaaaaa;
   }

   /* Mark input boxes that gets an error on validation: */
   input.invalid {
      background-color: #ffdddd;
   }

   /* Hide all steps by default: */
   .tab {
      display: none;
   }

   button {
      background-color: #04AA6D;
      color: #ffffff;
      border: none;
      padding: 10px 20px;
      font-size: 17px;
      font-family: senserif;
      cursor: pointer;
   }

   button:hover {
      opacity: 0.8;
   }

   #prevBtn {
      background-color: #bbbbbb;
   }

   /* Make circles that indicate the steps of the form: */
   .step {
      height: 15px;
      width: 15px;
      margin: 0 2px;
      background-color: #bbbbbb;
      border: none;
      border-radius: 50%;
      display: inline-block;
      opacity: 0.5;
   }

   .step.active {
      opacity: 1;
   }

   /* Mark the steps that are finished and valid: */
   .step.finish {
      background-color: #04AA6D;
   }
</style>

<body>

   <div class="container">
      <div class="row d-flex justify-content-center">
         <div class="col-md-7 p-5" style="background: rgb(255, 169, 169)">
            <h1 class="text-white">Personal Information</h1>
            <form method="POST" action="{{ route('pesonal.info.store') }}" id="personal_info_form">
               <div class="row">
                  <div class="form-group pb-3">
                     <label for="">First Name</label>
                     <input type="text" name="first_name" id="" class="form-control"
                        placeholder="Enter first name">
                  </div>
                  <div class="form-group pb-3">
                     <label for="">Last Name</label>
                     <input type="text" name="last_name" class="form-control" placeholder="Enter last name">
                  </div>
                  <div class="form-group">
                     <label for="">Designation</label>
                     <input placeholder="Please type your designation" oninput="this.className = ''" id="searchInput"
                        name="designation_id">
                     <ul id="autocompleteList"></ul>
                  </div>
                  <div class="form-group  pb-3">
                     <div class="row">
                        <div class="col-md-4">
                           <label for="">Country </label>
                           <span class="float-end"><button type="button" data-bs-toggle="modal"
                                 data-bs-target="#exampleModal"
                                 style="background: none;border:none;padding:0;color:black">
                                 <i class="fa fa-plus"></i>
                              </button></span>
                           <select name="country_name" id="" class="form-control"
                              onchange="getcity(this.value)">
                              <option value="">Select Country</option>
                              @foreach ($countries as $country)
                                 <option value="{{ $country->country_id }}">{{ $country->country_name }}
                                 </option>
                              @endforeach
                           </select>
                        </div>
                        <div class="col-md-4">
                           <div id="city">
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div id="area">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group  pb-3">
                     <label for="">Image Gallery</label>
                     <input type="file" class="form-control" name="image" multiple accept="jpg, jpeg, png">
                     <div class="image_previw">

                     </div>
                  </div>
                  {{-- <div class="form-group pb-3">
                     <div class="default">
                        <table class="w-100 cloneTable">
                           <tr>
                              <td style="width: 45%">
                                 <label for="">Book Title</label>
                                 <input type="text" name="book_name[]" class="form-control">
                              </td>
                              <td style="width: 45%">
                                 <label for="">Writer Name</label>
                                 <input type="text" name="book_name[]" class="form-control">
                              </td>
                              <td style="padding-top:5%">
                                 <button type="button" class="btn btn-primary" onclick="addMore();"><i
                                       class="bi bi-plus"></i></button>
                              </td>
                           </tr>
                        </table>
                     </div>
                  </div> --}}
                  <div class="mb-3">
                     <div class="row">
                        <div class="col-md-6">
                           <label for="" class="form-label">Add More Field</label>
                        </div>
                        <div class="col-md-6">
                           <button type="button" class="btn btn-primary float-end" onclick="addMoreField()"> <i
                                 class="fa fa-plus"></i> More</button>
                        </div>
                     </div>
   
                     <div id="moreContent">
                        <div class="row default" style="display: none">
                           <div style="width:45%">
                              <label for="">Title</label>
                              <input type="text" name="desc_title[]" class="form-control">
                           </div>
                           <div style="width:45%">
                              <label for="">Description</label>
                              <input type="text" name="description[]" class="form-control">
                           </div>
   
                           <button type="button" style="width: 7%; margin: 24px 0px 0px 0px;" class="btn btn-danger"
                              onclick="closeItem(this)"><i class="fa fa-trash"></i></button>
   
                        </div>
                     </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Save</button>
               </div>
            </form>
         </div>
      </div>
   </div>

   <!-- Modal -->
   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
            <div class="modal-header">
               <h1 class="modal-title fs-5" id="exampleModalLabel">Create Country</h1>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form action="javascript:createCountry();" method="POST" id="createCountry">
                  @csrf
                  <label for="">Country Name</label>
                  <input type="text" name="country_name" class="form-control">
                  <button type="submit" class="btn btn-primary mt-2">Create</button>
               </form>
            </div>
         </div>
      </div>
   </div>
   {{-- 
   <script>
      var currentTab = 0; // Current tab is set to be the first tab (0)
      showTab(currentTab); // Display the current tab

      function showTab(n) {
         // This function will display the specified tab of the form...
         var x = document.getElementsByClassName("tab");
         x[n].style.display = "block";
         //... and fix the Previous/Next buttons:
         if (n == 0) {
            document.getElementById("prevBtn").style.display = "none";
         } else {
            document.getElementById("prevBtn").style.display = "inline";
         }
         if (n == (x.length - 1)) {
            document.getElementById("nextBtn").innerHTML = "Submit";
         } else {
            document.getElementById("nextBtn").innerHTML = "Next";
         }
         //... and run a function that will display the correct step indicator:
         fixStepIndicator(n)
      }

      function nextPrev(n) {
         // This function will figure out which tab to display
         var x = document.getElementsByClassName("tab");
         // Exit the function if any field in the current tab is invalid:
         if (n == 1 && !validateForm()) return false;
         // Hide the current tab:
         x[currentTab].style.display = "none";
         // Increase or decrease the current tab by 1:
         currentTab = currentTab + n;
         // if you have reached the end of the form...
         if (currentTab >= x.length) {
            // ... the form gets submitted:
            document.getElementById("regForm").submit();
            return false;
         }
         // Otherwise, display the correct tab:
         showTab(currentTab);
      }

      function validateForm() {
         // This function deals with validation of the form fields
         var x, y, i, valid = true;
         x = document.getElementsByClassName("tab");
         y = x[currentTab].getElementsByTagName("input");
         // A loop that checks every input field in the current tab:
         for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
               // add an "invalid" class to the field:
               y[i].className += " invalid";
               // and set the current valid status to false
               valid = false;
            }
         }
         // If the valid status is true, mark the step as finished and valid:
         if (valid) {
            document.getElementsByClassName("step")[currentTab].className += " finish";
         }
         return valid; // return the valid status
      }

      function fixStepIndicator(n) {
         // This function removes the "active" class of all steps...
         var i, x = document.getElementsByClassName("step");
         for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
         }
         //... and adds the "active" class on the current step:
         x[n].className += " active";
      }
   </script> --}}

   <script src="{{ asset('js/jquery-3.6.0.js') }}"></script>
   <script src="{{ asset('js/jquery-3.6.0.js') }}"></script>
   <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

   {{-- <script>
      $(function() {
         //   var availableTags = [
         //     "ActionScript",
         //     "AppleScript",
         //     "Asp",
         //     "BASIC",
         //     "C",
         //     "C++",
         //     "Clojure",
         //     "COBOL",
         //     "ColdFusion",
         //     "Erlang",
         //     "Fortran",
         //     "Groovy",
         //     "Haskell",
         //     "Java",
         //     "JavaScript",
         //     "Lisp",
         //     "Perl",
         //     "PHP",
         //     "Python",
         //     "Ruby",
         //     "Scala",
         //     "Scheme"
         //   ];
         $("#tags").autocomplete({
            // source: availableTags
            source: function(request, response) {
               $.ajax({
                  url: "{{ route('search.designation') }}", // Replace with the actual endpoint that retrieves data from the database
                  dataType: "json",
                  data: {
                     query: request.term // Pass the user's search query to the server
                  },
                  success: function(data) {
                     response(data); // Pass the retrieved data to the response callback function
                  }
               });
            }
         });
      });
   </script> --}}

   {{-- <script>
      function addMore() {
         var container = $('.default');
         var item = container.find('.cloneTable').clone();
         item.removeClass('cloneTable');
         item.appendTo(container).show();
      }
   </script> --}}
   <script>
      
      function addMoreField() {
         var container = $('#moreContent');
         var item = container.find('.default').clone();
         item.removeClass('default');
         item.appendTo(container).show();
      }

      function closeItem(element) {
         $(element).parent().remove();
      }
   </script>

   <script>
      function createCountry() {
         var form = $('#createCountry');
         var formdata = new FormData(form[0]);
         $.ajax({
            type: 'post',
            url: '{{ route('country.store') }}',
            processData: false,
            contentType: false,
            data: formdata,
            success: function(response) {
               if (response.success) {

                  $('#exampleModal').modal('toggle');
               } else {
                  console.log('some thing wrong');
               }
            }

         })
      }
   </script>
   <script>
      function getcity(e) {
         var isEnable = $('#enableCity').prop('disabled');
         if (isEnable) {
            document.getElementById("enableCity").disabled = false;
         }
         $.ajax({
            type: 'POST',
            url: '{{ route('enable.city') }}',
            data: {
               'country_id': e,
               '_token': '{{ csrf_token() }}',
            },
            success: function(response) {
               if (response.success) {
                  // $("#showCity").empty();
                  $('#city').html(response.html);
               } else {
                  console.log('error expect');
               }
            }
         })
      }
   </script>


   <script>
      $(document).ready(function() {
         $("#searchInput").autocomplete({
            source: "{{ route('search.autocomplete') }}",
            minLength: 1,
            select: function(event, ui) {
               console.log(event);
               $("#autocompleteList").val(ui.item.value);
            }
         });
      });
   </script>

</body>

</html>
