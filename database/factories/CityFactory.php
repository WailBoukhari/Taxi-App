<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    // List of Moroccan cities
    protected $moroccanCities = [
        "Agadir",
        "Al Hoceima",
        "Assilah",
        "Azemmour",
        "Azrou",
        "Beni Mellal",
        "Berkane",
        "Berrechid",
        "Boujdour",
        "Casablanca",
        "Chefchaouen",
        "Dakhla",
        "El Aioun",
        "El Hajeb",
        "El Jadida",
        "Errachidia",
        "Essaouira",
        "Fes",
        "Figuig",
        "Fnideq",
        "Guelmim",
        "Ifrane",
        "Kenitra",
        "Khemisset",
        "Khenifra",
        "Khouribga",
        "Laayoune",
        "Larache",
        "Marrakech",
        "Martil",
        "Meknes",
        "Midelt",
        "Mohammedia",
        "Nador",
        "Ouarzazate",
        "Ouezzane",
        "Oujda",
        "Rabat",
        "Safi",
        "Salé",
        "Sefrou",
        "Settat",
        "Sidi Ifni",
        "Tangier",
        "Tan-Tan",
        "Taroudant",
        "Taza",
        "Témara",
        "Tetouan",
        "Tiznit",
        "Zagora"
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get a random Moroccan city from the list
        $cityName = $this->faker->randomElement($this->moroccanCities);

        return [
            'name' => $cityName,
        ];
    }
}
