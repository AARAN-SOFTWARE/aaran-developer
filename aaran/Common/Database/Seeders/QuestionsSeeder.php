<?php

namespace Aaran\Common\Database\Seeders;

use Aaran\Crm\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            ['software_type' => 'Billing Software', 'question' => 'How are you currently managing your billing process?'],
            ['software_type' => 'Billing Software', 'question' => 'Are you using any software for billing, or is it managed manually?'],
            ['software_type' => 'Billing Software', 'question' => 'What features do you need in your billing system? (Ex. Automated Invoicing, Tax Calculations, Payment Tracking)'],
            ['software_type' => 'Billing Software', 'question' => 'How many users will need to access the software?'],
            ['software_type' => 'Billing Software', 'question' => 'Do you need support for multiple currencies?'],
            ['software_type' => 'Billing Software', 'question' => 'What is your budget?'],
            ['software_type' => 'Billing Software', 'question' => 'Do you want to implement immediately or have a timeline?'],
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
