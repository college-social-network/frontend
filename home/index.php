<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>

</head>
<body class="h-screen bg-gray-800 text-white">

<header class="fixed top-0 left-0 w-full bg-gray-800 text-white shadow-md z-10">
    <div class="flex items-center justify-center py-4">
        <h1 class="text-lg font-bold">College Social Network</h1>
    </div>
</header>


<div class="flex flex-col items-center pt-16">
    <?php
    include "../config.php";
    include "../functs.php";

    $result = $api->fetchFollowersByUsername("all");

    echo "<div id='mainUserList' class='grid grid-cols-1 gap-3'>";
    foreach ($result as $name) {
        $cur_user_data = $api->fetchUserDataByUsername($name);


        echo "
        <div class='flex w-full items-center bg-gray-700 border p-1 rounded shadow-md'>
            <div class='flex w-full pl-2 flex-col items-center'>
                <img src='https://static-00.iconduck.com/assets.00/user-2-account-icon-2048x2046-oucjsuyg.png' alt='{$cur_user_data->name}' class='w-16 h-16 rounded-full'>
            </div>
            <a href='../profile?u={$cur_user_data->name}' class='flex flex-col w-2/3 pl-4'>
                <p>{$cur_user_data->name}</p>
                <p>{$cur_user_data->major}</p>
                <p>{$cur_user_data->year}</p>
            </a>
        </div>";
    }
    echo "</div>";
    ?>
</div>

</body>
</html>
