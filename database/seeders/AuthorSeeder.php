class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Author::create([
            'name' => 'Andrea Hirata',
            'email' => 'andrea.hirata@example.com',
            'bio' => 'Penulis terkenal dari Indonesia yang menulis novel Laskar Pelangi',
            'country' => 'Indonesia'
        ]);

        Author::create([
            'name' => 'Tere Liye',
            'email' => 'tere.liye@example.com',
            'bio' => 'Penulis produktif dengan banyak karya bestseller',
            'country' => 'Indonesia'
        ]);

        Author::create([
            'name' => 'Dewi Lestari',
            'email' => 'dewi.lestari@example.com',
            'bio' => 'Penulis dan musisi Indonesia dengan karya Supernova',
            'country' => 'Indonesia'
        ]);

        Author::create([
            'name' => 'Pramoedya Ananta Toer',
            'email' => 'pram@example.com',
            'bio' => 'Sastrawan besar Indonesia dengan karya Bumi Manusia',
            'country' => 'Indonesia'
        ]);

        Author::create([
            'name' => 'Eka Kurniawan',
            'email' => 'eka.kurniawan@example.com',
            'bio' => 'Penulis kontemporer dengan karya yang diakui secara internasional',
            'country' => 'Indonesia'
        ]);
    }
}