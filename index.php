<?php
$memcache = new Memcache();
$memcache->connect('127.0.0.1', 11211) or die ("Could not connect");
$list = array();
$allSlabs = $memcache->getExtendedStats('slabs');
$items = $memcache->getExtendedStats('items');
foreach($allSlabs as $server => $slabs) {
    foreach($slabs AS $slabId => $slabMeta) {
        if (!is_int($slabId)) {
            continue;
        }
        $cdump = $memcache->getExtendedStats('cachedump', (int) $slabId, 100000000);
        foreach($cdump AS $server => $entries) {
            if ($entries) {
                foreach($entries AS $eName => $eData) {
                    print_r($eName);
                    print_r(":");
                    $val = $memcache->get($eName);
                    print_r($val);
                    print_r("\n");
                }
            }
        }
    }
}
?>
