<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use App\Localidad;
use App\Agencia;
use App\Seguro;
use App\TipoCoche;
use App\Cliente;
use App\Tarjeta;
use App\Alojamiento;
use App\Fecha;
use App\Temporada;
use App\Reserva;
use App\Coche;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
  static $password;

  return [
      'name' => $faker->name,
      'email' => $faker->unique()->safeEmail,
      'password' => $password ?: $password = bcrypt('secret'),
      'remember_token' => Str::random(10),
      'verified'=> $verificado= $faker->randomElement([User::USUARIO_VERIFICADO,User::USUARIO_NO_VERIFICADO]),
      'verify_Token'=> $verificado== User::USUARIO_VERIFICADO ? null : User::generateVerificationToken(),
      'tipo_usuario' => $faker->randomElement([User::USUARIO_CLIENTE,User::USUARIO_EDITOR,User::USUARIO_ADMINISTRADOR]),
  ];
});

$factory->define(App\Agencia::class, function (Faker $faker) {
    $localidad= Localidad::All()->random();
    $values="";
    for($i=0;$i<8;$i++){
      $aux=$faker->randomDigit;
      $values=$values .  strval($aux);
    }
    $numero=intval($values);
    $resto=$numero%23;
    $letra=array('T','R','W','A','G','M','Y','F','P','D','X','B',
                'N','J','Z','S','Q','V','H','L','C','K','E');
    $values=$values. $letra[$resto];
    return [
      'nombre' => $faker->name,
      'NIF' => $values,
      'Localidad_id'=> $localidad->id,
    ];
});
$factory->define(App\Seguro::class, function (Faker $faker) {
    $Agencia=Agencia::All()->random();
    return [
       'tipo'=> $faker->randomElement([Seguro::SEGURO_TERCEROS,Seguro::SEGURO_TODORIESGO,Seguro::SEGURO_TODORIESGOPLUS]),
       'Agencia_id'=>$Agencia->id,
    ];
});

$factory->define(App\TipoCoche::class, function (Faker $faker) {
    $Agencia=Agencia::All()->random();
    return [
       'tipo'=> $faker->randomElement([TipoCoche::COCHE_SIMPLE,TipoCoche::COCHE_DEPORTIVO,TipoCoche::COCHE_FAMILIAR]),
       'Agencia_id'=>$Agencia->id,
    ];
});

$factory->define(App\Coche::class, function (Faker $faker) {
    $Agencia= Agencia::All()->random();
    $tipo= $faker->randomElement(TipoCoche::where('Agencia_id',$Agencia->id)->get());
    $numero=0;
    $numero=$faker->numberBetween($min=1,$max=400);
    $ceros="";
    if($numero<10) $ceros="00";
    if(10<$numero && $numero<100) $ceros="0";
    $numero2=$ceros.$numero;
    return [
       'numero'=> $numero2,
       'Agencia_id'=> $Agencia->id,
       'tipo_Coche_id'=> $tipo->id,
     ];
});

$factory->define(App\Cliente::class, function (Faker $faker) {
  $values="";
  for($i=0;$i<8;$i++){
    $aux=$faker->randomDigit;
    $values=$values .  strval($aux);
  }
  $numero=intval($values);
  $resto=$numero%23;
  $letra=array('T','R','W','A','G','M','Y','F','P','D','X','B',
              'N','J','Z','S','Q','V','H','L','C','K','E');
  $values=$values. $letra[$resto];

  return [
     'NIF'=> $values,
     'nombre'=> $faker->name,
     'email'=> $faker->unique()->email,
     'telefono'=> $faker->phoneNumber,

  ];
});
$factory->define(App\Tarjeta::class, function (Faker $faker) {
    $cliente=Cliente::All()->random();

    return [
       'numero'=> $faker->creditCardNumber,
       'Cliente_id'=> $cliente->id,

    ];
});

$factory->define(App\Reserva::class, function (Faker $faker) {
    $tarjeta=Tarjeta::All()->random();
    $cliente=Cliente::find($tarjeta->Cliente_id);
    $Coche=Coche::All()->random();
    $temporada=Temporada::where('Agencia_id',$Coche->Agencia_id)->get()->random();
    $fecha=Fecha::where('Agencia_id',$Coche->Agencia_id)
            ->whereBetween('abierto',[$temporada->fecha_desde,$temporada->fecha_hasta])
            ->get()->random();
    $Seguro=Seguro::where('Agencia_id',$Coche->Agencia_id)->get()->random();

    $alojamiento=Alojamiento::where('Temporada_id',$temporada->id)
      ->where('Seguro_id',$Seguro->id)
      ->where('tipo_Coche_id',$Coche->tipo_Coche_id)
      ->get()->random();
    return [

      'reservado'=> Reserva::RESERVADO,
      'estado'=> Reserva::PAGADO_TOTALMENTE,
      'pagado'=> $alojamiento->precio,
      'Fecha_id'=> $fecha->id,
      'Alojamiento_id'=> $alojamiento->id,
      'Coche_id'=> $Coche->id,
      'Cliente_id'=>$cliente->id,

    ];
});
