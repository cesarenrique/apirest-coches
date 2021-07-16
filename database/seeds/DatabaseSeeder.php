<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Pais;
use App\Provincia;
use App\Localidad;
use App\Agencia;
use App\Seguro;
use App\TipoCoche;
use App\Coche;
use App\Temporada;
use App\Alojamiento;
use App\Fecha;
use App\Cliente;
use App\Tarjeta;
use App\Reserva;
use Faker\Generator;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS= 0');

        User::truncate();
        Pais::truncate();
        Provincia::truncate();
        Localidad::truncate();
        Agencia::truncate();
        Seguro::truncate();
        TipoCoche::truncate();
        Coche::truncate();
        Temporada::truncate();
        Alojamiento::truncate();
        Fecha::truncate();
        Cliente::truncate();
        Tarjeta::truncate();
        Reserva::truncate();

        $cantidadUsuarios=20;
        $cantidadAgenciaes=100;
        $cantidadSeguro=100;
        $cantidadTipoCoche=100;
        $cantidadCochees=1000;
        $cantidadClientes=3000;
        $cantidadTarjetas=5000;
        $cantidadReservas=500;
        User::flushEventListeners();

        DB::statement('SET FOREIGN_KEY_CHECKS= 1');

        factory(User::class,$cantidadUsuarios)->create();
        DatabaseSeeder::rellenarLugares();
        factory(Agencia::class,$cantidadAgenciaes)->create();
        DatabaseSeeder::rellenarIdAgenciaes();
        factory(Seguro::class,$cantidadSeguro)->create();
        DatabaseSeeder::rellenarIdAgenciaes2();
        factory(TipoCoche::class,$cantidadTipoCoche)->create();
        factory(Coche::class,$cantidadCochees)->create();
        DatabaseSeeder::rellenarTemporada();
        $faker= Faker\Factory::create();
        DatabaseSeeder::rellenarAlojamiento($faker);
        DatabaseSeeder::rellenarFecha();
        factory(Cliente::class,$cantidadClientes)->create();
        factory(Tarjeta::class,$cantidadTarjetas)->create();
        factory(Reserva::class,$cantidadReservas)->create();
    }

    public function rellenarLugares(){


      DB::statement("INSERT INTO pais(id,nombre) VALUES (1,'Espanya')");


      DB::statement("INSERT INTO provincias (id, nombre,Pais_id) VALUES(1,'Araba/Álava',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(2, 'Albacete',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(3, 'Alicante/Alacant',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(4, 'Almería',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(5, 'Ávila',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(6, 'Badajoz',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(7, 'Illes Balears',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(8, 'Barcelona',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(9, 'Burgos',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(10, 'Cáceres',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(11, 'Cádiz',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(12, 'Castellón/Castelló',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(13, 'Ciudad Real',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(14, 'Córdoba',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(15, 'A Coruña',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(16, 'Cuenca',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(17, 'Girona',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(18, 'Granada',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(19, 'Guadalajara',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(20, 'Gipuzkoa',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(21, 'Huelva',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(22, 'Huesca',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(23, 'Jaén',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(24, 'León',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(25, 'Lleida',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(26, 'La Rioja',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(27, 'Lugo',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(28, 'Madrid',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(29, 'Málaga',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(30, 'Murcia',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(31, 'Navarra',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(32, 'Ourense',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(33, 'Asturias',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(34, 'Palencia',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(35, 'Las Palmas',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(36, 'Pontevedra',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(37, 'Salamanca',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(38, 'Santa Cruz de Tenerife',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(39, 'Cantabria',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(40, 'Segovia',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(41, 'Sevilla',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(42, 'Soria',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(43, 'Tarragona',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(44, 'Teruel',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(45, 'Toledo',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(46, 'Valencia/València',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(47, 'Valladolid',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(48, 'Bizkaia',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(49, 'Zamora',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(50, 'Zaragoza',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(51, 'Ceuta',1)");
      DB::statement("INSERT INTO provincias (id, nombre, Pais_id) VALUES(52, 'Melilla',1)");

      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(1,'Vitoria',1)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(2, 'Albacete',2)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(3, 'Alicante/Alacant',3)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(4, 'Almería',4)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(5, 'Ávila',5)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(6, 'Badajoz',6)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(7, 'Illes Balears',7)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(8, 'Barcelona',8)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(9, 'Burgos',9)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(10, 'Cáceres',10)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(11, 'Cádiz',11)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(12, 'Castellón de la Plana',12)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(13, 'Ciudad Real',13)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(14, 'Córdoba',14)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(15, 'La Coruña',15)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(16, 'Cuenca',16)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(17, 'Girona',17)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(18, 'Granada',18)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(19, 'Guadalajara',19)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(20, 'San Sebatián',20)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(21, 'Huelva',21)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(22, 'Huesca',22)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(23, 'Jaén',23)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(24, 'León',24)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(25, 'Lleida',25)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(26, 'Logronyo',26)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(27, 'Lugo',27)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(28, 'Madrid',28)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(29, 'Málaga',29)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(30, 'Murcia',30)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(31, 'Pamplona',31)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(32, 'Ourense',32)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(33, 'Oviedo',33)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(34, 'Palencia',34)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(35, 'Las Palmas',35)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(36, 'Pontevedra',36)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(37, 'Salamanca',37)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(38, 'Santa Cruz de Tenerife',38)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(39, 'Santander',39)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(40, 'Segovia',40)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(41, 'Sevilla',41)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(42, 'Soria',42)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(43, 'Tarragona',43)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(44, 'Teruel',44)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(45, 'Toledo',45)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(46, 'Valencia',46)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(47, 'Valladolid',47)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(48, 'Bilbao',48)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(49, 'Zamora',49)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(50, 'Zaragoza',50)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(51, 'Ceuta',51)");
      DB::statement("INSERT INTO localidads (id, nombre, Provincia_id) VALUES(52, 'Melilla',52)");
    }

    public function rellenarIdAgenciaes(){
      $Agenciaes=Agencia::All();

      foreach ($Agenciaes as $Agencia) {

        DB::statement(' Insert into Seguros (tipo,Agencia_id) values ("'.Seguro::SIN_SEGURO.'",'.$Agencia->id.')');

      }

    }

    public function rellenarIdAgenciaes2(){
      $Agenciaes=Agencia::All();

      foreach ($Agenciaes as $Agencia) {

        DB::statement(' Insert into tipo_Coches (tipo,Agencia_id) values ("'.TipoCoche::COCHE_NORMAL.'",'.$Agencia->id.')');

      }

    }

    public function rellenarTemporada(){

      $Agenciaes=Agencia::All();

      $fecha_ini1=DateTime::createFromFormat('Y-m-d',Temporada::INICIAL1);
      $fecha_ini2=DateTime::createFromFormat('Y-m-d',Temporada::INICIAL2);
      $fecha_ini3=DateTime::createFromFormat('Y-m-d',Temporada::INICIAL3);
      $fecha_ini4=DateTime::createFromFormat('Y-m-d',Temporada::INICIAL4);
      $fecha_fin1=date_modify(DateTime::createFromFormat('Y-m-d',Temporada::INICIAL2),'-1 day');
      $fecha_fin2=date_modify(DateTime::createFromFormat('Y-m-d',Temporada::INICIAL3),'-1 day');
      $fecha_fin3=date_modify(DateTime::createFromFormat('Y-m-d',Temporada::INICIAL4),'-1 day');
      $fecha_fin4=DateTime::createFromFormat('Y-m-d',Temporada::FIN);
      foreach ($Agenciaes as $Agencia) {
        DB::statement(' Insert into temporadas (tipo,fecha_desde,fecha_hasta,Agencia_id) values ("'.Temporada::TEMPORADA_BAJA.'","'.date_format($fecha_ini1,'Y-m-d').'","'.date_format($fecha_fin1,'Y-m-d').'",'.$Agencia->id.')');
        DB::statement(' Insert into temporadas (tipo,fecha_desde,fecha_hasta,Agencia_id) values ("'.Temporada::TEMPORADA_BAJA.'","'.date_format($fecha_ini2,'Y-m-d').'","'.date_format($fecha_fin2,'Y-m-d').'",'.$Agencia->id.')');
        DB::statement(' Insert into temporadas (tipo,fecha_desde,fecha_hasta,Agencia_id) values ("'.Temporada::TEMPORADA_ALTA.'","'.date_format($fecha_ini3,'Y-m-d').'","'.date_format($fecha_fin3,'Y-m-d').'",'.$Agencia->id.')');
        DB::statement(' Insert into temporadas (tipo,fecha_desde,fecha_hasta,Agencia_id) values ("'.Temporada::TEMPORADA_MEDIA.'","'.date_format($fecha_ini4,'Y-m-d').'","'.date_format($fecha_fin4,'Y-m-d').'",'.$Agencia->id.')');
      }
    }

    public function rellenarAlojamiento(Faker\Generator $faker){


      $alojamientos=DB::select("select p.id 'Seguro_id',th.id 'tipo_Coche_id',t.id 'Temporada_id', p.Agencia_id
          from Seguros p, tipo_Coches th, temporadas t
            where p.Agencia_id =t.Agencia_id and th.Agencia_id=t.Agencia_id and p.Agencia_id =th.Agencia_id ");



      foreach ($alojamientos as $alojamiento) {
          $precio=strval($faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 2000));
          DB::statement(' Insert into alojamientos (Seguro_id,tipo_coche_id,Temporada_id,precio) values ('.$alojamiento->Seguro_id.','.$alojamiento->tipo_Coche_id.','.$alojamiento->Temporada_id.','.$precio.')');

       }
    }

    public function rellenarFecha(){
      $Agenciaes=Agencia::All();
      $start_date = Fecha::INICIAL;
      $fecha = DateTime::createFromFormat('Y-m-d',$start_date);
      for($i=0;$i<365;$i++){
        foreach ($Agenciaes as $Agencia) {

          DB::statement(' Insert into fechas (abierto,Agencia_id) values ("'.date_format($fecha,'Y-m-d').'",'.$Agencia->id.')');

        }
        $fecha->modify('+1 day');
      }


    }
}
