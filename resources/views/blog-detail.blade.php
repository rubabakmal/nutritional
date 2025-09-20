@extends('website-layout.app')

<style>
    .blog-detail-wrap {
        margin-top: 130px;
        font-family: "Red Hat Display", sans-serif;
    }



    /* Hero image block */
    .blog-hero {
        width: 100%;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 28px;
        /* spacing before content */
    }

    .blog-hero {
        text-align: center;
        /* parent div ke andar image ko center karega */
    }

    .blog-hero img {
        width: 63%;
        height: 500px;
        object-fit: cover;
        border-radius: 12px;
        display: inline-block;
        /* inline-block karna zaroori hai center align ke liye */
        margin: 0 auto;
        /* horizontally center */
    }


    /* Blog content body */
    .blog-content {
        font-size: 17px;
        line-height: 1.8;
        color: #2c2c2c;
    }

    .blog-content h2 {
        margin-top: 26px;
        margin-bottom: 12px;
        font-weight: 800;
        font-size: 22px;
        color: #111;
    }

    .blog-content p {
        margin-bottom: 16px;
    }

    .blog-content ul {
        margin: 0 0 16px 22px;
    }

    .blog-content ul li {
        margin-bottom: 6px;
    }

    .blog-content img {
        max-width: 100%;
        border-radius: 10px;
        margin: 18px auto;
        display: block;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    }

    @media (max-width:554px) {
        .blog-detail-wrap {
            margin-top: 80px;
        }

        .blog-hero img {
            width: 100%;

        }

    }
</style>

@section('content')
    <div class="blog-detail-wrap">
        <div class="container">

            <!-- Blog Hero Image -->
            <div class="blog-hero">
                <img src="{{ asset('assets/imgs/banner5.png') }}" alt="Can Honey Go Bad?">
            </div>

            <!-- Blog Content -->
            <article class="blog-content">
                <p>You're cleaning out your pantry when you discover a forgotten jar of honey tucked away. The label reads
                    "Best By: March 2019." It's now 2025. Should you throw it out? Not so fast! Honey is one of the rare
                    foods that doesn’t spoil the way others do.</p>

                <p>That "expired" honey in your pantry is likely still perfectly safe to eat—and may taste exactly the same
                    as the day you bought it. In fact, honey found in ancient Egyptian tombs, over 3,000 years old, was
                    still
                    edible when archaeologists discovered it.</p>

                <h2>The Ancient Secret: Why Honey Doesn't Spoil</h2>
                <p>To understand why honey seems to defy time, we need to look at its remarkable natural composition. Honey
                    is essentially a supersaturated sugar solution with several built-in preservation mechanisms.</p>

                <ul>
                    <li><strong>Low Water Content:</strong> Honey contains only 14-18% water, preventing bacteria from
                        growing.</li>
                    <li><strong>Acidic pH:</strong> Its pH of 3.2–4.5 creates an acidic environment that kills microbes.
                    </li>
                    <li><strong>Hydrogen Peroxide:</strong> Enzymes in honey release hydrogen peroxide, adding protection.
                    </li>
                    <li><strong>High Sugar Concentration:</strong> Creates osmotic pressure that dehydrates bacteria.</li>
                    <li><strong>Antimicrobial Compounds:</strong> Natural flavonoids and acids fight fungi and bacteria.
                    </li>
                </ul>

                <p><strong>Bottom line:</strong> Honey doesn’t really expire — with proper storage, it stays safe and
                    delicious for years, even decades.</p>
            </article>

        </div>
    </div>
@endsection
