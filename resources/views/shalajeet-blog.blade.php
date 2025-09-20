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
                <img src="{{ asset('assets/imgs/shaljeet.png') }}" alt="Can Honey Go Bad?">
            </div>

            <article class="blog-content">
                <p>For centuries, Himalayan Shilajit has been regarded as one of nature’s most powerful health enhancers.
                    Found
                    high in the rocks of the Himalayas, it is formed over thousands of years by the slow decomposition of
                    plants and minerals. This resin-like substance is packed with nutrients and bioactive compounds that
                    support both body and mind.</p>

                <p>Often referred to as “the destroyer of weakness,” Shilajit has been used in traditional Ayurvedic
                    medicine
                    for energy, vitality, and recovery. Today, modern research is beginning to confirm what ancient healers
                    already knew: Shilajit is a true natural powerhouse.</p>

                <h2>Why Shilajit is Unique</h2>
                <p>The secret behind Shilajit’s strength lies in its high concentration of fulvic acid, trace minerals, and
                    antioxidants. Together, these compounds provide a wide range of health benefits that make it stand out
                    among natural supplements.</p>

                <ul>
                    <li><strong>Boosts Energy:</strong> Helps improve stamina and reduce fatigue by enhancing
                        mitochondrial function.</li>
                    <li><strong>Supports Brain Health:</strong> May improve memory and focus due to its antioxidant
                        properties.</li>
                    <li><strong>Strength & Recovery:</strong> Promotes muscle repair and faster recovery after exercise.
                    </li>
                    <li><strong>Rich in Minerals:</strong> Provides over 80 essential trace minerals that the body needs
                        for balance.</li>
                    <li><strong>Immune Support:</strong> Strengthens natural defense mechanisms against illness.</li>
                </ul>

                <h2>How to Use Shilajit</h2>
                <p>Shilajit is usually consumed by dissolving a pea-sized portion in warm water, milk, or tea. It has a
                    strong
                    earthy taste but blends well with herbal infusions. Consistency is key — regular use over time is
                    believed
                    to bring the best results.</p>

                <h2>Precautions</h2>
                <p>Only purified, high-quality Shilajit should be used. Raw or unprocessed Shilajit may contain impurities
                    and
                    should be avoided. Pregnant women, nursing mothers, or those with chronic health conditions should
                    consult
                    a healthcare professional before use.</p>

                <p><strong>Bottom line:</strong> Himalayan Shilajit is more than just a supplement — it’s a natural energy
                    and
                    vitality booster with centuries of proven use. Whether you’re looking to increase stamina, improve
                    focus,
                    or support recovery, this ancient remedy offers a powerful solution straight from the mountains.</p>
            </article>

        </div>
    </div>
@endsection
