<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="./assets/img/favicon.png" />
    <title>Monitoring</title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Popper -->
    <script src="https://unpkg.com/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <!-- Main Styling -->
    <link href="./assets/css/argon-dashboard-tailwind.css?v=1.0.1" rel="stylesheet" />
    @livewireStyles

</head>

<body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">

    {{ $slot }}

    <!-- plugin for charts  -->
    <script src="./assets/js/plugins/chartjs.min.js" async></script>
    <!-- plugin for scrollbar  -->
    <script src="./assets/js/plugins/perfect-scrollbar.min.js" async></script>
    <!-- main script file  -->
    <script src="./assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>
    @livewireScripts
</body>

</html>
