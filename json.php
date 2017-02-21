<?php
/*
    PHP Minecraft Query API
    https://github.com/MCServerStatus/PHP-Minecraft-Query-API
*/
header('Content-type:text/json');

$host = $_GET['host'];
$port = $_GET['port'];

require 'ApiQuery.php';
require 'ApiPing.php';

if (($Info = $Query->GetInfo()) !== false){
    $CleanHostName = str_replace("§k","",$Info['HostName']);
    $CleanHostName = str_replace("§l","",$CleanHostName);
    $CleanHostName = str_replace("§m","",$CleanHostName);
    $CleanHostName = str_replace("§n","",$CleanHostName);
    $CleanHostName = str_replace("§o","",$CleanHostName);
    $CleanHostName = str_replace("§r","",$CleanHostName);
    $CleanHostName = str_replace("§1","",$CleanHostName);
    $CleanHostName = str_replace("§2","",$CleanHostName);
    $CleanHostName = str_replace("§3","",$CleanHostName);
    $CleanHostName = str_replace("§4","",$CleanHostName);
    $CleanHostName = str_replace("§5","",$CleanHostName);
    $CleanHostName = str_replace("§6","",$CleanHostName);
    $CleanHostName = str_replace("§7","",$CleanHostName);
    $CleanHostName = str_replace("§8","",$CleanHostName);
    $CleanHostName = str_replace("§9","",$CleanHostName);
    $CleanHostName = str_replace("§a","",$CleanHostName);
    $CleanHostName = str_replace("§b","",$CleanHostName);
    $CleanHostName = str_replace("§c","",$CleanHostName);
    $CleanHostName = str_replace("§d","",$CleanHostName);
    $CleanHostName = str_replace("§e","",$CleanHostName);
    $CleanHostName = str_replace("§f","",$CleanHostName);
    if ($Info['GameName'] == 'MINECRAFT') {
        $json = array(
            'status' => 'Online',
            'platform' => 'Minecraft',
            'gametype' => $Info['GameType'],
            'motd' => array(
                'motd' => $Info['HostName'],
                'clean_motd' => $CleanHostName
            ),
            'host' => array(
                'host' => $host,
                'hostip' => $Info['HostIp'],
                'port' => $Info['HostPort']
            ),
            'players' => array(
                'max' => $Info['MaxPlayers'],
                'online' => $Info['Players']
            ),
            'version' => array(
                'version' => $Info['Version'],
                'software' => $Info['Software']
            ),
            'queryinfo' => array(
                'agreement' => 'Query',
                'processed' => $Timer
            )
        );
    } else if ($Info['GameName'] == 'MINECRAFTPE') {
        $json = array(
            'status' => 'Online',
            'platform' => 'Minecraft: Pocket Edition',
            'gametype' => $Info['GameType'],
            'motd' => array(
                'motd' => $Info['HostName'],
                'clean_motd' => $CleanHostName
            ),
            'host' => array(
                'host' => $host,
                'hostip' => $Info['HostIp'],
                'port' => $Info['HostPort']
            ),
            'players' => array(
                'max' => $Info['MaxPlayers'],
                'online' => $Info['Players']
            ),
            'version' => array(
                'version' => $Info['Version'],
                'software' => $Info['Software']
            ),
            'queryinfo' => array(
                'agreement' => 'Query',
                'processed' => $Timer
            )
        );
    } else {
        $json = array(
            'status' => 'Online',
            'platform' => $Info['GameName'],
            'gametype' => $Info['GameType'],
            'motd' => array(
                'motd' => $Info['HostName'],
                'clean_motd' => $CleanHostName
            ),
            'host' => array(
                'host' => $host,
                'hostip' => $Info['HostIp'],
                'port' => $Info['HostPort']
            ),
            'players' => array(
                'max' => $Info['MaxPlayers'],
                'online' => $Info['Players']
            ),
            'version' => array(
                'version' => $Info['Version'],
                'software' => $Info['Software']
            ),
            'queryinfo' => array(
                'agreement' => 'Query',
                'processed' => $Timer
            )
        );
    }
} else if ($InfoPing !== false){
    $version = explode(" ",$InfoPing['version']['name'],2);
    $CleanHostName = str_replace("§k","",$InfoPing['description']);
    $CleanHostName = str_replace("§l","",$CleanHostName);
    $CleanHostName = str_replace("§m","",$CleanHostName);
    $CleanHostName = str_replace("§n","",$CleanHostName);
    $CleanHostName = str_replace("§o","",$CleanHostName);
    $CleanHostName = str_replace("§r","",$CleanHostName);
    $CleanHostName = str_replace("§1","",$CleanHostName);
    $CleanHostName = str_replace("§2","",$CleanHostName);
    $CleanHostName = str_replace("§3","",$CleanHostName);
    $CleanHostName = str_replace("§4","",$CleanHostName);
    $CleanHostName = str_replace("§5","",$CleanHostName);
    $CleanHostName = str_replace("§6","",$CleanHostName);
    $CleanHostName = str_replace("§7","",$CleanHostName);
    $CleanHostName = str_replace("§8","",$CleanHostName);
    $CleanHostName = str_replace("§9","",$CleanHostName);
    $CleanHostName = str_replace("§a","",$CleanHostName);
    $CleanHostName = str_replace("§b","",$CleanHostName);
    $CleanHostName = str_replace("§c","",$CleanHostName);
    $CleanHostName = str_replace("§d","",$CleanHostName);
    $CleanHostName = str_replace("§e","",$CleanHostName);
    $CleanHostName = str_replace("§f","",$CleanHostName);
    $json = array(
        'status' => 'Online',
        'motd' => array(
            'motd' => $InfoPing['description'],
            'clean_motd' => $CleanHostName
        ),
        'host' => array(
            'host' => $host,
            'port' => $port
        ),
        'players' => array(
            'max' => $InfoPing['players']['max'],
            'online' => $InfoPing['players']['online']
        ),
        'version' => array(
            'version' => $version[1],
            'protocol' => $InfoPing['version']['protocol']
        ),
        'queryinfo' => array(
            'agreement' => 'Ping',
            'processed' => $Timer
        )
    );
} else {
    $json = array(
        'status' => 'Offline',
        'host' => $host,
        'port' => $port
    );
}
echo json_encode($json, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);
?>