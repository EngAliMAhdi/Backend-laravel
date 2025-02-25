<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name_ar' => 'قسط منزلي', 'name_en' => 'Rent/Mortgage'],
            ['name_ar' => 'الإقامة', 'name_en' => 'Accommodation'],
            ['name_ar' => 'مواصلات', 'name_en' => 'Transport'],
            ['name_ar' => 'تأمينات', 'name_en' => 'Insurance'],
            ['name_ar' => 'علاج', 'name_en' => 'Medical'],
            ['name_ar' => 'صيانة و تصليحات', 'name_en' => 'Repairs & Maintenance'],
            ['name_ar' => 'هاتف و اشتراك إنترنت', 'name_en' => 'Phone & Internet'],
            ['name_ar' => 'ملابس', 'name_en' => 'Clothing'],
            ['name_ar' => 'طعام و شراب', 'name_en' => 'Food & Drinks'],
            ['name_ar' => 'عائلة و أطفال', 'name_en' => 'Family & Kids'],
            ['name_ar' => 'تسوق', 'name_en' => 'Shopping'],
            ['name_ar' => 'ترفيه و رحلات', 'name_en' => 'Entertainment & Travel'],
            ['name_ar' => 'اشتراكات', 'name_en' => 'Subscriptions'],
            ['name_ar' => 'عشوائية', 'name_en' => 'Miscellaneous'],
        ];
        Category::insert($categories);
    }
}
