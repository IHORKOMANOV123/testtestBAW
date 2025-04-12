<?php
class CalcForm {
    public $kwota;
    public $lat;
    public $procent;

    public function loadFromRequest() {
        $this->kwota = isset($_POST['kwota']) ? $_POST['kwota'] : null;
        $this->lat = isset($_POST['lat']) ? $_POST['lat'] : null;
        $this->procent = isset($_POST['procent']) ? $_POST['procent'] : null;
    }
}
?>
