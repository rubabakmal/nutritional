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
                <img src="{{ asset('assets/imgs/honey-2.webp') }}" alt="Can Honey Go Bad?">
            </div>

            <!-- Blog Content -->
            <article class="blog-content">
                <p>You're cleaning out your pantry when you discover a forgotten jar of honey tucked away. The label reads
                    "Best By: March 2019." It's now 2025. Should you throw it out? Not so fast! Honey is one of the rare
                    foods that doesn’t spoil the way others do.</p>

                <p>That "expired" honey in your pantry is likely still perfectly safe to eat—and may taste exactly the same
                    as the day you bought it. In fact, honey found in ancient Egyptian tombs, over 3,000 years old, was
                    still edible when archaeologists discovered it.</p>

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

                <h2>Does Crystallized Honey Mean It's Bad?</h2>
                <p>One of the most common misconceptions about honey is that crystallization means it has gone bad. In
                    reality, crystallization is a natural process where the glucose in honey separates from water, forming
                    sugar crystals. This doesn’t affect safety or nutritional value—it simply changes the texture. To bring
                    honey back to liquid form, gently warm the jar in a bowl of hot (not boiling) water.</p>

                <h2>Health Benefits of Raw Honey</h2>
                <p>Beyond its long shelf life, raw honey is also valued for its health benefits. It is rich in antioxidants,
                    helps soothe sore throats, and provides quick energy due to its natural sugars. Some studies also
                    suggest
                    that locally sourced honey may reduce allergy symptoms by exposing the body to small amounts of local
                    pollen.</p>

                <ul>
                    <li>🍯 <strong>Boosts Immunity:</strong> Contains antioxidants that protect cells from damage.</li>
                    <li>💪 <strong>Natural Energy:</strong> A great pre-workout boost thanks to natural glucose and
                        fructose.</li>
                    <li>🌿 <strong>Healing Properties:</strong> Traditionally used on wounds for its antibacterial effects.
                    </li>
                    <li>😌 <strong>Soothes Throat:</strong> Commonly used to ease coughs and colds.</li>
                </ul>

                <h2>How to Store Honey Properly</h2>
                <p>To keep honey fresh and maintain its natural qualities, store it correctly. Always keep it in a tightly
                    sealed container, away from direct sunlight and moisture. Avoid refrigeration, as this accelerates
                    crystallization.</p>

                <p><strong>Bottom line:</strong> Honey doesn’t really expire — with proper storage, it stays safe and
                    delicious for years, even decades. Its natural preservation powers make it one of nature’s most
                    extraordinary gifts.</p>
            </article>

        </div>
    </div>
@endsection
