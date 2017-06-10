<?php
/** @var module $this */
foreach ($this->bluestats->plugins as $plugin) {
    /** @var \BlueStats\API\plugin $plugin */
    if (!$plugin::$isMySQLplugin)
        break;
    echo "<h2>{$plugin->name}</h2><div class='row'>";
    foreach ($plugin->database['stats'] as $stat => $info) {
        echo "<div class='col-md-6'><h3>$info[name]</h3>";

        $table = new Table();

        $options = [
          "selectMethod" => $info["summary"]?: "sum"
        ];

        foreach ($plugin->stats->statList($stat, 10, $options) as $row) {
            if ($plugin->database['identifier'] == "id") {
                $username = $plugin->player->getNamefromID($row['id']);
                $uuid     = $plugin->player->getUUIDfromID($row['id']);
            }
            else {
                $username = $plugin->player->getNamefromID($plugin->player->getID($row['id']));
                $uuid     = $row['id'];
            }
            if ($this->bluestats->url->useUUID) {
                $name = "<a href=\"" . $this->bluestats->url->player($uuid) . "\"><img src=\"https://minotar.net/helm/$username/32.png\" alt=\"\"> {$username}</a>";
            }
            else {
                $name = "<a href=\"" . $this->bluestats->url->player($username) . "\"><img src=\"https://minotar.net/helm/$username/32.png\" alt=\"\"> {$username}</a>";
            }
            $table->addRecord(
                $name,
                $row['aggregate']
            );
        }
        $table->makeHeader("Player", $info['name']);

        echo $table->tableToHTML(FALSE);

        echo "</div>";
    }
    echo "</div>";
}