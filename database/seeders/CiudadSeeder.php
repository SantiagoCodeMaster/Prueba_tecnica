<?php

namespace Database\Seeders;

use App\Models\Ciudad;
use App\Models\Departamento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CiudadSeeder extends Seeder
{
    public function run()
    {
        $departamentosCiudades = [
            'Amazonas' => ['Leticia', 'Puerto Nariño', 'La Chorrera', 'La Pedrera', 'El Encanto', 'Puerto Alegría', 'Tarapacá', 'Puerto Arica', 'Mirití-Paraná', 'Puerto Santander'],
            'Antioquia' => ['Medellín', 'Bello', 'Envigado', 'Itagüí', 'Rionegro', 'Apartadó', 'Turbo', 'Sabaneta', 'La Ceja', 'Caucasia'],
            'Arauca' => ['Arauca', 'Arauquita', 'Saravena', 'Tame', 'Fortul', 'Cravo Norte', 'Puerto Rondón', 'Panamá de Arauca', 'Bocas del Ele', 'La Paz'],
            'Atlántico' => ['Barranquilla', 'Soledad', 'Malambo', 'Sabanalarga', 'Galapa', 'Baranoa', 'Puerto Colombia', 'Palmar de Varela', 'Santo Tomás', 'Juan de Acosta'],
            'Bolívar' => ['Cartagena', 'Magangué', 'Turbaco', 'Arjona', 'El Carmen de Bolívar', 'Mompox', 'San Juan Nepomuceno', 'Santa Rosa del Sur', 'Simití', 'San Jacinto'],
            'Boyacá' => ['Tunja', 'Duitama', 'Sogamoso', 'Chiquinquirá', 'Paipa', 'Moniquirá', 'Garagoa', 'Soatá', 'Villa de Leyva', 'Samacá'],
            'Bogotá' => ['Bogotá', 'Usaquén', 'Chapinero', 'Santa Fé', 'San Cristóbal', 'La Candelaria', 'Los Mártires', 'Antonio Nariño', 'Puente Aranda', 'Barrios Unidos'],
            'Caldas' => ['Manizales', 'La Dorada', 'Chinchiná', 'Villamaría', 'Riosucio', 'Anserma', 'Neira', 'Salamina', 'Supía', 'Aguadas'],
            'Caquetá' => ['Florencia', 'San Vicente del Caguán', 'Puerto Rico', 'El Doncello', 'La Montañita', 'El Paujil', 'Cartagena del Chairá', 'Curillo', 'Solano', 'Albania'],
            'Casanare' => ['Yopal', 'Aguazul', 'Villanueva', 'Tauramena', 'Paz de Ariporo', 'Monterrey', 'Maní', 'Hato Corozal', 'Orocué', 'Nunchía'],
            'Cauca' => ['Popayán', 'Santander de Quilichao', 'Patía', 'Puerto Tejada', 'Piendamó', 'Toribío', 'Morales', 'Inzá', 'El Tambo', 'Guapi'],
            'Cesar' => ['Valledupar', 'Aguachica', 'La Jagua de Ibirico', 'Bosconia', 'Curumaní', 'El Copey', 'Chiriguaná', 'San Diego', 'Codazzi', 'Manaure Balcón del Cesar'],
            'Chocó' => ['Quibdó', 'Istmina', 'Tadó', 'Condoto', 'Bahía Solano', 'Nuquí', 'Unguía', 'Acandí', 'Lloró', 'Riosucio'],
            'Córdoba' => ['Montería', 'Cereté', 'Sahagún', 'Lorica', 'Montelíbano', 'Planeta Rica', 'Tierralta', 'Chinú', 'Ciénaga de Oro', 'San Antero'],
            'Cundinamarca' => ['Soacha', 'Fusagasugá', 'Zipaquirá', 'Girardot', 'Chía', 'Facatativá', 'Cajicá', 'Mosquera', 'La Calera', 'Madrid'],
            'Guainía' => ['Inírida', 'Barranco Minas', 'Cacahual', 'La Guadalupe', 'Mapiripana', 'Morichal', 'Pana Pana', 'San Felipe', 'Puerto Colombia', 'Amanavén'],
            'Guaviare' => ['San José del Guaviare', 'Calamar', 'El Retorno', 'Miraflores', 'Chiribiquete', 'La Libertad', 'El Capricho', 'Nare', 'Puerto Nuevo', 'Charras'],
            'Huila' => ['Neiva', 'Pitalito', 'Garzón', 'La Plata', 'San Agustín', 'Algeciras', 'Campoalegre', 'Gigante', 'Tello', 'Isnos'],
            'La Guajira' => ['Riohacha', 'Maicao', 'Uribia', 'Fonseca', 'San Juan del Cesar', 'Manaure', 'Albania', 'Hatonuevo', 'Villanueva', 'Dibulla'],
            'Magdalena' => ['Santa Marta', 'Ciénaga', 'Fundación', 'Aracataca', 'El Banco', 'Plato', 'Pivijay', 'Zona Bananera', 'Sitionuevo', 'Tenerife'],
            'Meta' => ['Villavicencio', 'Acacías', 'Granada', 'Puerto López', 'Cumaral', 'San Martín', 'Restrepo', 'Guamal', 'Castilla la Nueva', 'Vista Hermosa'],
            'Nariño' => ['Pasto', 'Tumaco', 'Ipiales', 'Túquerres', 'La Unión', 'Samaniego', 'Aldana', 'Sandoná', 'Guachucal', 'El Charco'],
            'Norte de Santander' => ['Cúcuta', 'Ocaña', 'Pamplona', 'Villa del Rosario', 'Tibú', 'Los Patios', 'El Zulia', 'Ábrego', 'Sardinata', 'Chinácota'],
            'Putumayo' => ['Mocoa', 'Puerto Asís', 'Orito', 'Valle del Guamuez', 'Villagarzón', 'Sibundoy', 'San Francisco', 'Colón', 'Puerto Leguízamo', 'Santiago'],
            'Quindío' => ['Armenia', 'Calarcá', 'Montenegro', 'Quimbaya', 'La Tebaida', 'Circasia', 'Salento', 'Génova', 'Filandia', 'Pijao'],
            'Risaralda' => ['Pereira', 'Dosquebradas', 'Santa Rosa de Cabal', 'La Virginia', 'Marsella', 'Belén de Umbría', 'Apía', 'Quinchía', 'Mistrató', 'Pueblo Rico'],
            'San Andrés' => ['San Andrés', 'Providencia', 'Santa Catalina', 'La Loma', 'San Luis', 'El Cove', 'San Francisco', 'La Rocosa', 'Sound Bay', 'Barrack'],
            'Santander' => ['Bucaramanga', 'Floridablanca', 'Girón', 'Piedecuesta', 'Barrancabermeja', 'Socorro', 'San Gil', 'Vélez', 'Rionegro', 'Barbosa'],
            'Sucre' => ['Sincelejo', 'Corozal', 'Sampués', 'Sincé', 'San Marcos', 'Tolú', 'Coveñas', 'Morroa', 'Ovejas', 'Los Palmitos'],
            'Tolima' => ['Ibagué', 'Espinal', 'Melgar', 'Honda', 'Chaparral', 'Líbano', 'Mariquita', 'El Espinal', 'Ortega', 'Guamo'],
            'Valle del Cauca' => ['Cali', 'Palmira', 'Buenaventura', 'Tuluá', 'Buga', 'Jamundí', 'Yumbo', 'Cartago', 'Candelaria', 'Zarzal'],
            'Vaupés' => ['Mitú', 'Carurú', 'Taraira', 'Pacoa', 'Papunahua', 'Yavaraté', 'Villa Fátima', 'Buenos Aires', 'Monforth', 'Santa Cruz'],
            'Vichada' => ['Puerto Carreño', 'Cumaribo', 'La Primavera', 'Santa Rosalía', 'San José de Ocune', 'Santa Teresita', 'Bocas del Tomo', 'El Tapón', 'Güerima', 'San Benito de Vichada']
        ];

        $ciudades = [];
        
       foreach ($departamentosCiudades as $departamentoNombre => $ciudadesNombres) {
        $departamento = Departamento::where('nombre', $departamentoNombre)->first();

        if ($departamento) {
            foreach ($ciudadesNombres as $ciudadNombre) {
                Ciudad::updateOrCreate(
                    ['nombre' => $ciudadNombre, 'departamento_id' => $departamento->id],
                    ['nombre' => $ciudadNombre]
                );
            }
        }
    }
        // Mass insertion in batches of 500
        collect($ciudades)->chunk(500)->each(function ($chunk) {
            Ciudad::upsert(
                $chunk->toArray(),
                ['nombre', 'departamento_id'],
                ['nombre']
            );
        });
    }
}