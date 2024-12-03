<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Young Scientist </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/site/student/owlcarousel/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/student/owlcarousel/assets/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/site/student/scss/style.css')}}">
    @yield('css')

</head>

<body>
    @yield('content')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="{{asset('assets/site/student/owlcarousel/owl.carousel.min.js')}}"></script>
    <script>
    AOS.init();
    </script>

    <script>
        $(document).ready(function () {
            // Fetch assignments from the server
            function fetchNotifications() {
                $.ajax({
                    url: `{{route($route.'.assignment-list')}}`, // Your API endpoint
                    method: 'GET',
                    success: function (response) {
                        const notificationList = $('#notification-list');
                        const notificationCount = $('#notification-count');
                        notificationList.empty(); // Clear existing notifications

                        if (response.assignments && response.assignments.length > 0) {
                            // Update the notification count
                            notificationCount.text(response.assignments.length);
                            notificationCount.show(); // Ensure it's visible if hidden

                            response.assignments.forEach(assignment => {
                                const studentName = assignment.student?.user?.name || "Unknown Student"; // Check if name exists
                                const topicName = assignment.assignment?.topic?.title || "Unknown Topic"; // Check if name exists

                                // Create a notification item
                                const notificationItem = `
                                    <li>
                                        <a href="#">
                                            Assignment submitted by ${studentName} on topic: ${topicName}
                                        </a>
                                    </li>
                                `;

                                // Append to the list
                                notificationList.append(notificationItem);
                            });
                        } else {
                            // No notifications
                            notificationCount.text('0');
                            notificationList.append('<li><a href="#">No new notifications</a></li>');
                        }
                    },
                    error: function () {
                        $('#notification-list').html('<li><a href="#">Failed to load notifications</a></li>');
                        $('#notification-count').hide(); // Hide count on error
                    }
                });
            }

            // Fetch notifications on page load
            fetchNotifications();

            // Optionally, refresh notifications periodically (e.g., every 60 seconds)
            setInterval(fetchNotifications, 60000);
        });
    </script>

    @yield('scripts')

</body>

</html>