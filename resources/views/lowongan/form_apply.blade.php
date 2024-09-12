@extends('frontend.layouts')

@section('container')
    <main>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #fff;
                margin: 0;
                padding: 0;
                justify-content: center;
                align-items: center;
            }

            .container h1 {
                text-align: center;
                margin-bottom: 20px;
                margin-top: 50px;
                color: #333;
            }

            .container form {
                display: flex;
                flex-direction: column;
            }

            .container label {
                margin-bottom: 5px;
                font-weight: 500;
            }

            .required-symbol {
                color: red;
            }

            .container form input[type="text"],
            .container form input[type="email"],
            .container form input[type="tel"],
            .container form input[type="hidden"],
            .container form input[type="url"],
            .container form input[type="file"],
            .container form textarea {
                margin-bottom: 15px;
                padding: 10px;
                font-size: 16px;
                border: 1px solid #ccc;
                border-radius: 4px;
                width: 100%;
                box-sizing: border-box;
            }

            .container form .linkedin-input {
                display: flex;
                align-items: center;
            }

            .container form .linkedin-input img {
                width: 50px;
                height: 50px;
            }

            .container form button {
                padding: 10px;
                font-size: 16px;
                color: #fff;
                background-color: #6A1B9A;
                border: none;
                border-radius: 20px;
                cursor: pointer;
                transition: background-color 0.3s;
                margin-bottom: 50px;
            }

            .container form button:hover {
                background-color: #4A148C;
            }
        </style>

        <div class="container">
            <h1>Job Application Form</h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('job.apply', $apply->jobname) }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="name">Name <span class="required-symbol">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name">

                <label for="email">Email <span class="required-symbol">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email">

                <label for="phone">Phone <span class="required-symbol">*</span></label>
                <input type="tel" id="phone" name="phone" required>

                <label for="linkedin">LinkedIn Profile</label>
                <div class="linkedin-input">
                    <img src="{{ asset('img/icon/linkedin.png') }}" alt="">
                    <input type="url" id="linkedin" name="linkedin"
                        placeholder="e.g. https://www.linkedin.com/in/username/">
                </div>

                <label for="resume" style="margin-top: 10px">CV</label>
                <input type="file" id="resume" name="resume">

                <label for="coverletter">Short Introduction</label>
                <textarea id="coverletter" name="coverletter" rows="4"
                    placeholder="Optional introduction, or any question you might have about the job..."></textarea>

                <button type="submit">Kirim</button>
            </form>
        </div>

        <script>
            document.getElementById('applicationForm').addEventListener('submit', function(event) {
                alert('Your file has been submitted successfully!');
            });
        </script>
    @endsection
