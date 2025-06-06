<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IcdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $dataicd = collect([
            [
                'kode_icd' => '1A00',
                'judul' => 'Cholera due to Vibrio cholerae 01, biovar cholerae',
                'deskripsi' => 'An infection caused by Vibrio cholerae serogroup O1.',
                'kategori' => 'Certain infectious or parasitic diseases',
                'subkategori' => 'Cholera',
                'versi' => '2019',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_icd' => '1B10',
                'judul' => 'Typhoid fever',
                'deskripsi' => 'A bacterial infection due to Salmonella typhi.',
                'kategori' => 'Certain infectious or parasitic diseases',
                'subkategori' => 'Typhoid and paratyphoid fevers',
                'versi' => '2019',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_icd' => '2A21',
                'judul' => 'Diabetes mellitus type 1',
                'deskripsi' => 'A chronic condition in which the pancreas produces little or no insulin.',
                'kategori' => 'Endocrine, nutritional or metabolic diseases',
                'subkategori' => 'Diabetes mellitus',
                'versi' => '2019',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_icd' => '2A22',
                'judul' => 'Diabetes mellitus type 2',
                'deskripsi' => 'A metabolic disorder characterized by hyperglycemia and insulin resistance.',
                'kategori' => 'Endocrine, nutritional or metabolic diseases',
                'subkategori' => 'Diabetes mellitus',
                'versi' => '2019',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_icd' => 'FA00',
                'judul' => 'Major depressive disorder, single episode',
                'deskripsi' => 'A mood disorder that causes a persistent feeling of sadness and loss of interest.',
                'kategori' => 'Mental, behavioural or neurodevelopmental disorders',
                'subkategori' => 'Depressive disorders',
                'versi' => '2019',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_icd' => 'BA40',
                'judul' => 'Essential (primary) hypertension',
                'deskripsi' => 'A condition with consistently elevated blood pressure of unknown cause.',
                'kategori' => 'Diseases of the circulatory system',
                'subkategori' => 'Hypertensive diseases',
                'versi' => '2019',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_icd' => 'BD40',
                'judul' => 'Acute myocardial infarction',
                'deskripsi' => 'A condition where blood flow to the heart is blocked, commonly known as a heart attack.',
                'kategori' => 'Diseases of the circulatory system',
                'subkategori' => 'Ischaemic heart diseases',
                'versi' => '2019',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_icd' => 'CA40',
                'judul' => 'Acute bronchitis',
                'deskripsi' => 'Inflammation of the bronchial tubes, usually due to viral infection.',
                'kategori' => 'Diseases of the respiratory system',
                'subkategori' => 'Acute upper respiratory infections',
                'versi' => '2019',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_icd' => 'DA61',
                'judul' => 'Iron deficiency anaemia',
                'deskripsi' => 'A type of anemia caused by insufficient iron, leading to reduced hemoglobin production.',
                'kategori' => 'Diseases of the blood or blood-forming organs',
                'subkategori' => 'Anaemias',
                'versi' => '2019',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_icd' => 'EA00',
                'judul' => 'Acute appendicitis',
                'deskripsi' => 'Inflammation of the appendix, often requiring surgical removal.',
                'kategori' => 'Diseases of the digestive system',
                'subkategori' => 'Diseases of appendix',
                'versi' => '2019',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $dataicd->each(fn($put) => DB::table('icdtable')->insert($put));
    }
}
