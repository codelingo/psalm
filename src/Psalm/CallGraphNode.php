<?php
namespace Psalm;

class location {
    public $start_offset;
    public $end_offset;

    public $file_name;

    public function __construct($internalLocation) {
        list($this->start_offset, $this->end_offset) = $internalLocation->getSelectionBounds();
        $this->file_name = $internalLocation->file_name;
    }
}

class CallGraphNode {
    public $to = []; // referenceLocations
    public $from; // definitionLocation

    public function __construct($def, $refs) {
        $this->from = new location($def);
        foreach ($refs as $refset) {
            foreach ($refset as $ref) {
                $this->to[] = new location($ref);
            }
        }
    }

    public function print() {
        $json = json_encode($this, JSON_UNESCAPED_UNICODE);
        print $json . "\r\n";
    }
}
