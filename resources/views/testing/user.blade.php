@php
    use App\Http\Controllers\UserController;
@endphp
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/treeflex.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <style>
        label.error {
            color: red;
        }

        /*----------------genealogy-scroll----------*/

        .genealogy-scroll::-webkit-scrollbar {
            width: 5px;
            height: 8px;
        }

        .genealogy-scroll::-webkit-scrollbar-track {
            border-radius: 10px;
            background-color: #e4e4e4;
        }

        .genealogy-scroll::-webkit-scrollbar-thumb {
            background: #212121;
            border-radius: 10px;
            transition: 0.5s;
        }

        .genealogy-scroll::-webkit-scrollbar-thumb:hover {
            background: #d5b14c;
            transition: 0.5s;
        }


        /*----------------genealogy-tree----------*/
        .genealogy-body {
            white-space: nowrap;
            overflow-y: hidden;
            padding: 50px;
            min-height: 500px;
            padding-top: 10px;
            text-align: center;
        }

        .genealogy-tree {
            display: inline-block;
        }

        .genealogy-tree ul {
            padding-top: 20px;
            position: relative;
            padding-left: 0px;
            display: flex;
            justify-content: center;
        }

        .genealogy-tree li {
            float: left;
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 20px 5px 0 5px;
        }

        .genealogy-tree li::before,
        .genealogy-tree li::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 2px solid #ccc;
            width: 50%;
            height: 18px;
        }

        .genealogy-tree li::after {
            right: auto;
            left: 50%;
            border-left: 2px solid #ccc;
        }

        .genealogy-tree li:only-child::after,
        .genealogy-tree li:only-child::before {
            display: none;
        }

        .genealogy-tree li:only-child {
            padding-top: 0;
        }

        .genealogy-tree li:first-child::before,
        .genealogy-tree li:last-child::after {
            border: 0 none;
        }

        .genealogy-tree li:last-child::before {
            border-right: 2px solid #ccc;
            border-radius: 0 5px 0 0;
            -webkit-border-radius: 0 5px 0 0;
            -moz-border-radius: 0 5px 0 0;
        }

        .genealogy-tree li:first-child::after {
            border-radius: 5px 0 0 0;
            -webkit-border-radius: 5px 0 0 0;
            -moz-border-radius: 5px 0 0 0;
        }

        .genealogy-tree ul ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 2px solid #ccc;
            width: 0;
            height: 20px;
        }

        .genealogy-tree li a {
            text-decoration: none;
            color: #666;
            font-family: arial, verdana, tahoma;
            font-size: 11px;
            display: inline-block;
            border-radius: 5px;
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
        }

        .genealogy-tree li a h3 {
            font-size: 15px;
        }

        .genealogy-tree li a:hover+ul li::after,
        .genealogy-tree li a:hover+ul li::before,
        .genealogy-tree li a:hover+ul::before,
        .genealogy-tree li a:hover+ul ul::before {
            border-color: #fbba00;
        }

        /*--------------memeber-card-design----------*/
        .member-view-box {
            padding: 0px 20px;
            text-align: center;
            border-radius: 4px;
            position: relative;
        }

        .member-image {
            /* width: 60px; */
            position: relative;
        }

        .member-image img {
            width: 60px;
            height: 60px;
            border-radius: 6px;
            background-color: #000;
            z-index: 1;
        }

        /* original idea http://www.bootply.com/phf8mnMtpe */

        .tree {
            min-height: 20px;
            padding: 19px;
            margin-bottom: 20px;
            background-color: #fbfbfb;
            -webkit-border-radius: 4px;
            -moz-border-radius: 4px;
            border-radius: 4px;
            -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
            -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05);
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.05)
        }

        .tree li {
            list-style-type: none;
            margin: 0;
            padding: 10px 5px 0 5px;
            position: relative
        }

        .tree li::before,
        .tree li::after {
            content: '';
            left: -20px;
            position: absolute;
            right: auto
        }

        .tree li::before {
            border-left: 1px solid #999;
            bottom: 50px;
            height: 100%;
            top: -5px;
            width: 1px
        }

        .tree li::after {
            border-top: 1px solid #999;
            height: 20px;
            top: 25px;
            width: 30px
        }

        .tree li span {
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            /* border: 1px solid #999; */
            border-radius: 5px;
            display: inline-block;
            padding: 3px 8px;
            text-decoration: none
        }

        .tree li.parent_li>span {
            cursor: pointer
        }

        .tree>ul>li::before,
        .tree>ul>li::after {
            border: 0
        }

        .tree li:last-child::before {
            height: 30px
        }

        .tree li.parent_li>span:hover,
        .tree li.parent_li>span:hover+ul li span {
            /* background: #eee; */
            /* border: 1px solid #94a0b4; */
            color: #000
        }
    </style>

</head>

<body>

    <div class="main bg-info-subtle">
        <div class="container p-5">
            <div class="row">
                <div class="col-xl-6 offset-3">
                    <form action="{{ route('user.store') }}" method="POST" id="userForm">
                        @csrf
                        <div class="form-goroup pb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                        </div>
                        <div class="form-goroup pb-3">
                            <label for="">Reference Name</label>
                            <select name="ref_id" id="referenceName" class="form-control">
                                <option value="">Select Ref Name</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-goroup pb-3">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>

                <div class="col-xl-6 d-none">
                    <form action="" id="testForm" class="">
                        <div class="wrap">
                            <button type="button" id="minus" style="border: none; background:none"><i
                                    class="fa fa-minus"></i></button>
                            <input id="mainInput" type="text" name="qty" style="width: 50px" value="0">
                            <button type="button" id="plus" style="border: none; background:none"><i
                                    class="fa fa-plus"></i></button>
                        </div>
                        <div class="form-goroup pb-3">
                            <label for="">Email</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>

                        <div class="form-goroup pb-3">
                            <input type="checkbox" class="chackD" name="checkvalue" value="1">
                            <label for="checkYes"> Yes</label><br>
                            <input type="checkbox" class="chackD" name="checkvalue" value="2">
                            <label for="checkYes"> No</label><br>
                            <input type="checkbox" class="chackD" name="checkvalue" value="3">
                            <label for="checkYes"> Other</label><br>

                        </div>


                        <div class="form-goroup pb-3">
                            <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="container pt-2">
        <div class="row">

            <div class="col-xl-12">

                <div id="collapseDVR3" class="panel-collapse in">
                    <div class="tree ">

                        <ul>
                            @foreach ($maniUser as $x)
                                <li> <span><i class="fa fa-minus-square"></i> {{ $x->firstname }} {{ $x->lastname }}
                                    </span>
                                    @if (count((array) $x->childs))
                                        @include('manageChild', ['childs' => $x->childs])
                                    @endif
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>

            {{-- <div class="col-xl-6">
                <div class="body genealogy-body genealogy-scroll">
                    <div class="genealogy-tree">
                        <ul>
                            <li>
                                <a href="javascript:void(0);" onclick="getChildMember('{{ $adminUser->id }}')">
                                    <div class="member-view-box">
                                        <div class="member-image">
                                            <img src="https://images.pexels.com/photos/2379005/pexels-photo-2379005.jpeg?cs=srgb&dl=pexels-italo-melo-2379005.jpg&fm=jpg"
                                                alt="Member">
                                            <div class="member-details">
                                                @php
                                                    $total = UserController::totalMemeverCount($adminUser->id);
                                                @endphp
                                                <h3>{{ $adminUser->name }} ({{ $total }})</h3>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <div id="{{ $adminUser->id }}">

                                </div>

                            </li>
                        </ul>
                    </div>
                </div>
            </div> --}}
        </div>
    </div>




    <script src="{{ asset('js/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

    <script>
        $('#plus').click(function() {
            $('#minus').prop('disabled', false);
            var input = $(this).closest('.wrap').find('#mainInput');
            input.val(+input.val() + 1);
        })

        $('#minus').click(function() {
            var input = $(this).closest('.wrap').find('#mainInput');
            if (input.val() > 0) {
                input.val(+input.val() - 1);
            }
            if (input.val() == 0) {
                $('#minus').prop('disabled', true);
            }
        })

        $('input.chackD').on('change', function() {
            $('input.chackD').not(this).prop('checked', false);
        });
    </script>

    <script>
        $("#userForm").validate({
            rules: {
                name: "required",
                ref_id: "required",
            },
            messages: {
                name: "Please Enter your Name",
                ref_id: "Please select your Ref Name",
            },

            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>

    <script>
        $("#testForm").validate({
            rules: {
                email: {
                    email: true,
                    required: true,
                },
            },
            messages: {
                email: {
                    email: "Enter valid email",
                    required: "Enter email"
                },

            },

            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>


    <script>
        $('#submitBtn').click(function() {
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
        });
    </script>


    <script>
        function getChildMember(id) {
            $.ajax({
                type: 'post',
                url: '{{ route('user.tree') }}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(response) {
                    $('#' + id).html(response.html);
                }
            })
        }
    </script>

    <script>
        $(function() {
            $('.tree li:has(ul)').addClass('parent_li').find(' > span').attr('title', 'Collapse this branch');
            $('.tree li.parent_li > span').on('click', function(e) {
                var children = $(this).parent('li.parent_li').find(' > ul > li');
                if (children.is(":visible")) {
                    children.hide('fast');
                    $(this).attr('title', 'Expand this branch').find(' > i').addClass('fa-plus-square')
                        .removeClass('fa-minus-square');
                } else {
                    children.show('fast');
                    $(this).attr('title', 'Collapse this branch').find(' > i').addClass('fa-minus-square')
                        .removeClass('fa-plus-square');
                }
                e.stopPropagation();
            });
        });
    </script>

</body>

</html>
