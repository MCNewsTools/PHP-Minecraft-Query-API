<?php
/*
    PHP Minecraft Query API
    https://github.com/MCServerStatus/PHP-Minecraft-Query-API
*/
use xPaw\MinecraftPing;
use xPaw\MinecraftPingException;

require __DIR__ . '/src/MinecraftPing.php';
require __DIR__ . '/src/MinecraftPingException.php';

$Timer = MicroTime( true );

$InfoPing = false;
$QueryPing = null;

try
{
    $QueryPing = new MinecraftPing( MQ_SERVER_ADDR, MQ_SERVER_PORT, MQ_TIMEOUT );
    
    $InfoPing = $QueryPing->Query( );
    
    if( $InfoPing === false )
    {
        $QueryPing->Close( );
        $QueryPing->Connect( );
        
        $InfoPing = $QueryPing->QueryOldPre17( );
    }
}
catch( MinecraftPingException $e )
{
    $Exception = $e;
}

if( $QueryPing !== null )
{
    $QueryPing->Close( );
}

$Timer = Number_Format( MicroTime( true ) - $Timer, 4, '.', '' );
?>