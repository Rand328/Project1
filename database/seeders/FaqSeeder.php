<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FaqCategory;
use App\Models\FaqQuestion;


class FaqSeeder extends Seeder
{
    public function run()
    {
        $flowerTypeCategory = FaqCategory::create(['name' => 'Flower Types']);
        $careTipsCategory = FaqCategory::create(['name' => 'Care Tips']);

        FaqQuestion::create([
            'faq_category_id' => $flowerTypeCategory->id,
            'question' => 'What are the different types of roses?',
            'answer' => 'There are various types of roses, including hybrid teas, floribundas, and climbers.'
        ]);

        FaqQuestion::create([
            'faq_category_id' => $flowerTypeCategory->id,
            'question' => 'How to care for tulips?',
            'answer' => 'Tulips thrive in well-drained soil and require sunlight for at least six hours a day.'
        ]);

        FaqQuestion::create([
            'faq_category_id' => $careTipsCategory->id,
            'question' => 'How often should I water my orchids?',
            'answer' => 'Water orchids when the top inch of the potting mix is dry.'
        ]);
    }
}
