<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Transferts aéroport / gare',
                'description' => 'Navette vers les principaux aéroports et gares. Suivi de vol, accueil soigné, aide aux bagages.',
                'type' => 'airport',
                'base_price' => 45.00,
                'price_unit' => 'from',
                'sort_order' => 1
            ],
            [
                'name' => 'Trajets professionnels',
                'description' => 'Déplacements business, rendez-vous clients, séminaires. Service discret, ponctuel et confortable.',
                'type' => 'business',
                'base_price' => 30.00,
                'price_unit' => 'from',
                'sort_order' => 2
            ],
            [
                'name' => 'Mise à disposition',
                'description' => 'Chauffeur privé à l\'heure pour mariages, soirées, événements, visites touristiques.',
                'type' => 'disposal',
                'base_price' => 60.00,
                'price_unit' => 'hourly',
                'sort_order' => 3
            ]
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
