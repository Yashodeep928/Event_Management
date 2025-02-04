<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold text-center mb-4">Register</h2>
        <form action="register.php" method="POST">
            <input type="text" name="name" id="name" class="border w-full p-2 mb-4" placeholder="Full Name" required>
            <input type="email" name="email" id="email" class="border w-full p-2 mb-4" placeholder="Email" required>
            <input type="password" name="password" id="password" class="border w-full p-2 mb-4" placeholder="Password" required>
            <button type="submit" class="w-full bg-green-500 text-white p-2 rounded">Register</button>
        </form>
        <p class="text-center mt-4">Already have an account? <a href="loginhtml.php" class="text-blue-500">Login</a></p>
    </div>


    <script>

    $(document).ready(function(e){

        e.preventDefault();

        let registerdata = {
            name: $("#name").val(),
            email: $("#email").val(),
            // role: $("#role").val(),
            password: $("#password").val()
        }
        
        $.ajax({
            url: "register.php",
            method: "POST",
            data: registerdata,
            success: function(response){
                if(response.status === 200){
                    console.log(response.message);
                    window.location.href = "loginhtml.php";
                }else{
                    alert("Invalid email or password");
                }
            }
        });

    });

</script>





</body>
</html>

