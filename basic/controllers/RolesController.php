<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        //------------------------------------------------------------------
        //SE CREAN LOS PERMISOS
        // agrega el permiso "crear"
        $crear = $auth->createPermission('crear');
        $crear->description = 'crear ofertas';
        $auth->add($crear);

        // agrega el permiso "modificar"
        $modificar = $auth->createPermission('modificar');
        $modificar->description = 'Modificar oferta';
        $auth->add($modificar);


        // agrega el permiso "eliminar"
        $eliminar = $auth->createPermission('eliminar');
        $eliminar->description = 'Eliminar oferta';
        $auth->add($eliminar);

        // agrega el permiso "consultar"
        $consultar = $auth->createPermission('consultar');
        $consultar->description = 'Consultar oferta';
        $auth->add($consultar);

        // agrega el permiso "buscar"
        $buscar = $auth->createPermission('buscar');
        $buscar->description = 'Buscar ofertas';
        $auth->add($buscar);
        //-----------------------------------------------------------------


        //-----------------------------------------------------------------
        //SE CREAN LOS ROLES Y SE ASIGNAN LOS PERMISOS
        // agrega el rol "invitado" y le asigna el permiso "consultar y buscar"
        $invitado = $auth->createRole('invitado');
        $auth->add($invitado);
        $auth->addChild($invitado, $consultar);
        $auth->addChild($invitado, $buscar);

        // agrega el rol "usuario" y le agrega todos los permisos de invitado mas crear
        $usuario = $auth->createRole('usuario');
        $auth->add($usuario);
        $auth->addChild($usuario, $invitado);
        $auth->addChild($usuario, $crear);

        // agrega el rol "patrocinador" con los mismos permisos que usuario
        $patrocinador = $auth->createRole('patrocinador');
        $auth->add($patrocinador);
        $auth->addChild($patrocinador, $usuario);

        // agrega el rol "moderador" y le agrega todos los permisos de usuario mas eliminar
        $moderador = $auth->createRole('moderador');
        $auth->add($moderador);
        $auth->addChild($moderador, $usuario);
        $auth->addChild($moderador, $eliminar);



         // agrega el rol "admin" y le agrega todos los permisos de moderador mas modificar
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $moderador);
        $auth->addChild($admin, $eliminar);



        // agrega el rol "sysadmin" y le agrega todos los permisos de moderador mas modificar
        $sysadmin = $auth->createRole('sysadmin');
        $auth->add($sysadmin);
        $auth->addChild($sysadmin, $admin);







    }
}

?>