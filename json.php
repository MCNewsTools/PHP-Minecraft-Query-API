<?php
/*
    PHP Minecraft Query API
    https://github.com/MCServerStatus/PHP-Minecraft-Query-API
*/
header('Content-type:text/json');

$host = $_GET['host'];
$port = $_GET['port'];

require_once 'ApiQuery.php';
require_once 'ApiPing.php';

require_once 'closeTags.php';

if (($Info = $Query->GetInfo()) !== false) {
    $hostNameHtml = str_replace("§k", "", $Info['HostName']);
    $hostNameHtml = str_replace("§l", "", $hostNameHtml);
    $hostNameHtml = str_replace("§m", "", $hostNameHtml);
    $hostNameHtml = str_replace("§n", "", $hostNameHtml);
    $hostNameHtml = str_replace("§o", "", $hostNameHtml);
    $hostNameHtml = str_replace("§r", '<font color="#">', $hostNameHtml);
    $hostNameHtml = str_replace("§0", '<font color="#000000">', $hostNameHtml);
    $hostNameHtml = str_replace("§1", '<font color="#0000AA">', $hostNameHtml);
    $hostNameHtml = str_replace("§2", '<font color="#00AA00">', $hostNameHtml);
    $hostNameHtml = str_replace("§3", '<font color="#00AAAA">', $hostNameHtml);
    $hostNameHtml = str_replace("§4", '<font color="#AA0000">', $hostNameHtml);
    $hostNameHtml = str_replace("§5", '<font color="#AA00AA">', $hostNameHtml);
    $hostNameHtml = str_replace("§6", '<font color="#FFAA00">', $hostNameHtml);
    $hostNameHtml = str_replace("§7", '<font color="#AAAAAA">', $hostNameHtml);
    $hostNameHtml = str_replace("§8", '<font color="#555555">', $hostNameHtml);
    $hostNameHtml = str_replace("§9", '<font color="#5555FF">', $hostNameHtml);
    $hostNameHtml = str_replace("§a", '<font color="#55FF55">', $hostNameHtml);
    $hostNameHtml = str_replace("§b", '<font color="#55FFFF">', $hostNameHtml);
    $hostNameHtml = str_replace("§c", '<font color="#FF5555">', $hostNameHtml);
    $hostNameHtml = str_replace("§d", '<font color="#FF55FF">', $hostNameHtml);
    $hostNameHtml = str_replace("§e", '<font color="#FFFF55">', $hostNameHtml);
    $hostNameHtml = str_replace("§f", '<font color="#FFFFFF">', $hostNameHtml);

    $cleanHostName = str_replace(array("§k", "§l", "§m", "§n", "§o", "§r", "§0", "§1", "§2", "§3", "§4", "§5", "§6", "§7", "§8", "§9", "§a", "§b", "§c", "§d", "§e", "§f"), "", $Info['HostName']);

    if ($Info['GameName'] == 'MINECRAFT') {
        $platform = 'Minecraft: Java Edition';
    } else if ($Info['GameName'] == 'MINECRAFTPE') {
        $platform = 'Minecraft: Bedrock Edition';
    } else {
        $platform = $Info['GameName'];
    }
    
    $playerList = array( );
	if ( !empty( $InfoPing['players']['sample'] ) ) {
		$playerList = $InfoPing['players']['sample'];
	}
	
	$pluginList = array( );
	if ( !empty( $Info['Plugins'] ) ) {
		$pluginList = $Info['Plugins'];
	}

    $json = array(
        'status' => 'Online',
        'platform' => $platform,
        'gametype' => $Info['GameType'],
        'motd' => array(
            'ingame' => $Info['HostName'],
            'clean' => $cleanHostName,
            'html' => closeTags($hostNameHtml)
        ),
        'host' => array(
            'host' => $host,
            'hostip' => $Info['HostIp'],
            'port' => $Info['HostPort']
        ),
        'players' => array(
            'max' => $Info['MaxPlayers'],
            'online' => $Info['Players'],
            'list' => $playerList
        ),
        'version' => array(
            'version' => $Info['Version'],
            'software' => $Info['Software']
        ),
        'Plugins' => $pluginList,
        'queryinfo' => array(
            'agreement' => 'Query',
            'processed' => $Timer
        )
    );
} else if ($InfoPing !== false){
    $version = explode(" ", $InfoPing['version']['name'], 2);
    $hostNameHtml = str_replace("§k", "", $InfoPing['description']);
    $hostNameHtml = str_replace("§l", "", $hostNameHtml);
    $hostNameHtml = str_replace("§m", "", $hostNameHtml);
    $hostNameHtml = str_replace("§n", "", $hostNameHtml);
    $hostNameHtml = str_replace("§o", "", $hostNameHtml);
    $hostNameHtml = str_replace("§r", '<font color="#">', $hostNameHtml);
    $hostNameHtml = str_replace("§0", '<font color="#000000">', $hostNameHtml);
    $hostNameHtml = str_replace("§1", '<font color="#0000AA">', $hostNameHtml);
    $hostNameHtml = str_replace("§2", '<font color="#00AA00">', $hostNameHtml);
    $hostNameHtml = str_replace("§3", '<font color="#00AAAA">', $hostNameHtml);
    $hostNameHtml = str_replace("§4", '<font color="#AA0000">', $hostNameHtml);
    $hostNameHtml = str_replace("§5", '<font color="#AA00AA">', $hostNameHtml);
    $hostNameHtml = str_replace("§6", '<font color="#FFAA00">', $hostNameHtml);
    $hostNameHtml = str_replace("§7", '<font color="#AAAAAA">', $hostNameHtml);
    $hostNameHtml = str_replace("§8", '<font color="#555555">', $hostNameHtml);
    $hostNameHtml = str_replace("§9", '<font color="#5555FF">', $hostNameHtml);
    $hostNameHtml = str_replace("§a", '<font color="#55FF55">', $hostNameHtml);
    $hostNameHtml = str_replace("§b", '<font color="#55FFFF">', $hostNameHtml);
    $hostNameHtml = str_replace("§c", '<font color="#FF5555">', $hostNameHtml);
    $hostNameHtml = str_replace("§d", '<font color="#FF55FF">', $hostNameHtml);
    $hostNameHtml = str_replace("§e", '<font color="#FFFF55">', $hostNameHtml);
    $hostNameHtml = str_replace("§f", '<font color="#FFFFFF">', $hostNameHtml);

    $cleanHostName = str_replace(array("§k", "§l", "§m", "§n", "§o", "§r", "§0", "§1", "§2", "§3", "§4", "§5", "§6", "§7", "§8", "§9", "§a", "§b", "§c", "§d", "§e", "§f"), "", $InfoPing['description']);

    $json = array(
        'status' => 'Online',
        'motd' => array(
            'ingame' => $InfoPing['description'],
            'clean' => $cleanHostName,
            'html' => closeTags($hostNameHtml)
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
