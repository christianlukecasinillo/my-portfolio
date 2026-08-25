<?php

// ------------------------------------------------------------------
// EDIT THIS FILE with your real information. Everything on the
// portfolio page pulls from here — you never have to touch the
// Blade template just to update your details.
// ------------------------------------------------------------------

return [

    'name'        => 'Christian Luke B. Casinillo',
    'title'       => 'Quality Assurance Tester',
    'tagline'     => 'Passionate About Delivering Quality Software.',

    'about'       => "Detail-oriented and results-driven
Quality Assurance Tester with a year of
experience in software testing, quality
assurance processes, and defect
management. Skilled in creating and
executing test cases, identifying and
documenting software defects,
performing functional, regression and
collaborating with cross-functional
teams to ensure the delivery of highquality software products. Proficient in
test management and bug-tracking
tools, with a strong understanding of the
software development life cycle (SDLC)
and Agile methodologies. Committed to
improving product reliability, enhancing
user experience, and maintaining quality
standards through thorough testing and
continuous process improvement.
Seeking to leverage technical expertise,
analytical problem-solving abilities, and
attention to detail to contribute to the
success of a dynamic organization
'
s
quality assurance team.",

    'photo'       => 'photo.jpg', // e.g. 'profile.jpg' placed in public/images/ — leave null to show initials instead
    // Place your PDF at public/resume.pdf (or change this filename) to enable the Download CV button.
    'resume'      => 'Casinillo-CV.pdf',

    'contact' => [
        'number'  => '+63 916 567 9714',
        'email'   => 'christianlukecasinillo2@gmail.com',
        'address' => 'Sacred Heart Village, Gun-ob,Lapu-Lapu City, Cebu, Philippines',
    ],

    // Shown as a stamped badge on the hero card
    'open_to_relocate' => true,

    'socials' => [
        'facebook'  => 'https://facebook.com/christianlukecasinillo2',
        'instagram' => 'https://instagram.com/saint_lukee',
        'x'         => 'https://x.com/chrstnlkcsnll',
    ],

    // icon key must match one defined in resources/views/welcome.blade.php's $icons array
    'skills' => [
        
        [
            'name'  => 'Testing Tools',
            'level' => 80,
            'icon'  => 'shield',
            'tools' => [
                ['name' => 'Playwright', 'level' => 80],
                ['name' => 'Selenium',   'level' => 75],
                ['name' => 'Postman',    'level' => 85],
            ],
        ],
        [
            'name'  => 'Google Workspace Proficiency',
            'level' => 95,
            'icon'  => 'shield',
            'tools' => [
                ['name' => 'Spreadsheet', 'level' => 97],
                ['name' => 'Docx',   'level' => 90],
            ],
        ],
        [
            'name'  => 'Programming (Basic)',
            'level' => 85,
            'icon'  => 'shield',
            'tools' => [
                ['name' => 'PHP', 'level' => 75],
                ['name' => 'C#',   'level' => 75],
                ['name' => 'ReactJS',   'level' => 85],
                ['name' => 'HTML',   'level' => 80],
                ['name' => 'CSS',   'level' => 80],
                ['name' => 'Javascript',   'level' => 80],
            ],
        ],
        [
            'name'  => 'Database',
            'level' => 86,
            'icon'  => 'shield',
            'tools' => [
                ['name' => 'PHPMyAdmin', 'level' => 87],
                ['name' => 'MySQL', 'level' => 85],
            ],
        ],
        [
            'name'  => 'Defect Tracking & Management',
            'level' => 90,
            'icon'  => 'shield',
            'tools' => [
                ['name' => 'JIRA', 'level' => 90],
            ],
        ],
        [
            'name'  => 'AI & Productivity Tools',
            'level' => 90,
            'icon'  => 'shield',
            'tools' => [
                ['name' => 'Gemini', 'level' => 90],
                ['name' => 'ChatGPT', 'level' => 90],
                ['name' => 'ClaudeAI', 'level' => 90],
                ['name' => 'Cline', 'level' => 80],
                ['name' => 'Git', 'level' => 80],
                ['name' => 'Github', 'level' => 90],
            ],
        ],
        [
            'name'  => 'Testing Methodologies',
            'level' => 88,
            'icon'  => 'shield',
            'tools' => [
                ['name' => 'Functional Testing', 'level' => 88],
                ['name' => 'Regression Testing', 'level' => 89],
                ['name' => 'Integration Testing', 'level' => 88],
                ['name' => 'Exploratory Testing', 'level' => 95],
                ['name' => 'User Acceptance Testing', 'level' => 80],
            ],
        ],
    ],
    'experience' => [
        [
            'role'    => 'Quality Assurance - INTERN',
            'company' => 'Cerenimbus Inc.',
            'start'   => 'Jan 2025',
            'end'     => 'April 2025',
            'current' => false,
            'summary' => 'Developed PHP APIs, conducted software testing, 
                        created detailed test cases, documented defects, 
                        and collaborated with developers to improve application functionality, 
                        user interface, and overall software quality.',
        ],
        [
            'role'    => 'Quality Assurance Tester',
            'company' => 'Forty Degrees Celsius Inc.',
            'start'   => 'August 2025',
            'end'     => 'July 2026',
            'current' => false,
            'summary' => 'Designed and executed manual test cases, 
                        identified and documented defects using JIRA, 
                        collaborated with developers to resolve issues, 
                        and performed basic automation testing with Playwright to ensure software quality.',
        ],
    ],
     // Photos go in public/images/activities/ — reference just the filename below.
    'activities' => [
        [
            'tag'     => 'Sports',
            'name'    => 'UCLM Indoor Volleyball Varsity Team - Player',
            'summary' => 'Represented the school in intercollegiate competetion (CESAFI 2022)',
            'photo'   => '2022.jpg', // e.g. 'cleanup.jpg'
        ],
        [
            'tag'     => 'Sports',
            'name'    => 'UCLM Beach Volleyball Varsity Team - Player',
            'summary' => 'Represented the school in intercollegiate competetion (CESAFI Beach Volleyball 2023)',
            'photo'   => '2023.png',
        ],
        [
            'tag'     => 'Sports',
            'name'    => 'Central Visayas Regional Athletics Association (CVIRAA-2017)',
            'summary' => 'Represented the school/city Secondary Division/HighSchool in Regional competition (TOP 4)',
            'photo'   => 'cviraa.jpg',
        ],
    ],
];
