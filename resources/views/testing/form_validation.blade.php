<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/treeflex.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/image-uploader.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">


    <style>
        label.error {
            color: red;
        }

        .image--cover {
            width: 150px;
            height: 150px;
            border-radius: 50%;

            object-fit: cover;
            object-position: center right;
        }

        .wrapper>input {
            display: none;

            +label {
                position: relative;
                display: inline-block;
                bottom: 40px;
                right: 40px;
                width: 40px;
                height: 40px;
                margin-bottom: 0;
                border-radius: 100%;
                background: #f1f1f1;
                border: 1px solid transparent;
                box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
                cursor: pointer;
                font-weight: normal;
                transition: all .2s ease-in-out;

                &:hover {
                    background: #f1f1f1;
                    border-color: #d6d6d6;
                }

                &:after {
                    content: "\f040";
                    font-family: 'FontAwesome';
                    color: #757575;
                    position: absolute;
                    top: 8px;
                    left: 0;
                    right: 0;
                    text-align: center;
                    margin: auto;
                }
            }
        }

        .coverView {
            width: 410px;
            height: 200px;
            border: 6px solid #F8F8F8;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
        }

        .coverView>div {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }




        /* multiple image view  */
        .image-preview {
            border: 1px solid #e0dbdb;
            border-radius: 6px;
            padding: 10px;
            height: 100%;

        }

        .image-container {
            height: 120px;
            width: 200px;
            border-radius: 6px;
            overflow: hidden;
            margin: 10px;

        }

        .image-container img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .image-container span {
            top: -8px;
            right: 8px;
            color: red;
            font-size: 28px;
            font-weight: normal;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h1 class="text-center text-success">Welcome to Form</h1>
    <p class="text-center">FORM VALIDATION USING JQUERY</p>
    <div class="container">
        <div class="col-lg-8 m-auto d-block">
            <form action="javascript:storeForm();" id="submitForm" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group pb-3">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter name">
                </div>
                <div class="form-group pb-3">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter email">
                </div>
                <div class="form-group pb-3">
                    <label for="">Phone</label>
                    <input type="text" name="phone" class="form-control" placeholder="Enter phone">
                </div>
                <div class="form-group pb-3">
                    <label for="">Password</label>
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Enter password">
                </div>
                <div class="form-group pb-3">
                    <label for="">Confirm Password</label>
                    <input type="password" name="password_confirm" class="form-control"
                        placeholder="Enter confirm password">
                </div>
                <div class="row pb-3">
                    <div class="col-xl-6">
                        <div class="form-group pb-3">
                            <label for="">Profile Picture</label>
                            <div class="wrapper">
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                    class="image--cover">
                                <input type='file' id="imageUpload" name="profile_picture"
                                    accept=".png, .jpg, .jpeg" />
                                <label for="imageUpload"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group pb-3">
                            <label for="">Cover Photo</label>
                            <input type="file" name="cover_photo" class="form-control" id="coverPhoto"
                                placeholder="Upload cover Photo">
                        </div>

                        <div class="coverView">
                            <div id="cView"> </div>
                        </div>
                    </div>
                </div>

                <div class="form-group pb-3">
                    <input type="file" name="images[]" class="form-control" id="image" onchange="imageSelect()"
                        multiple>
                    <div class="image-preview d-flex flex-wrap justify-content-start mt-3" id="container">

                    </div>
                </div>

                {{-- <div class="form-group pb-3">
                    <label for="">Gallery</label>
                    <div class="input-images"></div>
                </div> --}}


                <div class="form-group pb-3">
                    <label for="" class="pb-3">Favorite Books <i class="fa fa-plus"
                            onclick="addMore()"></i></label>
                    <div id="moreItems">
                        <div class="default" style="display: none">
                            <div class="row">
                                <div class="col-xl-5 pb-3">
                                    <div class="form-group">
                                        <label for="">Title</label>
                                        <input type="text" name="book_title[]" class="form-control book-title">
                                    </div>
                                </div>
                                <div class="col-xl-5 pb-3">
                                    <div class="form-group">
                                        <label for="">Writer Name</label>
                                        <input type="text" name="writer_name[]" class="form-control writer-name">
                                    </div>
                                </div>
                                <div class="col-xl-2 pb-3">
                                    <div class="form-group pt-4">
                                        <button type="button" class="btn btn-danger" onclick="closeBtn(this)"><i
                                                class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group pb-3">
                    <button type="submit" id="submitbtn" class="btn btn-primary"> Submit </button>
                </div>
            </form>
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="{{ asset('js/image-uploader.js') }}"></script>

    <script>
        $(document).ready(function() {

            $('.input-images').imageUploader();

        });
    </script>

    <script>
        var images = [];

        function imageSelect() {
            var image = document.getElementById('image').files;
            for (i = 0; i < image.length; i++) {
                if (check_duplicate(image[i].name)) {
                    images.push({
                        "name": image[i].name,
                        "url": URL.createObjectURL(image[i]),
                        "file": image[i],
                    })
                } else {
                    alert(image[i].name + "is already exist")
                    // console.log(image[i].name + "is already exist");
                }
            }
            // document.getElementById('submitForm').reset();
            document.getElementById('container').innerHTML = imageShow();
        }

        function imageShow() {
            var image = "";
            images.forEach((i) => {
                image += `<div class="image-container d-flex justify-content-center position-relative">
                            <img src="` + i.url + `" alt="">
                            <span class="position-absolute" onclick=deleteImage(` + images.indexOf(i) + `)>&times;</span>
                        </div>`;
            })
            return image;
        }

        function deleteImage(e) {
            images.splice(e, 1);
            $('#container').eq(image.length).remove();
            document.getElementById('container').innerHTML = imageShow();
        }

        function check_duplicate(name) {
            var image = true;
            if (images.langth > 0) {
                for (e = 0; e < images.langth; e++) {
                    if (images[e].name == name) {
                        image = true;
                        break;
                    }
                }
            }
            return image;
        }
    </script>


    <script>
        function storeForm() {
            // var isValid = validateFields();
            // if (isValid) {
            //     // Prevent form submission if validation fails
            //     return false;
            // }
            var data = $('#submitForm');
            var formData = new FormData(data[0]);
            $.ajax({
                type: 'post',
                url: '{{ route('form.store') }}',
                processData: false,
                contentType: false,
                data: formData,
                success: function(response) {
                    if (response.success) {
                        $('#submitForm').trigger("reset");
                        window.location = '{{ route('user.info.index') }}';
                    } else {
                        console.log(response);
                        alert('failed')
                    }
                }
            })
        }

        // function validateFields() {
        //     var isValid = true;

        //     $('input[name="book_title[]"]').each(function() {
        //         var fieldValue = $(this).val();

        //         // Perform validation for each field value
        //         if (fieldValue.trim() === '') {
        //             isValid = false;
        //             $(this).addClass('is-invalid');
        //         } else {
        //             $(this).removeClass('is-invalid');
        //         }
        //     });

        //     return isValid;
        // }
    </script>

    <script>
        function addMore() {
            var defaultDiv = document.querySelector('.default');
            var clonedDiv = defaultDiv.cloneNode(true);

            clonedDiv.style.display = '';

            var moreItemDiv = document.getElementById('moreItems');
            moreItemDiv.appendChild(clonedDiv);

        }

        function closeBtn(button) {
            $(button).closest('.default').remove();
        }

        function addValidationRules() {
            $(".book-title").each((i, e) => {
                $(e).rules("add", {
                    required: true,
                });
            });
            $(".writer-name").each((i, e) => {
                $(e).rules("add", {
                    required: true,
                });
            });
        }
        $(document).ready(function() {
            $("#submitForm").validate();
            addValidationRules();
        });
        $(document).on("focusin", ".book-title, .writer-name", function() {
            $(this).rules("add", {
                required: true,
            });
        });
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {

                    $('.image--cover').attr("src", e.target.result);
                    $('.image--cove').fadeIn(650)
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imageUpload").change(function() {
            readURL(this);
        });
    </script>
    <script>
        $('#coverPhoto').change(function() {
            changeCoverPhoto(this);
        })

        function changeCoverPhoto(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#cView').css('background-image', 'url(' + e.target.result + ')');
                    $('#cView').hide();
                    $('#cView').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        $("#submitForm").validate({
            rules: {
                name: "required",
                email: {
                    email: true,
                    required: true,
                },
                password: {
                    minlength: 5,
                },
                password_confirm: {
                    minlength: 5,
                    equalTo: "#password"
                },


            },
            messages: {
                name: "Plesae enter name",
                email: {
                    email: "Enter valid email",
                    required: "Enter email"
                },



            },


            submitHandler: function(form) {
                form.submit();
            },
        });
    </script>

    <script></script>

    {{-- <script>
        // Document is ready
            $(document).ready(function () {
                // Validate Username
                $("#usercheck").hide();
                let usernameError = true;
                $("#usernames").keyup(function () {
                    validateUsername();
                });

                function validateUsername() {
                    let usernameValue = $("#usernames").val();
                    if (usernameValue.length == "") {
                        $("#usercheck").show();
                        usernameError = false;
                        return false;
                    } else if (usernameValue.length < 3 || usernameValue.length > 10) {
                        $("#usercheck").show();
                        $("#usercheck").html("**length of username must be between 3 and 10");
                        usernameError = false;
                        return false;
                    } else {
                        $("#usercheck").hide();
                    }
                }

                // Validate Email
                const email = document.getElementById("email");
                email.addEventListener("blur", () => {
                    let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
                    let s = email.value;
                    if (regex.test(s)) {
                        email.classList.remove("is-invalid");
                        emailError = true;
                    } else {
                        email.classList.add("is-invalid");
                        emailError = false;
                    }
                });

                // Validate Password
                $("#passcheck").hide();
                let passwordError = true;
                $("#password").keyup(function () {
                    validatePassword();
                });
                function validatePassword() {
                    let passwordValue = $("#password").val();
                    if (passwordValue.length == "") {
                        $("#passcheck").show();
                        passwordError = false;
                        return false;
                    }
                    if (passwordValue.length < 3 || passwordValue.length > 10) {
                        $("#passcheck").show();
                        $("#passcheck").html("**length of your password must be between 3 and 10");
                        $("#passcheck").css("color", "red");
                        passwordError = false;
                        return false;
                    } else {
                        $("#passcheck").hide();
                    }
                }

                // Validate Confirm Password
                $("#conpasscheck").hide();
                let confirmPasswordError = true;
                $("#conpassword").keyup(function () {
                    validateConfirmPassword();
                });
                function validateConfirmPassword() {
                    let confirmPasswordValue = $("#conpassword").val();
                    let passwordValue = $("#password").val();
                    if (passwordValue != confirmPasswordValue) {
                        $("#conpasscheck").show();
                        $("#conpasscheck").html("**Password didn't Match");
                        $("#conpasscheck").css("color", "red");
                        confirmPasswordError = false;
                        return false;
                    } else {
                        $("#conpasscheck").hide();
                    }
                }

                // Submit button
                $("#submitbtn").click(function () {
                    validateUsername();
                    validatePassword();
                    validateConfirmPassword();
                    validateEmail();
                    if (usernameError == true && passwordError == true && confirmPasswordError == true && emailError == true) {
                        return true;
                    } else {
                        return false;
                    }
                });
            });
    </script> --}}
</body>

</html>
