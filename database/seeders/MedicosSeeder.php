<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MedicosSeeder extends Seeder
{
    public function run(): void
    {
        $path = storage_path('app/medicos.csv');

        if (!file_exists($path)) {
            $this->command->error('No se encontró el archivo: storage/app/medicos.csv');
            return;
        }

        $file = fopen($path, 'r');

        // Saltar encabezado: DNI;APELLIDOSNOMBRES;ESPECIALIDAD;PASSWORD
        fgetcsv($file, 0, ';');

        $total = 0;
        $omitidos = 0;

        while (($row = fgetcsv($file, 0, ';')) !== false) {
            $dni = trim($row[0] ?? '');
            $nombre = trim($row[1] ?? '');
            $especialidad = trim($row[2] ?? '');
            $password = trim($row[3] ?? '1234');

            if ($dni === '' || $nombre === '') {
                $omitidos++;
                continue;
            }

            $user = User::updateOrCreate(
                ['email' => $dni],
                [
                    'name' => $nombre,
                    'password' => Hash::make($password ?: '1234'),
                ]
            );

            $user->syncRoles(['medico']);

            $total++;
        }

        fclose($file);

        $this->command->info("Importación finalizada.");
        $this->command->info("Médicos procesados: {$total}");
        $this->command->info("Filas omitidas: {$omitidos}");
    }
}
