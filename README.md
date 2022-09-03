# COSC349A1
Assignment 1 for cosc349
By Cordell O'Leary and Jacob Rowe

Your repository should include an explanation to new developers
about the design of your application, including the purpose of each
of your VMs, and how they interact.


Application design:
We have three VMs that handle the processing and general usage of our site.
The first is a web page which users of our service would interact with the site and be able to book a house, submit their own house for potential bookings, and create and sign-in to an account. The second VM contains the admin web page and is used by authenticated users to approve user submitted houses and delete/view houses and bookings. The third VM contains the database which stores information on users, bookings, and houses. The two web pages access the database to display the information they need.
