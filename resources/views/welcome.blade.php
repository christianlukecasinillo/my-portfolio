<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile['name'] }} — {{ $profile['title'] }}</title>
    <meta name="description" content="{{ $profile['tagline'] }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

@php
    // Simple inline icon library — no external logo assets, so nothing
    // to license, download, or break if a CDN goes down.
    $icons = [
        'server'   => '<path d="M4 4h16v6H4zM4 14h16v6H4z"/><circle cx="8" cy="7" r=".6" fill="#fff" stroke="none"/><circle cx="8" cy="17" r=".6" fill="#fff" stroke="none"/>',
        'code'     => '<path d="M8 7 3 12l5 5M16 7l5 5-5 5M13.5 5 10.5 19"/>',
        'layers'   => '<path d="m12 3 9 5-9 5-9-5 9-5Z"/><path d="m3 13 9 5 9-5"/>',
        'database' => '<path d="M12 5c4.4 0 8 1.1 8 2.5S16.4 10 12 10s-8-1.1-8-2.5S7.6 5 12 5Z"/><path d="M4 7.5V17c0 1.4 3.6 2.5 8 2.5s8-1.1 8-2.5V7.5"/><path d="M4 12c0 1.4 3.6 2.5 8 2.5s8-1.1 8-2.5"/>',
        'brush'    => '<path d="M4 20c0-3 2-4 4-4 1.5 0 2 1 3 1 2 0 2-3 2-5 0-3 2-8 6-9-1 4-1 8 1 9 1 .5 1.5 2 0 3-2 2-4 1-6 1-1 0-3 .5-3 2 0 1-1 2-3 2s-4-1-4 0Z"/>',
        'branch'   => '<circle cx="6" cy="6" r="2"/><circle cx="6" cy="18" r="2"/><circle cx="18" cy="9" r="2"/><path d="M6 8v8M6 8c0 4 4 3 8 3"/>',
    ];

    $socialIcons = [
        'facebook' => '<path d="M13.5 21v-7.5h2.5l.4-3H13.5V8.4c0-.87.24-1.46 1.5-1.46H16.5V4.35C16.2 4.31 15.2 4.2 14 4.2c-2.4 0-4 1.46-4 4.16V10.5H7.5v3H10V21h3.5Z" fill="#fff"/>',
        'instagram'=> '<rect x="4" y="4" width="16" height="16" rx="5" fill="none" stroke="#fff" stroke-width="1.6"/><circle cx="12" cy="12" r="3.6" fill="none" stroke="#fff" stroke-width="1.6"/><circle cx="16.6" cy="7.4" r="1" fill="#fff"/>',
        'x'        => '<path d="M5 4 19 20M19 4 5 20" stroke="#fff" stroke-width="1.8" fill="none" stroke-linecap="round"/>',
    ];
@endphp

<header class="topnav">
    <div class="wrap">
        <div class="brand">PORTFOLIO / <strong>{{ $profile['name'] }}</strong></div>
        <nav>
            <a href="#about">About</a>
            <a href="#skills">Skills</a>
            <a href="#experience">Experience</a>
            <a href="#activities">Activities</a>
            <a href="#connect">Contact</a>
        </nav>
    </div>
</header>

<section class="hero">
    <div class="wrap">
        <div class="id-card">
            <div class="id-card__photo">
                @if(!empty($profile['photo']))
                    <img src="{{ asset('images/'.$profile['photo']) }}" alt="Photo of {{ $profile['name'] }}">
                @else
                    <div class="id-card__initials">
                        {{ collect(explode(' ', $profile['name']))->map(fn($p) => mb_substr($p, 0, 1))->join('') }}
                    </div>
                @endif
            </div>
            <div class="id-card__body">
                @if($profile['open_to_relocate'])
                    <div class="stamp-badge">Open to<br>Relocate</div>
                @endif

                <p class="id-card__eyebrow">Candidate Profile</p>
                <h1 class="id-card__name">{{ $profile['name'] }}</h1>
                <p class="id-card__title">{{ $profile['title'] }}</p>
                <p class="id-card__tagline">{{ $profile['tagline'] }}</p>

                @if(!empty($profile['resume']) && file_exists(public_path($profile['resume'])))
                    <a href="{{ asset($profile['resume']) }}" download class="cv-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3v12m0 0 4-4m-4 4-4-4M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2"/>
                        </svg>
                        Download CV
                    </a>
                @endif

                <dl class="id-card__fields">
                    <div>
                        <dt>Contact No.</dt>
                        <dd>{{ $profile['contact']['number'] }}</dd>
                    </div>
                    <div>
                        <dt>Email</dt>
                        <dd>{{ $profile['contact']['email'] }}</dd>
                    </div>
                    <div class="full" style="grid-column: 1 / -1;">
                        <dt>Address</dt>
                        <dd>{{ $profile['contact']['address'] }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</section>

<section id="about">
    <div class="wrap">
        <p class="section-label">01 — Background</p>
        <h2 class="section-title">About me</h2>
        <p class="about-text">{{ $profile['about'] }}</p>
    </div>
</section>

<section id="skills">
    <div class="wrap">
        <p class="section-label">02 — Capabilities</p>
        <h2 class="section-title">Skills</h2>

        <div class="skills-grid">
            @foreach($profile['skills'] as $skill)
                <div class="skill-card" style="--level: {{ $skill['level'] }}%;">
                    <div class="skill-card__head">
                        <div class="skill-icon">
                            <svg viewBox="0 0 24 24" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
                                {!! $icons[$skill['icon']] ?? $icons['code'] !!}
                            </svg>
                        </div>
                        <div class="skill-card__name">{{ $skill['name'] }}</div>
                    </div>
                    <div class="skill-meter">
                        <div class="skill-meter__fill"></div>
                    </div>
                    <div class="skill-card__level">{{ $skill['level'] }}%</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section id="experience">
    <div class="wrap">
        <p class="section-label">03 — Service Record</p>
        <h2 class="section-title">Work Experience</h2>

        <div class="timeline">
            @foreach($profile['experience'] as $job)
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <p class="timeline-dates">
                            {{ $job['start'] }} &ndash; {{ $job['current'] ? 'Present' : $job['end'] }}
                        </p>
                        <h3 class="timeline-role">{{ $job['role'] }}</h3>
                        <p class="timeline-company">{{ $job['company'] }}</p>
                        <p class="timeline-summary">{{ $job['summary'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section id="activities">
    <div class="wrap">
        <p class="section-label">04 — Beyond the Desk</p>
        <h2 class="section-title">Extra-Curricular Activities</h2>

        <div class="activities-grid">
            @foreach($profile['activities'] as $activity)
                <div class="activity-card">
                    <div class="activity-photo">
                        @if(!empty($activity['photo']))
                            <img src="{{ asset('images/activities/'.$activity['photo']) }}" alt="{{ $activity['name'] }}">
                        @else
                            <span>{{ $activity['tag'] }}</span>
                        @endif
                    </div>
                    <div class="activity-body">
                        <p class="activity-tag">{{ $activity['tag'] }}</p>
                        <h3 class="activity-name">{{ $activity['name'] }}</h3>
                        <p class="activity-summary">{{ $activity['summary'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<section id="socials">
    <div class="wrap">
            <p class="section-label">05 — Find me online</p>
        <h2 class="section-title">Social</h2>

        <div class="social-row">
            @if(!empty($profile['socials']['facebook']))
                <a class="social-badge" href="{{ $profile['socials']['facebook'] }}" target="_blank" rel="noopener">
                    <span class="icon-circle"><svg viewBox="0 0 24 24">{!! $socialIcons['facebook'] !!}</svg></span>
                    Facebook
                </a>
            @endif
            @if(!empty($profile['socials']['instagram']))
                <a class="social-badge" href="{{ $profile['socials']['instagram'] }}" target="_blank" rel="noopener">
                    <span class="icon-circle"><svg viewBox="0 0 24 24">{!! $socialIcons['instagram'] !!}</svg></span>
                    Instagram
                </a>
            @endif
            @if(!empty($profile['socials']['x']))
                <a class="social-badge" href="{{ $profile['socials']['x'] }}" target="_blank" rel="noopener">
                    <span class="icon-circle"><svg viewBox="0 0 24 24">{!! $socialIcons['x'] !!}</svg></span>
                    X (Twitter)
                </a>
            @endif
        </div>
    </div>
</section>

<section id="connect">
    <div class="wrap">
        <p class="section-label">06 — Get in touch</p>
        <h2 class="section-title">Contact me</h2>

        <div class="intake">
            <p class="intake__label">Inquiry Form</p>

            @if(session('status'))
                <div class="status-banner">{{ session('status') }}</div>
            @endif

            <form method="POST" action="{{ route('contact.store') }}">
                @csrf
                <div class="form-grid">
                    <div class="field">
                        <label for="name">Your name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="field">
                        <label for="email">Your email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="field">
                        <label for="company">Company (optional)</label>
                        <input type="text" id="company" name="company" value="{{ old('company') }}">
                        @error('company') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="field">
                        <label for="phone">Phone (optional)</label>
                        <input
                            type="tel"
                            id="phone"
                            name="phone"
                            inputmode="numeric"
                            pattern="[0-9]*"
                            maxlength="15"
                            value="{{ old('phone') }}"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                        >
                        @error('phone') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="field full">
                        <label for="reason">Reason for contacting me</label>
                        <textarea id="reason" name="reason" required>{{ old('reason') }}</textarea>
                        @error('reason') <div class="field-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                <button type="submit" class="submit-btn">Send message</button>
            </form>
        </div>
    </div>
</section>

<footer>
    <div class="wrap">
        &copy; {{ date('Y') }} {{ $profile['name'] }}. Built with Laravel + Vite.
    </div>
</footer>

</body>
</html>