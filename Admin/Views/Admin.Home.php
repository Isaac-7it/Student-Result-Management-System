<?php
include_once '../Utility/Header.php';
?>
<main class="p-xsm">
    <nav class="flex items-center justify-between mb-sm">
        <span><span class="font-semibold">Dashboard</span></span>
        <span class="text-icon inline-block"><i class="fa-solid fa-bell"></i></span>
    </nav>
    <div class="bg-white p-sm rounded-xl mb-sm">
        <h2 class="text-h4 font-semibold">Welcome, Admin 👋</h2>
    </div>
    <div class="bg-white p-sm mb-sm">
        <h5 class="mb-sm">Overview</h5>
        <div class="grid">
            <div class="bg-grey rounded-xl flex flex-col p-[8px]">
                <span class="text-[12px] text-wrap flex-1 inline-block">Total Students</span>
                <span class="font-stats text-3xl font-medium">3.67</span>
            </div>
            <div class="bg-grey rounded-xl flex flex-col p-[8px]">
                <span class="text-[12px] text-wrap flex-1 inline-block">Cummu. GPA</span>
                <span class="font-stats text-3xl font-medium">3.67</span>
            </div>
            <div class="bg-grey rounded-xl flex flex-col p-[8px]">
                <span class="text-[12px] text-wrap flex-1 inline-block">Credits</span>
                <span class="font-stats text-3xl font-medium">3.67</span>
            </div>
        </div>
    </div>
    <div class="">
        <div class="">
            <span>GPA Trend</span>

            <span>Last 4 semesters</span>
        </div>
        <div class="text-center mb-sm">
            <a href="" class="py-xsm bg-blue-800 block w-full text-white rounded-md">View Grades</a>
        </div>
        <div class="text-center mb-sm">
            <a href="../Views/Enrollment.php" class="py-xsm text-dark-grey block w-full bg-white rounded-md">Register Courses</a>
        </div>
           <div class="text-center mb-sm">
            <a href="" class="py-xsm text-dark-grey block w-full bg-white rounded-md">
                <span></span>
                <span>
                    Download Transcript
                </span>
            </a>
        </div>
        </div>
           <div class="text-center mb-sm">
            <a href="../Views/Admin.SignIn.php" class="py-xsm text-white block w-full bg-red-700 rounded-md">
               Log Out
            </a>
        </div>
    </div>
</main>