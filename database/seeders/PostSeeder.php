<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Post 1: "The Language of Roses"
        Post::create([
            'title' => 'The Language of Roses',
            'description' => 'Roses have long been associated with deep emotions and sentiments, and each color holds a unique meaning. In this post, we explore the fascinating language of roses, delving into the symbolism behind different colors and varieties. From the classic red rose symbolizing love to the mysterious black rose conveying farewell, discover how the language of roses can add depth and meaning to your floral arrangements.',
            'image' => 'images/enZeba8qENXxeWWnIrsyCNh7iKtUq8GWYs1baFjR.png',
            // Add other necessary fields
        ]);

        // Post 2: "Caring for Your Orchids: A Comprehensive Guide"
        Post::create([
            'title' => 'Caring for Your Orchids:z A Comprehensive Guide',
            'description' => 'Orchids are elegant and captivating flowers, but they require special care to thrive. In this comprehensive guide, we share expert tips on nurturing your orchids for optimal health and blooming. From proper watering techniques to choosing the right potting mix, learn the essentials of orchid care. Whether you\'re a seasoned orchid enthusiast or a beginner, this guide will help you cultivate beautiful and long-lasting blooms in your indoor garden.',
            'image' => 'images/5aMjKRkwYDHNpAOd230bXAcgkWidby8IpXfHgun5.png',
            // Add other necessary fields
        ]);

    }
}
