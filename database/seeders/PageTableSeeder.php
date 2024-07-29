<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            [
                'title' => 'About Us',
                'slug' => 'about-us',
                'description' => "
                <p><strong>About Us</strong></p>
<p>&nbsp;</p>
<p><strong>Welcome to [Your News Portal Name]</strong></p>
<p>At [Your News Portal Name], we are dedicated to delivering timely, accurate, and comprehensive news to our readers. Our mission is to provide a platform where you can stay informed about the latest events, trends, and developments from around the world.</p>
<p>&nbsp;</p>
<p><strong>Who We Are</strong></p>
<p>[Your News Portal Name] was founded in [Year] by a team of passionate journalists and digital content creators who believe in the power of information. Our team consists of experienced reporters, editors, and analysts who are committed to upholding the highest standards of journalism.</p>
<p>&nbsp;</p>
<p><strong>Our Mission</strong></p>
<p>Our mission is to:</p>
<ul>
  <li><strong>Inform:</strong> Provide our readers with up-to-date and reliable news coverage.</li>
  <li><strong>Educate:</strong> Offer in-depth analysis and insights into the stories that matter most.</li>
  <li><strong>Engage:</strong> Foster a community where readers can discuss and share their views on important issues.</li>
</ul>
<p>&nbsp;</p>
<p><strong>What We Cover</strong></p>
<p>We cover a wide range of topics, including:</p>
<ul>
  <li><strong>Politics:</strong> In-depth coverage of local, national, and international politics.</li>
  <li><strong>Business:</strong> The latest news and trends in the business world.</li>
  <li><strong>Technology:</strong> Updates on technological advancements and innovations.</li>
  <li><strong>Entertainment:</strong> News from the world of entertainment, including movies, music, and celebrity news.</li>
  <li><strong>Sports:</strong> Coverage of major sports events and highlights.</li>
  <li><strong>Lifestyle:</strong> Articles on health, travel, food, and more.</li>
</ul>
<p>&nbsp;</p>
<p><strong>Our Commitment to Quality</strong></p>
<p>At [Your News Portal Name], we are committed to:</p>
<ul>
  <li><strong>Accuracy:</strong> Ensuring that our reports are factual and precise.</li>
  <li><strong>Integrity:</strong> Upholding ethical journalism practices and standards.</li>
  <li><strong>Transparency:</strong> Being open and honest with our readers about our processes and sources.</li>
</ul>
<p>&nbsp;</p>
<p><strong>Join Our Community</strong></p>
<p>We invite you to join our community of informed readers. Follow us on social media, subscribe to our newsletter, and participate in the conversation by commenting on our articles. Your feedback and engagement help us to improve and serve you better.</p>
<p>&nbsp;</p>
<p><strong>Contact Us</strong></p>
<p>If you have any questions, comments, or story ideas, please feel free to contact us at [Your Contact Information]. We look forward to hearing from you!</p>
<p>&nbsp;</p>",
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

            [
                'title' => 'Testimonials',
                'slug' => 'testimonials',
                'description' => "
                    <p><strong>Testimonials</strong></p>
<p>&nbsp;</p>
<p><strong>What Our Readers Are Saying</strong></p>
<p>&nbsp;</p>
<p><strong>A Reliable Source of News</strong></p>
<p>I've been following [Your News Portal Name] for over a year now, and it's become my go-to source for reliable and unbiased news. The quality of reporting is top-notch, and I appreciate the in-depth analysis on current events.<br />&mdash; <strong>Alex P.</strong></p>
<p>&nbsp;</p>
<p><strong>Engaging and Informative</strong></p>
<p>I love the variety of content on [Your News Portal Name]. Whether it's politics, technology, or lifestyle, I always find something interesting to read. The articles are well-written and engaging.<br />&mdash; <strong>Samantha L.</strong></p>
<p>&nbsp;</p>
<p><strong>Timely Updates and Comprehensive Coverage</strong></p>
<p>As someone who likes to stay updated with the latest news, I find [Your News Portal Name] incredibly useful. The updates are timely, and the coverage is comprehensive. Keep up the great work!<br />&mdash; <strong>Michael R.</strong></p>
<p>&nbsp;</p>
<p><strong>A Platform for Thoughtful Discussions</strong></p>
<p>What sets [Your News Portal Name] apart is the community. The comment sections are filled with thoughtful discussions, and it's great to see different perspectives on important issues. It's a refreshing change from other news sites.<br />&mdash; <strong>Emily W.</strong></p>
<p>&nbsp;</p>
<p><strong>Trustworthy and Transparent</strong></p>
<p>In a time where misinformation is rampant, [Your News Portal Name] stands out for its commitment to accuracy and transparency. I trust the information I get here, and that's invaluable.<br />&mdash; <strong>David K.</strong></p>
<p>&nbsp;</p>
<p><strong>Exceptional Business Coverage</strong></p>
<p>As a business professional, I rely on [Your News Portal Name] for the latest news and trends in the business world. The reports are insightful and help me stay ahead in my field.<br />&mdash; <strong>Jessica T.</strong></p>
                ",
                'status' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
